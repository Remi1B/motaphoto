document.addEventListener('DOMContentLoaded', function () {
    const openButton = document.querySelector('.mobile_menu-open');
    const closeButton = document.querySelector('.mobile_menu-close');
    const mobileNav = document.querySelector('.mobile_nav');
    const menuLinks = document.querySelectorAll('.mobile_nav a');

    function checkWindowSize() {
        const windowWidth = document.documentElement.clientWidth;
        // Si la largeur de la fenêtre est inférieure ou égale à 576px ( $mobile dans _variables.scss)
        if (windowWidth <= 576) {
            mobileNav.classList.remove('open');
            openButton.classList.add("visible");
            closeButton.classList.remove("visible");
        } else {
            openButton.classList.remove("visible");
            closeButton.classList.remove("visible");
        }
    }

    // Vérifier la taille de la fenêtre au chargement de la page
    checkWindowSize();

    window.addEventListener('resize', checkWindowSize);

    openButton.addEventListener('click', function () {
        mobileNav.classList.add('open');
        openButton.classList.remove("visible");
        closeButton.classList.add("visible");
    });

    closeButton.addEventListener('click', function () {
        mobileNav.classList.remove('open');
        closeButton.classList.remove("visible");
        openButton.classList.add("visible");
    });

    menuLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            mobileNav.classList.remove('open');
            closeButton.classList.remove("visible");
            openButton.classList.add("visible");
        });
    });
});