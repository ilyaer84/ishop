<?php 
add_shortcode( 'art_feedback', 'art_feedback' );
/**
 * Шорткод вывода формы
 *
 * @return string
 * @see https://wpruse.ru/?p=3224
 */
function art_feedback() {

	ob_start();
	?>
	<form id="add_feedback">
		<input type="text" name="art_name" id="art_name" class="required art_name" placeholder="Ваше имя" value=""/>

		<input type="email" name="art_email" id="art_email" class="required art_email" placeholder="Ваш E-Mail" value=""/>

		<input type="text" name="art_subject" id="art_subject" class="art_subject" placeholder="Тема сообщения" value=""/>

		<textarea name="art_comments" id="art_comments" placeholder="Сообщение" rows="10" cols="30" class="required art_comments"></textarea>

		<input type="checkbox" name="art_anticheck" id="art_anticheck" class="art_anticheck" style="display: none !important;" value="true" checked="checked"/>

		<input type="text" name="art_submitted" id="art_submitted" value="" style="display: none !important;"/>

		<input type="submit" id="submit-feedback" class="button" value="Отправить сообщение"/>
	</form>
	<?php

	return ob_get_clean();
}