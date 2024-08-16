import { existsInDom } from './conecto-helpers';
import Splide from '../../../.build/node_modules/@splidejs/splide';

const contentBlockTeasersliders = document.querySelectorAll('.contentblock--teaserslider');
if (existsInDom(contentBlockTeasersliders)) {
    contentBlockTeasersliders.forEach(contentBlockTeaserslider => {
        const arrowLeft = contentBlockTeaserslider.querySelector('.arrow--prev');
        const arrowRight = contentBlockTeaserslider.querySelector('.arrow--next');
        const teaserSliderContainer = contentBlockTeaserslider.querySelector('.splide');
            var splide = new Splide(teaserSliderContainer, {
                type: 'loop',
                pagination: false,
                arrows: false,
                padding: 0,
                gap: 30,
                perPage: 3,
                breakpoints: {
                    767: {
                        perPage: 1,
                        gap: '5.33333vw',
                        fixedWidth: '70.13333vw',
                        focus: "center"
                    },
                    991: {
                        perPage: 2,
                    }
                }
            });

            splide.on('mounted', () => {
                arrowLeft.addEventListener('click', event => {
                    splide.go('<');
                    event.preventDefault();
                });
                arrowRight.addEventListener('click', event => {
                    splide.go('>');
                    event.preventDefault();
                });
            });

            splide.mount();
            console.log("blub")
    });
}

