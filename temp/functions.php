<?php 
// define( 'WP_ALLOW_MULTISITE', true );

/*

    thumbnail - Размеры миниатюр
    medium - Средний размер
    large - Крупный размер

*/




// wp_redirect
/*
function my_page_template_redirect(){
   if( is_page('dostavka')  ){

      if( isset($_COOKIE['city'])) {

         if( $_COOKIE['city'] == 'undefined') {
            echo '<div style="text-align:center; width: 100%;"> Город не выбран! </div>';
         }
      query_posts( array(
         'post_type'  =>  'post',
         'meta_query' => array(
            array(
               'key' 	=> 'city',
               'value' => $_COOKIE['city'] ,
         //     'compare' => 'IN',
         )
         ) ,
         'category_name'   => 'dostavka',   
            )
      
      );

      if(have_posts()) {
   while(have_posts()):  the_post(); // перебираем посты 
$url = get_the_permalink();
//echo '$url = '.$url ;

endwhile; 
//wp_safe_redirect( $url );
 wp_redirect($url , 302 );
   //  wp_redirect( home_url( '/' ) );
   } else{
      wp_redirect( home_url( '/' ), 302 );
   }
   wp_reset_query();
      exit();
   }
}
}
add_action( 'template_redirect', 'my_page_template_redirect' );

*/


// ! работа с сессиями
/*
add_action('init', 'start_session', 1);

function start_session() {
if(!session_id()) {
session_start();
}
}
add_action('wp_logout', 'end_session');
add_action('wp_login', 'end_session');
add_action('end_session_action', 'end_session');

function end_session() {
session_destroy ();
}
// end  работа с сессиями
*/

/*
    get_stylesheet_directory_uri() — получает URL текущей темы (дочерней, не родительской).

    get_template_directory_uri() — получает URL текущей темы (родительской, не дочерней).

    get_stylesheet_directory() — получает путь до текущей темы (дочерней, не родительской).

    get_template_directory() — получает путь до текущей темы (родительской, не дочерней).

    get_stylesheet() — получает название каталога текущей темы (дочерней, не родительской).

    get_template() — получает название каталога текущей темы (родительской, не дочерней).
    get_stylesheet_uri() — получает готовый URL на файл стилей style.css текущей темы. Если используется дочерняя тема, то получит ссылку на стили доч. темы. В этом случае для родительской темы такой функции в WordPress нет.

    */

    // ! КОНСТАНТЫ
    define('IMG_DIR', get_stylesheet_directory_uri() . '/assets/img/'); // константа глобально доступна для файлов темы
    
    define('CREATED', '2021');
    
    define('FROM_EMAIL', 'ilyaer84@ya.ru');
    define('TO_EMAIL', 'ilyaer84@ya.ru');
    
   // ! подключаем классы
 //require_once __DIR__ .'/inc/class_my_astra.php' ;
 //include_once(__DIR__ . '/inc/class_my_astra.php'); 

//

   // ! работаем с админкой
//   require_once get_stylesheet_directory_uri() . '/admin/admin_my_astra.php';
include_once(__DIR__ . '/inc/admin/admin_my_astra.php'); 

   //



//  ! Подключаем стили и js 

