<?php

const PATH_JSON = '../content/json/';
const PATH_ICON = '../content/media/icons/';
const PATH_IMAGE = '../content/media/images/';
const POST_STRING_CASES = ['пост', 'поста', 'постов'];
const ROW = 3;

require '../database.php';
require '../content/utilities/validation.php';
require '../content/utilities/caseHandler.php';

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

$userId = null;
if (isset($_GET['id']))
{
    $recievedId = $_GET['id'];
    if (validateId($recievedId))
    {
        $userId = $recievedId;
    };
}

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

function printGridOfPosts($userPosts, $connection)
{
    foreach ($userPosts as $post)
    {
        $postImages = getImageFromDB($connection, $post['id']);
        $postImage = $postImages[0]['image_path'];
        echo '<img class="posts__image" src="' . PATH_IMAGE . $postImage . '" alt="Пост" />';
    }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../content/fonts/font.css" type="text/css" rel="stylesheet">
    <link href="profile.css" rel="stylesheet">
    <title>Профиль</title>
</head>

<body>
    <div class="page">
        <div class="sidebar">
            <a href="../home" class="sidebar-shell">
                <img class="sidebar-shell__icon" src="<?= PATH_ICON . 'home.svg' ?>" alt="Домой" />
            </a>
            <a href="../profile?id=<?= $userId ?>" class="sidebar-shell sidebar-active">
                <img class="sidebar-shell__icon" src="<?= PATH_ICON . 'user.svg' ?>" alt="Профиль" />
            </a>
            <a href="../create_post" class="sidebar-shell">
                <img class="sidebar-shell__icon" src="<?= PATH_ICON . 'plus.svg' ?>" alt="Выложить пост" />
            </a>
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
    </div>
</body>

</html>