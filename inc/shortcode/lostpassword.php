<?php
add_shortcode( 'page_my_lostpassword', 'misha_render_pass_reset_form' ); // шорткод [page_my_lostpassword]
 
function misha_render_pass_reset_form() {
 
 	// если пользователь авторизован, просто выводим сообщение и выходим из функции
	if ( is_user_logged_in() ) {
		return sprintf( "Вы уже авторизованы на сайте. <a href='%s'>Выйти</a>.", wp_logout_url() );
	}
 
	$return = ''; // переменная, в которую всё будем записывать
 
	// обработка ошибок, если вам нужны такие же стили уведомлений, как в видео, CSS-код прикладываю чуть ниже
	if ( isset( $_REQUEST['errno'] ) ) {
		$errors = explode( ',', $_REQUEST['errno'] );
 
		foreach ( $errors as $error ) {
			switch ( $error ) {
				case 'empty_username':
					$return .= '<p class="errno">Вы не забыли указать свой email?</p>';
					break;
				case 'password_reset_empty':
					$return .= '<p class="errno">Укажите пароль!</p>';
					break;
				case 'password_reset_mismatch':
					$return .= '<p class="errno">Пароли не совпадают!</p>';
					break;
				case 'invalid_email':
				case 'invalidcombo':
					$return .= '<p class="errno">На сайте не найдено пользователя с указанным email.</p>';
					break;
			}
		}
	}
 
	// тем, кто пришёл сюда по ссылке из email, показываем форму установки нового пароля
	if ( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'] ) ) {
 
		$return .= '<h3>Укажите новый пароль</h3>
			<form name="resetpassform" id="resetpassform" action="' . site_url( 'wp-login.php?action=resetpass' ) . '" method="post" autocomplete="off">
				<input type="hidden" id="user_login" name="login" value="' . esc_attr( $_REQUEST['login'] ) . '" autocomplete="off" />
				<input type="hidden" name="key" value="' . esc_attr( $_REQUEST['key'] ) . '" />
         			<p>
					<label for="pass1">Новый пароль</label>
					<input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" />
				</p>
				<p>
					<label for="pass2">Повторите пароль</label>
					<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" />
				</p>
 
				<p class="description">' . wp_get_password_hint() . '</p>
 
				<p class="resetpass-submit">
					<input type="submit" name="submit" id="resetpass-button" class="button" value="Сбросить" />
				</p>
			</form>';
 
		// возвращаем форму и выходим из функции
		return $return;
	}
 
	// всем остальным - обычная форма сброса пароля (1-й шаг, где указываем email)
	$return .= '
		<h3>Забыли пароль?</h3>
		<p>Укажите свой email, под которым вы зарегистрированы на сайте и на него будет отправлена информация о восстановлении пароля.</p>
		<form id="lostpasswordform" action="' . wp_lostpassword_url() . '" method="post">
			<p class="form-row">
				<label for="user_login">Email</label>
				<input type="text" name="user_login" id="user_login">
			</p>
 			<p class="lostpassword-submit">
				<input type="submit" name="submit" class="lostpassword-button" value="Отправить" />
			</p>
		</form>';
 
	// возвращаем форму и выходим из функции
	return $return;
}