// Лучше подключить файлы стилей по-отдельности в HTML: сначала стили родительской темы, а затем дочерней, чтобы они были ниже в HTML коде и перебивали родительские стили. Делается это так:
   add_action('wp_enqueue_scripts', 'my_theme_styles' );
   function my_theme_styles() {
      wp_enqueue_style('parent-theme-css', get_template_directory_uri() .'/style.css' );
      // не обязательно, правильная родительская тема подключит его сама.
   //   wp_enqueue_style('child-theme-css', get_stylesheet_directory_uri() .'/style.css', array('parent-theme-css') );
   
      //прежде пользумся ивентовой моделью
   wp_enqueue_style('main', get_stylesheet_directory_uri() . '/assets/css/styles.css'); 
   wp_enqueue_style('main_icon', get_stylesheet_directory_uri() . '/assets/css/iconsfont.css'); 
   // (название , адресс) get_template_directory_uri - расположение темы 
 
  
   wp_deregister_script('jquery'); // прибиваем стандартный wp jquery

   wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js');
//   wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/assets/js/slick.min.js');
   wp_enqueue_script('main_script', get_stylesheet_directory_uri() . '/assets/js/main.js');

   //работаем с аватарами 
//  wp_enqueue_script('main_ava_js', get_stylesheet_directory_uri() . '/assets/js/image-uploader.js');

  

   // для стороны клиента, для того чтобы из php в java script при загрузке странице передать данные
   // надо динамически на лету создать ассоциативный массив в php, который в java привратится в объект
/*		wp_localize_script('script', '_PHP', [  // ('script' - тк хочу чтобы вывелось перед моим скриптом с тким id 'script' -> кот выше
      // '_PHP' - название глобально переменой кот будет сделана для java 
      'ajaxUrl' => admin_url('admin-ajax.php'),  //в ключ ajaxUrl из ф-я admin-ajax - получит нужный url
   //	'aa' => '2' // aa - пример- перечисляем ключи - любые данные при загрузки страницы со стороны сервера
      'is_mobile' => wp_is_mobile(),
   ]); 
*/
   }

// end 

// ! подключение стилей к  определенной странице
function wpse_enqueue_page_template_styles() {
   if ( is_page_template( 'adres-magaz.php' ) ) {
  //   wp_enqueue_style( 'page-template', get_stylesheet_directory_uri() . '/assets/css/adres-mag.css' );
   }
   if ( is_page( 20 ) ) {
      //подключаем стиль
    //  wp_enqueue_style ( 'contact', get_template_directory_uri()  . '/altercss.css', array(), '1.0' );  

          //подключаем скрипт Маска ввода телефона

      // ! доступ к папке uploads
      //  $uploads = wp_upload_dir();
      // $upload_path = $uploads['baseurl'];
 //     wp_enqueue_script('masked-input', get_stylesheet_directory_uri() . '/assets/js/jquery.maskedinput.min.js', array('jquery'), '1.1', true);
 //     wp_enqueue_script('obr_sv_zv', get_stylesheet_directory_uri() . '/assets/js/obrat_sv.js');

   }



}
add_action( 'wp_enqueue_scripts', 'wpse_enqueue_page_template_styles' );
// end 



// ! обработчик аякс запроса
function func_form(){
//	include(__DIR__ .'/assets/mytest.php');
// include(__DIR__ . '/assets/modul/process.php');   
   
}

add_action('wp_ajax_form_obr'       , 'func_form');
add_action('wp_ajax_nopriv_form_obr', 'func_form');

// создаем ссылки 
/*
function js_variables(){
   $variables = array (
      'ajax_url' => admin_url('admin-ajax.php'), // вид ссылки window.wp_data.ajax_url
      'is_mobile' => wp_is_mobile()
       // Тут обычно какие-то другие переменные
   );
   echo '<script type="text/javascript">window.wp_data = '.
       json_encode($variables).   ';</script>'  ;
}
add_action('wp_head','js_variables');
*/
// end  аякс 


add_action('after_setup_theme', function(){  
 
   register_nav_menu('top_menu', 'Menu_main'); // регистрируем меню, можно несколько 
   /*  
   add_theme_support('post-thumbnails'); // разрешить использование миниатюр
   add_theme_support('title-tag'); 	 // работа с title и потом гдето хуками фильтрами подписываются на изменение title 
   add_theme_support('post-formats', ['aside',	'chat',	'gallery',	'image', 'link',
  'quote', 'status',	'video',	'audio']); 
  // регистрируем форматы постов, и после приминения на посте 
   // и на странице блога в индексе посты распараленены на свои типы  что позволит использовать get_template_part() 
*/
     add_image_size('size100-100', 100, 100, false); // регистрация своего размера!
     add_image_size('size300-200', 300, 200, false); 
     add_image_size('size600-400', 600, 400, false); 
     add_image_size('size768-512', 768, 512, false); 
     add_image_size('size1536-1024', 1536, 1024, false);  // регистрация своего размера!
});


