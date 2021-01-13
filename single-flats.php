файл single-flats в корне для шаблона вывода ииз записи квартиры

<?php
 get_header(); // типо include header.php 

?>
<div class="content-wrapper clearfix">
            <main class="clearfix">
                      
            <?php  the_post(); // the_post - функция которая все функции глобально перенастраивать с одного поста на другой
                 ?> 
                <?php the_post_thumbnail('large', [
                    'class' => 'falts-img' //  вставляем свой класс
                ]); // вставляем миниатюры
                            ?>
                     <h1> <?php the_title();  ?>  </h1>                      
               
               <hr>
                <div class="like-box">
                    Likes: <span> <?php echo get_field('likes_fl'); ?>  </span>
                    <span class="like-post" data-id="<?php echo get_the_ID(); // id - поста
                    ?>">(+1)</span>
                </div>
               <hr>

                <div>
                    <?php the_content();  ?> 
                </div>
                
            </main>

            <aside class="rightBox aside_kv">
                Сайдбар для квартир не ддинамичекий, а программный
            </aside>
</div>

<?php get_footer(); ?>
