<?php 
    
    add_action('init', function (){
        add_theme_support('post-thumbnails');        
		
		register_post_type('review', array( // регистрация своего типа записи для отзывов
			'labels' => array(
				'name'               => 'Отзывы',
				'singular_name'      => 'Отзыв',
				'add_new'            => 'Добавить отзыв',
				'add_new_item'       => 'Добавление отзыв',
				'edit_item'          => 'Редактирование -',
				'new_item'           => 'Новое -',
				'view_item'          => 'Смотреть -',
				'search_items'       => 'Искать -',
				'not_found'          => 'Не найдено',
				'not_found_in_trash' => 'Не найдено в корзине',
				'menu_name'          => 'Отзывы'
			),
			'public'              => false, // доступ на клиентской части сайта + формируется ссылка
			'show_ui'             => true,  // доступ в админке
			'menu_icon'           => 'dashicons-sticky', 
			'supports'            => array('title', 'thumbnail') // какие стандартные поля будут использованы register_post_type , ('title','editor','author','thumbnail','excerpt','comments')
		) );
	});
    
    function getReviews(){
		$args = array(
			'orderby'     => 'date',
			'order'       => 'ASC',
			'post_type'   => 'review',
		);

		$reviews = [];

		foreach(get_posts($args) as $post){
			$review = get_fields($post->ID);
			$review['name'] = $post->post_title;
			$review['img'] = get_the_post_thumbnail_url($post->ID, 'thumbnail');
			$reviews[] = $review;
		}

		return $reviews;
	};