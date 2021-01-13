<?php 
// регистрируем свои типы записи
/*
register_post_type('stocks', [  // регистрируем свою запись
   'labels' => array(
      'name'               => 'Акции',
      'singular_name'      => 'Акция',
      'add_new'            => 'Добавить новую',
      'add_new_item'       => 'Добавление Акции',
      'edit_item'          => 'Редактирование Акции',
      'new_item'           => 'Новая Акция',
      'view_item'          => 'Смотреть Акцию',
      'search_items'       => 'Искать Акции',
      'not_found'          => 'Не найдено',
      'not_found_in_trash' => 'Не найдено в корзине',
      'parent_item_colon'  => '',
      'menu_name'          => 'Акции',
   ),
   'show_ui' => true, // показывать интерфейс в админке
   'public'              => true, // доступ на клиентской части сайта + формируется ссылка
   // формировать url адреса вида: catalog/[slug], у public много аргументов можно менять
   'menu_position'       => 25,
   'menu_icon'           => 'dashicons-category', 
   'hierarchical'        => false,  //  нет родительских элементов
     'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'post-formats'), // какие стандартные
     // поля будут использованы register_post_type , ('title','editor','author','thumbnail','excerpt','comments')
  // 'has_archive'         => true // для данного типа записи будет создана страница архива, котороя позволит отобразить все посты
]);


 // таксономии - раздылы, признаки 
register_taxonomy('type_stocks', ['stocks'], [ // имя таксономии type_stocks, ['stocks'] к  какому типу поста привязываем хоть к станд post
            
     'labels' => array(  // массив
      'name'              => 'Тип акции',
      'singular_name'     => 'тип акции',
      'search_items'      => 'Найти тип акции',
      'all_items'         => 'Все Типы акции',
      'view_item '        => 'Посмотреть тип акции',
      'edit_item'         => 'Редактировать тип акции',
      'update_item'       => 'Обновить тип акции',
      'add_new_item'      => 'Добавить новый тип акции',
      'new_item_name'     => 'Добавить новый',
      'menu_name'         => 'Тип акции',
   ),
   'description'           => 'Где тип Акция',
   'public'              => true,
   'hierarchical'        => false // не иерархичекая таксоомия
]);


register_taxonomy('Период', ['stocks'], array(
   'labels'                => array(
      'name'              => 'Период акции',
      'singular_name'     => 'Период акции',
      'search_items'      => 'Период акции',
      'all_items'         => 'Все варианты',
      'view_item '        => 'Посмотреть к',
      'edit_item'         => 'Редактировать к',
      'update_item'       => 'Обновить к',
      'add_new_item'      => 'Добавить новый к',
      'new_item_name'     => 'Добавить новый',
      'menu_name'         => 'Период акции'
   ),
   'description'           => '', // описание таксономии
   'public'                => true,
   'hierarchical'          => false
));
*/

 // регистрируем свою запись адресс магазина
register_post_type('adr_mag', [ 
   'labels' => array(
      'name'               => 'Адресс магазина',
      'singular_name'      => 'Адресс магазина',
      'add_new'            => 'Добавить новый адресс магазина',
      'add_new_item'       => 'Добавление адресса',
      'edit_item'          => 'Редактирование адресса',
      'new_item'           => 'Новый адресса',
      'view_item'          => 'Смотреть адресс',
      'search_items'       => 'Искать адресс',
      'not_found'          => 'Не найдено',
      'not_found_in_trash' => 'Не найдено в корзине',
      'parent_item_colon'  => '',
      'menu_name'          => 'Адресс магазина',
   ),
   'show_ui' => true, // показывать интерфейс в админке
   'public'              => true, // доступ на клиентской части сайта + формируется ссылка
   'menu_position'       => 25,
   'menu_icon'           => 'dashicons-category', 
   'hierarchical'        => false,  //  нет родительских элементов
     'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'post-formats'), // какие стандартные
     // поля будут использованы register_post_type , ('title','editor','author','thumbnail','excerpt','comments')
   'has_archive'         => true, // есть архивная страница 
   'show_in_rest'          => null, // Создание кастомного типа записей с поддержкой Gutenberg
]);

 // таксономии - раздылы, признаки 
 register_taxonomy('type_mag', ['adr_mag'], [ // имя таксономии type_mag, ['adr_mag'] к  какому типу поста привязываем хоть к станд post
            
   'labels' => array(  // массив
    'name'              => 'Тип магазина',
    'singular_name'     => 'тип магазина',
    'search_items'      => 'Найти тип магазина',
    'all_items'         => 'Все Типы магазина',
    'view_item '        => 'Посмотреть тип магазина',
    'edit_item'         => 'Редактировать тип магазина',
    'update_item'       => 'Обновить тип магазина',
    'add_new_item'      => 'Добавить новый тип магазина',
    'new_item_name'     => 'Добавить новый',
    'menu_name'         => 'Тип магазина',
 ),
 'description'           => 'Где тип магазина',
 'public'              => true,
 'hierarchical'        => false, // не иерархичекая таксоомия
 'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
 'show_tagcloud'     => true, // Создать виджет облако элементов этой таксономии 
 
]);

