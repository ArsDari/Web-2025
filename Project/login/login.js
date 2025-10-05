const URL_API = "../api/";
const URL_ICON = "../content/media/icons/";

const setShow = (div, force) => div.classList.toggle("hidden", !force);

const enableEye = () => {
    const passwordField = document.querySelector(".login-form__field__input.password-field");
    const eye = document.querySelector(".icon-eye");
    const eyeClassList = eye.classList;
    eye.addEventListener("click", () => {
        eyeClassList.toggle("eye-on");
        eye.src = eyeClassList.contains("eye-on") ?
            URL_ICON + "icon-eye-on.svg" :
            URL_ICON + "icon-eye.svg";
        passwordField.type = eyeClassList.contains("eye-on") ? "text" : "password";
    });
};

const enableLogin = () => {
    const errorWindow = document.querySelector(".error");
    const errorIcon = document.querySelector(".error__icon");
    const errorMessage = document.querySelector(".error__message");
    const description = document.querySelector(".login-form__field__description");
    const form = document.getElementById("login-form");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const submitButton = document.getElementById("submit-button");

    const raiseErrorMessage = (text, icon) => {
        errorIcon.src = URL_ICON + icon;
        errorMessage.innerText = text;
        errorWindow.classList.remove("hidden");
    };

    const setEmailError = () => {
        email.classList.add("input-error");
        description.classList.add("description-error");
        email.addEventListener("mousedown", removeEmailError, { once: true });
    };

    const removeEmailError = () => {
        email.classList.remove("input-error");
        description.classList.remove("description-error");
        removeErrorWindow();
    };

    const setPasswordError = () => {
        password.classList.add("input-error");
        password.addEventListener("mousedown", removePasswordError, { once: true });
    };

    const removePasswordError = () => {
        password.classList.remove("input-error");
        removeErrorWindow();
    };

    const removeErrorWindow = () => {
        const errors = document.querySelectorAll(".input-error");
        if (errors.length == 0) {
            setShow(errorWindow, false);
        }
    };

    const handleLoginSuccess = response => window.location.replace(`http://localhost:8001/profile/?id=${response["user_id"]}`);

    const handleLoginError = error => {
        setEmailError();
        setPasswordError();
        if (error.message == "401") {
            raiseErrorMessage("Не те логин или пароль…", "unsure.png");
        } else {
            raiseErrorMessage("Неизвестная ошибка", "unsure.png");
        }
    };

    const handleClick = event => {
        event.preventDefault();
        removeEmailError();
        removePasswordError();
        const loginData = new FormData(form);
        const emailData = loginData.get("email");
        const passwordData = loginData.get("password");
        if (emailData.length == 0 || passwordData.length == 0) {
            if (emailData.length == 0) {
                setEmailError();
            }
            if (passwordData.length == 0) {
                setPasswordError();
            }
            raiseErrorMessage("Поля обязательные", "nerd.png");
            return;
        }
        if (emailData.includes("@")) {
            fetch(URL_API + "login/", {
                method: "POST",
                body: loginData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(response.status);
                }
                return response.json();
            })
            .then(handleLoginSuccess, handleLoginError);
        } else {
            setEmailError();
            raiseErrorMessage("Неверный формат электропочты", "unsure.png");
        }
    };

    submitButton.addEventListener("click", handleClick);
};

const enableFeatures = () => {
    enableEye();
    enableLogin();
};

document.addEventListener("DOMContentLoaded", enableFeatures);