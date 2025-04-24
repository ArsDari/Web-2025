<?php

require_once('../content/templates/utilities.php');

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
    <title>Заглавная</title>
</head>

<body>
    <div class="tree">
        <img class="tree_icon" src="<?= PATH_ICON . 'home.svg' ?>" alt="Домой" />
        <img class="tree_icon" src="<?= PATH_ICON . 'user.svg' ?>" alt="Профиль" />
        <img class="tree_icon" src="<?= PATH_ICON . 'plus.svg' ?>" alt="Выложить пост" />
    </div>
    <div class="feed">
        <?php

        foreach ($posts as $post)
        {
            $current_user_id = 1;

            $user = $users[$post['user_id'] - 1];
            $profileName = $user['name'];
            $profilePicture = PATH_IMAGE . $user['profile_picture'];
            $drawIconEdit = $current_user_id === $post['user_id'];

            $postImagePointer = 0;
            $postImage = PATH_IMAGE . $post['images'][$postImagePointer];
            $postText = $post['text'];

            $postTime = $post['timestamp'];
            $deltaTime = time() - $postTime;

            require '../content/templates/post.php';
        }

        ?>
    </div>
</body>

</html>