<aside id="archives-3" class="widget widget_archive">
			
<?php


// вытаскиваем все рубрики в массив $typeegories, описание параметров функции смотрите чуть ниже
$type_mag = get_terms('type_mag', 'orderby=name&hide_empty=0');
/* $count = count($type_mag);	
   echo 'count = '.$count;
*/
//   wtf( $type_mag );

$link =get_permalink();    // переменная для ссылки
//$link = dirname($link);
//echo '$link = '.$link;
//untrailingslashit($link);

$i=0;
if($type_mag){ 
   echo '<div class="type_mag"> <h2 class="widget-title"> Фильтр по типу магазина </h2>';
   echo '<a href="'.$link.'?w=all" >Все</a><br>';

   // обращаемся к каждому объекту массива (в данном случае рубрика)
foreach ($type_mag as $type) {
    ++$i; 

   // выводим элемент списка, где атрибут value равен ID рубрики, а $type->name - название рубрики
   if($type->parent == 0) {
   
      //	 echo var_dump($res);	
   // print_r( $type_mag );
      
   //   echo '<br	><input type="checkbox" id="hd-'.$i.'" name="checked"  class="hide" '.$checked.'> >
   //      <label  for="hd-'.$i.'"> <h4>'.$type->name.'</h4> </label>  ';
         echo '<a href="'.$link.'?w='.$type->slug.'" >'.$type->name.'</a><br>';
      
   }
}
echo '</div>';
}

?>

</aside>