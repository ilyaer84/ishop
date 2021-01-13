var slideIndex = 1;

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("img_sli"); //$('img_sli');// document.getElementsByClassName("img_sli"); // помещает в себя элемент .img.curry
    var dots = document.getElementsByClassName("dot"); // $('.dot') //

    var currentImage = $('.img_sli.curry'); // помещает в себя элемент .img.curry
    //  var currentImageIndex = $('.img_sli.curry').index(); // помещает в себя индекс текущ элемента
    currentImage.fadeOut(1000);
    /*  
      if($('.sli_control_right').click) {
          clearInterval(interval_sli);  
      }
     */
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }

    for (i = 0; i < slides.length; i++) {
        //        slides[i].style.display = "none";

        slides[i].className = slides[i].className.replace("curry", "");
    }

    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace("dot_act", "");
    }

    var nextImageIndex = slideIndex - 1;
    var nextImage = $('.img_sli').eq(nextImageIndex);
    nextImage.fadeIn(1000);
    slides[slideIndex - 1].className += " curry";
    dots[slideIndex - 1].className += " dot_act";
    //      slides[slideIndex-1].style.display = "block";

}
/*
interval_sli = setInterval(function auto_sli() {
    plusSlides(1);
    //     interval_inner_css = setInterval(inner_css, 800) // 1000 одна секунда        
}, 5000); // 1000 - одна секунда
*/

/*** 2 вариант **/
/*
$(document).ready(function(){ // ready выполнит функция как только дом загрузился

        function next_sli(){   
           // s--prev           
                        var currentImage = $('.img_sli.curry'); // помещает в себя элемент .img.curry
                        var currentImageIndex = $('.img_sli.curry').index(); // помещает в себя индекс текущ элемента
                        var nextImageIndex = currentImageIndex + 1;
                        var nextImage = $('.img_sli').eq(nextImageIndex); // eq выборка соседних элем по nextImageIndex
                        
            /*            var currentDot = $('.dot.dot_act'); 
                        var currentDotIndex = $('.dot.dot_act').index();
                        var nextDotIndex = currentDotIndex + 1;
                        var nextDot = $('.dot').eq(nextDotIndex);
*/
//   intervalID = setTimeout(tran_ef, 700); // выводится только один раз

/*                       currentImage.fadeOut(1000); //fadeOut - скрываются соотв елем путем затухания до полного прозрачности
                        currentImage.removeClass('curry'); // удаляем класс
              //          currentDot.removeClass('dot_act');
                        
                        // условия для того чтоб после последнего экрана след была 1 а не пустота
                        if(nextImageIndex == ($('.img_sli:last').index()+1)) {
                        // если nextImageIndex == блок выбранного элемента (блок с классом .img) :last - сымый последний
                        // .index()+1 узнаем индекс +1 
                            $('.img_sli').eq(0).fadeIn(1000);
                            $('.img_sli').eq(0).addClass('curry'); // добавляем класс
             //               $('.dot').eq(0).addClass('dot_act');
                        } else { // если не последний 
                            nextImage.fadeIn(1000);             
                            nextImage.addClass('curry');
              //              nextDot.addClass('dot_act');

                        //       intervalID = setTimeout(tran_ef, 700); // выводится только один раз
                        }
                        }
                        
             interval_sli = setInterval(function auto_sli() { 
                 next_sli(); 
           //     interval_inner_css = setInterval(inner_css, 800) // 1000 одна секунда
         //        slider__slide-part-inner
             },	5000); // 1000 - одна секунда

    $('.sli_control_right').click(function(){
        next_sli()  ;
         clearInterval(interval_sli);         
    });
    
    function prev_sli(){
        var currentImage = $('.img_sli.curry'); // помещает в себя элемент .img.curry
        var currentImageIndex = $('.img_sli.curry').index(); // помещает в себя индекс текущ элемента
        
  //      var currentDot = $('.dot.dot_act'); 
  //      var currentDotIndex = $('.dot.dot_act').index();
        
        
        var prevImageIndex = currentImageIndex - 1;
        var prevImage = $('.img_sli').eq(prevImageIndex); // eq выборка соседних элем по nextImageIndex

  //      var prevDotIndex = currentDotIndex - 1;
  //      var prevDot = $('.dot').eq(prevDotIndex);

        currentImage.fadeOut(1000);  //fadeOut - скрываются соотв елем путем затухания до полного прозрачности
        currentImage.removeClass('curry');  // удаляем класс
  //      currentDot.removeClass('dot_act');

        prevImage.fadeIn(1000);
        prevImage.addClass('curry');
        prevDot.addClass('dot_act');

    //    intervalID = setTimeout(tran_ef, 700); // выводится только один раз
    }

    $('.sli_control').click(function (){   
        prev_sli();
        clearInterval(interval_sli);  
    });
});

*/