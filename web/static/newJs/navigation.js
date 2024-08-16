document.addEventListener('DOMContentLoaded', () => {



    function handleMenuOpening() {
            const hamburger = document.querySelector('.main-menu--hamburger');
            const nav = document.querySelector('.header--nav');

            hamburger.addEventListener('click', function () {
                console.log("click");
                const isOpen = hamburger.classList.toggle('open');
                document.body.classList.toggle('menu-open', isOpen);
                nav.classList.toggle('open');
                hamburger.setAttribute('aria-expanded', isOpen);
                hamburger.setAttribute('aria-label', isOpen ? 'Close the menu' : 'Open the menu');
            });
    }

    function handleSubMenuOpening() {
        const buttons = document.querySelectorAll('.main-menu--sub-opener');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const isExpanded = button.getAttribute('aria-expanded') === 'true';
                const submenuId = button.getAttribute('aria-controls');
                const submenu = document.getElementById(submenuId);

                buttons.forEach(otherButton => {
                    if (otherButton !== button) {
                        const otherSubmenuId = otherButton.getAttribute('aria-controls');
                        const otherSubmenu = document.getElementById(otherSubmenuId);
                        otherButton.setAttribute('aria-expanded', 'false');
                        otherSubmenu.classList.remove('open');
                    }
                });

                button.setAttribute('aria-expanded', !isExpanded);
                submenu.classList.toggle('open');
            });
        });
    }

    function handleScrollHight () {
        const logo = document.querySelector('.header--top--inner');

        window.addEventListener('scroll', function () {
            if (window.scrollY > 40) {
                logo.style.padding = '0 2rem';
            } else {
                logo.style.padding = '';
            }
        });
    }







    handleMenuOpening();
    handleSubMenuOpening();
    handleScrollHight();







});
