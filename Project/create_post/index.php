<?php

const PATH_JSON = '../content/json/';
const PATH_ICON = '../content/media/icons/';
const PATH_IMAGE = '../content/media/images/';

session_name("auth");
session_start();
if (empty($_SESSION["user_id"])) {
    header("Location: ../login");
    exit();
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../content/fonts/font.css" type="text/css" rel="stylesheet">
    <link href="create_post.css" rel="stylesheet">
    <script src="create_post.js"></script>
    <title>Поделиться постом</title>
</head>

<body>
    <div class="page">
        <div class="sidebar">
            <div class="sidebar__navigation navigation-upper">
                <a href="../home" class="sidebar__navigation__shell">
                    <img class="sidebar__navigation__shell__icon" src="<?= PATH_ICON . 'home.svg' ?>" alt="Домой" />
                </a>
                <a href="../profile?id=<?= $sessionUserId ?>" class="sidebar__navigation__shell">
                    <img class="sidebar__navigation__shell__icon" src="<?= PATH_ICON . 'user.svg' ?>" alt="Профиль" />
                </a>
                <a href="../create_post" class="sidebar__navigation__shell sidebar__navigation-active">
                    <img class="sidebar__navigation__shell__icon" src="<?= PATH_ICON . 'plus.svg' ?>"
                        alt="Выложить пост" />
                </a>
            </div>
            <div class="sidebar__navigation navigation-lower">
                <a href="../api/logout" class="sidebar__navigation__shell">
                    <img class="sidebar__navigation__shell__icon" src="<?= PATH_ICON . 'icon-logout.svg' ?>"
                        alt="Выйти из аккаунта" />
                </a>
            </div>
        </div>
        <div class="message-field hidden">
            <div class="message-field__text"></div>
        </div>
        <div class="creating-post">
            <div class="images">
                <img class="icon-remove hidden" src="<?= PATH_ICON . 'icon-remove.svg' ?>" alt="Влево">
                <img class="icon-slider left-button hidden" src="<?= PATH_ICON . 'slider-button.svg' ?>" alt="Влево">
                <img class="icon-slider right-button hidden" src="<?= PATH_ICON . 'slider-button.svg' ?>" alt="Вправо">
                <div class="counter hidden"></div>
                <div class="upload-primary">
                    <img class="upload-primary__image" src="../content/media/icons/icon-picture.png">
                    <label class="button-primary" for="upload-from-images">
                        <span class="button-primary__text">Добавить фото</span>
                    </label>
                    <input id="upload-from-images" class="uploader hidden" type="file" accept="image/*" multiple>
                </div>
            </div>
            <div class="info-message hidden">
                <img class="info-message__icon" src="../content/media/icons/cool.png">
                <span class="info-message__text">Вы добавили максимум фото, круто!</span>
            </div>
            <div class="upload-secondary">
                <label class="button-secondary" for="upload-from-button">
                    <img class="button-secondary__icon" src="../content/media/icons/icon-square-plus.svg">
                    <span class="button-secondary__text">Добавить фото</span>
                </label>
                <input id="upload-from-button" class="uploader hidden" type="file" accept="image/*" multiple>
            </div>
            <form id="create-form" class="create-form" method="post">
                <textarea id="text" name="text" class="create-form__text" placeholder="Добавьте подпись…"
                    required></textarea>
            </form>
            <input id="send-button" type="submit" class="create-form__submit-button button-primary" form="create-form" value="Поделиться"
                disabled>
        </div>
    </div>
</body>

</html>