<?php
/**
 * The header for Astra Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php astra_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<!-- доп шапка  -->
<div class="h-top">

   <div class="h_left" >  

     <div class="h_left__1">
  
<div class="users">
<?php 
// или так: 
if( is_user_logged_in() ){  // залогинен пользователь или нет
   $current_user = wp_get_current_user();
   $user_id = $current_user->ID ;
   $user_img = get_user_meta( $user_id, 'userimg', 1 );
   $default_image = get_stylesheet_directory_uri().'/assets/img/no-user.png'; 
  // $default_image = plugins_url('images/no-user.png', __FILE__);


       echo '<div class="far fa-heart">  </div>' ;
   echo ' <div class="HeaderUserName"> 
   
      <div class="HeaderUserName__image-container">
      <a href="/my-account/">
      <img class="HeaderUserName__image" src="'.(empty($user_img)? $default_image : $user_img ).'" width="50">
      
   <div class="HeaderUserName__name">'.
   $current_user->user_login. 
        '</div>   </a> </div>  ' ;
       
        echo ' <div class="menu_users"> ';
        echo ' <div class="menu_users_otz"> Нет отзывов </div>';
        wp_nav_menu([
         'menu' => 'Верхнее левое',
         'menu_class' => 'header_list',
//      	'item_wrap' => 'ul class="%2$s"><div>%3S</ul></div>',
 //        'items_wrap'     => '<ul><div id="item-id">Список: %3$s </div></ul>',

         'item_wrap' => 'ul class="%2$s"><div>%3S</ul></div>',
         'items_wrap'     => '<div class="main-navigation"> <ul id="primary-menu" class="main-header-menu ast-nav-menu ast-flex ast-justify-content-flex-end  submenu-with-border astra-menu-animation-fade ">
          %3$s </ul></div>',
         
       'container'       => 'nav',
       'container_class' => 'ast-flex-grow-1 navigation-accessibility',
//         'depth'           => 1,
         ]);

         echo  '</div>     </div>' ;

 //  echo get_avatar( $current_user->user_email, 30, '', '', array('class'=>'pull-left', 'extra_attr'=>'style="margin: -4px 7px;"') ) ;
    
} else {
   ?>

<!-- Модальное окно - кнопка -->
   <div class="mod_a">    
      <a  class="mod_okno" onClick="div_hide('openModal');">
         <button class="button-ui button-ui_white header__login_button" data-role="login-button">
         Войти
         </button>
      </a>
   </div>
   <?php
  // echo '<div>'. wp_loginout() . '</div>';
}
?>
   

      </div>

 

</div>
   <!-- .site-branding -->


          <?php

//dynamic_sidebar('sidebar-top'); //для вызова по ид сайдбар
//get_sidebar('top');  // для вызова из фала sidebar-single.php



// Когда у вас есть ключ, вы можете загрузить объект поля и вывести его значения
/*
$field_key = "field_5f0dd30bb217f"; // ключ
$field = get_field_object($field_key); 
// wtf($field);
// echo '<p>'.$field['label'].'</p>' ; 

if( $field ) { echo '<select id="selectItem" name="' . $field['key'] . '">'; 
   echo '<option value="vibor">Выберите город</option>';
   $i=0;
   foreach( $field['choices'] as $k => $v ) {
   ++$i;
   if( isset($_COOKIE['city']) and $_COOKIE['city'] == $v) {
      echo '<option id="' . $i . '" name="'.$k.'" selected>' . $v . '</option>'; 
      
   } else {
    echo '<option id="' . $i . '" name="'.$k.'">' . $v . '</option>';
    } 
    
   }
   echo '</select>';  
}
*/
?>
</div>



   <div class="h_right">
  <?php 
  wp_nav_menu([
           'menu' => 'Верхнее правое',
           'menu_class' => 'header_list',
  //      	'item_wrap' => 'ul class="%2$s"><div>%3S</ul></div>',
   //        'items_wrap'     => '<ul><div id="item-id">Список: %3$s </div></ul>',

           'item_wrap' => 'ul class="%2$s"><div>%3S</ul></div>',
           'items_wrap'     => '<div class="main-navigation"> <ul id="primary-menu" class="main-header-menu ast-nav-menu ast-flex ast-justify-content-flex-end  submenu-with-border astra-menu-animation-fade ">
            %3$s </ul></div>',
           
         'container'       => 'nav',
         'container_class' => 'ast-flex-grow-1 navigation-accessibility',
//         'depth'           => 1,
           ]);

  //dynamic_sidebar('sidebar-top'); //для вызова по ид сайдбар
  //get_sidebar('top');  // для вызова из фала sidebar-single.php
  ?>
 
   </div>


</div>
<?php wp_head(); ?>
<?php astra_head_bottom(); ?>
</head>

<body <?php astra_schema_body(); ?> <?php body_class(); ?>>

<?php astra_body_top(); ?>
<?php wp_body_open(); ?>
<div 
	<?php
	echo astra_attr(
		'site',
		array(
			'id'    => 'page',
			'class' => 'hfeed site',
		)
	);
	?>
>
	<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html( astra_default_strings( 'string-header-skip-link', false ) ); ?></a>

	<?php astra_header_before(); ?>
   <?php // get_search_form() ; ?>
	<?php astra_header(); ?>

	<?php astra_header_after(); ?>

	<?php astra_content_before(); ?>

	<div id="content" class="site-content">

		<div class="ast-container">

		<?php astra_content_top(); ?>

      <!--  кнопка вверх  -->

      <button class="but__backToTop">
        <svg viewBox="0 0 8 11" class="App__backToTopIcon----3FHO" width="8" height="11">
        <path d="M0 3.99h3V11h2V3.99h3L4 0 0 3.99z"></path></svg></button>
