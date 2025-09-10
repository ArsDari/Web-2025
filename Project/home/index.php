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
$sessionUserId = $_SESSION["user_id"];

require '../database.php';
require '../content/utilities/validation.php';

try {
    $connection = connectToDatabase();
} catch (PDOException $exception) {
    echo "Ошибка подключения к базе данных: " . $exception->getMessage();
    exit(1);
}

$posts = getPostsFromDB($connection);
$users = getUsersFromDB($connection);
$userId = null;
if (isset($_GET['id'])) {
    $recievedId = $_GET['id'];
    if (validateId($recievedId)) {
        $userId = $recievedId;
    }
}

require_once '../content/utilities/caseHandler.php';

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../content/fonts/font.css" type="text/css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
    <script src="home.js"></script>
    <title>Заглавная</title>
</head>

<body>
    <div class="page">
        <div class="sidebar">
            <div class="sidebar__navigation navigation-upper">
                <a href="../home" class="sidebar__navigation__shell sidebar__navigation-active">
                    <img class="sidebar__navigation__shell__icon" src="<?= PATH_ICON . 'home.svg' ?>" alt="Домой" />
                </a>
                <a href="../profile?id=<?= $sessionUserId ?>" class="sidebar__navigation__shell">
                    <img class="sidebar__navigation__shell__icon" src="<?= PATH_ICON . 'user.svg' ?>" alt="Профиль" />
                </a>
                <a href="../create_post" class="sidebar__navigation__shell">
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
        <div class="feed">
            <?php

            foreach ($posts as $post) {
                if ($userId && $userId != $post['user_id']) {
                    continue;
                }
                $user = $users[$post['user_id'] - 1];
                $profileName = $user['name'];
                $profilePicture = PATH_IMAGE . $user['profile_picture'];
                $showIconEdit = $sessionUserId == $post['user_id'];
                $postImages = getImageFromDB($connection, $post['id']);
                $postText = $post['text'];
                $postTime = strtotime($post['created_timestamp']);
                $postLikes = $post['likes'];
                $deltaTime = time() - $postTime;
                if ($deltaTime >= 0) {
                    require '../content/templates/post.php';
                }
            }

            ?>
        </div>
        <div class="modal hidden">
            <div class="modal__content">
                <img class="modal__content__icon-close" src="<?= PATH_ICON . 'close.svg' ?>" alt="Домой" />
                <div class="modal__content__images">
                    <img class="modal-icon icon-slider left-button" src="<?= PATH_ICON . 'slider-button.svg' ?>"
                        alt="Влево">
                    <img class="modal-icon icon-slider right-button" src="<?= PATH_ICON . 'slider-button.svg' ?>"
                        alt="Вправо">
                </div>
                <div class="modal__content__counter counter-text"></div>
            </div>
        </div>
    </div>
</body>

</html>