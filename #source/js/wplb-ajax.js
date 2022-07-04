jQuery(document).ready(function ($) {

	// открываем модальное окно ссылка get 
	if (window.location.href.indexOf('#openModal') != -1) {
		//$('#openModal').modal('show');
		div_hide('openModal');
	}
	//

	// CORS
	/*
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');  // разрешить все домены Разрешённые источники
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); //  С ним будут разрешены только те запросы из других источников, которые выполнены с применением перечисленных методов.
	header('Access-Control-Allow-Headers: Content-Type');
	header('Access-Control-Allow-Credentials: true');
	*/

	// console.log('wplb'); // выводим

	// скрипт передача аякс запроса авторизации, можно несколько форм -> по какой кнопке
	'use strict'; // это так называемый «строгом режиме», который заметно ограничивает синтаксис котором можно пользоваться.
	'esversion: 6'; // что мы используем синтаксис ECMAScript версии 6, а так версия вышла аж в 2015 году, то за совместимость с браузерами сомневаться не приходится.

	// Функция отправки форм.
	$('.wplb_holder').on('submit', 'form', function (ev) {
		//e.preventDefault(); // предотвращаем отправку формы
		// Определяем какую форму пользователь заполнил.
		let this_is = $(this);

		// Определяем кнопку.
		let button = $(this).find('input[type="submit"]');  // find разрешает нам находить потомки элементов в DOM дереве и конструировать новый объект jQuery из найденных элементов.

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

				// Передаём значения формы. - с пом ф-ии serialize
				'content': $(this).serialize(),

				// Используем   для защиты.
				'security': wplb_ajax_obj.nonce,

				// Перед отправкой Ajax запроса.
				beforeSend: function () {

					// Спрячем кнопку и покажем что скрипт работает.
					button.hide();
					this_is.find('.wplb_alert').hide();
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
					//console.log('$result.content' + $result.content); // выводим
					button.show();
					//$('.wplb_holder').addClass('wplb_alert wplb_signon').html('<p style="margin-bottom:3px;"><strong>  УПС  !!!</strong></p>');


				} else {

					if (document.location.href == 'http://avito-pro/reg/') {  // надо править!
						window.location.replace(window.wp_data.url_homme); // Переадресация страницы
					} else {
						setTimeout(function () {
							$('.form-result-success').toggleClass('d-none');
							div_hide('openModal');
							//$('#recaptchaError').text('');
							//console.log('AJAX response : ', response);
							//$('input').not(':input[type=submit], :input[type=hidden]').val('');
							//$('textarea').val('');
						}, 2200);
						$('.form-result-success').toggleClass('d-none');
						//console.log('$remem ' + $remem);					 
						window.location.reload();  // Перезагрузка страницы
					}

					// Пользователь авторизован, покажем ему сообщение.
					// $('.wplb_holder').addClass('wplb_alert wplb_signon').html('<p style="margin-bottom:3px;"><strong>Добро пожаловать!</strong></p>Ajax выполнил свою работу, вы в системе! Перезагрузите страницу и убедитесь.');

				}

			})
			.fail(function (errorThrown) {
				// Читать ошибки будем в консоли если что-то пойдет не по плану.

				console.log(errorThrown);

			});

		// Предотвращаем действие, заложенное в форму по умолчанию.
		//	ev.preventDefault();
		//e.preventDefault();
		event.preventDefault();

	});

	// ********************************************************************** //

	$(".social_net").click(function () {

		console.log('social_net'); // выводим

		//e.preventDefault(); // предотвращаем отправку формы
		// Определяем какую форму пользователь заполнил.
		let this_is = $(this);  // переменная доступна внутри “блока” - {}

		// Определяем кнопку.
		// let button = $(this).find('input[type="submit"]');  // find разрешает нам находить потомки элементов в DOM дереве и конструировать новый объект jQuery из найденных элементов.

		// Определяем тип формы.
		let type = $(this).attr('data-type');
		// let - пременная ограничена областью видимости блока
		// attr - Название атрибута, которое нужно получить.
		console.log('this ' + this); // выводим
		console.log('data ' + type); // выводим

		window.location.href = "http://oauth.vk.com/authorize?client_id=7725386&redirect_uri=http://avito-pro//&response_type=code";

		// Отправляем запрос Ajax в WordPress.
		$.ajax({

			// Путь к файлу admin-ajax.php.
			url: wplb_ajax_obj.ajaxurl,

			// Создаем объект, содержащий параметры отправки.
			data: {

				// Событие к которому будем обращаться.
				'action': 'wplb_ajax_autSoch',

				// Передаём тип формы.
				'type': type,

				// Передаём значения формы. - с пом ф-ии serialize
				// 'content': $(this).serialize(),

				//data: {text: 'Текст'},     /* Параметры передаваемые в запросе. */

				// Используем   для защиты.
				'security': wplb_ajax_obj.nonce,

				// Перед отправкой Ajax запроса.
				beforeSend: function () {

					// Спрячем кнопку и покажем что скрипт работает.
					button.hide();
					this_is.find('.wplb_alert').hide();
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
					//console.log('$result.content' + $result.content); // выводим
					button.show();
					//$('.wplb_holder').addClass('wplb_alert wplb_signon').html('<p style="margin-bottom:3px;"><strong>  УПС  !!!</strong></p>');


				} else {

					if (document.location.href == 'http://avito-pro/reg/') {  // надо править!
						window.location.replace(window.wp_data.url_homme); // Переадресация страницы
					} else {
						setTimeout(function () {
							$('.form-result-success').toggleClass('d-none');
							div_hide('openModal');
							//$('#recaptchaError').text('');
							//console.log('AJAX response : ', response);
							//$('input').not(':input[type=submit], :input[type=hidden]').val('');
							//$('textarea').val('');
						}, 2200);
						$('.form-result-success').toggleClass('d-none');
						//console.log('$remem ' + $remem);					 
						window.location.reload();  // Перезагрузка страницы
					}

					// Пользователь авторизован, покажем ему сообщение.
					// $('.wplb_holder').addClass('wplb_alert wplb_signon').html('<p style="margin-bottom:3px;"><strong>Добро пожаловать!</strong></p>Ajax выполнил свою работу, вы в системе! Перезагрузите страницу и убедитесь.');

				}

			})
			.fail(function (errorThrown) {
				// Читать ошибки будем в консоли если что-то пойдет не по плану.

				console.log(errorThrown);

			});

		// Предотвращаем действие, заложенное в форму по умолчанию.
		//	ev.preventDefault();
		//e.preventDefault();
		event.preventDefault();

	});

});
