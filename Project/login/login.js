document.addEventListener('DOMContentLoaded', () => {
    const email = document.querySelector('.login-form__input-field');
    const password = document.querySelector('.login-form__password-field');
    const sendButton = document.querySelector('.login-form__button-submit');

    sendButton.addEventListener('click', (event) => {
        event.preventDefault();
        const form = event.target.closest('form');
        const formData = new FormData(form);
    
        const email = formData.get('email');
        const password = formData.get('password');
        
        console.log(email);
        console.log(password);
    })
});