// ! перевод для дочерней - своей темы
   function my_child_theme_setup() {
      load_child_theme_textdomain( 'my_child_theme', get_stylesheet_directory() . '/languages' );
   }
   add_action( 'after_setup_theme', 'my_child_theme_setup' );
   //  Также, нужно создать файл перевода в дочерней теме: languages/en_US.mo.
   // Теперь можно использовать функции локализации WordPress в подтеме:
   // _e( 'Это нужно перевести на англ.', 'my_child_theme' );
   // Так, для дочерней темы у нас будут отдельные файлы перевода, а для родительской будет использоваться родные файлы.
//



//  ! регистрация sidebar 

add_action('widgets_init', function(){  // widgets_init название хука
    register_sidebar([
		'name'          => 'Сайдбар сверху',
		'id'            => 'sidebar-top',
		'description'   => 'Для верхнего меню',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<div class="menu">',
		'after_title'   => "</div>\n",
     ]);

//     register_widget('Test_Widget_Recent_Posts'); // вызов своего виджета с указание соего класса - в отдельном файле
	
//	 register_widget('/assets/inc/Widget_Ya_Dialog'); // вызов своего виджета с указание соего класса - в отдельном файле

	});
//


// ! регистрируем свои типы записи +  // таксономии - раздылы, признаки 
   
   include_once(__DIR__ . '/inc/my/type_zap_tax.php'); //! регистрируем свои типы записи +  // таксономии - раздылы, признаки
   // __DIR__ - работа от текущей папки functiopn подключен к к индексу <-
   
   // ! свои плагины

 // include_once(__DIR__ . '/inc/plugin/custom-registration/custom-registration.php'); // однократного включения, регистрация 
  
// include_once(__DIR__ . '/inc/plugin/SocialAuther/SocialAuther.php'); // однократного включения, авторизация через соц сети 

// include_once(__DIR__ . '/inc/plugin/my_SocialAuther.php'); // однократного включения, авторизация через соц сети 

// include_once(__DIR__ . '/inc/plugin/custom-registration/reg_prof.php'); // однократного включения, регистрация 

 //  include_once(__DIR__ . '/inc/my/avatar_my.php');  //работаем с аватарами  + js надо поключить

//



   // ! Подключаем шорткоды
include_once(__DIR__ . '/inc/shortcode/my_shortcode.php'); 

   add_shortcode('test_shortcode', function($atts){
      var_dump($atts);
      return '------';
  });

  // !  отключение админ бара
 add_action('show_admin_bar', '__return_false');

// ! для Contact Form
//Доработка возвртим галочку

// ! Ориентация на конкретную контактную форму

add_action( 'wp_footer', 'mycustom_wp_footer' );
 
function mycustom_wp_footer() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( '493' == event.detail.contactFormId ) {
      $('.form_tel').removeClass('form_req');
         $('.form_mail').addClass('form_req');
    }
}, false );
</script>
<?php
}

// end Contact Form


// ! свои функции

/***для использования пути  в js ***/
add_action( 'wp_enqueue_scripts', 'mythemeurl', 99 );
function mythemeurl(){
wp_localize_script( 'jquery', 'mytheme', array( 
   //( 'jquery' Название скрипта, перед которым будут добавлены данные. Скрипт должен быть зарегистрирован заранее.
   //, 'mytheme', Название Javascript объекта, который будет содержать данные.
   'template_url' => get_template_directory_uri(), 
   'stylesheet_url' => get_stylesheet_directory_uri(),
) );
}

function wtf($array, $stop = false) {
   echo '<pre>'.print_r($array,1).'</pre>';
   if(!$stop) {
      exit();
   }
}

//
\

// Работа с формой входа 