register_taxonomy('phone_m', ['adr_mag'], [ // имя таксономии cyti, ['adr_mag'] к  какому типу поста привязываем хоть к станд post
            
   'labels' => array(  // массив
    'name'              => 'Телефон',
    'singular_name'     => 'Телефон',
    'search_items'      => 'Найти Телефон',
    'all_items'         => 'Все Телефоны',
    'view_item '        => 'Посмотреть Телефон',
    'edit_item'         => 'Редактировать Телефон',
    'update_item'       => 'Обновить Телефон',
    'add_new_item'      => 'Добавить новый Телефон',
    'new_item_name'     => 'Добавить новый',
    'menu_name'         => 'Телефон',
 ),
 'description'           => 'Где Телефон',
 'public'              => true,
 'hierarchical'        => false, // не иерархичекая таксоомия
 //'rewrite'               => true,  // true (тип записи используется как префикс)
		//'query_var'             => $taxonomy, // название параметра запроса
	//	'capabilities'          => array(),
//		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		
// 'show_admin_column'     => true, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
 //		'show_in_rest'          => null, // добавить в REST API
 //		'rest_base'             => null, // $taxonomy
]);

register_taxonomy('ulicha', ['adr_mag'], [ // имя таксономии ulicha, ['adr_mag'] к  какому типу поста привязываем хоть к станд post
            
   'labels' => array(  // массив
    'name'              => 'Улица',
    'singular_name'     => 'Улица',
    'search_items'      => 'Найти Улицу',
    'all_items'         => 'Все Улицы',
    'view_item '        => 'Посмотреть Улицу',
    'edit_item'         => 'Редактировать Улицу',
    'update_item'       => 'Обновить Улицу',
    'add_new_item'      => 'Добавить новую Улицу',
    'new_item_name'     => 'Добавить новую',
    'menu_name'         => 'Улица',
 ),
 'description'           => 'Где Улица',
 'public'              => true,
 'hierarchical'        => false // не иерархичекая таксоомия
]);

register_taxonomy('dom', ['adr_mag'], [ // имя таксономии ulicha, ['adr_mag'] к  какому типу поста привязываем хоть к станд post
            
   'labels' => array(  // массив
    'name'              => 'Дом',
    'singular_name'     => 'Номер дома',
    'search_items'      => 'Найти Дом',
    'all_items'         => 'Все дома',
    'view_item '        => 'Посмотреть дома',
    'edit_item'         => 'Редактировать дом',
    'update_item'       => 'Обновить дом',
    'add_new_item'      => 'Добавить новый дом',
    'new_item_name'     => 'Добавить новый',
    'menu_name'         => 'Дом',
 ),
 'description'           => 'Где дом',
 'public'              => true,
 'hierarchical'        => false // не иерархичекая таксоомия
]);

