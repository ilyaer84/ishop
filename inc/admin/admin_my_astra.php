<?php

// Работаем с админкой

// Чтобы узнать screen_id используем функцию get_current_screen(). Её можно повесить на хук in_admin_header: 
/* add_action( 'in_admin_header', function(){  
	echo '<pre>'. print_r( get_current_screen(), 1 ) .'</pre>';
} );
*/

// Работаем с типом записи  алресами магазинов
// добавляем фильтр по типу магазина
function true_taxonomy_filter() {
	global $typenow; // тип поста
	if( $typenow == 'adr_mag' ){ // для каких типов постов отображать
		$taxes = array('type_mag'); // таксономии через запятую
		foreach ($taxes as $tax) {
			$current_tax = isset( $_GET[$tax] ) ? $_GET[$tax] : '';
			$tax_obj = get_taxonomy($tax);
			$tax_name = mb_strtolower($tax_obj->labels->name);
			// функция mb_strtolower переводит в нижний регистр
			// она может не работать на некоторых хостингах, если что, убирайте её отсюда
			$terms = get_terms($tax);
			if(count($terms) > 0) {
				echo "<select name='$tax' id='$tax' class='postform'>";
				echo "<option value=''>Все $tax_name</option>";
				foreach ($terms as $term) {
					echo '<option value='. $term->slug, $current_tax == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
 
add_action( 'restrict_manage_posts', 'true_taxonomy_filter' );

// end adr_mag


 
// add_filter("manage_edit-{название таксономии}_columns", 'true_add_columns');
//Добавляем колонки у постов в админке (сортируемые)




// создаем новую колонку
add_filter( 'manage_'.'adr_mag'.'_posts_columns', 'add_views_column', 4 );
function add_views_column( $columns ){
	$num = 2; // после какой по счету колонки вставлять новые
	$new_columns = array(
		'views' => 'Города',
	);

	return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}

// заполняем колонку данными
// wp-admin/includes/class-wp-posts-list-table.php
add_action('manage_'.'adr_mag'.'_posts_custom_column', 'fill_views_column', 5, 2 );
function fill_views_column( $colname, $post_id ){
	if( $colname === 'views' ){
      // соберем все метаполя в объект $meta
      $views = get_post_meta( $post_id , 'city');
  // echo get_post_meta( $post_id , 'city');
   echo   $views[0];
   //   wtf($metta);
     // echo get_post_meta( $post_id, 'city'); 
    //  echo get_the_terms( $post_id, 'views', 1 );
	}
}

// подправим ширину колонки через css
add_action('admin_head', 'add_views_column_css');
function add_views_column_css(){
	if( get_current_screen()->base == 'edit')
		echo '<style type="text/css">.column-views{width:15%;}</style>';
}

// добавляем возможность сортировать колонку
add_filter('manage_edit-adr_mag_sortable_columns', 'add_views_sortable_column');
function add_views_sortable_column($sortable_columns){
   $sortable_columns['views'] = [ 'views_views', false ]; 
    // false = asc (по умолчанию)
	 // true  = desc

	return $sortable_columns;
}
// изменяем запрос при сортировке колонки
add_action( 'pre_get_posts', 'add_column_views_request' );
function add_column_views_request( $query ){
	if( ! is_admin() 
		|| ! $query->is_main_query() 
		|| $query->get('orderby') !== 'views_views' 
		|| get_current_screen()->id !== 'edit-post'
	)
		return;

	$query->set( 'meta_key', 'views' );
	$query->set( 'orderby', 'meta_value_num' );
}

/*
// изменяем запрос при сортировке колонки
add_filter( 'request', 'add_column_views_request' );
function add_column_views_request( $vars ) {
	if( isset($vars['orderby']) && $vars['orderby'] === 'views_views' ){
		$vars['meta_key'] = 'views';
		$vars['orderby'] = 'meta_value_num';
	}

	return $vars;
}
*/

// end работа с админкой


