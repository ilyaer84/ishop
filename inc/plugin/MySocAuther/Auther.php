<?php

$adapterConfigs = array(
    'vk' => array(
        'client_id'     => '7725386', // ID приложения
        'client_secret' => 'f3apfsnqlfNTXOlJyTRG', // Защищённый ключ
        'redirect_uri'  => 'http://avito-pro/auth?provider=vk' // Адрес сайта
    ),
    
    'yandex' => array(
        'client_id'     => 'bff0bfcaef054ab66c0538b39e0a86cf',
        'client_secret' => '219ba88d386b114b9c6abef7eab4e8e4',
        'redirect_uri'  => 'http://localhost/auth/?provider=yandex'
    ),
    'google' => array(
        'client_id'     => '393337311853.apps.googleusercontent.com',
        'client_secret' => 'B38WaUlZG8gDI6jIEWVct5id',
        'redirect_uri'  => 'http://localhost/auth?provider=google'
    ),
	 /*
	 'odnoklassniki' => array(
		'client_id'     => '658606315',
		'client_secret' => 'C35045020A8C7C066F25C4C7',
		'redirect_uri'  => 'http://localhost/auth?provider=odnoklassniki',
		'public_key'    => 'BAMKABABACADCBBAB'
  ),
  'mailru' => array(
		'client_id'     => '670707',
		'client_secret' => 'a619062972f2073ded61405b8f8eccd2',
		'redirect_uri'  => 'http://localhost/auth/?provider=mailru'
  ),
    'facebook' => array(
        'client_id'     => '346158195993388',
        'client_secret' => '2de1ab376d1c17cd47250920c05ab386',
        'redirect_uri'  => 'http://localhost/auth?provider=facebook'
    )
	 */
);

//include_once(get_stylesheet_directory() . '/inc/plugin/SocialAuther/autoload.php');

/*
include_once(get_stylesheet_directory() . '/inc/plugin/SocialAuther/SocialAuther.php');
include_once(get_stylesheet_directory() . '/inc/plugin/SocialAuther/Adapter/AdapterInterface.php');


*/


$client_id = 7725386; // ID приложения
$client_secret = 'f3apfsnqlfNTXOlJyTRG'; // Защищённый ключ
$redirect_uri = 'http://avito-pro/'; // Адрес сайта auth?provider=vk

$url_auther = 'http://oauth.vk.com/authorize'; // Ссылка для авторизации на стороне ВК

$params = [ 'client_id' => $client_id, 'redirect_uri'  => $redirect_uri, 'response_type' => 'code']; // Массив данных, который нужно передать для ВК содержит ИД приложения код, ссылку для редиректа и запрос code для дальнейшей авторизации токеном

/*
//if(empty($_SESSION['id'])) {
    if(isset($_SESSION['id']) & !empty($_SESSION['id']) ) {

    echo "Вы авторизованы!";

} else {

    echo $link = '<p><a href="' . $url_auther . '?' . urldecode(http_build_query($params)) . '">Аутентификация через ВКонтакте</a></p>';
    // urldecode — Декодирование URL-кодированной строки
    // http_build_query — Генерирует URL-кодированную строку запроса
}
*/

$result = false;

if (isset($_GET['code'])) {
    $result = true;
    $params = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri
    ];


    // Осуществляем запрос через функцию file_get_contents:
    // Ответ от сервера приходит в формате JSON, поэтому декодируем его в ассоциативный массив и достаем из него параметры
    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $params = [
            'uids' => $token['user_id'],
            'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,nickname',
            'access_token' => $token['access_token'],
            'v' => '5.95'];


            // После того как получен токен, мы можем запросить данные пользователя.
            // Для этого посылаем на сервер ВК еще один GET запрос: 
            // Осуществляем запрос и декодируем JSON ответ:
        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['id'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }

    
    if ($result) {
        /*
        Здесь делаем логику
            проверка зарегин ли - ! с какой сети ! 
            регистрируем если не зарегин

            и производим вход 
        */
        echo "ID пользователя: " . $userInfo['id'] . '<br />';
        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
        echo "Ссылка на профиль: " . $userInfo['screen_name'] . '<br />';
        if($userInfo['sex'] == 0){echo "Пол: не указан<br>";}
        if($userInfo['sex'] == 1){echo "Пол: женский<br>";}
        if($userInfo['sex'] == 2){echo "Пол: мужской<br>";}
        echo "День Рождения: " . $userInfo['bdate'] . '<br />';
        echo '<img src="' . $userInfo['photo_big'] . '" />'; echo "<br />";


        wplb_ajax_request();

        /*
        echo "Фамилия: ".$data['last_name']."<br>";
        echo "Дата рождения: ".$data['bdate']."<br>";
        echo "Страна: ".$data['country']['title']."<br>";
        echo "Город: ".$data['city']['title'];
*/
    }
}

$_SESSION['id'] = $userInfo['id'];

