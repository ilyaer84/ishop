<?php 
/*
    Template Name: Стр Все бренды 
*/
?>

<?php 
get_header();

if ( astra_page_layout() == 'left-sidebar' ) :
   ?>
<!-- sidebar 
<div class="widget-area secondary" id="secondary" role="complementary" itemtype="https://schema.org/WPSideBar" itemscope="itemscope">
	<div class="sidebar-main">
   -->
  <?php  get_sidebar();
     
?>
<!-- .sidebar-main 
	</div>
</div> -->
<?php endif ;
?>

<!-- all_brend -->
<div id="primary" class="content-area primary">

   <section class="ast-archive-description">
   <h1 class="page-title ast-archive-title"> <?php the_title();  ?></h1>	

   <?php
      // Вот так один атрибут без пустых терминов
            $tax = 'pa_brend';
            $pa_args = get_terms( $tax, array(
               'hide_empty' => false,
            )     );

if ( 0 !== count( $pa_args ) ) {
   $string = '';

  // if ( 0 !== count( $pa_args ) ) {
      $count_brend = count( $pa_args );
      ?>

   <h2 class="BrandBook__header">
                Бренды <span class="BrandBook__count"><?php  echo $count_brend; ?></span></h2>								
   </section>

   <main id="main" class="site-main"> 

   <!-- #main -->

   <?php

      $string .= '<div class="stat_col_4"> ';

   foreach ($pa_args as $key => $value) {

         $string .= '<div class="stat__col"> ';
         $string .= '<article class="art__stat">
             <a class="stat__link" href="/shop/?filter_brend='.$value->name.'"> ';
            
             if ( get_field('woo_img_brands', 'pa_brend_'.$value->term_id) ) {
         $string .= '<div class="img_glav_cont" ><img src="'.get_field('woo_img_brands', 'pa_brend_'.$value->term_id).'" class="img_brend" alt="'.$value->name.'"></div>';
             } else {
               $string .= '<div class="img_glav_cont" ><img src="#" class="img_brend" alt="'.$value->name.'"></div>';
             }

         $string .= '<h4 class="stat__title">'.$value->name.' </h4>';
         $string .= '</article></a></div>';
/*
   echo '<a href="/shop/?filter_brend='.$value->name.'"><span itemprop="name">'.$value->name.'</span></a>';

      echo '<img src="'.get_field('woo_img_brands', 'pa_brend_'.$value->term_id).'" class="img_brend" alt="'.$value->name.'">'.'<br>'; 
         $string .= '</div>';
*/
// }
}  $string .= '</div>';
} echo $string;
?>
</main> 

</div>

<!-- end all_brend -->

<!-- sidebar -->
<?php
if ( astra_page_layout() == 'right-sidebar' ) :
   ?>
<!-- sidebar -->
  <?php get_sidebar(); ?>

<?php endif ;?>




<?php get_footer(); ?>