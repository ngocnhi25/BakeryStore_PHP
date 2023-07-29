const main = document.querySelector("#main");
const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const showMenu = document.querySelector("#show-menu");
const shortenMenu = document.querySelector("#shorten-menu");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");
const list = document.querySelectorAll("aside .sidebar .nav-item");
const itemMenus = document.querySelectorAll("aside .sidebar .nav-item .sub-menu .menu-item");

function addRemoveClasses(element, addClasses, removeClasses) {
    element.classList.add(...addClasses);
    element.classList.remove(...removeClasses);
}

menuBtn.addEventListener('click', () => {
    addRemoveClasses(sideMenu, ["active"], ["show-menu", "shorten-menu"]);
    addRemoveClasses(main, ["active"], ["show-menu", "shorten-menu"]);
});

showMenu.addEventListener('click', () => {
    addRemoveClasses(sideMenu, ["show-menu"], ["shorten-menu"]);
    addRemoveClasses(main, ["show-menu"], ["shorten-menu"]);
});

shortenMenu.addEventListener('click', () => {
    addRemoveClasses(sideMenu, ["shorten-menu"], ["show-menu"]);
    addRemoveClasses(main, ["shorten-menu"], ["show-menu"]);
});

closeBtn.addEventListener('click', () => {
    sideMenu.classList.remove("active");
});

themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');
    themeToggler.querySelectorAll('span').forEach(span => span.classList.toggle('active'));
});