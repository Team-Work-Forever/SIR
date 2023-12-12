let isOpen = false;
const toogleSideMenu = document.querySelector('.side-menu button');
const sideMenu = document.getElementsByClassName('side-menu')[0];

toogleSideMenu.addEventListener('click', () => {
    if (isOpen) {
        sideMenu.classList.add('compact');
    } else {
        sideMenu.classList.remove('compact');
    }

    isOpen = !isOpen;
});