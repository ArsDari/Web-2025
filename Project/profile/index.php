<?php

const PATH_JSON = '../content/json/';
const PATH_ICON = '../content/media/icons/';
const PATH_IMAGE = '../content/media/images/';

$posts = json_decode(file_get_contents(PATH_JSON . 'posts.json'), true);
$users = json_decode(file_get_contents(PATH_JSON . 'users.json'), true);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Профиль</title>
</head>

<body>
    <div class="tree">
        <img class="tree_icon" src="<?= PATH_ICON . 'home.svg' ?>" alt="Домой" />
        <img class="tree_icon" src="<?= PATH_ICON . 'user.svg' ?>" alt="Профиль" />
        <img class="tree_icon" src="<?= PATH_ICON . 'plus.svg' ?>" alt="Выложить пост" />
    </div>
    <?php include_once '../content/templates/profile.php'; ?>
</body>

</html>