//Неудавшаяся попытка входа 
/*
add_action( 'wp_login_failed', 'pu_login_failed' ); // перехватить неудачный логин
 
function pu_login_failed( $user ) {
     // проверьте, с какой страницы происходит попытка входа в систему
     //$referrer = $_SERVER['HTTP_REFERER'];
     $referrer = home_url(); // bloginfo('url') ;//. "/?login=failed&logform=y";
 
     // проверьте, что не было на странице входа по умолчанию
     if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $user!=null ) {
          // убедитесь, что у нас еще нет неудачной попытки входа в систему
          if ( !strstr($referrer, '?login=failed' )) {
               // Перенаправить на страницу входа и добавить строку запроса входа в систему не удалось
          wp_redirect( $referrer . '?login=failed');
          //header('Location: #openModal');
         } else {
          wp_redirect( $referrer . '?login=failed' );
         }
 
         exit;
     }
}


// Пустой логин и пароль

add_action( 'authenticate', 'form_page_login');
function form_page_login( $user ){
    $referrer = $_SERVER['HTTP_REFERER'];
    $error = false;
    if($_POST['log'] == '' || $_POST['pwd'] == '')
    {
        $error = true;
    }
    if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $error ) {
        if ( !strstr($referrer, '?login=failed') ) {
            wp_redirect( $referrer . '?login=failed' );
        } else {
            wp_redirect( $referrer );
        }
 
    exit;
 
    }
}
*/
// ! Переход на главную после нажатия кнопки выход
add_action('wp_logout','my_wp_logout');
function my_wp_logout() {
    wp_safe_redirect('/');
    exit;
};
//


// ! загрузить SVG
/*
add_filter( 'upload_mimes', 'svg_upload_allow' );

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';

	return $mimes;
}
*/
//

// ! Работаем с формой поиска woocommerce

add_filter( 'get_product_search_form' , 'woo_andreyex_product_my_searchform' );
function woo_andreyex_product_my_searchform( $form ) {

	$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
		<div>
			<label class="screen-reader-text" for="s">' . __( 'Поиск товара', 'woocommerce' ) . '</label>
			<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __( 'Поиск товара', 'woocommerce' ) . '" />
			<input type="submit" id="searchsubmit" value="'. esc_attr__( 'Искать', 'woocommerce' ) .'" />
			<input type="hidden" name="post_type" value="product" />
         </div>
	</form>';

	return $form;

}
//

// ! Вносим Изменения в родительскую тему
//header 
function astra_site_branding_markup() {
   ?>

   <div class="site-branding">
      <div
      <?php
         echo astra_attr(
            'site-identity',
            array(
               'class' => 'ast-site-identity',
            )
         );
      ?>
      >
         <?php astra_logo(); ?>
      </div>
      <div class="header-tools">
<?php  // get_search_form() ;
// get_product_search_form(); ?>
      </div>
   
</div>
   <!-- .site-branding -->
   <?php
}

//add_action( 'astra_masthead_content', 'astra_site_branding_markup', 8 );

//

// *************

// для входа на сайт пользователей
// ! переадресацией после входа
/*
function login_redirect() {
   return '/';
   }
   add_filter('login_redirect', 'login_redirect');
*/



// изменить логотип при входе

function custom_login_logo(){
   echo  '<style type="text/css">
   #login h1 a { background: url('. IMG_DIR.'logo.png) no-repeat 50% 50% !important;
   width: 150px;
   height: 150px; 
}
   </style>';
   }
   add_action('login_enqueue_scripts', 'custom_login_logo');

// изменить ссылку  входе

function custom_logo_admin_link(){
   return home_url( '/');
}
add_filter( 'login_headerurl','custom_logo_admin_link');

//

// !Осторожно  Перенос скриптов в подвал 
/*
if(!is_admin()){ 
   remove_action('wp_head', 'wp_print_scripts'); 
   remove_action('wp_head', 'wp_print_head_scripts', 9); 
   remove_action('wp_head', 'wp_enqueue_scripts', 1); 
   add_action('wp_footer', 'wp_print_scripts', 5); 
   add_action('wp_footer', 'wp_enqueue_scripts', 5); 
   add_action('wp_footer', 'wp_print_head_scripts', 5); 
   }
 */

 //Значения true если нужно отобразить подключения в футере и false если в хедере. 
/*
add_action( 'wp_enqueue_scripts', 'true_include_myscript' );
function true_include_myscript() {
    wp_enqueue_script( 'themename', get_stylesheet_directory_uri() . '/js/jquery.polaris.js', array('jquery'), null, true );
}
*/