register_taxonomy('graf_s', ['adr_mag'], [ // имя таксономии graf_s, ['adr_mag'] к  какому типу поста привязываем хоть к станд post
            
   'labels' => array(  // массив
    'name'              => 'С какого часа',
    'singular_name'     => 'С какого часа',
    'search_items'      => 'Найти С какого часа',
    'all_items'         => 'Все С какого часа',
    'view_item '        => 'Посмотреть С какого часа',
    'edit_item'         => 'Редактировать С какого часа',
    'update_item'       => 'Обновить С какого часа',
    'add_new_item'      => 'Добавить новый С какого часа',
    'new_item_name'     => 'Добавить новый',
    'menu_name'         => 'С какого часа',
 ),
 'description'           => 'Где С какого часа',
 'public'              => true,
 'hierarchical'        => false // не иерархичекая таксоомия
]);
register_taxonomy('graf_do', ['adr_mag'], [ // имя таксономии graf_do, ['adr_mag'] к  какому типу поста привязываем хоть к станд post
            
   'labels' => array(  // массив
    'name'              => 'До какого часа',
    'singular_name'     => 'До какого часа',
    'search_items'      => 'Найти До какого часа',
    'all_items'         => 'Все До какого часа',
    'view_item '        => 'Посмотреть До какого часа',
    'edit_item'         => 'Редактировать До какого часа',
    'update_item'       => 'Обновить До какого часа',
    'add_new_item'      => 'Добавить новый До какого часа',
    'new_item_name'     => 'Добавить новый',
    'menu_name'         => 'До какого часа',
 ),
 'description'           => 'Где До какого часа',
 'public'              => true,
 'hierarchical'        => false // не иерархичекая таксоомия
]);
//


 // регистрируем свою запись ИНФОРМАЦИЯ
 register_post_type('information', [ 
   'labels' => array(
      'name'               => 'Информация',
      'singular_name'      => 'Информация',
      'add_new'            => 'Добавить новую информацию',
      'add_new_item'       => 'Добавление информации',
      'edit_item'          => 'Редактирование информации',
      'new_item'           => 'Новая информация',
      'view_item'          => 'Смотреть информацию',
      'search_items'       => 'Искать информацию',
      'not_found'          => 'Не найдено',
      'not_found_in_trash' => 'Не найдено в корзине',
      'parent_item_colon'  => '',
      'menu_name'          => 'Информация',
   ),
   'show_ui' => true, // показывать интерфейс в админке
   'public'              => true, // доступ на клиентской части сайта + формируется ссылка
   'menu_position'       => 25,
   'menu_icon'           => 'dashicons-category', 
   'hierarchical'        => false,  //  нет родительских элементов
     'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'post-formats'), // какие стандартные
     // поля будут использованы register_post_type , ('title','editor','author','thumbnail','excerpt','comments')
   'has_archive'         => true, // есть архивная страница 
   'show_in_rest'          => true, // Создание кастомного типа записей с поддержкой Gutenberg
]);

register_taxonomy('Категория инф-ии', ['information'], [ // имя таксономии graf_do, ['adr_mag'] к  какому типу поста привязываем хоть к станд post
            
   'labels' => array(  // массив
    'name'              => 'Категория инф-ии',
    'singular_name'     => 'Категория инф-ии',
    'search_items'      => 'Найти Категория инф-ии',
    'all_items'         => 'Все Категория инф-ии',
    'view_item '        => 'Посмотреть Категория инф-ии',
    'edit_item'         => 'Редактировать Категория инф-ии',
    'update_item'       => 'Обновить Категория инф-ии',
    'add_new_item'      => 'Добавить новый Категория инф-ии',
    'new_item_name'     => 'Добавить новый',
    'menu_name'         => 'Категория инф-ии',
 ),
 'description'           => 'Где Категория инф-ии',
 'public'              => true,
 'hierarchical'        => true // не иерархичекая таксоомия
]);

//

/*
slug — по ярлыку,

   post_type - все записи данного типа
   post_type/post_slug - одна запись данного типа

   taxonomy_name/taxonomy_slug

   taxonomy_name - funct
   taxonomy_slug - из админки

   stocks
   stocks/moscow
     stocks/moscow/id
     **********

     stocks?type_stocks=moscow&rooms=3
     get запрос 
     на странице stocks  или др
     с помощью ф-ии get_post выбирать все данные данного типа

function test_postsRecent($atts){  // пример нужное ниже
   $atts = shortcode_atts([    //
      'cnt' => 3              //
   ], $atts);                  //

   $posts = get_posts([        <----------
      'post_type'   => 'post',    
      'numberposts' => $atts['cnt'],  
      'orderby'     => 'date',
         'order'       => 'DESC',
                                     <---- добавляем ключ meta_query 
   ]);

*/
//