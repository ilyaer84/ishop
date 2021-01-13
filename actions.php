<?php 
/*
    Template Name: Акции 
*/
?>

<?php 
//  для адрес магазина
get_header();

$link =get_permalink();    // переменная для ссылки

/*
$args = array(
   'post_type'  => 'post',
   'category_name' =>   'actions' ,
   'meta_query' => array(
      array(
         'key'     => date("Y-M-D", $data_s),
         'value'   => date("Y-M-D"),
         'type'    => 'DATE',
         'compare' => '!='
      ),
  	array(
         'key'     => date("d.m.Y", $data_do),
         'value'   => $cur_data,
         'type'    => 'DATE',
         'compare' => '>='
      )
   )
 );
query_posts( $args );  
*/


if ( astra_page_layout() == 'left-sidebar' ) :
   
   // get_sidebar();

   ?>
<!-- sidebar -->
<div class="widget-area secondary" id="secondary" role="complementary" itemtype="https://schema.org/WPSideBar" itemscope="itemscope">
	<div class="sidebar-main"> 
  <?php  
   if ( ! dynamic_sidebar('sidebar-act') ) : 
   
   query_posts( array(
               'post_type'  =>  'post',
               'category_name' =>   'actions' ,          
            )
            );
   ?>

<?php  
  if(have_posts()) {


   echo '<div class="type_mag"> <h2 class="widget-title"> Фильтр по типу акции </h2>';
   echo '<a href="'.$link.'?w=all" >Все</a><br>';

  $typ_act = array();
while(have_posts()):  the_post(); // перебираем посты 
 if(get_field('period')) {

   $xdata =  get_field('period'); //getdate(); // использовано текущее время
   $cur_data = date("Y.m.d");
   // Даты в Великобритании (например, 27/05/1990) не будут работать с strotime, даже если часовой пояс установлен правильно.
   //Однако, если вы просто замените «/» на «-», он будет работать нормально.
   
   $data_s = strtotime(str_replace('/', '-', $xdata['ac_s']));  // strtotime() может преобразовать текстовое представление даты/времени в метку времени
   $data_do = strtotime(str_replace('/', '-', $xdata['ac_do']));

      if ( date("Y.m.d") >=  date("Y.m.d",$data_s)  and ( date("Y.m.d")  <= date("Y.m.d",$data_do) ) ) {
         $posttags = get_the_tags();
        //echo '<pre>'.$posttags.'</pre>';
         //wtf ($posttags);
         if( $posttags ) {
            $typ_act[$posttags[0]->name] = $posttags[0]->slug;
            //$typ_act[] .= $posttags[0]->slug;
            //   echo $posttags[0]->name . ' ';            
         }
      }
   }

endwhile;
 
// wtf($typ_act);

//Удаление дубликатов из массива
//$array = array("Красный", "Желтый", "Красный", "Белый");
//$result = array_diff($typ_act, array_diff_assoc($typ_act, array_unique($typ_act)));
//С помощью array_unique мы выбираем уникальные значения.
//С помощью array_diff_assoc находим расхождение, с учетом ключей.
//С помощью array_diff, который не учитывает ключи, убиваем эти повторения.
// print_r($result);

$array = array_unique($typ_act); // array_unique — Убирает повторяющиеся значения из массива

foreach ($array as $key => $value) {
echo '<a href="'.$link.'?w='.$value.'" >'.$key.'</a><br>';
}
echo '</div>';

  }
         ?>

<?php endif; 
wp_reset_query();
 // dynamic_sidebar('sidebar-act'); 
    
?>
	</div> 
</div>  <!--.sidebar-main  -->
<?php
 endif ;
?>


<?php
// основной запрос 

