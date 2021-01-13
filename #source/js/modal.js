$(document).ready(function() {

    $("#f_sub").hide();
    $("#zvonok .div_sub").append("<input class='bot-send-mail' type='submit' name='zakaz_zvonka' value='Отправить'>");
    //  $('.bot-send-mail').bind('click', savecontact);


    //получаем идентификатор элемента

    //  $(".bot-send-mail").click(function(e) {
    $("#zvonok").submit(function(e) {
        // $('.bot-send-mail').click(function() {
        e.preventDefault();
        var base_url = window.location.origin;
        console.log('base_url : ', base_url);

        var fData = $('#zvonok').serialize();
        console.log('fData : ', fData);
        fData = fData + '&j=1';
        console.log('fData : ', fData);
        //  alert("bot-send-mail was clicked");

        $.ajax({
            type: "POST",
            url: base_url + '/wp-content/themes/web-star/assets/modul/email.php',
            //    data: formNm.serialize(),
            //dataType: 'json', // data type                
            data: fData, //$(this).serialize(),
            beforeSend: function() {
                $('#recaptchaError').text(' Идет передача данных...');
            },
            success: function(response) {


                setTimeout(function() {
                    $('.form-result-success').toggleClass('d-none');
                    div_hide('openModal');
                    $('#recaptchaError').text('');
                    console.log('AJAX response : ', response);
                    $('input').not(':input[type=submit], :input[type=hidden]').val('');
                    $('textarea').val('');
                }, 2200);
                $('.form-result-success').toggleClass('d-none');

            },

            error: function(jqXHR, text, error) {
                $('#recaptchaError').text('');
                // Если существует свойство msg у объекта $data, то...
                if ($data.msg) {
                    // вывести её в элемент у которого id=recaptchaError
                    $('#recaptchaError').text($data.msg);
                }
                // Вывод сообщения об ошибке отправки
                $('input').not(':input[type=submit], :input[type=hidden]').val('');
                $('textarea').val('');

                setTimeout(function() {
                    // $('.mform-error').html('Ошибка. Данные не отправлены.');
                    $('.mform-error').toggleClass('d-none');
                    div_hide('openModal');
                }, 2000);
                $('.mform-error').toggleClass('d-none');
            }
        })

        return false;
    }​);​
    //  });


    //****** проверка - сепаратор ввод номера телефона ********/
    // masked_input_1.4.1-min.js
    // angelwatt.com/coding/masked_input.php
    (function(a) {
        a.MaskedInput = function(f) {
            if (!f || !f.elm || !f.format) { return null }
            if (!(this instanceof a.MaskedInput)) { return new a.MaskedInput(f) }
            var o = this,
                d = f.elm,
                s = f.format,
                i = f.allowed || "0123456789",
                h = f.allowedfx || function() { return true },
                p = f.separator || "/:-",
                n = f.typeon || "_YMDhms",
                c = f.onbadkey || function() {},
                q = f.onfilled || function() {},
                w = f.badkeywait || 0,
                A = f.hasOwnProperty("preserve") ? !!f.preserve : true,
                l = true,
                y = false,
                t = s,
                j = (function() { if (window.addEventListener) { return function(E, C, D, B) { E.addEventListener(C, D, (B === undefined) ? false : B) } } if (window.attachEvent) { return function(D, B, C) { D.attachEvent("on" + B, C) } } return function(D, B, C) { D["on" + B] = C } }()),
                u = function() { for (var B = d.value.length - 1; B >= 0; B--) { for (var D = 0, C = n.length; D < C; D++) { if (d.value[B] === n[D]) { return false } } } return true },
                x = function(C) { try { C.focus(); if (C.selectionStart >= 0) { return C.selectionStart } if (document.selection) { var B = document.selection.createRange(); return -B.moveStart("character", -C.value.length) } return -1 } catch (D) { return -1 } },
                b = function(C, E) {
                    try {
                        if (C.selectionStart) {
                            C.focus();
                            C.setSelectionRange(E, E)
                        } else {
                            if (C.createTextRange) {
                                var B = C.createTextRange();
                                B.move("character", E);
                                B.select()
                            }
                        }
                    } catch (D) { return false }
                    return true
                },
                m = function(D) {
                    D = D || window.event;
                    var C = "",
                        E = D.which,
                        B = D.type;
                    if (E === undefined || E === null) { E = D.keyCode }
                    if (E === undefined || E === null) { return "" }
                    switch (E) {
                        case 8:
                            C = "bksp";
                            break;
                        case 46:
                            C = (B === "keydown") ? "del" : ".";
                            break;
                        case 16:
                            C = "shift";
                            break;
                        case 0:
                        case 9:
                        case 13:
                            C = "etc";
                            break;
                        case 37:
                        case 38:
                        case 39:
                        case 40:
                            C = (!D.shiftKey && (D.charCode !== 39 && D.charCode !== undefined)) ? "etc" : String.fromCharCode(E);
                            break;
                        default:
                            C = String.fromCharCode(E);
                            break
                    }
                    return C
                },
                v = function(B, C) {
                    if (B.preventDefault) { B.preventDefault() }
                    B.returnValue = C || false
                },
                k = function(B) {
                    var D = x(d),
                        F = d.value,
                        E = "",
                        C = true;
                    switch (C) {
                        case (i.indexOf(B) !== -1):
                            D = D + 1;
                            if (D > s.length) { return false }
                            while (p.indexOf(F.charAt(D - 1)) !== -1 && D <= s.length) { D = D + 1 }
                            if (!h(o, B, D)) { c(B); return false }
                            E = F.substr(0, D - 1) + B + F.substr(D);
                            if (i.indexOf(F.charAt(D)) === -1 && n.indexOf(F.charAt(D)) === -1) { D = D + 1 }
                            break;
                        case (B === "bksp"):
                            D = D - 1;
                            if (D < 0) { return false }
                            while (i.indexOf(F.charAt(D)) === -1 && n.indexOf(F.charAt(D)) === -1 && D > 1) { D = D - 1 }
                            E = F.substr(0, D) + s.substr(D, 1) + F.substr(D + 1);
                            break;
                        case (B === "del"):
                            if (D >= F.length) { return false }
                            while (p.indexOf(F.charAt(D)) !== -1 && F.charAt(D) !== "") { D = D + 1 }
                            E = F.substr(0, D) + s.substr(D, 1) + F.substr(D + 1);
                            D = D + 1;
                            break;
                        case (B === "etc"):
                            return true;
                        default:
                            return false
                    }
                    d.value = "";
                    d.value = E;
                    b(d, D);
                    return false
                },
                g = function(B) {
                    if (i.indexOf(B) === -1 && B !== "bksp" && B !== "del" && B !== "etc") {
                        var C = x(d);
                        y = true;
                        c(B);
                        setTimeout(function() {
                            y = false;
                            b(d, C)
                        }, w);
                        return false
                    }
                    return true
                },
                z = function(C) {
                    if (!l) { return true }
                    C = C || event;
                    if (y) { v(C); return false }
                    var B = m(C);
                    if ((C.metaKey || C.ctrlKey) && (B === "X" || B === "V")) { v(C); return false }
                    if (C.metaKey || C.ctrlKey) { return true }
                    if (d.value === "") {
                        d.value = s;
                        b(d, 0)
                    }
                    if (B === "bksp" || B === "del") {
                        k(B);
                        v(C);
                        return false
                    }
                    return true
                },
                e = function(C) {
                    if (!l) { return true }
                    C = C || event;
                    if (y) { v(C); return false }
                    var B = m(C);
                    if (B === "etc" || C.metaKey || C.ctrlKey || C.altKey) { return true }
                    if (B !== "bksp" && B !== "del" && B !== "shift") {
                        if (!g(B)) { v(C); return false }
                        if (k(B)) {
                            if (u()) { q(o, x(d)) }
                            v(C, true);
                            return true
                        }
                        if (u()) { q(o, x(d)) }
                        v(C);
                        return false
                    }
                    return false
                },
                r = function() {
                    if (!d.tagName || (d.tagName.toUpperCase() !== "INPUT" && d.tagName.toUpperCase() !== "TEXTAREA")) { return null }
                    o.elm = d;
                    if (!A || d.value === "") { d.value = s }
                    j(d, "keydown", function(B) { z(B) });
                    j(d, "keypress", function(B) { e(B) });
                    j(d, "focus", function() { t = d.value });
                    j(d, "blur", function() { if (d.value !== t && d.onchange) { d.onchange() } });
                    return o
                };
            o.resetField = function() { d.value = s };
            o.setAllowed = function(B) {
                i = B;
                o.resetField()
            };
            o.setCursorPos = function(B) { b(d, B) };
            o.setFormat = function(B) {
                s = B;
                o.resetField()
            };
            o.setSeparator = function(B) {
                p = B;
                o.resetField()
            };
            o.setTypeon = function(B) {
                n = B;
                o.resetField()
            };
            o.setEnabled = function(B) { l = B };
            return r()
        }
    }(window));

    MaskedInput({
        elm: document.getElementById('phone'), // select by id
        format: '(___)___-__-__',
        separator: '()-'
    });

    //*********** end сепаратор телефона************** */
    /*
        // переключить во включенное или выключенное состояние кнопку submit
        var _changeStateSubmit = function(form, state) {
            $(form).find('[type="submit"]').prop('disabled', state);
        };

        // изменение состояния элемента формы (success, error, clear)
        var _setStateValidaion = function(input, state, message) {
            input = $(input);
            if (state === 'error') {
                input
                    .removeClass('is-valid').addClass('is-invalid')
                    .siblings('.invalid-feedback').text(message);
                // jQuery метод .siblings() позволяет получить все элементы находящиеся на одном уровне вложенности (смежные элементы) с указанным элементом, дополнительно они могут фильтроваться с помощью заданного селектора.
            } else if (state === 'success') {
                input.removeClass('is-invalid').addClass('is-valid');
            } else {
                input.removeClass('is-valid is-invalid');
            }
        };

        // при получении успешного ответа от сервера 
        var _success = function(data) {
            var _this = this;
            if ($(this).find('.progress').length) {
                $(this)
                    .find('.progress').addClass('d-none')
                    .find('.progress-bar').attr('aria-valuenow', '0').width('0')
                    .find('.sr-only').text('0%');
            }

            // при успешной отправки формы
            if (data.result === "success") {
                $(this).parent().find('.form-result-success')
                    .removeClass('d-none')
                    .addClass('d-flex');
                return;
            }
            // если произошли ошибки при отправке
            $(this).find('.form-error').removeClass('d-none');
            //      _changeStateSubmit(this, false);

            // выводим ошибки которые прислал сервер
            for (var error in data) {
                if (!data.hasOwnProperty(error)) {
                    continue;
                };
                switch (error) {
                    case 'captcha':
                        _refreshCaptcha($(this));
                        _setStateValidaion($(this).find('[name="' + error + '"]'), 'error', data[error]);
                        break;
                    case 'attachment':
                        $.each(data[error], function(key, value) {
                            console.log('[name="attachment[]"][data-index="' + key + '"]');
                            _setStateValidaion($(_this).find('[name="attachment[]"][data-index="' + key + '"]'), 'error', value);
                        });
                        break;
                    case 'log':
                        $.each(data[error], function(key, value) {
                            console.log(value);
                        });
                        break;
                    default:
                        _setStateValidaion($(this).find('[name="' + error + '"]'), 'error', data[error]);
                }
                // устанавливаем фокус на 1 невалидный элемент
                if ($(this).find('.is-invalid').length > 0) {
                    $(this).find('.is-invalid')[0].focus();
                }
            }
        };

        //отправка данных , вывод собщений
        /*
            $("form").submit(function() {
                // Получение ID формы
                var formID = $(this).attr('id');
                // Добавление решётки к имени ID
                var formNm = $('#' + formID);
                var message = $(formNm).find(".msgs"); // Ищет класс .msgs в текущей форме  и записываем в переменную
                var formTitle = $(formNm).find(".formTitle"); // Ищет класс .formtitle в текущей форме и записываем в переменную
        */





    /* ************** 
        $("#zvonok").submit(function(e) {
            e.preventDefault();
            // Работа с виджетом recaptcha
            // 1. Получить ответ гугл капчи
            var captcha = grecaptcha.getResponse();
            console.log('captcha : ', captcha);

            var base_url = window.location.origin; // 
            console.log('base_url : ', base_url);

            // 2. Если ответ пустой, то выводим сообщение о том, что пользователь не прошёл тест.
            // Такую форму не будем отправлять на сервер.

            if (!captcha.length) {
                // Выводим сообщение об ошибке
                $('#recaptchaError').text(' ! Вы не прошли проверку "Я не робот" ! ');
            } else {
                // получаем элемент, содержащий капчу
                $('#recaptchaError').text('');
            }

            // 3. Если форма валидна и длина капчи не равно пустой строке, то отправляем форму на сервер (AJAX)
            if (captcha.length) {

                // добавить в formData значение 'g-recaptcha-response'=значение_recaptcha
                //data.append('g-recaptcha-response', captcha);


                $.ajax({
                    type: "POST",
                    url: base_url + '/wp-content/themes/web-star/assets/modul/email.php',
                    //    data: formNm.serialize(),
                    //dataType: 'json', // data type                
                    data: $(this).serialize(),

                    beforeSend: function() {
                        $('#recaptchaError').text(' Идет передача данных...');
                    },
                    success: function(response) {
                        $('#recaptchaError').text('');
                        console.log('AJAX response : ', response);
                        //$(formNm).css("display","block");
                        // $('.formTitle').css("display", "block");
                        //$('.msgs').html('Заказ обратного звонока отправлен. Мы свяжемся с вами в ближайшее время.');
                        $('input').not(':input[type=submit], :input[type=hidden]').val('');
                        $('textarea').val('');
                        grecaptcha.reset();

                        setTimeout(function() {
                            // $('div.alert-success').html('Форма успешно отправлена.');
                            $('.form-result-success').toggleClass('d-none');
                            div_hide('openModal');
                        }, 2200);
                        $('.form-result-success').toggleClass('d-none');
                    },

                    error: function(jqXHR, text, error) {
                        $('#recaptchaError').text('');
                        // 4. Если сервер вернул ответ error, то делаем следующее...
                        // Сбрасываем виджет reCaptcha
                        grecaptcha.reset();
                        // Если существует свойство msg у объекта $data, то...
                        if ($data.msg) {
                            // вывести её в элемент у которого id=recaptchaError
                            $('#recaptchaError').text($data.msg);
                        }
                        // Вывод сообщения об ошибке отправки
                        //message.html(error);
                        //formTitle.css("display", "none");
                        // $(formNm).css("display","none");
                        //$(formNm).css("display","block");
                        //     $('.formTitle').css("display", "block");
                        // $('.msgs').html('Ошибка! Заявка не отправлена!');
                        $('input').not(':input[type=submit], :input[type=hidden]').val('');
                        $('textarea').val('');

                        setTimeout(function() {
                            // $('.mform-error').html('Ошибка. Данные не отправлены.');
                            $('.mform-error').toggleClass('d-none');
                            div_hide('openModal');
                        }, 2000);
                        $('.mform-error').toggleClass('d-none');
                    }
                })
            }
            return false;
        });
        //для стилей формы
        /*
        var $input = $('.form-fieldset > input');
        $input.blur(function(e) {
            $(this).toggleClass('filled', !!$(this).val());
        });
    */

})