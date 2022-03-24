<?php
/*
    Template Name: Custom Registration
    страница регистрации
*/



get_header();

 if ( astra_page_layout() == 'left-sidebar' ) :
   ?>
<!-- sidebar -->
<div class="widget-area secondary" id="secondary" role="complementary" itemtype="https://schema.org/WPSideBar" itemscope="itemscope">
	<div class="sidebar-main">
  <?php // get_sidebar('adres-mag');
     

//wtf($_COOKIE);
?>
	</div><!-- .sidebar-main -->
</div>
<?php endif ;

?>

<div id="primary" class="content-area primary">
		

<?php

  //  include_once(__DIR__ . '/inc/plugin/custom-registration/Logik_registr.php');
  //  global $wpdb, $user_ID;
    //Проверяем, вошел ли уже пользователь в систему
    if ($user_ID) {
    
    //Залогиненного пользователя перенаправляем на главную страницу.
    // Вывод кода JavaScript-редиректа с помощью функции PHP echo()
    echo   '<section class="ast-archive-description">
    <h1 class="t-c page-title ast-archive-title"> Вы Авторизованы !</h1>									
    </section>';

    echo "<script>self.location='".home_url()."';</script>";
   // header( 'Location:' . home_url() );
    
    } else {
      ?>

   <section class="ast-archive-description">
   <h1 class="t-c page-title ast-archive-title"> <?php the_title();  ?></h1>									
   </section>

 <main id="main" class="site-main"> 





 <div class="wplb_holder <?php echo is_user_logged_in() ? // Проверяет авторизован ли пользователь (вошел ли пользователь под своим логином). Возвращает true, если пользователь авторизован и false, если нет.
                                 'wplb_alert wplb_signon' : ''?>">

    <?php
    if (!$_COOKIE["wordpress_test_cookie"]) {
      // setcookie("test","1");
      ?>
        
      <div> 
      Ошибка: Cookies либо заблокированы, либо не поддерживаются вашим браузером.
      <br>Чтобы использовать сайт, нужно разрешить cookies.</div>
      
      <?php
    }
    ?>
    <!--
        <form name="loginform" id="loginform" action="<?php //bloginfo('url') ?>/wp-login.php" method="post" data-type="authorization"> 
    
        <form name="loginform" id="loginform" action="login"  method="post" data-type="authorization"> 
         
        registration authorization
    -->
  <form name="regform" onsubmit="return false;"  id="regform" action="<?php //bloginfo('url') ?>/wp-login.php" method="post" data-type="registration"> 
   <!--  onsubmit="return false; чтобы форма не отправляла данные  -->
    <div class="form-login"> 

    <p class="msgs"></p>

    <?php
      if(isset($_GET['login']) && $_GET['login'] == 'failed')
      {
          ?>
                <!-- Сообщение при ошибке -->
                          <div class="text-danger">
                            <p class="t-c">Ошибка входа: вы ввели неверное имя пользователя или пароль, попробуйте еще раз.</p>
                          </div>

      <?php } ?>

      <!-- элемент для вывода ошибок -->
          <div class="text-danger t-c" id="recaptchaError">

          </div>

     
          <div class="mform-error  d-none" style="z-index: 1001; position: absolute;
            top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,.6); color: #fff; font-size: 1.25rem; z-index: 1000;">
            Сбой! Вход не выполнен!
          </div>
        

           <!-- Индикация отправки данных формы на сервер -->
           <div class="progress d-none mb-2">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="0"
              aria-valuemin="0" aria-valuemax="100" style="width: 0">
              <span class="sr-only">0%</span>
            </div>
          </div>

            <!-- Сообщение об успешной отправки формы -->
              <!--
        <div class="form-result-success d-none t-c" style="position: absolute;
        top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,.6); color: #fff; font-size: 1.25rem; z-index: 1000;">
          <div class=" alert-success " style="z-index: 1001;">Вы зарегистрированы! Вход совершен.
          </div>
        </div>
        -->

        <div class="user_name">
        <label>Имя <span>*</span></label>        
        <input type="text" name="log" id="user_login" value="" placeholder="Имя / Почта / Телефон" required="required"/></label>         
        <div class="invalid-feedback"></div>
      </div>  

      <div class="user_mail">
        <label>Email <span>*</span></label>        
        <input type="text" name="email" id="user_email" value="" placeholder="Email" /></label>         
        <div class="invalid-feedback"></div>
      </div>  

      <div class="user_pass">
        <div class="input-password-container">
          <label>Пароль <span>*</span></label>
          <input type="password" name="pwd" id="user_pass" placeholder="Пароль" required="required" />      
        </div>
        <div class="invalid-feedback"></div>
      </div> 

      <div class='div_sub'>  
        <input class='sub_form' type="submit" name="wp-submit" id="wp-submit" value="Регистрация"  /> 
      
       </div>

    <!--  в атрибуте value укажите страницу, на которую хотите редиректить пользователя после входа на сайт. -->
          <input type="hidden" name="redirect_to" value="<?php bloginfo('url') ?>/" /> 
          <input type="hidden" name="testcookie" value="1" />

      
     </form>


 </div>




<?php 
     
  //  custom_registration_function();

    }

?>

</main> 
<!-- #main -->

</div>

<!-- sidebar -->
<?php
if ( astra_page_layout() == 'right-sidebar' ) :
   ?>
<!-- sidebar -->
<div class="widget-area secondary" id="secondary" role="complementary" itemtype="https://schema.org/WPSideBar" itemscope="itemscope">
	<div class="sidebar-main">
  <?php get_sidebar('adres-mag');
    
?>
	</div><!-- .sidebar-main -->
</div>
<?php
 endif ;

   // dynamic_sidebar('sidebar-top'); //для вызова по ид сайдбар
   //get_sidebar('adres-mag'); // для вызова из фала sidebar-adres-mag.php
  ?>


<?php get_footer(); ?>