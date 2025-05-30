<?php

const PATH_JSON = '../content/json/';
const PATH_ICON = '../content/media/icons/';
const PATH_IMAGE = '../content/media/images/';

require('../database.php');

$connection = connectToDatabase();
$posts = getPostsFromDB($connection);
$users = getUsersFromDB($connection);

// $posts = json_decode(file_get_contents(PATH_JSON . 'posts.json'), true);
// $users = json_decode(file_get_contents(PATH_JSON . 'users.json'), true);

$sessionUserId = 1; // заглушка для будущей сессии
$userId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

require_once('../content/utilities/caseTime.php');

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Заглавная</title>
    <script src="home.js"></script>
</head>

<body>
    <div class="tree">
        <img class="tree__icon" src="<?= PATH_ICON . 'home.svg' ?>" alt="Домой" />
        <img class="tree__icon" src="<?= PATH_ICON . 'user.svg' ?>" alt="Профиль" />
        <img class="tree__icon" src="<?= PATH_ICON . 'plus.svg' ?>" alt="Выложить пост" />
    </div>
    <div class="feed">
        <?php

        foreach ($posts as $post) // database implementation
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
            $postImage = PATH_IMAGE . $postImages[0]['image_path'];
            $showSlider = count($postImages) > 1;

            $postText = $post['text'];
            $postTime = strtotime($post['created_timestamp']);

            require '../content/templates/post.php';
        }
        
        // foreach ($posts as $post) // json implementation
        // {
        //     if ($userId && $userId != $post['user_id'])
        //     {
        //         continue;
        //     }
            
        //     $user = $users[$post['user_id'] - 1];
        //     $profileName = $user['name'];
        //     $profilePicture = PATH_IMAGE . $user['profile_picture'];

        //     $drawIconEdit = $sessionUserId == $post['user_id'];
        //     $postImage = PATH_IMAGE . $post['images'][0];
        //     $postText = $post['text'];
        //     $postTime = $post['created_timestamp'];

        //     require '../content/templates/post.php';
        // }

        ?>
    </div>
</body>

</html>