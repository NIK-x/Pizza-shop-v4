// import Header from "./Header";

// Получаем элементы
const burgerButton = document.querySelector('[data-js-burger-button]');
const overlay = document.querySelector('.header__overlay');
const menuLinks = document.querySelectorAll('[data-js-menu-link]');

// Функция для переключения меню
function toggleMenu() {
    burgerButton.classList.toggle('active');
    overlay.classList.toggle('active');
    document.html.classList.toggle('is.lock'); 
}


burgerButton.addEventListener('click', toggleMenu);

// Закрытие меню при клике на ссылку
menuLinks.forEach(link => {
    link.addEventListener('click', () => {
        if (overlay.classList.contains('active')) {
            toggleMenu();
        }
    });
});
