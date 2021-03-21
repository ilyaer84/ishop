jQuery(document).ready(function ($) {
	console.log('Hi? login'); // выводим 

	// скрипт передача аякс запроса авторизации, можно несколько форм -> по какой кнопке
	'use strict'; // это так называемый «строгом режиме», который заметно ограничивает синтаксис котором можно пользоваться. 
	'esversion: 6'; // что мы используем синтаксис ECMAScript версии 6, а так версия вышла аж в 2015 году, то за совместимость с браузерами сомневаться не приходится. 

	// Функция отправки форм.
	$('.openModal').on('submit', 'form', function (ev) {
		// Определяем какую форму пользователь заполнил.
		let this_is = $(this);

		// Определяем кнопку.
		let button = $(this).find('input[type="submit"]');

		// Определяем тип формы.
		let type = $(this).attr('data-type');

		// Отправляем запрос Ajax в WordPress.
		$.ajax({

			// Путь к файлу admin-ajax.php.
			url: wplb_ajax_obj.ajaxurl,

			// Создаем объект, содержащий параметры отправки.
			data: {

				// Событие к которому будем обращаться.
				'action': 'wplb_ajax_request',

				// Передаём тип формы.
				'type': type,

				// Передаём значения формы.
				'content': $(this).serialize(),

				// Используем nonce для защиты.
				'security': wplb_ajax_obj.nonce,

				// Перед отправкой Ajax запроса.
				beforeSend: function () {

					// Спрячем кнопку и аокажем что скрипт работает.
					button.hide();
					this_is.find('.wplb_alert').hide(); // ! остановка
					this_is.find('.wplb_loading').show();
				}
			}

		})
			.always(function () {
				// Выполнять после каждого Ajax запроса

				this_is.find('.wplb_loading').hide();

			})
			.done(function (data) {
				// Функция для работы с обработанными данными.

				// Переменная $reslut будет хранить результат обработки.
				let $result = JSON.parse(data);

				// Проверяем какой статус пришел
				if ($result.status == false) {

					//Пришла ошибка, скрываем не нужные элементы и возвращаем кнопку.
					this_is.find('.wplb_alert').addClass('wplb_alert_error').html($result.content).show();

					button.show();

				} else {

					// Пользователь авторизован, покажем ему сообщение.
					$('.wplb_holder').addClass('wplb_alert wplb_signon').html('<p style="margin-bottom:3px;"><strong>Добро пожаловать!</strong></p>Ajax выполнил свою работу, вы в системе! Перезагрузите страницу и убедитесь.');
				}

			})
			.fail(function (errorThrown) {
				// Читать ошибки будем в консоли если что-то пойдет не по плану.

				console.log(errorThrown);

			});

		// Предотвращаем действие, заложенное в форму по умолчанию.
		ev.preventDefault();
	});

	console.log('Hi? login'); // выводим 

});