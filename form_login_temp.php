<style>
	.wplb_holder {
		padding: 20px;
		box-shadow: 0px 0px 40px rgba(0,0,0,0.1);
	}
	.wplb_flex {
		display: flex;
		width: 100%;
		justify-content: space-between;
		border-radius: 5px;
	}
	.wplb_flex > div {
		width: 45%
	}
	.wplb_flex > div:not(.wplb_flex) input:not([type="submit"]) {
		padding: 7px 12px;
		margin-bottom: 20px;
		display: block;
		width: 100%;
		box-sizing: border-box;
		border-radius: 3px;
		font-size: 12px;
		border: 1px solid #eaeaea;
		background: #fff;
	}
	.wplb_heading {
		font-size: 20px;
		border-bottom: 1px solid #eaeaea;
		padding-bottom: 20px;
		margin-bottom: 20px;
	}
	.wplb_holder input[type="submit"] {
		padding: 10px 15px;
		background: #fff;
		color: #61ce70;
		border-radius: 3px;
		border: 1px solid #61ce70;
		font-size: 14px;
	}
	.wplb_holder label {
		display: block;
		margin-bottom: 7px;
		font-size: 13px;
	}
	.wplb_alert {
		position: relative;
		padding: .75rem 1.25rem;
		margin-bottom: 1rem;
		border: 1px solid transparent;
		border-radius: .25rem;
		display: none;
		margin-top: 20px;
		font-size: 12px;
	}
	.wplb_alert_error{
		color: #721c24;
		background-color: #f8d7da;
		border-color: #f5c6cb;
	}
	.wplb_signon {
		color: #155724;
		background-color: #d4edda;
		border-color: #c3e6cb;
		box-shadow: none;
		display: block;
	}
	.wplb_loading {
		animation: pulse 0.3s infinite;
		display: none;
		font-size: 12px;
	}
	@keyframes pulse {
	  0% {
		color: #eaeaea;
	  }
	  100% {
		color: #000;
	  }
	}
</style>
<div class="wplb_flex wplb_holder <?php echo is_user_logged_in() ? 'wplb_alert wplb_signon' : ''?>">
	<?php if(is_user_logged_in()) {
		echo 'Вы уже авторизованный пользователь! <a href="'.wp_logout_url().'">Выход</a>';
	}else { ?>
	<div class="wplb_login">
		<p class="wplb_heading">Авторизация</p>
		<form data-type="authorization" autocomplete="false">
			<div class="wplb_flex">
				<div>
					<label>Логин или E-mail</label>
					<input type="text" name="wplb_login" placeholder="Логин" required>
				</div>
				<div>
					<label>Пароль</label>
					<input type="password" name="wplb_password" placeholder="******" autocomplete="false" required>
				</div>
			</div>
			<input type="submit" name="wplb_submit" value="Войти"><span class="wplb_loading">Загрузка...</span>
			<div class="wplb_alert"></div>
		</form>
	</div>
	<div class="wplb_registration">
		<p class="wplb_heading">Регистрация</p>
		<form data-type="registration" autocomplete="off">
			<div>
				<label>Желаемый логин</label>
				<input type="text" name="wplb_login" placeholder="Имя пользователя" aria-required>
				<label>E-mail адрес</label>
				<input type="email" name="wplb_email" placeholder="E-mail">
			</div>
			<div>
				<label>Пароль</label>
				<input type="password" name="wplb_password" placeholder="Пароль" required>
			</div>
			<input type="submit" name="wplb_submit" value="Зарегистрироваться"><span class="wplb_loading">Загрузка...</span>
			<div class="wplb_alert"></div>
		</form>
	</div>
	<?php } ?>
</div>