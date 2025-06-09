<?php

const PATH_JSON = '../content/json/';
const PATH_ICON = '../content/media/icons/';
const PATH_IMAGE = '../content/media/images/';

require '../database.php';
require '../content/utilities/validation.php';

try
{
    $connection = connectToDatabase();
}
catch (PDOException $exception)
{
    echo "Ошибка подключения к базе данных: " . $exception->getMessage();
    exit(1);
}

$posts = getPostsFromDB($connection);
$users = getUsersFromDB($connection);

$sessionUserId = 1; // заглушка для будущей сессии
$userId = null;
if (isset($_GET['id']))
{
    $recievedId = $_GET['id'];
    if (validateId($recievedId))
    {
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
            <a href="../home" class="sidebar-shell sidebar-active">
                <img class="sidebar-shell__icon" src="<?= PATH_ICON . 'home.svg' ?>" alt="Домой" />
            </a>
            <a href="../profile?id=<?= $sessionUserId ?>" class="sidebar-shell">
                <img class="sidebar-shell__icon" src="<?= PATH_ICON . 'user.svg' ?>" alt="Профиль" />
            </a>
            <a href="../create_post" class="sidebar-shell">
                <img class="sidebar-shell__icon" src="<?= PATH_ICON . 'plus.svg' ?>" alt="Выложить пост" />
            </a>
        </div>
        <div class="feed">
            <?php

            foreach ($posts as $post)
            {
                if ($userId && $userId != $post['user_id'])
                {
                    continue;
                }
                $user = $users[$post['user_id'] - 1];
                $profileName = $user['name'];
                $profilePicture = PATH_IMAGE . $user['profile_picture'];

                $showIconEdit = $sessionUserId == $post['user_id'];

                $postImages = getImageFromDB($connection, $post['id']);
                $postImageCounter = count($postImages);

                $postText = $post['text'];
                $postTime = strtotime($post['created_timestamp']);
                $postLikes = $post['likes'];
                $deltaTime = time() - $postTime;

                if ($deltaTime >= 0)
                {
                    require '../content/templates/post.php';
                }
            }

            ?>
        </div>
    </div>

    <div class="modal-window">
        <div class="modal-window__content">
            <div class="modal-window__shell">
                <img class="modal-window__shell__icon" src="<?= PATH_ICON . 'close.svg' ?>" alt="Домой" />
            </div>
            <div class="modal-images">
                <img class="modal-icon-slider-left-button" src="<?= PATH_ICON . 'slider-button.svg' ?>" alt="Влево">
                <img class="modal-icon-slider-right-button" src="<?= PATH_ICON . 'slider-button.svg' ?>" alt="Вправо">
            </div>
            <div class="modal-counter"></div>
        </div>
    </div>

</body>

</html>