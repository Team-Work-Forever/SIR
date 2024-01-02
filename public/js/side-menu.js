/* Side Menu */
const isOpen = false;
const toggleSideMenu = document.querySelector('.side-menu button');
const sideMenu = document.getElementsByClassName('side-menu')[0];

toggleSideMenu.addEventListener('click', () => {
    if (isOpen) {
        sideMenu.classList.add('compact');
    } else {
        sideMenu.classList.remove('compact');
    }

    isOpen = !isOpen;
});