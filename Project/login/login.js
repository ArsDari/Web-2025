document.addEventListener('DOMContentLoaded', () => {
    const errorWindow = document.querySelector('.login-form__error');
    const email = document.querySelector('.login-form__input-field');
    const emailDescriptionText = document.querySelector('.login-form__input-extra-info');
    const password = document.querySelector('.login-form__password-field');
    const sendButton = document.querySelector('.login-form__button-submit');

    function raiseErrorMessage(message, icon) {
        const errorText = errorWindow.querySelector('.login-form__error-message');
        errorText.innerText = message;
        const errorIcon = errorWindow.querySelector('.login-form__error-icon');
        errorIcon.src = `../content/media/icons/${icon}`;
        errorWindow.classList.remove('hidden');
    }

    function validateEmail(emailData) {
        const emailRegex = /^[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.[a-zA-Z]+$/; 
        // /текст/ короткий синтаксис регулярного выражения, ^ - якорь начала строки, $ - якорь конца строки
        // \s - класс пробельных символов, + - квантификатор одного или более символов, [...] - искать любой символ из заданного набора
        // [^...] - исключающий набор, [^\s@.] - исключить пробельные символы, @ . - исключенные символы
        // \. - символ точки, + - смотреть до конца
        if (!emailRegex.test(emailData)) {
            setErrorClass(email);
            raiseErrorMessage('Неверный формат электропочты', 'unsure.png');
            return false;
        }
        return true;
    }

    function setErrorClass(div) {
        div.classList.add('input-error');
        div.addEventListener('click', () => removeErrorClass(div), {
            once: true,
        });
    }

    function removeErrorClass(div) {
        div.classList.remove('input-error');
        if (div.classList == 'login-form__input-field') {
            emailDescriptionText.classList.remove('login-form__error-description');
        }
        const errorFields = document.querySelectorAll('.input-error');
        if (errorFields.length == 0) {
            errorWindow.classList.add('hidden');
        }
    }

    sendButton.addEventListener('click', (event) => {
        event.preventDefault();
        const form = event.target.closest('form');
        const formData = new FormData(form);
    
        const emailData = formData.get('email');
        const passwordData = formData.get('password');
        const isEmailValid = validateEmail(emailData);
        let isValid = true;

        if (!isEmailValid) {
            setErrorClass(email);
            emailDescriptionText.classList.add('login-form__error-description');
            raiseErrorMessage('Поля обязательные', 'nerd.png');
            isValid = false;
        }
        
        if (passwordData.length == 0) {
            setErrorClass(password);
            raiseErrorMessage('Поля обязательные', 'nerd.png');
            isValid = false;
        }

        if (isValid) {
            if (isEmailValid) {
                setErrorClass(email);
                emailDescriptionText.classList.add('login-form__error-description');
                setErrorClass(password);
                raiseErrorMessage('Не те логин или пароль...', 'unsure.png');
            } else {
                setErrorClass(email);
                emailDescriptionText.classList.add('login-form__error-description');
                raiseErrorMessage('Неверный формат электропочты', 'unsure.png');
            }
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const password = document.querySelector('.login-form__password');
    const passwordField = password.querySelector('.login-form__password-field');
    const eye = password.querySelector('.login-form__button-eye');
    
    eye.addEventListener('click', () => {
        eye.classList.toggle('eye-off');
        const isClose = eye.classList.contains('eye-off');
        if (isClose) {
            passwordField.type = 'password';
            eye.src = '../content/media/icons/icon-eye-off.svg';
        }
        else {
            passwordField.type = 'text';
            eye.src = '../content/media/icons/icon-eye-on.svg';
        };
    });
});