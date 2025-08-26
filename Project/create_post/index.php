<?php

const PATH_JSON = '../content/json/';
const PATH_ICON = '../content/media/icons/';
const PATH_IMAGE = '../content/media/images/';

$sessionUserId = 1; // заглушка для будущей сессии
$postImages = [1];

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
            <div class="sidebar__navigation">
                <a href="../home" class="sidebar__navigation__shell">
                    <img class="sidebar__navigation__shell__icon" src="<?= PATH_ICON . 'home.svg' ?>" alt="Домой" />
                </a>
                <a href="../profile?id=<?= $sessionUserId ?>" class="sidebar__navigation__shell">
                    <img class="sidebar__navigation__shell__icon" src="<?= PATH_ICON . 'user.svg' ?>" alt="Профиль" />
                </a>
                <a href="../create_post" class="sidebar__navigation__shell sidebar__navigation-active">
                    <img class="sidebar__navigation__shell__icon" src="<?= PATH_ICON . 'plus.svg' ?>" alt="Выложить пост" />
                </a>
            </div>
        </div>
        <div class="creating-post">
            <div class="images">
                <img class="icon-remove hidden" src="<?= PATH_ICON . 'icon-remove.svg' ?>" alt="Влево">
                <img class="icon-slider left-button hidden" src="<?= PATH_ICON . 'slider-button.svg' ?>" alt="Влево">
                <img class="icon-slider right-button hidden" src="<?= PATH_ICON . 'slider-button.svg' ?>" alt="Вправо">
                <div class="counter hidden"></div>
                <div class="upload">
                    <img class="upload__image" src="../content/media/icons/icon-picture.png">
                    <label for="upload-from-images" class="upload__button">
                        <span class="upload__button__text">Добавить фото</span>
                    </label>
                    <input id="upload-from-images" class="hidden" type="file" accept="image/*">
                </div>
            </div>
            <div class="info-message hidden">
                <img class="info-message__icon" src="../content/media/icons/cool.png">
                <span class="info-message__text">Вы добавили максимум фото, круто!</span>
            </div>
            <div class="upload-new">
                <label for="upload-from-button" class="upload-new__button">
                    <img class="upload-new__button__icon" src="../content/media/icons/icon-square-plus.svg">
                    <span class="upload-new__button__text">Добавить фото</span>
                </label>
                <input id="upload-from-button" class="hidden" type="file" accept="image/*">
            </div>
            <form id="create-form" class="new-post" method="post">
                <textarea id="text" class="new-post__text" placeholder="Добавьте подпись…" required></textarea>
                <div>
                    <input id="send-button" type="submit" class="create-form__submit-button upload__button disabled" value="Поделиться" disabled>
                </div>
            </form>
        </div>
    </div>
</body>

</html>