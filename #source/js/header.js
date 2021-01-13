// выбор города
$(function () {

   if (localStorage.getItem("myKey")) { //добавляет в localStorage новый ключ со значением (а если такой ключ уже существует, 
      // то перезаписывает новым значением). Пишем, например, localStorage.setItem(‘myKey’, ‘myValue’);
      var stored_select = localStorage.getItem("myKey");
      $('#' + stored_select).prop("selected", true);
      $('.' + stored_select).show();

      //Выводим его в консоль:
      console.log('stored_select = ' + stored_select); //

   } else {
      $('.pusto').show(); // jQuery метод .show() позволяет отобразить скрытые выбранные элементы. Для того, чтобы скрыть выбранные элементы вы можете воспользоваться методом .hide().
   }
   // Посмотреть cookie В консоли набрать document.cookie 
   console.log(document.cookie);
});

$(document).ready(function () {


   // end выбор города

   function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
      var expires = "expires=" + d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      console.log(document.cookie); // выводим куки
      location.reload();
   }


   $("#selectItem").change(function () {
      //    $('.containerss').find('div').hide();
      var selected = $('#selectItem option:selected').attr('id');
      var name = $('#selectItem option:selected').attr('name');
      console.log('selected ' + selected); //
      localStorage.setItem("myKey", selected);
      $('.' + selected).show();
      setCookie('city', name);

   });

   //




   /****** кнопка вверх ********/
   $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
         $('.but__backToTop').fadeIn();
      } else {
         $('.but__backToTop').fadeOut();
      }
   });

   $('.but__backToTop').click(function () {
      $("html, body").animate({
         scrollTop: 0
      }, 600);
      return false;
   });

   //  Применим к слайду в Elementor. Найдем ссылка с именем Заголовка рисунка и изменим на нужную ссылку *****/

   // $("a[data-elementor-lightbox-title='Акция Подарок']").attr('href', 'http://best/actions/podarok-s-zabotoi/')
   // var a_slyd = $("a[data-elementor-lightbox-title='Акция Подарок']");
   //! как вывести объект в консоль
   //Используйте собственный метод JSON.stringify. Этот метод поддерживает работы с вложенными объектами и всеми основными браузерами.
   //str2 = JSON.stringify(a_slyd, null, 4); // (Optional) beautiful indented output.
   //   console.log('a_slyd ' + str2); //


})

/*доб стили разделителей в меню*/

var header = $('#header');
var heightHeader = header.height;
/*
if (window.matchMedia('(max-width: 768px)').matches) {
   $('.site-header').css({
      top: '0px',
   })
}
*/
window.onscroll = function () {

   /*
      if (window.matchMedia('(min-width: 940px)').matches) {
         */
   if (window.pageYOffset == 0) {
      $('.site-header').css({
         //   top: '55px',
         position: 'absolute',
      });

   } else {
      $('.site-header').css({
         top: '0px',
         position: 'fixed',
      });
   }
   /*
} else {
   $('.site-header').css({
      top: '0px',
   });

}
*/







};