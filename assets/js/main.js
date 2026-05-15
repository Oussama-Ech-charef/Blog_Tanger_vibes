document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.getElementById('menu_btn');
    const closeMenuBtn = document.getElementById('close_menu');
    const mobileNav = document.querySelector('.header_nav_mobile');

    if (menuBtn && closeMenuBtn && mobileNav) {
        // Open menu
        menuBtn.addEventListener('click', function() {
            mobileNav.classList.add('open');
        });

        // Close menu
        closeMenuBtn.addEventListener('click', function() {
            mobileNav.classList.remove('open');
        });
    }
});