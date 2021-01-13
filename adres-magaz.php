<?php 
/*
    Template Name: Адрес магазинов
*/
?>

<?php 
//  для адрес магазина
get_header();

 if ( astra_page_layout() == 'left-sidebar' ) :
   ?>
<!-- sidebar -->
<div class="widget-area secondary" id="secondary" role="complementary" itemtype="https://schema.org/WPSideBar" itemscope="itemscope">
	<div class="sidebar-main">
  <?php get_sidebar('adres-mag');
     

//wtf($_COOKIE);
?>
	</div><!-- .sidebar-main -->
</div>
<?php endif ;
?>

<div id="primary" class="content-area primary">
		


   <section class="ast-archive-description">
   <h1 class="page-title ast-archive-title"> <?php the_title();  ?></h1>									
   </section>

 <main id="main" class="site-main"> 

<div class="adr_mag">

   
<?php 

if( isset($_COOKIE['city']) &&  $_COOKIE['city'] != 'undefined') {
  

   //if( isset($_GET['w'])) {
      /*
      $arg =  array(
         'post_type'  =>  'adr_mag',
         'meta_query' => array(
            array(
               'key' 	=> 'city',
               'value' => $_COOKIE['city'] ,               
               'taxonomy' => 'type_mag',
               'field'    => 'slug',
               'terms'    => $_GET['w']
         //     'compare' => 'IN',
         )
         )   
      );
               $query = new WP_Query( $arg );
 wtf($query);
while ( $query->have_posts() ) {
	$query->the_post();
the_title(  );
*/
     
  

  
         // фильтр по типу магазинов
         if( isset($_GET['w']) and $_GET['w'] != 'all') {            
            query_posts( array(
               'post_type'  =>  'adr_mag',
               'meta_query' => array(
               array(
                  'key' 	=> 'city',
                  'value' => $_COOKIE['city'] ,
            //     'compare' => 'IN',
            )
            ) ,
               'tax_query' => array(
                  array(                     
                     'post_type' => 'adr_mag',                     
                     'taxonomy' => 'type_mag',
                     'field'    => 'slug',
                     'terms'    => $_GET['w']
                  )
               )
            ) );	 
         } else {
            query_posts( array(
               'post_type'  =>  'adr_mag',
       //        'category__in' => 6,
       //        'cat' => '-12,-34,-56', // все посты, кроме
        //       'category_name' =>   'info' ,
               'meta_query' => array(
                  array(
                     'key' 	=> 'city',
                     'value' => $_COOKIE['city'] ,
               //     'compare' => 'IN',
               )
               )   
            )
            );
         }


/*
$arg =  array(
   'post_type'  =>  'adr_mag',
   'meta_query' => array(
      array(
         'key' 	=> 'city',
         'value' => $_COOKIE['city'] ,
   //     'compare' => 'IN',
   )
   )   
);
         $query = new WP_Query( $arg );

         */
 //        wtf($query);

     if(have_posts()) { // все начинается глобальной функции have_post() без аргументов
                        // синтаксис : endif; тоже чтои {}                        
                        
                        ?>

   
<div class="name_block" > <div class="name_col l_krai">Название </div>  

 <?php    while(have_posts()):  the_post(); // перебираем посты 

         ?>
       <div class="d_mag l_krai">
         <a href="<?php the_permalink(); ?> " >
                     <?php the_title();  ?>
         </a>                     
<?php 
echo '<br>'.get_field('city');

$cur_terms = get_the_terms( $post->ID, 'ulicha');
if( is_array( $cur_terms  )) {
   foreach( $cur_terms as $cur_term ){
         echo ' ул. '.$cur_term->name.',';
            }
         }

$cur_terms = get_the_terms( $post->ID, 'dom');
if( is_array( $cur_terms  )) {
   foreach( $cur_terms as $cur_term ){
         echo ' д. '.$cur_term->name.' ';
            }
         }
         

/*
$my_tax = array( 'ulicha','dom' );
$cur_terms = get_the_terms( $post->ID, $my_tax );
//wtf($cur_terms);
if( $cur_terms ){
   if( is_array( $cur_terms ) ){
      foreach( $cur_terms as $cur_term ){
         $data = $cur_term->taxonomy;
         
         if ( $data == 'ulicha') {
            $ul = $cur_term->name;
         }
         if ( $data == 'dom') {
            $dom = $cur_term->name;
         }
 //        echo '<a href="'. get_term_link( $cur_term->term_id, $cur_term->taxonomy ) .'">'. $cur_term->name .'</a>,';
      }
 echo '<div> ул. '.$ul.', д. '.$dom.'</div>,';
  
   }
}
*/

 // the_post_thumbnail('large', array('class' => 'ds_img'));
?>
</div>

<?php
endwhile; 
?>

 </div>

 

 <div class="name_block graf_block" > <div class="name_col">Время работы </div> 

 <?php
while(have_posts()):  the_post(); // перебираем посты
echo '<div class="d_mag">';

$cur_terms = get_the_terms( $post->ID, 'graf_s');
if( is_array( $cur_terms  )) {
   foreach( $cur_terms as $cur_term ){
         echo ' С '.$cur_term->name;
            }
         }
$cur_terms = get_the_terms( $post->ID, 'graf_do');
if( is_array( $cur_terms  )) {
   foreach( $cur_terms as $cur_term ){
         echo ' До '.$cur_term->name;
            }
         }
 echo '</div>';
endwhile; 

?>
 </div>


 <div class="name_block tel_block"> <div class="name_col">Телефон </div> 
 
 <?php
while(have_posts()):  the_post(); // перебираем посты
echo '<div class="d_mag">';
echo get_field('tel');
 echo '</div>';
endwhile; 
?>
 </div>

 <div class="name_block type_block"> <div class="name_col p_krai">Тип </div> 
 
 <?php
while(have_posts()):  the_post(); // перебираем посты
echo '<div class="d_mag">';

$cur_terms = get_the_terms( $post->ID, 'type_mag');
if( is_array( $cur_terms  )) {
   foreach( $cur_terms as $cur_term ){
         echo $cur_term->name;
            }
         }

 echo '</div>';
endwhile; 
?>
 </div>


<?php
     } else {
      
      echo '<div class="d_osh"> Адреса магазинов не найдены! </div>';
   }
    

wp_reset_query();
} else {
   echo '<div class="d_osh"> Выберете город! </div>';
}
?>


</div>


</main> 
<!-- #main -->

</div>

<!-- sidebar -->
<?php
if ( astra_page_layout() == 'right-sidebar' ) :
   ?>
<!-- sidebar -->
<div class="widget-area secondary" id="secondary" role="complementary" itemtype="https://schema.org/WPSideBar" itemscope="itemscope">
	<div class="sidebar-main">
  <?php get_sidebar('adres-mag');
    
?>
	</div><!-- .sidebar-main -->
</div>
<?php
 endif ;

   // dynamic_sidebar('sidebar-top'); //для вызова по ид сайдбар
   //get_sidebar('adres-mag'); // для вызова из фала sidebar-adres-mag.php
  ?>


<?php get_footer(); ?>

