<?php 
/*
    Template Name: Страница информация
*/

// Страница отображает записи из рубрики "Информация", и сравнивает с выбранным городом, относиться ли записи к выбранному городу - то выводим. Если запись не относиться ни к какому городу то выводим (считается что относиться ко всем городам). Запись добавляеться и редактируется через админку сайта.
?>

<?php 

if ( astra_page_layout() == 'left-sidebar' ) :
   ?>
<!-- sidebar 
<div class="widget-area secondary" id="secondary" role="complementary" itemtype="https://schema.org/WPSideBar" itemscope="itemscope">
	<div class="sidebar-main">
   -->
  <?php  get_sidebar();
//wtf($_COOKIE);
?>
<!-- .sidebar-main 
	</div>
</div> -->
<?php endif ;
?>

<!-- info-page -->
<?php
get_header();
// astra_entry_content_single

query_posts( array(
   'post_type'  =>  'post',
//        'category__in' => 6,
//        'cat' => '-12,-34,-56', // все посты, кроме
       'category_name' =>   'info' ,
   'order'=> 'DESC', // ASC сначало старые о порядку (от меньшего к большему // DESC
 //  'orderby' => 'date ' ,   
)
);
if(have_posts()) { // все начинается глобальной функции have_post() без аргументов
   ?>
<div id="primary" class="content-area primary">

   <section class="ast-archive-description">
   <h1 class="page-title ast-archive-title"> <?php the_title();  ?></h1>									
   </section>

   <main id="main" class="site-main"> 

<?php astra_entry_before(); ?>

	<?php // astra_entry_top(); ?>

   <?php 

while ( have_posts() ) :
   the_post();

// соберем все метаполя в объект $meta
$meta = new stdClass;
foreach( (array) get_post_meta( $post->ID ) as $k => $v ) $meta->$k = $v[0];

// Теперь, допустим у записи есть метаполе 'city'
// Получаем его так:
//echo $meta->city;


if ( isset($meta->city) && (( isset($_COOKIE['city']) &&  $_COOKIE['city'] != 'undefined') && $meta->city == $_COOKIE['city']) ) {

 //  echo 'echo $meta->city; = '.$meta->city;
 ?>

 <article 
    <?php
       echo astra_attr(
          'article-blog',
          array(
             'id'    => 'post-' . get_the_id(),
             'class' => join( ' ', get_post_class() ),
          )
       );		?>
       >
       <?php
  astra_entry_top();

 astra_entry_content_blog(); ?>

<?php
}
if( !isset($meta->city) || $meta->city == "") {
   ?>

<article 
	<?php
		echo astra_attr(
			'article-blog',
			array(
				'id'    => 'post-' . get_the_id(),
				'class' => join( ' ', get_post_class() ),
			)
		);	?>
      >
      <?php
	
  astra_entry_top();

   astra_entry_content_blog(); 

}

 //  astra_entry_content_blog(); ?>

	<?php astra_entry_bottom(); ?>

</article><!-- #post-## -->

<?php astra_entry_after();

endwhile;
} else {
   echo '<div class="d_osh"> Информация не найдена! </div>';

}
wp_reset_query();
?>


<!-- #main -->
</main> 

</div>



<!-- sidebar -->
<?php
if ( astra_page_layout() == 'right-sidebar' ) :
   ?>
<!-- sidebar -->
<!-- <div class="widget-area secondary" id="secondary" role="complementary" itemtype="https://schema.org/WPSideBar" itemscope="itemscope">
	<div class="sidebar-main"> -->
  <?php get_sidebar();
    
?>
<!--	</div> 
</div>  .sidebar-main  -->
<?php
 endif ;

   // dynamic_sidebar('sidebar-top'); //для вызова по ид сайдбар
   //get_sidebar('adres-mag'); // для вызова из фала sidebar-adres-mag.php
  

?>



<?php get_footer(); ?>

