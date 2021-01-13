<?php 
//  регистрация sidebar 
add_action('widgets_init', function(){  // widgets_init название хука
    register_sidebar([
		'name'          => 'Сайдбар сверху',
		'id'            => 'sidebar-top',
		'description'   => 'Для верхнего меню',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<div class="menu">',
		'after_title'   => "</div>\n",
     ]);