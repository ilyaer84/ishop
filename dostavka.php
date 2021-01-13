<?php 
/*
    Template Name: Для доставки
*/
?>

<?php 
get_header();
// astra_entry_content_single


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

<!-- dostavka -->

<div id="primary" class="content-area primary">

   <section class="ast-archive-description">
   <h1 class="page-title ast-archive-title"> <?php the_title();  ?></h1>									
   </section>

   <main id="main" class="site-main"> 

   <?php
if (isset($_COOKIE['city']) && $_COOKIE['city'] != 'undefined' ) {

$postslist = get_posts( array( 'posts_per_page' => 1,
 //     'category' => 84 ,
      'category_name' =>  'dostavka',
    //  'order'=> 'DESC', // ASC сначало старые о порядку (от меньшего к большему // DESC
 //   'orderby' => 'date ' ,
      'meta_query' => array(
   array(
      'key' 	=> 'city',
      'value' => $_COOKIE['city'] ,
//     'compare' => 'IN',
   )
   )   
   ) );
 // wtf($postslist);
   if (!empty($postslist)) {
      foreach( $postslist as $post ){
	   setup_postdata($post); // устанавливаем данные
	?>

   <article 
	<?php
		echo astra_attr(
			'article-single',
			array(
				'id'    => 'post-' . get_the_id(),
				'class' => join( ' ', get_post_class() ),
			)
      );
      
		?>
>

   <?php    astra_entry_top(); ?>

   <?php   astra_entry_content_single(); ?>
	<?php astra_entry_bottom(); ?>

</article><!-- #post-## -->

<?php  // astra_entry_after(); ?>
	<?php
   }
   wp_reset_postdata();

} else { 
   echo '<div class="d_osh"> Данные не найдены! </div>';
      }

} else { 
  //    get_template_part( 'template-parts/content', '404' );
 // astra_404_content_template(); 
 //add_action( 'astra_template_parts_content_none', 'template_parts_none'  );
 //     if( isset($_COOKIE['city']) && $_COOKIE['city'] == 'undefined') {

      echo '<div class="d_osh"> Выберете город! </div>';
 //     } else {
 //        echo '<div class="d_osh"> Данные не найдены! </div>';
 //     }
 //  get_template_part( 'template-parts/content', '404' );
   ?>
<?php
}

 // сброс
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

<script>

 $('.entry-meta').css({
   display: 'none',
   })
   
// заменим ссылку на div
 var aa = $( '.entry-title a' )
 console.log(aa); // 
   aa.replaceWith( "<div>" + $( aa ).text() + "</div>" );
//

// блокировка ссылки
/*  $('.entry-title a').unbind('click');
        $('.entry-title a').click(function () {
            //DO SOMETHING
            return false;
        });
*/


</script>

