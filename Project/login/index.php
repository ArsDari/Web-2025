<?php

const PATH_IMAGE = '../content/media/images/';
$loginImage = PATH_IMAGE . 'login.jpg';

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Войти</title>
</head>

<body>
    <div class="title">
        <h1 class="title__text">Войти</h1>
        <img class="title__image" src="<?= $loginImage ?>" alt="Ошибка">
    </div>
    <form class="form">
        <label for="email" class="form__label">Электропочта</label>
        <input id="email" type="email" class="form__input" autocomplete="email">
        <span class="form__input-info">Введите электропочту в формате *****@***.**</span>
        <label for="password" class="form__label">Пароль</label>
        <input id="password" type="password" class="form__input" autocomplete="current-password">
        <input type="submit" class="form__button">
    </form>
</body>

</html>