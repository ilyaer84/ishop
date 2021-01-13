<?php

/*
  Plugin Name: Custom Registration
  Plugin URI: 
  Description: Updates user rating based on number of posts.
  Version: 1.0
  Author: Agbonghama Collins
  Author URI: 
 */

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
// При помощи этого хука можно задать определённые имена пользователей, которые вы бы хотели запретить для регистрации, пример:

add_filter( 'illegal_user_logins', function( $illegal_logins ) {
 
	return array( 'Loh', 'administrator', 'admin' );
 
} );


//************************ */  



// Как добавить новое поле в Профиль пользователя WordPress
add_filter('user_contactmethods', 'my_user_contactmethods');
 
function my_user_contactmethods($user_contactmethods){
 
  $user_contactmethods['city'] = 'Город';
  $user_contactmethods['mobile'] = 'Телефон';
 
  return $user_contactmethods;
}

// подключаем форму - создаем функцию PHP, которая содержит HTML-код регистрационной формы.
get_template_part('inc\plugin\custom-registration/form_reg');
// get_template_part( 'nav', 'single', [ 'param1' => 'hello', 'param2' => [ 1, 2 ] ] );


// активирует все созданные нами функции.
function custom_registration_function() {
    if (isset($_POST['submit'])) {
        registration_validation(
        $_POST['username'],
        $_POST['password'],
        $_POST['email'],
        $_POST['city'],
        $_POST['mobile'],
        $_POST['website'],
        $_POST['fname'],
        $_POST['lname'],
        $_POST['nickname'],
        $_POST['bio']
		);
		
		// sanitize user form input
        global $username, $password, $email, $city, $mobile, $website, $first_name, $last_name, $nickname, $bio;
        $username	= 	sanitize_user($_POST['username']);
        $password 	= 	esc_attr($_POST['password']);
        $email 		= 	sanitize_email($_POST['email']);
        $city = 	sanitize_text_field($_POST['city']);
        $mobile = 	sanitize_text_field($_POST['mobile']);
        $website 	= 	esc_url($_POST['website']);
        $first_name = 	sanitize_text_field($_POST['fname']);
        $last_name 	= 	sanitize_text_field($_POST['lname']);
        $nickname 	= 	sanitize_text_field($_POST['nickname']);
        $bio 		= 	esc_textarea($_POST['bio']);

		// call @function complete_registration to create the user
		// only when no WP_error is found
        complete_registration(
        $username,
        $password,
        $email,
        $city, 
        $mobile,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $bio
		);
    }

    registration_form(
    	$username,
        $password,
        $email,        
        $city, 
        $mobile,
        $website,
        $first_name,
        $last_name,
        $nickname,
        $bio
		);
}

  

// Чтобы облегчить процесс проверки, мы используем класс WordPress WP_Error.
function registration_validation( $username, $password, $email, $city, $mobile, $website, $first_name, $last_name, $nickname, $bio )  {
    global $reg_errors;
    $reg_errors = new WP_Error;

    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $reg_errors->add('field', 'Отсутствует обязательное поле формы');
    }

    if ( strlen( $username ) < 4 ) {
        $reg_errors->add('username_length', 'Имя пользователя слишком короткое.Требуется минимум 4 символа');
    }

    if ( username_exists( $username ) )
        $reg_errors->add('user_name', 'Извините, это имя пользователя уже существует!');

    if ( !validate_username( $username ) ) {
        $reg_errors->add('username_invalid', 'к Сожалению,Введенное Вами Имя Пользователя Недействительно');
    }

    if ( strlen( $password ) < 5 ) {
        $reg_errors->add('password', 'Длина пароля должна быть больше 5');
    }

    if ( !is_email( $email ) ) {
        $reg_errors->add('email_invalid', 'Email не является допустимым');
    }

    if ( email_exists( $email ) ) {
        $reg_errors->add('email', 'Этот электронный адрес уже занят');
    }
    
    if ( !empty( $city ) ) {
        if ($city == ''){
            $reg_errors->add('city', 'Город не введен');
        }
    }

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
    global $reg_errors, $username, $password, $email, $city, $mobile, $website, $first_name, $last_name, $nickname, $bio;
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
        
        $user = wp_insert_user( $userdata );        

      // ! записываем в woocomerce
	$customer = new WC_Customer( $user );
	$customer->set_billing_city( $city);
	$customer->set_billing_phone( $_POST['mobile'] );
    $customer->save();
    
        echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';   
 
    }
}

/*
$user_contactmethods['city'] = 'Город';
$user_contactmethods['mobile'] = 'Телефон';

return $user_contactmethods;
*/

// Register a new shortcode: [cr_custom_registration]
add_shortcode('cr_custom_registration', 'custom_registration_shortcode');

// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}