// Перемещаем jQuery в футер сайта
//add_action('wp_enqueue_scripts', 'true_peremeshhaem_jquery_v_futer');  
 /*
function true_peremeshhaem_jquery_v_futer() {  
 	// снимаем стандартную регистрацию jQuery
        wp_deregister_script('jquery');  
 
        // регистрируем для подключения в футере, описание параметров - в документации функции (ссылка чуть выше)
        wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, null, true);  
 
	// подключаем
        wp_enqueue_script('jquery');  
 
}
*/

// end Перенос скриптов в подвал 
/*
add_action( 'wp_print_styles', 'true_otkljuchaem_stili_contact_form', 100 ); 
// по идее вы можете использовать и хук wp_enqueue_scripts, хотя конкретно его я не тестировал
 
function true_otkljuchaem_stili_contact_form() {
   wp_deregister_style( 'contact-form-7' ); // в параметрах - ID подключаемого файла
   wp_deregister_style( 'astra-theme-css-inline-css' ); 
   wp_deregister_style( 'google-fonts-1-css' );
}
*/


// При помощи этого хука можно задать определённые имена пользователей, которые вы бы хотели запретить для регистрации, пример:

add_filter( 'illegal_user_logins', function( $illegal_logins ) {
 
	return array( 'Loh', 'administrator', 'admin' );
 
} );

// !Аякс Авторизация - регистрация

// Добавляем событие в процесс инициализации JS скриптов
add_action( 'wp_enqueue_scripts', 'wplb_ajax_enqueue' );

//Описываем событие
function wplb_ajax_enqueue() {

	// Подключаем файл js скрипта.
	wp_enqueue_script(
		'wplb-ajax', // Имя
		get_stylesheet_directory_uri() . '/assets/js/wplb-ajax.js', // Путь до JS файла.
		array( 'jquery' ), // В массив jquery.
		'',
		true
	);

	// Используем функцию wp_localize_script для передачи переменных в JS скрипт.
	wp_localize_script(
		'wplb-ajax', // Куда будем передавать
		'wplb_ajax_obj', // Название массива, который будет содержать передаваемые данные
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ), // Элемент массива, содержащий путь к admin-ajax.php
			'nonce' => wp_create_nonce( 'wplb-nonce' ) // Создаем nonce Создает уникальный защитный ключ на короткий промежуток времени
		)
	);

}


// Создаём событие обработки Ajax запроса.
add_action( 'wp_ajax_nopriv_wplb_ajax_request', 'wplb_ajax_request' );
add_action( 'wp_ajax_wplb_ajax_request', 'wplb_ajax_request' );

