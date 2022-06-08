/***собираем в один ***/

//@prepros-append header.js

console.log('Hi? main'); // выводим 
//console.log(my_tem.url_tem);

/**** ф-я скрыть / открыть *****/
function div_hide(id) {
   x = document.getElementById(id);
   if (x.style.display == 'block') {

      //   document.getElementById(id).innerHTML = 'function div_hide!'; //document.getElementById('xx').style.display = 'none'; 
      x.style.display = 'none';
   } else {
      x.style.display = 'block';
   }
}

/**** отлов события клика на фон, а там проверяйте, попадает ли клик в модальное окно, и если нет, то закрываеv его: *****/
$(document).click(function (e) {
   if ($(e.target).is('.modalDialog')) {
      div_hide('openModal');
   }
});

console.log('Ok - main'); // выводим 



