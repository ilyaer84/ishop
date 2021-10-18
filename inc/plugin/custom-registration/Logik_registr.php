<?php 


/*
 шорткод [cr_custom_registration]
or 
<?php custom_registration_function(); ?>
*/

/* *************************
//Хуки 

// К примеру вы хотите добавлять перед логином пользователя последовательность из случайных букв, тогда ваш хук будет выглядеть так:
add_filter( 'pre_user_login', function( $user_login ) {
 
	return substr( str_shuffle( "abcdefghijklmnopqrstuvwxyz" ), 0, 4 ) . '_' . $user_login;
 
});
*/



//************************ */  





// подключаем форму - создаем функцию PHP, которая содержит HTML-код регистрационной формы.
get_template_part('inc\plugin\custom-registration/form_reg');  // // подключит файл php
// get_template_part( 'nav', 'single', [ 'param1' => 'hello', 'param2' => [ 1, 2 ] ] );
//include_once(get_stylesheet_directory() . '/inc/plugin/custom-registration/form_reg.php');




// активирует все созданные нами функции.
function custom_registration_function() {
    if (isset($_POST['submit'])) {
        registration_validation(
        $_POST['username'],
        $_POST['password'],
        $_POST['password_confirmation'],
        $_POST['email'],
        $_POST['city'],
        $_POST['mobile'],
        $_POST['website'],
        $_POST['fname'],
        $_POST['lname'],
        $_POST['nickname'],
        $_POST['uslov_f'],
        $_POST['bio']
		);
        
		// Продолжительность ввода формы пользователя
        global $username, $password, $email, $city, $mobile, $website, $first_name, $last_name, $nickname, $bio;
        $username	= 	sanitize_user($_POST['username']);
        $password 	= 	esc_attr($_POST['password']);
        $password_confirmation 	= 	esc_attr($_POST['password_confirmation']);
        $email 		= 	sanitize_email($_POST['email']);
        $city = 	sanitize_text_field($_POST['city']);
        $mobile = 	sanitize_text_field($_POST['mobile']);
        $website 	= 	esc_url($_POST['website']);
        $first_name = 	sanitize_text_field($_POST['fname']);
        $last_name 	= 	sanitize_text_field($_POST['lname']);
        $nickname 	= 	sanitize_text_field($_POST['nickname']);
        //$uslov_f 		= 	esc_textarea($_POST['uslov_f']);
        $bio 		= 	esc_textarea($_POST['bio']);

		// Вызовите @function comeny_registration, чтобы создать пользователь
        // только тогда, когда нет WP_ERROR не найден
        complete_registration(
        $username,
        $password,
        $password_confirmation,  
        $email,
        $city, 
        $mobile,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $uslov_f, 
        $bio
		);
    }

    registration_form(
    	$username,
        $password,
        $password_confirmation,  
        $email,        
        $city, 
        $mobile,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $uslov_f, 
        $bio
		);
}

  

// Чтобы облегчить процесс проверки, мы используем класс WordPress WP_Error.
function registration_validation( $username, $password, $email, $city, $mobile, $website, $first_name, $last_name, $nickname, $bio )  {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

        //Убедитесь, что имя пользователя присутствует и еще не используется
		if ( strpos($username, ' ') !== false ) { 
            $reg_errors->add('user_name', "Извините, в именах пользователей нельзя использовать пробелы");
		}
                //если поле с именем пользователя пустое
		if(empty($username)) { 
            $reg_errors->add('user_name', "Пожалуйста введите имя пользователя");

		} elseif( username_exists( $username ) ) {
                //если такой пользователь уже зарегистрирован
            $reg_errors->add('user_name', "Имя пользователя уже существует, попробуйте другое");
		}
                //если такойимя пользователь меньше 4 знаков
        if ( strlen( $username ) < 4 ) {
            $reg_errors->add('username_length', 'Имя пользователя слишком короткое.Требуется минимум 4 символа');
        }
                // ликвидность имени
        if ( !validate_username( $username ) ) {
            $reg_errors->add('username_invalid', 'При создании логина пользователь может использовать латинские буквы a-z');
        }

        //проверка на пустоту обязательных полей

    if ( empty( $username ) || empty( $password )   ) {  //  || empty( $email )
        $reg_errors->add('field', 'Отсутствует обязательное поле формы');
    }       

        // Проверка пароля на валидность
    if(0 === preg_match("/.{5,}/", $_POST['password'])){
        $reg_errors->add('password', "Пароль должен состоять не менее чем из 5 (пяти) символов.");
    }  
		// Проверка повторного ввода пароля
		if(0 !== strcmp($_POST['password'], $_POST['password_confirmation'])){
            $reg_errors->add('password_confirmation', "Пароли не совпадают");
    }

        //проверка email
    
    if( email_exists(  $_POST['email'] ) ) {
        $reg_errors->add('email', 'Этот электронный адрес уже занят');
    } elseif ( !empty($_POST['email'] )  ){
        if (!is_email($_POST['email'])) {
        $reg_errors->add('email_valid', 'Некорректный email');
        } 
        }

    // Проверить согласие с условиями обслуживания 
		if($_POST['uslov_f'] != "Yes"){
			$errors['uslov_f'] = "Вы должны согласиться с Условиями использования";
            $reg_errors->add('uslov_f', "Вы должны согласиться с Условиями использования");
		}

    /*
    if ( !empty( $city ) ) {
        if ($city == ''){
            $reg_errors->add('city', 'Город не введен');
        }
    }
*/
    if ( !empty( $mobile ) ) {
        if ($mobile == ''){
            $reg_errors->add('mobile', 'Телефон не введен');
        }
    }
    
    if ( !empty( $website ) ) {
        if ( !filter_var($website, FILTER_VALIDATE_URL) ) {
            $reg_errors->add('website', 'Веб-сайт не является действительным URL');
        }
    }
}

    // выводим ошибки
    if ( is_wp_error( $reg_errors ) ) {

        foreach ( $reg_errors->get_error_messages() as $error ) {
            echo '<div>';
            echo '<strong>ERROR</strong>:';
            echo $error . '<br/>';

            echo '</div>';
        }
    }
}

