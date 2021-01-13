<?php
// Поддержка Open Graph в WordPress

function add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

function insert_fb_in_head() {
    global $post;
    if ( !is_singular())
		return;
		echo '<!-- Open Graph	 -->'."\r\n";
//    echo '<meta property="fb:admins" content="Ваш ID в Facebook"/>';
    echo '<meta property="og:title" content="' . get_the_title() . '"/>'."\r\n";
    echo '<meta property="og:type" content="article"/>'."\r\n";
    echo '<meta property="og:url" content="' . get_permalink() . '"/>'."\r\n";
    echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '"/>'."\r\n";
    if(!has_post_thumbnail( $post->ID )) {
        $default_image = IMG_DIR."ya.jpg";
        echo '<meta property="og:image" content="' . $default_image . '"/>'."\r\n";
    }
    else {
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>'."\r\n";
    }
    echo "
    ";
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );


/****** meta мета теги   ******/
//title
function title_er() {
	$title_er = get_the_title();
	if ( !empty(get_field('title_er')) ) { 
		echo '<title>'.get_field('title_er').'</title>'."\r\n" ;
	} else {
		echo '<title>'.get_the_title().'</title>'."\r\n" ;
	}
}
// robots
function f_robots() {
if (!empty(get_field('robots_er'))) { ?>
	<meta name="robots" content="<?php echo get_field('robots_er'); ?>" />
	<?php }
}

//Keywords
function f_Keywords() {
if (!empty(get_field('keyword_er'))) { ?>
	<meta name="Keywords" content="focus <?php echo get_field('keyword_er'); ?>" />
	<?php }
}
// функция запуска вывода тегов
function seo_er() {
// главная станица 
 // if (is_home()) { 

// для страниц
if (is_front_page() || is_page()) {
	title_er();
	f_robots(); ?>
	<meta name="description" content="<?php echo get_field('description_er') ?>" />	
	<meta property="og:description" content="<?php echo get_field('description_er') ?>"/>
	<?php	f_Keywords() ;
	 } 

// для постов
elseif (is_single()) { 
	title_er();
	f_robots();
	f_Keywords() ;
	echo '<link rel="canonical" href="'.get_page_link().'" />'."\r\n";

	if (!empty(get_field('description_er'))) { ?>
	<meta name="description" content="<?php  echo get_field('description_er') ?>" />	

	<?php } elseif (!empty(get_the_excerpt())) { ?>	
		<meta name="description" content="<?php  $excerpt= get_the_excerpt(); echo substr($excerpt, 0, 250);  
		//  wp_trim_words( get_the_excerpt(), 40, '...' ); Эта функция обрезает текст до определенного количества слов, вместо'...' - что угодно или убрать
		?>" />
	
	<?php } elseif (!empty(get_the_content())) { ?>
		<meta name="description" content="<?php wp_trim_words( get_the_content(), 250, '...' );  ?>" />
		<?php } 	
}

// для рубрик, меток, таксономий
elseif  ( is_category() || is_attachment() || has_term() || is_tag() || is_tax() ){
	
	$term = get_queried_object();  // Получает текущий объект запроса (полная информация о посте, метках, рубриках и т.д.).
	$desc = get_term_meta( $term->term_id); // Получает значение указанного мета поля элемента таксономии (рубрики, метки, и т.д.)
	
	//print_r($term);
	//print_r($desc);
	if(!empty($desc["title_er"]["0"])) {
		echo '<title>'.$desc["title_er"]["0"].'</title>'."\r\n" ;
	} else { ?>
		<title> <?php single_cat_title() ?> </title>
	<?php	}

	if(!empty($desc["description_er"]["0"])) {
	echo '<meta name="description" content="'.$desc["description_er"]["0"].'" /> '."\r\n" ;
		}

	if(!empty($desc["robots_er"]["0"])) {
				echo '<meta name="robots" content="'.$desc["robots_er"]["0"].'" /> '."\r\n";				
		}	
		
	if(!empty($desc["keyword_er"]["0"])) {
				echo '<meta name="Keywords" content="focus '.$desc["keyword_er"]["0"].'" /> '."\r\n";				
		}						
}

/*
Какие типы страниц нужно индексировать (через запятую):
	*                cpage, is_category, is_tag, is_tax, is_author, is_year, is_month,
	*                is_attachment, is_day, is_search, is_feed, is_post_type_archive, is_paged
	*                (можно использовать любые условные теги в виде строки)
	*                cpage - страницы комментариев	
*/
//<meta name="robots" content="index, follow" или content="noindex, nofollow" />
// Рубрики ( category) / метки ( post_tag )  / форматы ( post_format )  - индесировать (все  в настройках Custom Fields)

// ? настройки архивов
// Настройки RSS канала

// не забваем  -    ** Удалить префиксы рубрик *******
}

// twitter
/*
$els['twitter:card']        = '<meta name="twitter:card" content="summary" />';
$els['twitter:description'] = '<meta name="twitter:description" content="'. esc_attr( $desc ) .'" />';
$els['twitter:title']       = '<meta name="twitter:title" content="'. esc_attr( $title ) .'" />';
if( isset($image_url) )
	$els['twitter:image'] = '<meta name="twitter:image" content="'. esc_url($image_url) .'" />';

/**
 * Filter resulting properties. Allows to add or remove any og/twitter properties.
 *
 * @param array  $els
 */
/*
$els = apply_filters( 'kama_og_meta_elements', $els );

return "\n\n". implode("\n", $els ) ."\n\n";
}
*/

/****** end meta мета теги   ******/
