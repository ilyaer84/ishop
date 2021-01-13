
<?php
/*
 * Бэкэнд для добавления настроек на страницу редактирования элементов таксономий
 * Взято из статьи: http://truemisha.ru/blog/wordpress/metadannyie-v-taksonomiyah.html
 * ver 1.2
 * Нужно PHP 5.3+
 */
 class trueTaxonomyMetaBox {
	private $opt;
	private $prefix;

	function __construct( $option ) {
		$this->opt    = (object) $option;
		$this->prefix = $this->opt->id .'_'; // префикс настроек

		foreach( $this->opt->taxonomy as $taxonomy ){
			add_action( $taxonomy . '_edit_form_fields', array( &$this, 'fill'), 10, 2 ); // хук добавления полей
		}

		// установим таблицу в $wpdb, если её нет
		global $wpdb;
		if( ! isset( $wpdb->termmeta ) ) $wpdb->termmeta = $wpdb->prefix .'termmeta';

		add_action('edit_term', array( &$this, 'save'), 10, 1 ); // хук сохранения значений полей
	}

	function fill( $term, $taxonomy ){

		foreach( $this->opt->args as $param ){
			$def   = array('id'=>'', 'title'=>'', 'type'=>'', 'desc'=>'', 'std'=>'', 'args'=>array() );
			$param = (object) array_merge( $def, $param );

			$meta_key   = $this->prefix . $param->id;
			$meta_value = get_metadata('term', $term->term_id, $meta_key, true ) ?: $param->std;

			echo '<tr class ="form-field">';
				echo '<th scope="row"><label for="'. $meta_key .'">'. $param->title .'</label></th>';
				echo '<td>';

				// select
		if( $param->type == 'wp_editor' ){
		  wp_editor( $meta_value, $meta_key, array(
			'wpautop' => 1,
			'media_buttons' => false,
			'textarea_name' => $meta_key, //нужно указывать!
			'textarea_rows' => 10,
			//'tabindex'      => null,
			//'editor_css'    => '',
			//'editor_class'  => '',
			'teeny'         => 0,
			'dfw'           => 0,
			'tinymce'       => 1,
			'quicktags'     => 1,
			//'drag_drop_upload' => false
		  ) );
		}
		// select
				elseif( $param->type == 'select' ){
					echo '<select name="'. $meta_key .'" id="'. $meta_key .'">
							<option value="">...</option>';

							foreach( $param->args as $val => $name ){
								echo '<option value="'. $val .'" '. selected( $meta_value, $val, 0 ) .'>'. $name .'</option>';
							}
					echo '</select>';
					if( $param->desc ) echo '<p class="description">' . $param->desc . '</p>';
				}
				// checkbox
				elseif( $param->type == 'checkbox' ){
					echo '
						<label>
							<input type="hidden" name="'. $meta_key .'" value="">
							<input name="'. $meta_key .'" type="'. $param->type .'" id="'. $meta_key .'" '. checked( $meta_value, 'on', 0) .'>
							'. $param->desc .'
						</label>
					';
				}
				// textarea
				elseif( $param->type == 'textarea' ){
					echo '<textarea name="'. $meta_key .'" type="'. $param->type .'" id="'. $meta_key .'" value="'. $meta_value .'" class="large-text">'. esc_html( $meta_value ) .'</textarea>';                    
					if( $param->desc ) echo '<p class="description">' . $param->desc . '</p>';
				}
				// text
				else{
					echo '<input name="'. $meta_key .'" type="'. $param->type .'" id="'. $meta_key .'" value="'. $meta_value .'" class="regular-text">';

					if( $param->desc ) echo '<p class="description">' . $param->desc . '</p>';
				}
				echo '</td>';
			echo '</tr>';         
		}

	}

	function save( $term_id ){
		foreach( $this->opt->args as $field ){
			$meta_key = $this->prefix . $field['id'];
			if( ! isset($_POST[ $meta_key ]) ) continue;

			if( $meta_value = trim($_POST[ $meta_key ]) ){
				update_metadata('term', $term_id, $meta_key, $meta_value, '');
			}
			else {
				delete_metadata('term', $term_id, $meta_key, '', false );
			}
		}
	}

}


