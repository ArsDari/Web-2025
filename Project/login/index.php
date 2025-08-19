<?php

const PATH_ICON = '../content/media/icons/';
const PATH_IMAGE = '../content/media/images/';
$loginImage = PATH_IMAGE . 'login.jpg';

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../content/fonts/font.css" type="text/css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
    <script src="login.js"></script>
    <title>Войти</title>
</head>

<body>
    <div class="page">
        <div class="sidebar">
            <h1 class="sidebar__text">Войти</h1>
            <img class="sidebar__image" src="<?= $loginImage ?>" alt="Ошибка">
        </div>
        <form class="login-form">
            <div class="login-form__error hidden">
                <img class="login-form__error-icon">
                <div class="login-form__error-message"></div>
            </div>
            <label for="email" class="login-form__input-description">Электропочта</label>
            <input id="email" type="email" name="email" class="login-form__input-field" autocomplete="email">
            <div class="login-form__input-extra-info">Введите электропочту в формате *****@***.**</div>
            <label for="password" class="login-form__input-description">Пароль</label>
            <div class="login-form__password">
                <input id="password" type="password" name="password" class="login-form__password-field" autocomplete="current-password">
                <img class="login-form__button-eye eye-off" src="<?= PATH_ICON . 'icon-eye-off.svg' ?>" alt="Скрыть">
            </div>
            <input type="submit" class="login-form__button-submit" value="Продолжить">
        </form>
    </div>
</body>

</html>