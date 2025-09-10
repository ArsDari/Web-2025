<?php

session_name("auth");
session_start();
if (!empty($_SESSION["user_id"])) {
    header("Location: ../profile?id=" . $_SESSION["user_id"]);
    exit();
}

const PATH_ICON = '../content/media/icons/';
const PATH_IMAGE = '../content/media/images/';

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
            <img class="sidebar__image" src="<?= PATH_IMAGE . 'login.jpg' ?>" alt="Ошибка">
        </div>
        <div class="menu">
            <div class="error hidden">
                <img class="error__icon">
                <div class="error__message"></div>
            </div>
            <form id="login-form" class="login-form">
                <div class="login-form__field">
                    <label class="login-form__field__label" for="email">Электропочта</label>
                    <input class="login-form__field__input" id="email" type="email" name="email" autocomplete="email">
                    <div class="login-form__field__description">Введите электропочту в формате *****@***.**</div>
                </div>
                <div class="login-form__field">
                    <label class="login-form__field__label" for="password">Пароль</label>
                    <div class="login-form__field__password">
                        <input class="login-form__field__input password-field" id="password" type="password"
                            name="password" autocomplete="current-password">
                        <img class="icon-eye" src="<?= PATH_ICON . 'icon-eye.svg' ?>" alt="Скрыть">
                    </div>
                </div>
            </form>
            <input class="submit-button" id="submit-button" type="submit" value="Продолжить" form="login-form">
        </div>
    </div>
</body>

</html>