add_action('init', 'register_additional_term_fields');
function register_additional_term_fields(){ 
	new trueTaxonomyMetaBox( array(
		'id'       => 'txseo', // id играет роль префикса названий полей
		'taxonomy' => array('category','post_tag'), // названия таксономий, для которых нужно добавить ниже перечисленные поля
		'args'     => array(
			array(
				'id'    => 'seo_title', // атрибуты name и id без префикса, получится "txseo_seo_title"
				'title' => 'SEO Заголовок',
				'type'  => 'text',
				'desc'  => 'Укажите альтернативное название термина для SEO.',
				'std'   => '', // по умолчанию
			),
			array(
				'id'    => 'seo_description',
				'title' => 'SEO Описание',
				'type'  => 'text',
				'desc'  => 'meta тег description.',
				'std'   => '', // по умолчанию
			)
		)
	) );
}


add_action('wp_head', 'add_taxseo_head_meta_fields');
function add_taxseo_head_meta_fields(){
	if( ! is_tax() && ! is_category() && ! is_tag() ) return; // выходим если не таксы

	$term = get_queried_object();

	echo '<meta name="description" content="'. get_metadata('term', $term->term_id, 'txseo_seo_description', 1 ) .'">'. "\n";
}

//apply_filters( 'wp_title', $title, $sep, $seplocation );
add_filter('wp_title', 'add_taxseo_wp_title', 20, 3);
function add_taxseo_wp_title( $title, $sep, $seplocation ){
	if( ! is_tax() && ! is_category() && ! is_tag() ) return $title; // выходим если не таксы

	$term = get_queried_object();
	$title = get_metadata('term', $term->term_id, 'txseo_seo_title', 1 );

	return esc_html( $title );
}

/*
$description = get_metadata('term', $term->term_id, 'txseo_seo_description', 1 )
$title = get_metadata('term', $term->term_id, 'txseo_seo_title', 1 );
*/
// с версии WP 4.4 можно использовать встроенные функции 
$description = get_term_meta( $term->term_id, 'txseo_seo_description', 1 );
$title = get_term_meta( $term->term_id, 'txseo_seo_title', 1 );

/*
созданные метаполя выводятся так:

<?php echo get_metadata('term', $term->term_id, 'term_seo_description', 1 ); ?>

*/
## Функция создания таблицы метаданных таксономий, вешается на register_activation_hook()
# register_activation_hook( __FILE__, 'create_termmeta_table');
function create_termmeta_table(){
	global $wpdb;

	$charset_collate = '';  
	if ( ! empty($wpdb->charset) )
		$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
	if ( ! empty($wpdb->collate) )
		$charset_collate .= " COLLATE $wpdb->collate";

	/*
	 * Indexes have a maximum size of 767 bytes. Historically, we haven't need to be concerned about that.
	 * As of 4.2, however, we moved to utf8mb4, which uses 4 bytes per character. This means that an index which
	 * used to have room for floor(767/3) = 255 characters, now only has room for floor(767/4) = 191 characters.
	 */
	$max_index_length = 191;

	$tables = $wpdb->get_results("show tables like '{$wpdb->prefix}termmeta'");
	if (!count($tables)){
		$wpdb->query("CREATE TABLE {$wpdb->prefix}termmeta (
			meta_id bigint(20) unsigned NOT NULL auto_increment,
			term_id bigint(20) unsigned NOT NULL default '0',
			meta_key varchar(255) default NULL,
			meta_value longtext,
			PRIMARY KEY (meta_id),
			KEY term_id (term_id),
			KEY meta_key (meta_key($max_index_length))
		) $charset_collate;");
	}
}

// запуск
create_termmeta_table();
/************************ */

