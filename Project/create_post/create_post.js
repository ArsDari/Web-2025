const MAX_FILES = 10;
const setShow = (div, force) => div.classList.toggle("hidden", !force);

const enableFeatures = () => {
    const images = document.querySelector(".images");
    const uploadFromImages = document.querySelector(".upload");
    const uploadFromButton = document.querySelector(".upload-new");
    const createForm = document.getElementById("create-form");
    const uploadImageFromImages = document.getElementById("upload-from-images");
    const uploadImageFromButton = document.getElementById("upload-from-button");
    const infoMessage = document.querySelector(".info-message");

    const remove = document.querySelector(".icon-remove");
    const sliderLeft = document.querySelector('.icon-slider.left-button');
    const sliderRight = document.querySelector('.icon-slider.right-button');
    const counter = document.querySelector('.counter');

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

    const loadImage = event => {
        const newImg = document.createElement("img");
        newImg.classList.add("image", "hidden");
        const [file] = event.target == uploadImageFromImages ?
            uploadImageFromImages.files : uploadImageFromButton.files;
        event.target.value = null;
        newImg.src = URL.createObjectURL(file);
        newImg.alt = `изображение ${currentImages.length + 1}`;
        images.appendChild(newImg);
        currentImages.push(newImg);
    }

    const updateUI = () => {
        setShow(infoMessage, currentImages.length == 10);
        setShow(uploadFromButton, currentImages.length != 10);
    }

    const addImage = event => {
        if (currentImages.length < 10) {
            loadImage(event);
            moveImage("right", currentImages.length - currentImageIndex - 1);
            updateUI();
        }
        if (currentImages.length > 0) {
            setShow(remove, true);
            setShow(uploadFromImages, false);
        }
        if (currentImages.length > 1) {
            setShow(sliderLeft, true);
            setShow(sliderRight, true);
            setShow(counter, true);
        }
        if (currentImages < 2) {
            setShow(sliderLeft, false);
            setShow(sliderRight, false);
            setShow(counter, false);
        }
    }

    const removeImage = () => {
        const uploadedImages = images.querySelectorAll(".image");
        console.log(uploadedImages[currentImageIndex]);
        uploadedImages[currentImageIndex].remove();
        currentImageIndex -= 1;
        currentImages.splice(currentImageIndex, 1);
        if (currentImages.length == 0) {
            setShow(remove, false);
            setShow(uploadFromImages, true);
        }
        updateUI();
    }

    uploadImageFromImages.addEventListener("change", addImage);
    uploadImageFromButton.addEventListener("change", addImage);
    remove.addEventListener("click", removeImage);
};

document.addEventListener('DOMContentLoaded', enableFeatures);