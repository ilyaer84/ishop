<?php

 //global $user_ID, $user_identity, $user_level; 
 wp_reset_postdata();  // при вызове с другой страницы, сброс

$admin_email=get_option('admin_email'); // получить опциии для sample_theme_option

// echo $post->ID;
// echo get_the_title();
//$srttitle= get_the_title();;  // делаем для текущего поста, если сбросили
$url_str = get_permalink();
//$post= get_post($post_id = 4);
/*
if(isset($_POST["zakaz_zvonka"])) {
  include(__DIR__ . '/assets/modul/email.php'); }
  */    

  include_once(get_stylesheet_directory() . '/inc/plugin/MySocAuther/Auther.php');  // подключаем файл логики с авторизацией соцсетей

  ?>

<div class="wplb_holder <?php echo is_user_logged_in() ? // Проверяет авторизован ли пользователь (вошел ли пользователь под своим логином). Возвращает true, если пользователь авторизован и false, если нет.
                                 'wplb_alert wplb_signon' : ''?>">


		<a title="Закрыть" class="close" onClick="div_hide('openModal');" >X</a>
		<p class="p_centr p_mad_title">Вход </p>  

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
    -->
    
  <form name="loginform" onsubmit="return false;"  id="login_form" action="<?php //bloginfo('url') ?>/wp-login.php" method="post" data-type="authorization"> 
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
        <div class="form-result-success d-none t-c" style="position: absolute;
        top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,.6); color: #fff; font-size: 1.25rem; z-index: 1000;">
          <div class=" alert-success " style="z-index: 1001;">Вход совершен.
          </div>
        </div>

<!-- 
      <div class="d_zakaz">
          <label>Заказ <span>*</span></label>
          <input type="text" name="zakaz" readonly>
          <div class="invalid-feedback"></div>  
      </div>
-->
      <div class="user_name">
        <label>Имя <span>*</span></label>        
        <input type="text" name="log" id="user_login" value="" placeholder="Имя / Почта / Телефон" required="required"/></label>         
        <div class="invalid-feedback"></div>
      </div>  

      <div class="user_name">
        <div class="input-password-container">
          <label>Пароль <span>*</span></label>
          <input type="password" name="pwd" id="user_pass" placeholder="Пароль" required="required" />      
        </div>
        <div class="invalid-feedback"></div>
      </div> 

      <!-- Email пользователя 
      <div class="form-group">
                <label for="email" class="control-label">Email-адрес</label>
                <input id="email" type="email" name="email"  
                class="form-control" value=""
                  placeholder="Email-адрес">
                <div class="invalid-feedback"></div>
              </div>
     

      <input type="hidden" name="emailto" class="form-control" value="<?php //echo $admin_email ; ?>"  >
      <input type="hidden" name="url_str" class="form-control" value="<?php //echo $url_str ; ?>"  >                 
       -->
       

<!-- рабочая
      <div class="div_cap">
      <div class="g-recaptcha my_captcha"  data-sitekey="6LepUAEVAAAAAGfL5sOirddhdGEeFIJpyTm8rmEY"></div>
      </div>
-->       
      <!-- 
      <div class="g-recaptcha"  data-sitekey="6LfLUAEVAAAAACIwQdiPVgKuVNWiCgpa3l3X5MPH"></div>

      светлый или темный внешний вид — data-theme=»light» или data-theme=»dark».
      нормальный или компактный размер — data-size=»compact», data-size=»norml»

       type="button"  type="submit" 
-->    
      <div class='div_sub'>  
      <input class='sub_form' type="submit" name="wp-submit" id="wp-submit" value="Вход"  /> 
      
       </div>

        
          <span class="wplb_loading t-c"> Загрузка... </span>
       
<!-- элемент для вывода ошибок -->

       <div class="wplb_alert text-danger t-c"></div>

    <div class="signin-signup__content"> 

      <div class="checkbox-after-label">
        <span class="js-inPopup">
          <input class="js-inPopup"  name="rememberme" type="checkbox" id="rememberme" value="true" checked /> 
        Запомнить меня </span>
      </div>  
            <span class="span_logintpassword">
            <a href="<?php bloginfo( 'url' ) ?>/wp-login.php?action=lostpassword">Забыли пароль? </a> </span> 
       
    </div> 

</div>
    <!--  в атрибуте value укажите страницу, на которую хотите редиректить пользователя после входа на сайт. -->
          <input type="hidden" name="redirect_to" value="<?php bloginfo('url') ?>/" /> 
          <input type="hidden" name="testcookie" value="1" />

      
     </form>

     <div class="form-login_niz"> 

     <div class="user_name t-c" >
       <span>или войти через</span>
     </div>

<!--  Вход через социльные сети -->
<div class="social-likes m-c">
          <?PHP
              //if(empty($_SESSION['id'])) {
                // ! Удали !!!
            if(isset($_SESSION['id']) & !empty($_SESSION['id']) ) {

              echo "<div class='t-c'>Вы авторизованы!</div>";
          
          } else {
            ?>

     
      <div class="m-c">

      

      <?PHP
              echo $link = '<a class="mod_icon  z_vk icon-vk social_net" data-type="VK" href="' . $url_auther . '?' . urldecode(http_build_query($params)) . '"title="Авторизоваться через Вконтакте"></a></div>';
              // urldecode — Декодирование URL-кодированной строки
              // http_build_query — Генерирует URL-кодированную строку запроса
          
      /*
      if (!isset($_GET['code'])) {

	    echo '<p><a href="' . $vkAdapter->getAuthUrl() . '">Аутентификация через ВКонтакте</a></p>';

	}
  */
?>
<!--
        <a class="mod_icon  z_vk icon-vk " href="http://avito-pro/auth?provider=vk" title="Авторизоваться через Вконтакте">  </a>
      </div>
-->
      <div class="m-c">
        <a class="mod_icon red icon-yandex social_net"  title="Авторизоваться через Яндекс">  </a>
      </div>

      <?PHP } ?>
<!--

       <a class="external-auth-providers__provider icon-viber" href="https://oauth.vk.com/authorize?client_id=7725386&display=popup&redirect_uri=http://avito-pro/callback&scope=friends&response_type=code" title="Авторизоваться через Habr Account">
       <svg class="svg-icon svg-icon--icon-habr svg-icon--type-external-auth">
         <use xlink:href="/assets/iconsfont/svg/apple-alt.svg">
        </use>   </svg>  </a>

      <a class="external-auth-providers__provider" href="/users/auth/facebook" title="Авторизоваться через Facebook">
      <svg class="svg-icon svg-icon--icon-facebook svg-icon--type-external-auth">
        <use xlink:href="/assets/svg/services-8aabfac2ddad40fec69762be46e382dcca48cc1a302d69a2b38b769e79b26f4f.svg#facebook">
      </use></svg></a>
-->
      
    </div>


     <!-- 
     <div class="social-likes social-likes_visible">
      <div>
        <a href="#" class="link_logo vk" onclick="return socialVkLogin();" title="Войти через Вконтакте">
        <span>ВКонтакте</span>      </a>
      </div>

      <div>
        <a href="https://kwork.ru/login_soc?type=fb" class="link_logo fb" onclick="return socialFbLogin();" title="Войти через Facebook">
        <span>Facebook</span>       </a>
      </div>

    </div>
-->

    <div class="signin-signup__content">
      <span>Нет аккаунта? </span>
    <!--  <a class="signin-signup-footer-link" onclick="show_signup(); return false;">Зарегистрироваться</a> -->
    <a href="/reg"  class="link_logo" >Зарегистрироваться</a>
    </div>
    


 </div>


