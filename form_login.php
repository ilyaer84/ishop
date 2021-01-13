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
		<p class="p_centr p_mad_title">Перезвоните мне на номер</p>  


<form id="zvonok"  class="forma_zapisi" method="GET">
    <div class="form-zvonok"> 

    <p class="msgs"></p>

<!-- элемент для вывода ошибок -->
<div class="text-danger text-c" id="recaptchaError"></div>

          <!-- Сообщение при ошибке -->
                    <div class="form-error d-none">
            Сбой! Сообщение не отправлено!
          </div>



          <div class="mform-error  d-none" style="z-index: 1001; position: absolute;
            top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,.6); color: #fff; font-size: 1.25rem; z-index: 1000;">
            Сбой! Сообщение не отправлено!
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
          <div class=" alert-success " style="z-index: 1001;">Форма успешно отправлена.
          </div>
        </div>


      <div class="d_zakaz">
          <label>Заказ <span>*</span></label>
          <input type="text" name="zakaz" readonly>
          <div class="invalid-feedback"></div>  
      </div>

      <div class="user_name">
        <label>Имя <span>*</span></label>
        <input id="name" type="text" name="username" class="form-control" value="" placeholder="Имя" minlength="2"
                        maxlength="30" required="required">
        
        <div class="invalid-feedback"></div>
      </div>  

      <div class="user_name">
        <label>Номер телефона <span>*</span></label>
        <div class="tel7"> 
          <div class="tel7_1">+7</div>
          <div class="tel7_2">               
          <input id="phone" type="tel" name="usernumber" class="form-control" value="(___)___-__-__" pattern="^\(?[0-9]{3}\)?(\s+)?[0-9]{3}-?[0-9]{2}-?[0-9]{2}$">
          </div>
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
      -->
      <div class="div_mess">
        <label>Сообщение</label>
        <textarea id="message" name="mess" class="form-control" rows="3" placeholder="Сообщение. Не более 500 символов." maxlength="500" ></textarea>
        <div class="invalid-feedback"></div>
      </div>

      <input type="hidden" name="emailto" class="form-control" value="<?php echo $admin_email ; ?>"  >
      <input type="hidden" name="url_str" class="form-control" value="<?php echo $url_str ; ?>"  >                 
      
      <div class="form-sogl">
        <p> Нажимая кнопку «Отправить», я даю свое согласие на обработку моих персональных данных, 
        в соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных»,
        на условиях и для целей, определенных в Согласии на обработку персональных данных
        </p>
      </div>

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

      <input id='f_sub' type='button' name='l_zakaz_zvonka' value='Отправить'>
<!--
          <input class="bot-send-mail" type='submit' name='zakaz_zvonka' value='Отправить'
          onclick="ym(64554898,'reachGoal','ya_nazat_zakaz_zvonka'); return true;" >
   -->        
       </div>

    </div>
          <!-- Кнопка для отправки формы 
          <div class="text-right submit">
            <button type="submit" class="btn btn-primary position-relative" >Послать заявку</button>
          </div>
          -->
         <!--     <img src="<?php // IMG_DIR.'/111.jpg'?>" height="50px" > -->
              <p> <?php // $descr; ?> </p>

</form>
</div>

<script>
$(document).ready(function() {

// $("#f_sub").hide();
//$("#zvonok").append("<input class='bot-send-mail' type='submit' name='zakaz_zvonka' value='Отправить'>");

})
</script>