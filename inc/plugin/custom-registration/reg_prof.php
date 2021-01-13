
<?php
// доб в форму регистрации wp
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

add_action('register_form','show_fields');
add_action('register_post','check_fields',10,3);
add_action('user_register', 'register_fields');
 
function show_fields() {
/* добавляем поля "Город" и "Номер сотового" в форму регистрации в WordPress */ 
?>
<p>
	<label>Город<br/>
	<input id="city" class="input" type="text" value="<?php echo $_POST['city']; ?>" name="city" /></label>
</p>
<p>
	<label>Номер сотового<br/>
	<input id="mobile" class="input" type="text" value="<?php echo $_POST['mobile']; ?>" name="mobile" /></label>
</p>
<?php }
 
function check_fields ( $login, $email, $errors ) {
	/* 
	 * Функция проверки полей, в этом примере только смотрит, чтобы они не оставались пустыми, 
	 * но можно задать и свои условия,
	 * например запретить пользователям регистрироваться под одним и тем же номером телефона
	 */
	global $city, $mobile;
	if ($_POST['city'] == ''){
		$errors->add( 'empty_realname', "ОШИБКА: Город?" );
	} else {
		$city = $_POST['city'];
	}
	if ($_POST['mobile'] == ''){
		$errors->add( 'empty_realname', "ОШИБКА: Номер телефона?" );
	} else {
		$mobile = $_POST['mobile'];
	}
	return $errors;
}
 
function register_fields($user_id,$password= "",$meta=array()){
	update_user_meta( $user_id, 'city', $_POST['city'] );
	update_user_meta( $user_id, 'mobile', $_POST['mobile'] );

	// ! записываем в woocomerce
	$customer = new WC_Customer( $user_id );
	$customer->set_billing_city( $_POST['city'] );
	$customer->set_billing_phone( $_POST['mobile'] );
	$customer->save();
}


