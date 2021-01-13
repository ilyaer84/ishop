файл single-video в корне для шаблона вывода ииз записи квартиры

<?php
 get_header(); // типо include header.php 

?>
<div class="content-wrapper clearfix">
            <main class="clearfix">
                      
            <?php  the_post(); // the_post - функция которая все функции глобально перенастраивать с одного поста на другой
                 ?> 
                
                     <h1> <?php the_title();  ?>  </h1>                      
               
                     <div>
	<!-- выведем нифу с видео через iframe + доделать в стилях  -->
		<iframe width="560" height="320" src="https://www.youtube.com/embed/<?php  echo get_field('code');  // 3_2 короткое описание с помощью доп поля и плагин Advanced Custom Fields
          ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; 
			picture-in-picture" allowfullscreen></iframe>
 
                            </div>

   <!-- выведем слайдс отзывыми -->             
   <?php 
        $reviews = get_field('video-reviews');
        //var_dump($reviews);
foreach($reviews as $review): 
        //print_r($review); // наглядно что взять
        //echo get_field('city'); // будет искать у страницы - глобально настроеного поста
        ?>    
            <div class="user">
                <div class="user__img">
                    <?php // echo get_the_post_thumbnail($review->ID, 'reviews-large'); // reviews-large - свой размер
                    // get_the_post_thumbnail('medium'); -- ищет на этой странице - на глобальной настроена
                    // настриваем на  нужную $review->ID
                    // не забываем в function edrfpfnm в типе записи 'supports' => array('title', 'thumbnail')
                    ?>
                </div>
                <div class="user__name">
                    <?php echo $review->post_title ?>
                </div>
                <div class="user__job">
                    <?php echo get_field('city', $review->ID) // укажим где искать поле city 
                    ?> 
                </div>
                <div class="user__post">
                    <?php echo get_field('text', $review->ID) // укажим где искать поле 
                    ?>
                </div>
            </div>
        <?php endforeach; ?>





   ?>
            </main>

            <aside class="rightBox aside_kv">
                Сайдбар для video не ддинамичекий, а программный
            </aside>
</div>

<?php get_footer(); ?>
