<?php
// Проверяем или метод запроса POST
/*
if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['j']) ) {
  header("Location: /");
  exit();
} 

/*
 include_once ( __DIR__ . '/recaptchalib.php') ;

// Введите свой секретный ключ
$secret = "6LepUAEVAAAAAGT-eGQgaNIfG4EpmxkqGWTR0-SV";
//$secret = "6Ldifv4UAAAAAD802ONPJcnujSeW4wi63K9x7R6x";

// пустой ответ каптчи
$response = null;

// Для проверка вашего секретного ключа
$reCaptcha = new ReCaptcha($secret);
if ($_POST["g-recaptcha-response"]) {
$response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
*/
const 
  IS_CHECK_CAPTCHA = false, // проверять капчу
  IS_SEND_MAIL = true, // отправлять письмо получателю
  IS_SEND_MAIL_SENDER = false, // отправлять информационное письмо отправителю
  IS_WRITE_LOG = false ; // записывать данные в лог

 //   $to = TO_EMAI ;
  $to = "ilyaer84@ya.ru";//Почтовый ящик на который будет отправленно сообщение
  $subject = "Заказ звонка";//Тема сообщения
  $message = "Message, сообщение!";//Сообщение, письмо
  $from = "noreply@web-app-pro.ru"; // кто отправитель
  
  //$headers = "Content-type: text/plain; charset=utf-8 \r\n";//Шапка сообщения, 
  //содержит определение типа письма, от кого, и кому отправить ответ на письмо
  $headers = "Content-type: text/html; charset=\"utf-8\"\r\n";  //         
  $headers .= "From: ".$from." \r\n";  // кто отправитель
  $headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";  // дата
  $headers .= "Precedence: bulk\r\n";  // (если убрать то единичное письмо) не единичное письмо, письмо рассылка( много идентичных писем) - иначе спам

    // Поочередно проверяем или были переданные параметры формы, или они не пустые

 // if ($response != null && $response->success) { 

  $data['result'] = 'success';

/*  ЭТАП - ПРОВЕРКА КАПЧИ */
if (IS_CHECK_CAPTCHA == true) {

// Проверка того, что есть данные из капчи
if (!$_POST["g-recaptcha-response"]) {
  // Если данных нет, то программа останавливается и выводит ошибку
  
  $data['result'] = 'error';
  $data['capt'] = 'Не пройдена каптча! Попробуйте еще раз!';
  exit("Произошла ошибка");
} else { // Иначе создаём запрос для проверки капчи
  // URL куда отправлять запрос для проверки
  $url = "https://www.google.com/recaptcha/api/siteverify";
  // Ключ для сервера
  $key = "6LepUAEVAAAAAGT-eGQgaNIfG4EpmxkqGWTR0-SV";
  // Данные для запроса
  $query = array(
      "secret" => $key, // Ключ для сервера
      "response" => $_POST["g-recaptcha-response"], // Данные от капчи
      "remoteip" => $_SERVER['REMOTE_ADDR'] // Адрес сервера
  );

  // Создаём запрос для отправки
  $ch = curl_init();
  // Настраиваем запрос 
  curl_setopt($ch, CURLOPT_URL, $url); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
  curl_setopt($ch, CURLOPT_POST, true); 
  curl_setopt($ch, CURLOPT_POSTFIELDS, $query); 
  // отправляет и возвращает данные
  $data = json_decode(curl_exec($ch), $assoc=true); 
  // Закрытие соединения
  curl_close($ch);

  // Если нет success то
  if (!$data['success']) {
    $data['result'] = 'error';
    $data['capt'] = 'Не пройдена каптча! Попробуйте еще раз!';
      // Останавливает программу и выводит "ВЫ РОБОТ"
      exit("ВЫ РОБОТ");
  } else { 
    $data['result'] = 'success';
  }
}

}

/* ЭТАП - ВАЛИДАЦИЯ ДАННЫХ (ЗНАЧЕНИЙ ПОЛЕЙ ФОРМЫ) */
    if(isset($_POST["zakaz_zvonka"])) {
      $zakaz_zvomka = 'Форма заказа звонка';
    }

    if (isset($_POST['username'])) {
      $name = filter_var($_POST['username'], FILTER_SANITIZE_STRING); // защита от XSS
      $nameLength = mb_strlen($name, 'UTF-8');
      if ($nameLength < 2) {
        $data['username'] = 'Текст должен быть не короче 2 симв. Длина текста сейчас: '. $nameLength .' симв.';
        $data['result'] = 'error';
      } else if ($nameLength > 30) {
        $data['username'] = 'Длина текста не должна превышать 30 симв. (сейчас '. $nameLength .' симв.).';
        $data['result'] = 'error';
      }
    } else {
      $data['username'] = 'Заполните это поле.';
      $data['result'] = 'error';
    }