if( isset($_GET['w']) and $_GET['w'] != 'all') {  

   query_posts( array(
      'post_type'  =>  'post',
      'category_name' =>   'actions' ,
      'tag' =>   $_GET['w'] ,
   )
   );
   
   
         } else {
         query_posts( array(
            'post_type'  =>  'post',
         //        'category__in' => 6,
         //        'cat' => '-12,-34,-56', // все посты, кроме
            'category_name' =>   'actions' ,
         /*       'meta_query' => array(
               array(
                  'key' 	=> 'city',
                  'value' => $_COOKIE['city'] ,
            //     'compare' => 'IN',
            )
            )   */
         )
         );
         }

?>

<div id="primary" class="content-area primary">
		


   <section class="ast-archive-description">
   <h1 class="page-title ast-archive-title"> <?php the_title();  ?></h1>									
   </section>

 <main id="main" class="site-main"> 

 <div class="adr_mag" style=" display: flex;">
<?php 


  

     if(have_posts()) { // все начинается глобальной функции have_post() без аргументов
                        // синтаксис : endif; тоже чтои {}                        
                        
                        ?>

   
   <div id="actions-list" class="action_content">

 <?php    while(have_posts()):  the_post(); // перебираем посты 
 if(get_field('period')) {

   $xdata =  get_field('period'); //getdate(); // использовано текущее время
   // $xdata['ac_do'];
   $cur_data = date("Y.m.d");
   
   //echo '$date = '.date("d.m.Y", strtotime($date)) .'<br>';
   //echo '$date2 = '.date("d.m.Y", strtotime($date2));
   //echo '<br> ДАТА $xdata = '.date("jS F, Y", strtotime($xdata)); 
   
   // Даты в Великобритании (например, 27/05/1990) не будут работать с strotime, даже если часовой пояс установлен правильно.
   //Однако, если вы просто замените «/» на «-», он будет работать нормально.
   
   $data_s = strtotime(str_replace('/', '-', $xdata['ac_s']));  // strtotime() может преобразовать текстовое представление даты/времени в метку времени
   $data_do = strtotime(str_replace('/', '-', $xdata['ac_do']));

      if ( date("Y.m.d") >=  date("Y.m.d",$data_s)  and ( date("Y.m.d")  <= date("Y.m.d",$data_do) ) ) {
   
         ?>
      <div class="cont_act"> 
     
      <div class="act_d_img">

         <a href="<?php the_permalink();  ?>">

               <?php // the_post_thumbnail('size100-100'); // вставляем миниатюры

            //the_post_thumbnail(array(50,50)); // вставляем миниатюры с новыми размерами 
            the_post_thumbnail('size100-100', array('class' => 'act_img'));
             
                 ?>
         </a>
      </div>

   
      <div class="cont_act_left">

      <div class="product_labels">
      <span class="label action discount_price_filter">
         <?php $posttags = get_the_tags();
            if( $posttags ) {
               foreach( $posttags as $tag ){
               //   echo $tag->name . ' ';
                  echo $posttags[0]->name . ' '; 
               }
            }
    //     echo get_the_tags(name);
         ?> 
      </span>

  <?php 

   //текущая дата

//список месяцев с названиями для замены
$_monthsList = array(
  ".01." => "января",
  ".02." => "февраля",
  ".03." => "марта",
  ".04." => "апреля",
  ".05." => "мая",
  ".06." => "июня",
  ".07." => "июля",
  ".08." => "августа",
  ".09." => "сентября",
  ".10." => "октября",
  ".11." => "ноября",
  ".12." => "декабря"
);
 
//Наша задача - вывод русской даты, 
//поэтому заменяем число месяца на название:

//   $_mD = date(".m.", strtotime($currentDate)); //для замены
//   $currentDate = str_replace($_mD, " ".$_monthsList[$_mD]." ", $currentDate);

//$data_s = date("d.m.y", $data_s);
//   $data_do = date("d.m.", $data_do);
      $_mD = date(".m.", $data_s); //для замены
      $data_s = date("d", $data_s) . " ".$_monthsList[$_mD]." ";

      $_mD = date(".m.", $data_do); //для замены
      $data_do = date("d", $data_do) . " ".$_monthsList[$_mD]." ";
  
         ?>
       <time> с <?php echo $data_s; ?> до <?php echo  $data_do;  ?>
      </time>
         <?php   
      ?>
      </div>
      

      <div class="act_title">
      <a href="<?php the_permalink();  ?>">
      <?php the_title();  ?>
         </a>
      </div>
     
    <div class="act_excerpt">
    <?php the_excerpt() ?>  
    </div>
    


    </div>


   </div>

<?php
 }
 }
endwhile; 
?>

<?php
     }  // if(have_posts())
     else {      
      echo '<div class="d_osh"> Акции не найдены! </div>';
   }
