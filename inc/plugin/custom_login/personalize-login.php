<?php
$admin_email=get_option('admin_email'); // получить опциии для sample_theme_option

wp_reset_postdata();  // при вызове с другой страницы, сброс
// echo $post->ID;
// echo get_the_title();
//$srttitle= get_the_title();;  // делаем для текущего поста, если сбросили
$url_str = get_permalink();
//$post= get_post($post_id = 4);
/*
if(isset($_POST["zakaz_zvonka"])) {
  include(__DIR__ . '/assets/modul/email.php'); }
  */    
  ?>

<div>
		<a title="Закрыть" class="close" onClick="div_hide('openModal');" >X</a>
		<p class="p_centr p_mad_title">Вход </p>  


    <form name="loginform" id="loginform" action="<?php bloginfo('url') ?>/wp-login.php" method="post"> 

    <div class="form-login"> 

    <p class="msgs"></p>

<!-- элемент для вывода ошибок -->
<div class="text-danger text-c" id="recaptchaError"></div>

          <!-- Сообщение при ошибке -->
                    <div class="form-error d-none">
            Сбой! Сообщение не отправлено!
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
        <div class="form-result-success d-none text-c" style="position: absolute;
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
        <input type="text" name="log" id="user_login" /></label>         
        <div class="invalid-feedback"></div>
      </div>  

      <div class="user_name">
        <div class="input-password-container">
          <label>Пароль <span>*</span></label>
          <input type="password" name="pwd" id="user_pass" />      
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
     

      <input type="hidden" name="emailto" class="form-control" value="<?php echo $admin_email ; ?>"  >
      <input type="hidden" name="url_str" class="form-control" value="<?php echo $url_str ; ?>"  >                 
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
-->    
      <div class='div_sub'>  
      <input type="submit" name="wp-submit" id="wp-submit" value="Вход" /> 
<!--
          <input class="bot-send-mail" type='submit' name='zakaz_zvonka' value='Отправить'
          onclick="ym(64554898,'reachGoal','ya_nazat_zakaz_zvonka'); return true;" >
   -->        
       </div>

    
          <!-- Кнопка для отправки формы 
          <div class="text-right submit">
            <button type="submit" class="btn btn-primary position-relative" >Послать заявку</button>
          </div>
          -->
         <!--     <img src="<?php // IMG_DIR.'/111.jpg'?>" height="50px" > 
              <p> <?php // $descr; ?> </p>  -->

    <div class="signin-signup__content"> 

      <div class="checkbox-after-label">
        <label class="js-inPopup"><input class="js-inPopup" name="rememberme" type="checkbox" id="rememberme" value="forever" /> Запомнить меня</label>
      </div>  
            <span class="span_logintpassword">
            <a class="logintpassword-link" href="/my-account/lost-password/">Забыли пароль?</a> </span> 
        
    </div>

</div>
<!--  в атрибуте value укажите страницу, на которую хотите редиректить пользователя после входа на сайт. -->
          <input type="hidden" name="redirect_to" value="<?php bloginfo('url') ?>/" /> 
          <input type="hidden" name="testcookie" value="1" />
     
     </form>

     <div class="form-login2"> 

     <div class="user_name text-c" >
       <span>или войти через</span>
     </div>

     <div class="external-auth-providers">

       <a class="external-auth-providers__provider" href="https://freelance.habr.com/auth/tmid/login" title="Авторизоваться через Habr Account">
       <svg class="svg-icon svg-icon--icon-habr svg-icon--type-external-auth">
         <use xlink:href="/assets/svg/services-8aabfac2ddad40fec69762be46e382dcca48cc1a302d69a2b38b769e79b26f4f.svg#habr">
        </use>   </svg>  </a>

      <a class="external-auth-providers__provider" href="/users/auth/facebook" title="Авторизоваться через Facebook">
      <svg class="svg-icon svg-icon--icon-facebook svg-icon--type-external-auth">
        <use xlink:href="/assets/svg/services-8aabfac2ddad40fec69762be46e382dcca48cc1a302d69a2b38b769e79b26f4f.svg#facebook">
      </use></svg></a>
      
    </div>


     <!--
     <div class="js-form-login-element signin-signup__social-buttons">
      <a href="#" class="link_logo vk" onclick="return socialVkLogin();" title="Войти через Вконтакте">
      <span>ВКонтакте</span>      </a>
      <a href="https://kwork.ru/login_soc?type=fb" class="link_logo fb" onclick="return socialFbLogin();" title="Войти через Facebook">
      <span>Facebook</span>       </a>
    </div>
-->

    <div class="signin-signup__content">
      <span>Нет аккаунта? </span>
    <!--  <a class="signin-signup-footer-link" onclick="show_signup(); return false;">Зарегистрироваться</a> -->
    <a href="/reg" class="link_logo" >Зарегистрироваться</a>
    </div>

    </div>


<script>
$(document).ready(function() {

// $("#f_sub").hide();
//$("#zvonok").append("<input class='bot-send-mail' type='submit' name='zakaz_zvonka' value='Отправить'>");

})
</script>