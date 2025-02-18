document.addEventListener('DOMContentLoaded', () => {
    let headerMenu = document.querySelector('.header__nav');
    const dropdownHeader = document.querySelector('.header__dropdown');
    document.addEventListener('click', ({ target }) => {
        // burger
        if (target.classList.contains('burger')) {
            target.classList.toggle('_opened');
            headerMenu.classList.toggle('active');
        }
        if(target.classList.contains('js-dropdown-btn')) {
            target.classList.toggle('active');
            dropdownHeader.classList.toggle('active');
            document.querySelector('body').classList.toggle('shadow');
        }
        if(!target.closest('.js-dropdown-btn') && !target.closest('.header__dropdown')) {
            dropdownHeader.classList.remove('active');
            document.querySelector('body').classList.remove('shadow');
            document.querySelector('.js-dropdown-btn').classList.remove('active');
        }
    });
    // header menu villages and heroes 
    const villages = document.querySelectorAll('.header__dropdown-village');
    if(villages.length) {
        const heroes = document.querySelectorAll('.header__dropdown-name');
        villages.forEach(village => {
            village.addEventListener('click', function(){
                if(!village.classList.contains('active')) {
                    document.querySelector('.header__dropdown-village.active').classList.remove('active');
                }
                village.classList.add('active');
                const id = this.getAttribute('data-id');
                heroes.forEach(hero => {
                    hero.classList.remove('active');
                    const activeHero = hero.getAttribute('data-id');
                    if(activeHero == id) {
                        hero.classList.add('active');
                    }
                });
            });
        })
    }

    // hidden dead items
    const deadItemMore = document.querySelector('.dead__more');
    if(deadItemMore) {
        const hiddenItems = document.querySelectorAll('.dead__item.hidden');
        deadItemMore.addEventListener('click', () => {
            deadItemMore.classList.toggle('active');
            hiddenItems.forEach(item => item.classList.toggle('hidden'));
        });
    }

    // const feedback file input
    const inputFile = document.querySelector('#file-1');
    if(inputFile) {
        const htmlTemplate = document.querySelector('.feedback__file span');
        inputFile.addEventListener('input', () => {
            const fileName = inputFile.files[0]?.name || 'Прикрепите фото погибшего или документов  при наличии';
            htmlTemplate.textContent = fileName;
        });
    }

    // search checkbox submit
    const formCheckbox = document.querySelector('#search-checkboxes');
    if(formCheckbox) {
        const checkboxItems = formCheckbox.querySelectorAll('input');
        checkboxItems.forEach(input => {
            input.addEventListener('change', () => formCheckbox.submit());
        })
    }
});

window.onload = () => {
    // $.fn.setCursorPosition = function(pos) {
    //     if ($(this).get(0).setSelectionRange) {
    //         $(this).get(0).setSelectionRange(pos, pos)
    //     } else if ($(this).get(0).createTextRange) {
    //         var range = $(this).get(0).createTextRange()
    //         range.collapse(true)
    //         range.moveEnd('character', pos)
    //         range.moveStart('character', pos)
    //         range.select()
    //     }
    // }
    // $('input[type="tel"]').on('click', function() {
    //     $(this).setCursorPosition(3)
    // }).mask('+7 (999) 999 99 99')

    // $('.way').waypoint({
    //     handler: function() {
    //         $(this.element).addClass("way--active");

    //     },
    //     offset: '88%'
    // });
    const heroSlider = new Swiper('.hero__slider', {
        sliderPerView: 1,
        effect: 'fade',
        loop: true,
        autoplay: true,
        navigation: {
            prevEl: '.hero__arrow.prev',
            nextEl: '.hero__arrow.next',
        }
    });
    $('.ticker-1').marquee({
        direction: 'left',
        speed: 50,
        delayBeforeStart: 0, // Задержка перед стартом
        startVisible: true
    });
    $('.ticker-2').marquee({
        direction: 'left',
        speed: 50,
        delayBeforeStart: 0, // Задержка перед стартом
        startVisible: true
    });
};

// loader func
function submitForm() {
    $('#form_loader').show();
}
//Alert form
let alertt = document.querySelector(".alert--fixed");
let alertClose = document.querySelectorAll(".alert--close")
for (let item of alertClose) {
    item.addEventListener('click', function(event) {
        alertt.classList.remove("alert--active")
        alertt.classList.remove("alert--warning")
        alertt.classList.remove("alert--error")
    })
}