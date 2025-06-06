<?php

const PATH_JSON = '../content/json/';
const PATH_ICON = '../content/media/icons/';
const PATH_IMAGE = '../content/media/images/';
const ROW = 3;

// require '../database.php';

// $posts = getPostsFromDB($connection);
// $users = getUsersFromDB($connection);

$posts = json_decode(file_get_contents(PATH_JSON . 'posts.json'), true);
$users = json_decode(file_get_contents(PATH_JSON . 'users.json'), true);

$userId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if (!$userId)
{
    header('Location: ../home');
    exit();
}

$foundUser = NULL;
foreach ($users as $user)
{
    if ($userId == $user['id'])
    {
        $foundUser = $user;
        break;
    }
}

if (!$foundUser)
{
    header('Location: ../home');
    exit();
}

// function printGridOfPosts($userPosts, $connection, $row) // database implementation
// {
//     for ($iter = 0; $iter < count($userPosts); $iter++)
//     {
//         $post = $userPosts[$iter];
//         $postImages = getImageFromDB($connection, $post['id']);
//         $postImage = $postImages[0]['image_path'];

//         if ($iter % $row == 0)
//         {
//             echo '<tr class="posts__row">';
//         }
//         echo '<td class="post">';
//         echo '<img class="post__image" src="' . PATH_IMAGE . $postImage . '" width="322" height="322" alt="Пост" />';
//         echo '</td>';
//         if (($iter + 1) % $row == 0)
//         {
//             echo '</tr>';
//         }
//     }
// }

function printGridOfPosts($userPosts, $row) // json implementation
{
    for ($iter = 0; $iter < count($userPosts); $iter++)
    {
        $post = $userPosts[$iter];
        $postImages = $post['images'];
        $postImage = $postImages[0];

        if ($iter % $row == 0)
        {
            echo '<tr class="posts__row">';
        }
        echo '<td class="post">';
        echo '<img class="post__image" src="' . PATH_IMAGE . $postImage . '" width="322" height="322" alt="Пост" />';
        echo '</td>';
        if (($iter + 1) % $row == 0)
        {
            echo '</tr>';
        }
    }
}

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
    <?php

    $name = $foundUser['name'];
    $profilePicture = PATH_IMAGE . $foundUser['profile_picture'];
    $aboutMe = $foundUser['about_me'];

    $userPosts = [];
    foreach ($posts as $post)
    {
        if ($userId == $post['user_id'])
        {
            array_push($userPosts, $post);
        }
    }
    require '../content/templates/profile.php';

    ?>
</body>

</html>