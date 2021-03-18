/***собираем в один ***/

//@prepros-append header.js

console.log('Hi? main'); // выводим 

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






