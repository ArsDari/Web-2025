const MAX_FILES = 10;
const setShow = (div, force) => div.classList.toggle("hidden", !force);

async function createPost(formData) {
    const response = await fetch("../api.php", {
        method: "POST",
        body: formData
    });
    if (!response.ok) {
        throw new Error(response.status);
    }
    return await response.json();
}

const enableFeatures = () => {
    const messageField = document.querySelector(".message-field");
    const creatingPost = document.querySelector(".creating-post");
    const createForm = document.getElementById("create-form");
    const images = document.querySelector(".images");

    const uploadPrimary = document.querySelector(".upload-primary");
    const uploaders = document.querySelectorAll(".uploader");

    const textArea = document.getElementById("text");
    const infoMessage = document.querySelector(".info-message");
    const sendButton = document.getElementById("send-button");

    const remove = document.querySelector(".icon-remove");
    const sliderLeft = document.querySelector('.icon-slider.left-button');
    const sliderRight = document.querySelector('.icon-slider.right-button');
    const counter = document.querySelector('.counter');

    let currentImageIndex = 0;
    const currentImages = [];
    const imageData = [];

    const getText = () => textArea.value.trim();
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

    const updateUI = () => {
        setShow(infoMessage, currentImages.length == 10);

        setShow(remove, currentImages.length > 0);
        setShow(uploadPrimary, currentImages.length < 1);

        setShow(sliderLeft, currentImages.length > 1);
        setShow(sliderRight, currentImages.length > 1);
        setShow(counter, currentImages.length > 1);

        const allowSending = currentImages.length > 0 && getText().length > 0;
        sendButton.toggleAttribute("disabled", !allowSending);
    };

    const loadImage = image => {
        if (currentImages.length < 10) {
            const newImg = document.createElement("img");
            newImg.classList.add("image", "hidden");
            newImg.src = URL.createObjectURL(image);
            newImg.alt = `изображение ${currentImages.length + 1}`;
            images.appendChild(newImg);
            currentImages.push(newImg);
            imageData.push(image);
        }
    };

    const addImage = event => {
        Array.from(event.target.files).forEach(loadImage);
        event.target.value = null;
        moveImage("right", currentImages.length - currentImageIndex - 1);
        updateUI();
    };

    const removeImage = () => {
        const uploadedImages = images.querySelectorAll(".image");
        uploadedImages[currentImageIndex].remove();
        currentImages.splice(currentImageIndex, 1);
        imageData.splice(currentImageIndex, 1);
        if (currentImages.length != 0) {
            if (currentImages.length == currentImageIndex) {
                currentImageIndex -= 1;
            }
            moveImage("right", 0);
        }
        updateCounter();
        updateUI();
    };

    uploaders.forEach(element => element.addEventListener("change", addImage));
    remove.addEventListener("click", removeImage);
    textArea.addEventListener("change", updateUI);

    const handleResponseFulfill = response => {
        setShow(creatingPost, false);

        // Сделать показ
    };

    const handleResponseError = error => {
        console.log(error.message);
    };

    const handleUpload = event => {
        event.preventDefault();
        if (currentImages.length > 0 && getText().length > 0) {
            const formData = new FormData(createForm);
            imageData.forEach(image => formData.append("image[]", image));
            const text = formData.get("text").trim();
            formData.set("text", text);
            console.log(Array.from(formData.entries())); // 11 лабораторная
            // createPost(formData).then(
            //     handleResponseFulfill,
            //     handleResponseError
            // );
        }
    };

    document.addEventListener("submit", handleUpload);
};

document.addEventListener('DOMContentLoaded', enableFeatures);