//отвечает за обработку регистрации пользователей.
function complete_registration() {
    global $reg_errors, $username, $password, $password_confirmation, $email, $city, $mobile, $website, $first_name, $last_name, $nickname, $uslov_f, $bio;
    if ( count($reg_errors->get_error_messages()) < 1 ) {
        $userdata = array(
        'user_login'	=> 	$username,
        'user_email' 	=> 	$email,
        'user_pass' 	=> 	$password,
        'city' 	=> 	$city,
        'mobile' 	=> 	$mobile,
        'user_url' 		=> 	$website,
        'first_name' 	=> 	$first_name,
        'last_name' 	=> 	$last_name,
        'nickname' 		=> 	$nickname,
        'description' 	=> 	$bio,
        //'role'            => '', // (строка) роль пользователя        
        );
        
        $user = wp_insert_user( $userdata );  // Вставляет данные пользователя в Базу Данных. Создает/обновляет пользователя.
//        $new_user_id = wp_create_user( $username, $password, $email ); // Регистрирует нового пользователя. Указываются логин (имя), пароль и email.


        
		// Здесь вы можете делать все, что угодно, например, отправлять электронное письмо пользователю и т. д. 


      // ! записываем в woocomerce
	$customer = new WC_Customer( $user );
	$customer->set_billing_city( $city);
	$customer->set_billing_phone( $mobile );
    $customer->save();
       // echo 'Регистрация завершена. Перейти к <a href="' . get_site_url() . '/wp-login.php">страницe авторизации</a>.';   
  

               // !Авторизуем пользователя

        // Пробуем авторизовать пользователя.

        // Устанавливает/Изменяет текущего пользователя по ID или имени
       // wp_set_current_user( $null, $userdata['user_login'] );  // null  $id

        
        if( $user ) {
            global $user;
            global $password;

            // Получаем ID пользователя по его имени пользователя (логину)

            /*строка) по какому параметру будем определять пользователя. Может принимать значения:
            id — ID пользователя,
            slug — значение user_nicename,
            email — email пользователя,
            login — имя пользователя (логин);
            */
           
             

            $user = get_user_by('login', $username); // Получает пользователя по указанному полю и значению
            
            $user_id = $user->ID;

            echo 'ID ===  ' .   $user_id   . '<br />'; 
            echo 'user_login ' .   $user->user_login   . '<br />';
            echo 'user_pass ' .   $user->user_pass   . '<br />'; 
            echo 'user_pass ' .   $password   . '<br />'; 

      //       wp_set_current_user( $user->ID, $user->user_login );  // null  $id

            

				if ( is_wp_error( $signon ) ) {

					// Авторизовать не получилось
					//$result[ 'status' ] = false;
					//$result[ 'content' ] = $signon->get_error_message();
                    echo '<div>';
                    echo '<strong>ERROR AUTH </strong>:';
                    echo $signon->get_error_message();    
                    echo '</div>';

				} else {

					// Авторизация успешна, устанавливаем необходимые куки.
                    /*
					wp_clear_auth_cookie();
					clean_user_cache( $signon->ID );
					wp_set_current_user( $signon->ID );
					wp_set_auth_cookie( $signon->ID );
					update_user_caches( $signon );
                    */

					// Записываем результаты в массив.
					// $result[ 'status' ] = true;
				}


            /*
            $user_level = (int) $user->user_level;
            $userdata   = $user;
            $user_login = $user->user_login;
            $user_email = $user->user_email;
            $user_url   = $user->user_url;
            $user_identity = $user->display_name;
            */
            //wp_set_auth_cookie( $user_id );
            //do_action( 'wp_login', $user->user_login );
        }
        


        // Вывод кода JavaScript-редиректа с помощью функции PHP echo()
     //   echo "<script>self.location='".home_url()."';</script>";
        /*
        echo "<script>document.location.href='https://example.com/final.php';</script>";
        echo "<script>window.location.href='https://example.com/final.php';</script>";
        echo "<script>window.location.replace('https://example.com/final.php');</script>";
        */

    }
}

/*
$user_contactmethods['city'] = 'Город';
$user_contactmethods['mobile'] = 'Телефон';

return $user_contactmethods;
*/

// Register a new shortcode: [cr_custom_registration]
/*
add_shortcode('cr_custom_registration', 'custom_registration_shortcode');

// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}
*/