?>


   </div>

   </div>
</main> 
<!-- #main -->

</div>


<?php wp_reset_query(); ?>

<!-- sidebar -->
<?php
if ( astra_page_layout() == 'right-sidebar' ) :
   
    //get_sidebar();

   ?>
<!-- sidebar -->
 <div class="widget-area secondary" id="secondary" role="complementary" itemtype="https://schema.org/WPSideBar" itemscope="itemscope">
	<div class="sidebar-main"> 
  <?php  
   if ( ! dynamic_sidebar('sidebar-act') ) : 
   
   query_posts( array(
               'post_type'  =>  'post',
               'category_name' =>   'actions' ,          
            )
            );
   ?>

<?php  
  if(have_posts()) {


   echo '<div class="type_mag"> <h2 class="widget-title"> Фильтр по типу акции </h2>';
   echo '<a href="'.$link.'?w=all" >Все</a><br>';

  $typ_act = array();
while(have_posts()):  the_post(); // перебираем посты 
 if(get_field('period')) {

   $xdata =  get_field('period'); //getdate(); // использовано текущее время
   $cur_data = date("Y.m.d");
   // Даты в Великобритании (например, 27/05/1990) не будут работать с strotime, даже если часовой пояс установлен правильно.
   //Однако, если вы просто замените «/» на «-», он будет работать нормально.
   
   $data_s = strtotime(str_replace('/', '-', $xdata['ac_s']));  // strtotime() может преобразовать текстовое представление даты/времени в метку времени
   $data_do = strtotime(str_replace('/', '-', $xdata['ac_do']));

      if ( date("Y.m.d") >=  date("Y.m.d",$data_s)  and ( date("Y.m.d")  <= date("Y.m.d",$data_do) ) ) {
         $posttags = get_the_tags();
        //echo '<pre>'.$posttags.'</pre>';
         //wtf ($posttags);
         if( $posttags ) {
            $typ_act[$posttags[0]->name] = $posttags[0]->slug;
            //$typ_act[] .= $posttags[0]->slug;
            //   echo $posttags[0]->name . ' ';            
         }
      }
   }

endwhile;
 
// wtf($typ_act);

//Удаление дубликатов из массива
//$array = array("Красный", "Желтый", "Красный", "Белый");
//$result = array_diff($typ_act, array_diff_assoc($typ_act, array_unique($typ_act)));
//С помощью array_unique мы выбираем уникальные значения.
//С помощью array_diff_assoc находим расхождение, с учетом ключей.
//С помощью array_diff, который не учитывает ключи, убиваем эти повторения.
// print_r($result);

$array = array_unique($typ_act); // array_unique — Убирает повторяющиеся значения из массива

foreach ($array as $key => $value) {
echo '<a href="'.$link.'?w='.$value.'" >'.$key.'</a><br>';
}
echo '</div>';

  }
         ?>

<?php endif; 
wp_reset_query();
 // dynamic_sidebar('sidebar-act'); 
    
?>
	</div> 
</div>  <!--.sidebar-main  -->
<?php
 endif ;

   // dynamic_sidebar('sidebar-top'); //для вызова по ид сайдбар
   //get_sidebar('adres-mag'); // для вызова из фала sidebar-adres-mag.php
   

?>



<?php


get_footer(); ?>