/*
    if(isset($_POST["username"])) {
      //Если параметр есть, присваеваем ему переданое значение
      $name     =trim(strip_tags($_POST["username"]));
    } else {
      $data['username'] = 'Имя не заполнено';
      $data['result'] = 'error';
    }
*/
// проверка поля email
/*
if (isset($_POST['email'])) {
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { // защита от XSS
    $data['email'] = 'Адрес электронной почты не корректный';
    $data['result'] = 'error';
  } else {
    $email = $_POST['email'];
  }
} else {
  $data['email'] = 'Заполните это поле.';
  $data['result'] = 'error';
}
*/
// проверка поля phone
/*
if (isset($_POST['usernumber'])) {
  $phone = preg_replace('/\D/', '', $_POST['usernumber']); //получить номер телефона (цифры) из строки
  if (!preg_match('/^(\d{10})$/', $phone)) {
    $data['usernumber'] = 'Поле Телефон содержит не корректный номер!';
    $data['result'] = 'error';
  }
}
*/
  if(isset($_POST["usernumber"]))
    {
      $number   = trim(strip_tags($_POST["usernumber"]));
    } else {
      $data['usernumber'] = 'Телефон не заполнено, или заполнен не правильно!';
      $data['result'] = 'error';
    }

// проверка поля message
/*
if (isset($_POST['mess'])) {
  $message = filter_var($_POST['mess'], FILTER_SANITIZE_STRING); // защита от XSS
  $messageLength = mb_strlen($message, 'UTF-8');
 if ($messageLength < 20) {
    $data['mess'] = 'Текст должен быть не короче 20 симв. Длина текста сейчас: '. $messageLength .' симв.';
    $data['result'] = 'error';
  } elseif ($messageLength > 500) {
    $data['mess'] = 'Длина текста не должна превышать 500 симв. (сейчас '. $messageLength .' симв.)';
    $data['result'] = 'error';
  }
} else {
  $data['mess'] = 'Заполните это поле.';
  $data['result'] = 'error';
}
*/
    if (isset( $_POST["mess"])) {       
      $mess   = trim(strip_tags($_POST["mess"]));
    } else {
  $data['mess'] = 'Заполните это поле.';
  $data['result'] = 'error';
}
    

    if (isset( $_POST["url_str"])) {
      $url_str   = trim(strip_tags($_POST["url_str"]));
    } 
    if (isset( $_POST["zakaz"])) {
      $zakaz   = trim(strip_tags($_POST["zakaz"]));
    }
    
/* 5 ЭТАП - ПРОВЕРКА КАПЧИ */
/*
if (IS_CHECK_CAPTCHA == true) {
  if (isset($_POST['captcha']) && isset($_SESSION['captcha'])) {
    $captcha = filter_var($_POST['captcha'], FILTER_SANITIZE_STRING); // защита от XSS
    if ($_SESSION['captcha'] != $captcha) { // проверка капчи
      $data['captcha'] = 'Код не соответствует изображению.';
      $data['result'] = 'error';
    }
  } else {
    $data['captcha'] = 'Ошибка при проверке кода.';
    $data['result'] = 'error';
  }
}
*/

   // Формируем письмо
if ($data['result'] == 'success' ) {
   
      $message  = "<html>";
        $message  .= "<body>";
        $message  .= "Форма: ".$subject;        
        $message  .= "<br />";
        $message  .= "С сайта: ".$url_str;
        $message  .= "<br />";
        $message  .= "Телефон: ".$number;
        $message  .= "<br />";
        $message  .= "Имя: ".$name;
        $message  .= "<br />";
        $message  .= "Сообщение: ".$mess;
        if (!empty( $zakaz)) {
          $message  .= "<br />Заказ: ".$zakaz;
        }
        $message  .= "<br />Дата: ". date('D, d M Y h:i:s O');
        $message  .= "</body>";
      $message  .= "</html>";
      // Окончание формирования тела письма
      // Посылаем письмо
      //mail (TO_EMAIL, $subject, $message, $headers);
      $send = mail ($to, $subject, $message, $headers);
        if ($send == 'true') {
          $data['res'] = 'Сообщение отправлено!';
        } else {
          echo $data['res'] = 'Сбой. Сообщение не отправлено!</b></p>';
        }
      }
// end Формируем письмо
     

/* ФИНАЛЬНЫЙ ЭТАП - ВОЗВРАЩАЕМ РЕЗУЛЬТАТЫ РАБОТЫ */
 echo json_encode($data);

