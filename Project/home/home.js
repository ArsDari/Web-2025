document.addEventListener('DOMContentLoaded', () => { // потому что несколько можно вставить несколько обработчиков, а сам DOMContentLoaded говорит о том, что браузер разобрал HTML
    const MAX_HEIGHT_IN_PX = 37;
    const posts = document.querySelectorAll('.post');

    posts.forEach((post) => {
        const text = post.querySelector('.post__text');
        const button = post.querySelector('.post__button-expand');
        if (text.scrollHeight > MAX_HEIGHT_IN_PX) {
            button.classList.remove('hidden');
            text.classList.add('less');
        } else {
            button.classList.add('hidden');
            text.classList.remove('less');
        }
        button.addEventListener('click', () => {
            text.classList.toggle('less');
            button.textContent = text.classList.contains('less') ? 'ещё' : 'свернуть';
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const containersOfImages = document.querySelectorAll('.post-images');

    containersOfImages.forEach((div) => {
        const images = div.querySelectorAll('.post-image');
        const sliderLeft = div.querySelector('.icon-slider-left-button');
        const sliderRight = div.querySelector('.icon-slider-right-button');
        const counter = div.querySelector('.counter');
        
        let currentImageIndex = 0;

        images.forEach((image, index) => {
            image.classList.toggle('hidden', index != 0); // force = true работает как add(), force = false работает как remove()
        });

        sliderLeft?.addEventListener('click', () => { // ?. - оператор опциональной последовательности
            images[currentImageIndex].classList.add('hidden');
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            images[currentImageIndex].classList.remove('hidden');
            updateCounter();
        });

        sliderRight?.addEventListener('click', () => {
            images[currentImageIndex].classList.add('hidden');
            currentImageIndex = (currentImageIndex + 1) % images.length;
            images[currentImageIndex].classList.remove('hidden');
            updateCounter();
        });

        function updateCounter() {
            counter.textContent = `${currentImageIndex + 1}/${images.length}`;
        }
    });
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

    document.querySelectorAll('.post-image').forEach((img) => {
        img.addEventListener('click', handleImageClick);
    });

    modalSliderLeft.addEventListener('click', () => {
        currentImages[currentImageIndex].classList.remove('image-active');
        currentImageIndex = (currentImageIndex - 1 + currentImages.length) % currentImages.length;
        currentImages[currentImageIndex].classList.add('image-active');
        updateModalCounter();
    });

    modalSliderRight.addEventListener('click', () => {
        currentImages[currentImageIndex].classList.remove('image-active');
        currentImageIndex = (currentImageIndex + 1) % currentImages.length;
        currentImages[currentImageIndex].classList.add('image-active');
        updateModalCounter();
    });

    function handleImageClick(clickedElement) {
        const post = clickedElement.target.closest('.post');
        const postImages = [...post.querySelectorAll('.post-image')]; // ... развёртывает содержимое и [] делает массив
        currentImageIndex = postImages.indexOf(clickedElement.target);
        postImages.forEach((img, index) => {
            const newImg = document.createElement('img');
            newImg.classList.add('modal-image');
            if (index == currentImageIndex) {
                newImg.classList.add('image-active');
            }
            newImg.src = img.src;
            newImg.alt = `изображение ${index + 1}`;
            modalSliderImages.appendChild(newImg);
            currentImages.push(newImg);
        });
        if (currentImages.length == 1) {
            modalSliderLeft.classList.add('hidden');
            modalSliderRight.classList.add('hidden');
            modalCounter.classList.add('hidden');
        }
        updateModalCounter();
        openModalWindow();
    }

    function openModalWindow() {
        modalWindow.classList.add('modal-active');
        document.body.classList.add('scroll-block');
        modalIconClose.addEventListener('click', handleCloseWindow);
        document.addEventListener('keydown', handleEscapeKey);
    }

    function updateModalCounter() {
        modalCounter.textContent = `${currentImageIndex + 1} из ${currentImages.length}`;
    }

    function handleCloseWindow() {
        modalIconClose.removeEventListener('click', handleCloseWindow);
        document.removeEventListener('keydown', handleEscapeKey);
        modalWindow.classList.remove('modal-active');
        document.body.classList.remove('scroll-block');
        currentImages = [];
        modalSliderImages.querySelectorAll('.modal-image').forEach((img) => {
            img.remove();
        });
        modalSliderLeft.classList.remove('hidden');
        modalSliderRight.classList.remove('hidden');
        modalCounter.classList.remove('hidden');
    }

    function handleEscapeKey(event) {
        if (event.key == 'Escape') {
            handleCloseWindow();
        }
    }
});