// Описываем саму функцию.
function wplb_ajax_request() {

	// Перемененная $_REQUEST содержит все данные заполненных форм.
	if ( isset( $_REQUEST ) ) {

		// Проверяем nonce, а в случае если что-то пошло не так, то прерываем выполнение функции.
		if ( !wp_verify_nonce( $_REQUEST[ 'security' ], 'wplb-nonce' ) ) {
			wp_die( 'Базовая защита не пройдена' );
		}

		// Введём переменную, которая будет содержать массив с результатом отработки события.
		$result = array( 'status' => false, 'content' => false );

		// Создаём массив который содержит значения полей заполненной формы.
      parse_str( $_REQUEST[ 'content' ], $creds ); //  Разбирает строку в переменные
      

		switch ( $_REQUEST[ 'type' ] ) {
         case 'registration':            
				/**
				 * Заполнена форма регистрации.
				 */

            // Создаём массив с данными для регистрации нового пользователя.
            $user_data = array(
               'user_login' => $creds[ 'log' ], // Логин.
               'user_pass' => $creds[ 'pwd' ], // Пароль.
               'role' => 'subscriber' // Роль.
            );

				// Пробуем создать объект с пользователем.
            //$user = username_exists( $creds[ 'wplb_login' ] );
            $user = username_exists( $creds[ 'log' ] );
          //  $result[ 'content' ] .= ' wplb_login =   '. $creds[ 'log' ];

				// Проверяем, а может быть уже есть такой пользователь
				if ( !$user ) { // && false == email_exists( $creds[ 'wplb_email' ] ) ) {
					// Пользователя не существует.

               // Создаём массив с данными для регистрации нового пользователя.
               /*
					$user_data = array(
						'user_login' => $creds[ 'wplb_login' ], // Логин.
						'user_email' => $creds[ 'wplb_email' ], // Email.
						'user_pass' => $creds[ 'wplb_password' ], // Пароль.
						'display_name' => $creds[ 'wplb_login' ], // Отображаемое имя.
						'role' => 'subscriber' // Роль.
               );
               */

               

					// Добавляем пользователя в базу данных.
					$user = wp_insert_user( $user_data );

					// Проверка на ошибки.
					if ( is_wp_error( $user ) ) {

						// Невозможно создать пользователя, записываем результат в массив.
						//$result[ 'status' ] = false;
                  $result[ 'content' ] .= $user->get_error_message();

					} else {

						// Создаём массив для авторизации.
						/*$creds = array(
							'user_login' => $creds[ 'wplb_login' ], // Логин пользователя.
							'user_password' => $creds[ 'wplb_password' ], // Пароль пользователя.
							'remember' => true // Запоминаем.
                  );*/
                  $creds = array(
							'user_login' => $creds[ 'log' ], // Логин пользователя.
							'user_password' => $creds[ 'pwd' ], // Пароль пользователя.
							'remember' => true // Запоминаем.
						);

						// Пробуем авторизовать пользователя.
						$signon = wp_signon( $creds, false );

						if ( is_wp_error( $signon ) ) {

							// Авторизовать не получилось.
							$result[ 'status' ] = false;
                     $result[ 'content' ] .= $signon->get_error_message();
                     $result[ 'content' ] .= 'Авторизовать не получилось';

						} else {

							// Авторизация успешна, устанавливаем необходимые куки.
							wp_clear_auth_cookie();
							clean_user_cache( $signon->ID );
							wp_set_current_user( $signon->ID );
							wp_set_auth_cookie( $signon->ID );
							update_user_caches( $signon );

							// Записываем результаты в массив.
							$result[ 'status' ] = true;
						}

					}
				} else {
					
					// Такой пользователь уже существует, регистрация не возможна, записываем данные в массив.
					$result[ 'status' ] = false;
					$result[ 'content' ] = esc_html__( 'Пользователь уже существует', 'wplb_ajax_lesson' );
				}
				break;


			case 'authorization':
				/**
				 * Заполнена форма авторизации.
				 */

            If ($creds[ 'rememberme' ] == "true") {
            $remem = true;
            } else { $remem = false; }

				// Создаём массив для авторизации
				$creds = array(
					'user_login' => $creds[ 'log' ], // Логин пользователя
					'user_password' => $creds[ 'pwd' ], // Пароль пользователя
					'remember' => $remem, // true  $remem, // Запомнинаем
				);

				// Пробуем авторизовать пользователя.
				$signon = wp_signon( $creds, false );

				if ( is_wp_error( $signon ) ) {

					// Авторизовать не получилось
					$result[ 'status' ] = false;
					$result[ 'content' ] = $signon->get_error_message();

				} else {

					// Авторизация успешна, устанавливаем необходимые куки.
					wp_clear_auth_cookie();
					clean_user_cache( $signon->ID );
					wp_set_current_user( $signon->ID );
					wp_set_auth_cookie( $signon->ID );
					update_user_caches( $signon );

					// Записываем результаты в массив.
					$result[ 'status' ] = true;
				}

				break;
		}

		// Конвертируем массив с результатами обработки и передаем его обратно как строку в JSON формате.
		echo json_encode( $result );

	}

	// Заканчиваем работу Ajax.
	wp_die();
}

// end ayax рег авториз

/*
add_shortcode( 'wplb_ajax_example', 'wplb_ajax_example_function' );
function wplb_ajax_example_function() {
    ob_start();
	echo get_template_part( 'form_login');
	return ob_get_clean();
}
*/

/**
 * Направление пользователя на собственную страницу регистрации
 * вместо wp-login.php?action=register.
 */
/*
public function redirect_to_custom_register() {
   if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
       if ( is_user_logged_in() ) {
           $this->redirect_logged_in_user();
       } else {
           wp_redirect( home_url( 'member-register' ) );
       }
       exit;
   }
}
*/

