<?php
/*********    работаем с аватарами      *********/
/*
Возможно, при работе с профилями пользователей вам понадобятся еще такие функции из WordPress Codex в переводе на сайте wp-kama.ru:
    get_user_meta()
    get_the_author_meta()
    get_userdata()
    wp_get_current_user()
    get_users()
*/

add_action( 'show_user_profile', 'er_ava_extra_fields_to_user' );
add_action( 'edit_user_profile', 'er_ava_extra_fields_to_user' );

function er_ava_extra_fields_to_user($user){
	$default_image = get_stylesheet_directory_uri('/assets/img/no-user.png', __FILE__); 
	$user_img = get_user_meta( $user->ID, 'userimg', true) ;
	
?>
  <h3>Extra profile information</h3>
  <table class="form-table">
   <tr>
     <th>
	<img data-src="<?php echo $default_image ?>" width="150" height="150" id="profile-user-img" 
        src="<?php echo ( $user_img!= "" ? $user_img : $default_image) ?>"  />
     </th>
     <td>
	<label for="userimg">Profile Image</label>
	<br>
	<input type="text" name="userimg" id="userimg" value="<?php echo $user_img ?>" size="50" />
        <span class="profile-buttons">
          <input type="button" name="submit" id="submit-photo" class="button user_image_button" 
          value="Select image">
          <input type="button" name="submit" id="delete" class="button delete remove-user-image" 
          value="&times;">
        </span>    
    </td>
   </tr>
 </table>
<?php }
//Сохранение полей в профиле пользователя при обновлении профиля
add_action( 'personal_options_update', 'er_ava_extra_fields_to_user_save' );
add_action( 'edit_user_profile_update', 'er_ava_extra_fields_to_user_save' );
function er_ava_extra_fields_to_user_save($user_id){
	if (!current_user_can('edit_user', $user_id))
		return false;
	update_user_meta($user_id, 'userimg', $_POST['userimg']);
}

// Подключение скриптов
//стандартный медиа-загрузчик WordPress, необходимо его добавить в нашу функцию строкой wp_enqueue_media();
function er_ava_admin_scripts() {
   wp_enqueue_media();
   wp_enqueue_script(
  'user-profile-image-uploader',
  get_stylesheet_directory_uri( '/assets/js/image-uploader.js', __FILE__ ),
  array( 'jquery','media-upload' ), 1.0, true
    );
}

add_action( 'admin_enqueue_scripts', 'er_ava_admin_scripts' );

//Создание колонок для страницы со списком пользователей

add_filter( 'manage_users_columns', 'your_slug_add_profile_photo_column', 4 );
function your_slug_add_profile_photo_column( $columns ){
   $num = 2; // после какой по счету колонки вставлять новую

   $new_columns = array(
       'profile_photo' => __('Profile Photo','profile-photo'),
   );

   return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}

//Заполнение колонки данными пользователей
add_action( 'manage_users_custom_column', 'your_slug_fill_photo_column', 10, 3);
function your_slug_fill_photo_column( $val, $colname, $user_id ){
   $default_image = get_stylesheet_directory_uri('images/no-user.png', __FILE__);
   $user_img = get_user_meta( $user_id, 'userimg', 1 );
   if( $colname === 'profile_photo' ){
	return '<img src="'.(empty($user_img)? $default_image : $user_img ).'" width="50">'; 
   }
}