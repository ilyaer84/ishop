<?php

//  создаем функцию PHP, которая содержит HTML-код регистрационной формы.
function registration_form( $username, $password, $password_confirmation, $email, $city, $mobile, $website, $first_name, $last_name, $nickname, $uslov_f, $bio ) {
    echo '
    <style>
	div {
		margin-bottom:2px;
	}
	
	input{
		margin-bottom:4px;
	}
	</style>
	';

//    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
?>
<div class="wplb_holder <?php echo is_user_logged_in() ? // Проверяет авторизован ли пользователь (вошел ли пользователь под своим логином). Возвращает true, если пользователь авторизован и false, если нет.
                                 'wplb_alert wplb_signon' : ''?>">

<?php
// authorization   registration    onsubmit="return false;"
    echo ' 

	 <form name="regform" onsubmit="return false; action="/wp-login.php" method="post" data-type="registration">
	<div>
	<label for="username">Логин <strong>*</strong></label>
	<input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '">
	</div>
	
	<div>
	<label for="password">Password <strong>*</strong></label>
	<input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
	</div>

	<div>
	<label for="password_confirmation">Повторите пароль</label>
	<input type="password" name="password_confirmation" id="password_confirmation" value="' . (isset($_POST['password_confirmation']) ? $password_confirmation : null) . '">
	</div>
	
	<div>
	<label for="email">Email <strong>*</strong></label>
	<input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '">
    </div>
    
    <div>
	<label for="city">Город</label>
	<input type="text" name="city" value="' . (isset($_POST['city']) ? $city : null) . '">
    </div>
    
    <div>
	<label for="mobile">Телефон</label>
	<input type="text" name="mobile" value="' . (isset($_POST['mobile']) ? $mobile : null) . '">
	</div>
	
	<div>
	<label for="website">Website</label>
	<input type="text" name="website" value="' . (isset($_POST['website']) ? $website : null) . '">
	</div>
	
	<div>
	<label for="firstname">Имя</label>
	<input type="text" name="fname" value="' . (isset($_POST['fname']) ? $first_name : null) . '">
	</div>
	
	<div>
	<label for="website">Фамилия</label>
	<input type="text" name="lname" value="' . (isset($_POST['lname']) ? $last_name : null) . '">
	</div>
	
	<div>
	<label for="nickname">Ник</label>
	<input type="text" name="nickname" value="' . (isset($_POST['nickname']) ? $nickname : null) . '">
	</div>

	<div>
	<input name="uslov_f" id="uslov_f" type="checkbox" value="Yes"' . (isset($_POST['uslov_f']) ? $uslov_f : null) . '">
	<label for="uslov_f">Я согласен(-на) с условиями предоставления услуг</label>
	</div>
	
	<div>
	<label for="bio">About / Bio</label>
	<textarea name="bio">' . (isset($_POST['bio']) ? $bio : null) . '</textarea>
	</div>
	<span class="wplb_loading t-c"> Загрузка... </span>
	<input type="submit" name="submit" value="Зарегистрироваться"/>
	</form>
	
	';
	?>
	
	<!-- элемент для вывода ошибок -->

	<div class="wplb_alert text-danger t-c"> </div>


	</div>

<?php
}
