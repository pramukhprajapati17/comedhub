let burger = document.querySelector('.burger');
let aside = document.querySelector('.aside');
let content = document.querySelector('.content');
burger.addEventListener('click', () => {
    if(aside.style.width == '20%') {
        aside.style.width = '0%';
        content.style.width = '100%';
    }
    else {
        aside.style.width = '20%';
        content.style.width = '80%';
    }
});