// Login redirects
// Направление пользователя при регистрации
/*
function custom_login_url() {
   echo header("Location: " . get_bloginfo( 'url' ) ); //. "/reg");  на стр входа
}
 
add_action('login_head', 'custom_login_url');


function login_link_url( $url ) {
   $url = get_bloginfo( 'url' ) ; //. "/reg";
   return $url;
   }
add_filter( 'login_url', 'login_link_url', 10, 2 );

// чтобы полностью скрыть стандартную страницу регистрации WordPress:
function register_link_url( $url ) {
   if ( ! is_user_logged_in() ) {
      if ( get_option('users_can_register') )
    $url = '<li><a href="' . get_bloginfo( 'url' ) . "/reg" . '">' . __('Register', 'yourtheme') . '</a></li>';
       else  $url = '';
   } else { 
         $url = '<li><a href="' . admin_url() . '">' . __('Site Admin', 'yourtheme') . '</a></li>';
   }
   return $url;
 }

 add_filter( 'register', 'register_link_url', 10, 2 );
*/


// !Все для кастомной регистрации, авторизации

// При помощи этого хука можно задать определённые имена пользователей, которые вы бы хотели запретить для регистрации, пример:

add_filter( 'illegal_user_logins', function( $illegal_logins ) {
 
	return array( 'Loh', 'administrator', 'admin');
 
} );

add_action('init','wpse_login');

function wpse_login(){
 global $pagenow;
 if( 'wp-login.php' == $pagenow && !is_user_logged_in()) { // && !is_user_logged_in() )
  wp_redirect('http://avito-pro/');
  exit();
 }
}

// Как добавить новое поле в Профиль пользователя WordPress
add_filter('user_contactmethods', 'my_user_contactmethods');
 
function my_user_contactmethods($user_contactmethods){
 
  $user_contactmethods['city'] = 'Город';
  $user_contactmethods['mobile'] = 'Телефон';
//  $user_contactmethods['uslov_f'] = 'Согласие с уловием';  
 
  return $user_contactmethods;
}



// Как перенаправить пользователя после входа в WordPress
/*
function redirect_users_after_login() {
   $user = wp_get_current_user();
   $roles = ( array ) $user->roles;
   $url = 'http://avito-pro';
   
   // Редирект для администраторов
   if ( $roles[0] == 'administrator' ) {
        wp_redirect( $url );
        exit;
   }
   
   // Редирект для подписчиков
   if ( $roles[0] == 'subscriber' ) {
        wp_redirect( $url );
        exit;
   }

   // Редирект для авторов
   if ( $roles[0] == 'author' ) {
        wp_redirect( $url );
        exit;
   }

   // Редирект для редакторов
   if ( $roles[0] == 'editor' ) {
        wp_redirect( $url );
        exit;
   }

}
add_action( 'admin_init', 'redirect_users_after_login' );
*/
//


add_action('init','my_auth');
function my_auth(){
   global $user;
   global $password;
   if( $user ) {
      global $reg_errors;
/*
      wp_set_current_user( $user->$user_id, $user->user_login );
      echo 'ID ===  ' .   $user->$user_id   . '<br />'; 
      echo 'user_login ' .   $user->user_login   . '<br />';
      echo 'user_pass ' .   $user->password   . '<br />'; ;
 
      wp_set_auth_cookie( $user->$user_id );
      do_action( 'wp_login', $user->user_login );
*/
//echo 'f login ===  ' .   $user->user_login   . '<br />'; 
//wtf($user->$user_id );
/*
$user['remember'] = true;
$signon = wp_signon($user, false);
if (is_wp_error($signon)) 
echo $signon->get_error_message();
//print_r($signon);

  }

  $creds = array();
  $creds['user_login'] = $user->user_login;
  $creds['user_password'] =  $password ;
  $creds['remember'] = true;
  $signon = wp_signon( $creds, false );

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
       
   wp_clear_auth_cookie();
   clean_user_cache( $signon->ID );
   wp_set_current_user( $signon->ID );
   wp_set_auth_cookie( $signon->ID );
   update_user_caches( $signon );
        

   // Записываем результаты в массив.
   // $result[ 'status' ] = true;
}
   */

}

}




// end 