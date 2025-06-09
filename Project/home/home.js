document.addEventListener('DOMContentLoaded', () => {
    function getTargetHeight(text) {
        const computedText = window.getComputedStyle(text);
        const targetHeight = parseFloat(computedText.fontSize) * 2;
        return targetHeight;
    }

    const posts = document.querySelectorAll('.post');
    posts.forEach((post) => {
        const text = post.querySelector('.post__text');
        const button = post.querySelector('.post__button-expand');

        if (text && button) {
            if (text.scrollHeight > getTargetHeight(text)) {
                button.classList.remove('hidden');
                text.classList.add('less');
            }
            else {
                button.classList.add('hidden');
                text.classList.remove('less');
            };
            button.addEventListener('click', () => {
                text.classList.toggle('less');
                button.textContent = text.classList.contains('less') ? 'ещё' : 'свернуть';
            });
        };
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const divOfImages = document.querySelectorAll('.post-images');

    divOfImages.forEach((div) => {
        const images = div.querySelectorAll('.post-image');
        const sliderLeft = div.querySelector('.icon-slider-left-button');
        const sliderRight = div.querySelector('.icon-slider-right-button');
        const counter = div.querySelector('.counter');

        const isVisible = (image) => {
            return !image.classList.contains('hidden');
        };

        const updateCounter = () => {
            if (!counter) {
                return;
            }
            const visibleImageIndex = [...images].findIndex(isVisible); // [...images] превращает узел images в массив (images объект просто)
            counter.textContent = `${visibleImageIndex + 1}/${images.length}`;
        };

        sliderLeft?.addEventListener('click', function () { // ?. - выполняет функцию, если элемент существует
            const currentIndex = [...images].findIndex(isVisible);
            images[currentIndex].classList.add('hidden');
            const nextIndex = (currentIndex + 1) % images.length;
            images[nextIndex].classList.remove('hidden');
            updateCounter();
        });

        sliderRight?.addEventListener('click', function () {
            const currentIndex = [...images].findIndex(isVisible);
            images[currentIndex].classList.add('hidden');
            const nextIndex = (currentIndex - 1 + images.length) % images.length;
            images[nextIndex].classList.remove('hidden');
            updateCounter();
        });

        images.forEach((image, index) => {
            image.classList.toggle('hidden', index != 0);
        });

        updateCounter();
    })
});

document.addEventListener('DOMContentLoaded', () => {
    const modalWindow = document.querySelector('.modal-window');
    const modalIconClose = modalWindow.querySelector('.modal-window__shell__icon');
    const modalSliderImages = modalWindow.querySelector('.modal-images');
    const modalSliderLeft = modalWindow.querySelector('.modal-icon-slider-left-button');
    const modalSliderRight = modalWindow.querySelector('.modal-icon-slider-right-button');
    const modalCounter = modalWindow.querySelector('.modal-counter');

    let currentImageIndex = 0;
    let currentImages = [];

    const handleEscapeKey = (event) => {
        if (event.key == 'Escape') {
            handleCloseWindow();
        };
    };

    function handleImageClick(element) {
        const postElement = element.target.closest('.post'); // ближайший родитель с классом post
        const postImages = [...postElement.querySelectorAll('.post-image')];
        const clickedIndex = postImages.indexOf(element.target);
        openModalWindow(postElement, clickedIndex);
    };

    function openModalWindow(postElement, index) {
        currentImages = [...postElement.querySelectorAll('.post-image')].map(image => image.src);
        currentImageIndex = index;
        if (currentImages.length <= 1) {
            modalSliderLeft.classList.add('hidden');
            modalSliderRight.classList.add('hidden');
            modalCounter.classList.add('hidden');
        };
        updateModalSlider();
        modalWindow.classList.add('active');
        document.body.classList.add('scroll-block');
        modalIconClose.addEventListener('click', handleCloseWindow);
        document.addEventListener('keydown', handleEscapeKey);
    };

    function updateModalSlider() {
        modalSliderImages.querySelectorAll('.modal-image').forEach((element) => {
            element.remove();
        });
        currentImages.forEach((sourceImage, index) => {
            const image = document.createElement('img');
            image.classList.add('modal-image');
            if (index == currentImageIndex) {
                image.classList.toggle('active');
            }
            image.src = sourceImage;
            image.alt = `изображение ${index + 1}`;
            modalSliderImages.appendChild(image);
        });
        modalCounter.textContent = `${currentImageIndex + 1} из ${currentImages.length}`;
    }

    function handleCloseWindow() {
        modalWindow.classList.remove('active');
        document.body.classList.remove('scroll-block');
        modalIconClose.removeEventListener('click', handleCloseWindow);
        document.removeEventListener('keydown', handleEscapeKey);
        modalSliderImages.querySelectorAll('.modal-image').forEach((element) => {
            element.remove();
        });
        modalSliderLeft.classList.remove('hidden');
        modalSliderRight.classList.remove('hidden');
        modalCounter.classList.remove('hidden');
    }

    document.querySelectorAll('.post-image').forEach((image) => {
        image.addEventListener('click', handleImageClick);
    });

    modalSliderLeft.addEventListener('click', () => {
        currentImageIndex = (currentImageIndex - 1 + currentImages.length) % currentImages.length;
        updateModalSlider();
    });

    modalSliderRight.addEventListener('click', () => {
        currentImageIndex = (currentImageIndex + 1) % currentImages.length;
        updateModalSlider();
    });
});