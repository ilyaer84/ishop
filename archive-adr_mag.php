archive
<?php 
//  для адрес магазина
get_header();

//wtf($_COOKIE);
?>
<div id="primary" class="content-area primary">
		
<!-- <main id="main" class="site-main"> -->

   <section class="ast-archive-description">
   <h1 class="page-title ast-archive-title"> <?php the_title();  ?></h1>									
   </section>
<div class="adr_mag" style=" display: flex;">

   
<?php 

if( isset($_COOKIE['city'])) {

   if( $_COOKIE['city'] == 'undefined') {
      echo '<div style="text-align:center; width: 100%;"> Адреса магазинов не найдены! </div>';
   } 

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
     
  
         query_posts( array(
            'post_type'  =>  'adr_mag',
            'meta_query' => array(
               array(
                  'key' 	=> 'city',
                  'value' => $_COOKIE['city'] ,
            //     'compare' => 'IN',
            )
            )   
         )
         );
  
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

 

 <div class="graf_block" > <div class="name_col">Время работы </div> 

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


 <div class="tel_block"> <div class="name_col">Телефон </div> 
 
 <?php
while(have_posts()):  the_post(); // перебираем посты
echo '<div class="d_mag">';
echo get_field('tel');
 echo '</div>';
endwhile; 
?>
 </div>

 <div class="type_block"> <div class="name_col p_krai">Тип </div> 
 
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
      echo '<div style="text-align:center; width: 100%;"> Таких типов магазиннов нет! </div>';
   }


wp_reset_query();
}
else {
   echo '<div style="text-align:center; width: 100%;"> Адреса магазинов не найдены! </div>';
}
?>


</div>


<!-- </main> -->
<!-- #main -->

</div>

<!-- sidebar -->
<div class="widget-area secondary" id="secondary" role="complementary" itemtype="https://schema.org/WPSideBar" itemscope="itemscope">
	<div class="sidebar-main">
   <?php // dynamic_sidebar('sidebar-top'); //для вызова по ид сайдбар
   get_sidebar('adres-mag'); // для вызова из фала sidebar-adres-mag.php
  ?>
	</div><!-- .sidebar-main -->
</div>

<?php get_footer(); ?>


