const enableEye = () => {
    const passwordField = document.getElementById("password");
    const eye = document.getElementById("eye");
    const eyeClassList = eye.classList;
    eye.addEventListener("click", () => {
        if (eyeClassList.contains("eye-on")) {
            eyeClassList.remove("eye-on");
            passwordField.type = "password";
            eye.src = "../content/media/icons/icon-eye-off.svg";
        }
        else {
            eyeClassList.add("eye-on");
            passwordField.type = "text";
            eye.src = "../content/media/icons/icon-eye-on.svg";
        }
    });
};

const emailRegex = /^[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.[a-zA-Z]+$/;
// /текст/ короткий синтаксис регулярного выражения, ^ - якорь начала строки, $ - якорь конца строки
// \s - класс пробельных символов, + - квантификатор одного или более символов, [...] - искать любой символ из заданного набора
// [^...] - исключающий набор, [^\s@.] - исключить пробельные символы, @ . - исключенные символы
// \. - символ точки, + - смотреть до конца

const enableLogin = () => {
    const errorWindow = document.getElementById("error-window");
    const errorIcon = document.getElementById("error-icon");
    const errorText = document.getElementById("error-text");
    const email = document.getElementById("email");
    const emailExtraInfo = document.getElementById("email-extra-info");
    const password = document.getElementById("password");
    const sendButton = document.getElementById("send-button");
    const form = document.getElementById("login-form");

    const raiseErrorMessage = (text, icon) => {
        errorText.innerText = text;
        errorIcon.src = `../content/media/icons/${icon}`;
        errorWindow.classList.remove("hidden");
    };

    const setEmailError = () => {
        email.classList.add("input-error");
        emailExtraInfo.classList.add("login-form__error-description");
        email.addEventListener("mousedown", removeEmailError, { once: true });
    };

    const removeEmailError = () => {
        email.classList.remove("input-error");
        emailExtraInfo.classList.remove("login-form__error-description");
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
        const errorFields = document.querySelectorAll(".input-error");
        if (errorFields.length == 0) {
            errorWindow.classList.add("hidden");
        }
    };

    const handleSend = event => {
        event.preventDefault();
        removeEmailError();
        removePasswordError();
        const formData = new FormData(form);
        const emailData = formData.get("email");
        const passwordData = formData.get("password");
        const isEmailValid = emailRegex.test(emailData);
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
        if (isEmailValid) {
            setEmailError();
            setPasswordError();
            raiseErrorMessage("Не те логин или пароль...", "unsure.png");
        } else {
            setEmailError();
            raiseErrorMessage("Неверный формат электропочты", "unsure.png");
        }
    };

    sendButton.addEventListener("click", handleSend);
};

document.addEventListener("DOMContentLoaded", enableEye);
document.addEventListener("DOMContentLoaded", enableLogin);