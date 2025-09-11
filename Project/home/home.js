const setShow = (div, force) => div.classList.toggle("hidden", !force);

const addTextFolding = post => {
    const text = post.querySelector(".post__text");
    const lineHeight = parseInt(window.getComputedStyle(text).lineHeight);
    const lines = 2;
    if (text.scrollHeight > lineHeight * lines) {
        const foldButton = document.createElement("div");
        foldButton.classList.add("post__button-expand");
        foldButton.textContent = "ещё";
        foldButton.addEventListener("click", () => {
            text.classList.toggle("less");
            foldButton.textContent = text.classList.contains("less") ? "ещё" : "свернуть";
        });
        text.classList.add("less");
        text.after(foldButton);
    }
};

const addSlider = postImages => {
    const images = postImages.querySelectorAll(".post-image");
    if (images.length > 1) {
        let currentImageIndex = 0;
        images.forEach((image, index) => setShow(image, index == 0));
        const sliderLeft = postImages.querySelector(".icon-slider.left-button");
        const sliderRight = postImages.querySelector(".icon-slider.right-button");
        const counterField = postImages.querySelector(".counter-field");
        const updateCounter = () => counterField.textContent = `${currentImageIndex + 1}/${images.length}`;
        const moveImage = (direction, step) => {
            setShow(images[currentImageIndex], false);
            if (direction == "left") {
                currentImageIndex = (currentImageIndex - step + images.length) % images.length;
            } else {
                currentImageIndex = (currentImageIndex + step) % images.length;
            }
            setShow(images[currentImageIndex], true);
            updateCounter();
        };
        sliderLeft.addEventListener("click", () => moveImage("left", 1));
        sliderRight.addEventListener("click", () => moveImage("right", 1));
    }
};

const enableModalWindow = () => {
    const modalWindow = document.querySelector(".modal");
    const modalIconClose = document.querySelector(".modal__content__icon-close");
    const modalImages = document.querySelector(".modal__content__images");
    const sliderLeft = modalWindow.querySelector(".icon-slider.left-button");
    const sliderRight = modalWindow.querySelector(".icon-slider.right-button");
    const counter = document.querySelector(".modal__content__counter");

    let currentImageIndex = 0;
    let currentImages = [];
    const updateCounter = () => counter.textContent = `${currentImageIndex + 1} из ${currentImages.length}`;
    const moveImage = (direction, step) => {
        setShow(currentImages[currentImageIndex], false);
        if (direction == "left") {
            currentImageIndex = (currentImageIndex - step + currentImages.length) % currentImages.length;
        } else {
            currentImageIndex = (currentImageIndex + step) % currentImages.length;
        }
        setShow(currentImages[currentImageIndex], true);
        updateCounter();
    };
    sliderLeft.addEventListener("click", () => moveImage("left", 1));
    sliderRight.addEventListener("click", () => moveImage("right", 1));

    const copyNodeImg = (img, index) => {
        const copyImg = document.createElement("img");
        copyImg.classList.add("modal__content__image");
        setShow(copyImg, index == currentImageIndex);
        copyImg.src = img.src;
        copyImg.alt = `изображение ${index + 1}`;
        modalImages.appendChild(copyImg);
        currentImages.push(copyImg);
    }

    const handleClickOnImage = event => {
        const post = event.target.closest(".post");
        const postImages = [...post.querySelectorAll(".post-image")];
        currentImageIndex = postImages.indexOf(event.target);
        postImages.forEach((img, index) => copyNodeImg(img, index));
        if (currentImages.length == 1) {
            setShow(sliderLeft, false);
            setShow(sliderRight, false);
            setShow(counter, false);
        }
        updateCounter();
        openWindow();
    }

    const openWindow = () => {
        document.body.classList.add("scroll-block");
        setShow(modalWindow, true);
        modalIconClose.addEventListener("click", closeWindow);
        document.addEventListener("keydown", handleKeyboard);
    }

    const closeWindow = () => {
        modalIconClose.removeEventListener("click", closeWindow);
        document.removeEventListener("keydown", handleKeyboard);
        document.body.classList.remove("scroll-block");
        modalImages.querySelectorAll(".modal__content__image").forEach(img => img.remove());
        currentImages = [];
        setShow(modalWindow, false);
        setShow(sliderLeft, true);
        setShow(sliderRight, true);
        setShow(counter, true);
    }

    const handleKeyboard = event => {
        if (event.key == "Escape") {
            closeWindow();
        }
    }

    document.querySelectorAll(".post-image").forEach(post => post.addEventListener("click", handleClickOnImage));
}

const enableFeatures = () => {
    document.querySelectorAll(".post").forEach(addTextFolding);
    document.querySelectorAll(".post-images").forEach(addSlider);
    enableModalWindow();
}

document.addEventListener("DOMContentLoaded", enableFeatures);