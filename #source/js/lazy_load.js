// выбираем let при добовлении обьекта 
// let 1)Область видимости переменной let – блок {...} 2)Переменная let видна только после объявления. 3) При использовании в цикле, для каждой итерации создаётся своя переменная.

//const Объявление const задаёт константу, то есть переменную, которую нельзя менять:
/*
const images = document.querySelectorAll('img');

const options = {
    root: null, // какой объект отслеживать - например div? класс, #
    rootMargin: '0px', // отступы 
    threshold: 0.1 // порог срабатывания
}

function handleImg(myImg, observer) {
    myImg.forEach(myImgSingle => {
        console.log(myImgSingle.intersectionRatio); // у картинок появляется свойство intersectionRatio
        if (myImgSingle.intersectionRatio > 0) {
            loadImage(myImgSingle.target); // картинки ()- передаем картинку
        }
    })
}
// loadImage - a-z загрузки картинки
function loadImage(image) {
    image.src = image.getAttribute('data-src');
}

// IntersectionObserver - js обьект , позволяет отслеживать и выполнять действие, кот попадает в зону действия
// observer - создаем экземпляр
const observer = new IntersectionObserver(handleImg, options);

images.forEach(img => {
    observer.observe(img); // в объект observer с помощью его метода observe следит за элементами img 
})
*/