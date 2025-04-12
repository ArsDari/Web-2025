<?php

$posts = file_get_contents("posts.json");
$posts = json_decode($posts, true);
$users = file_get_contents("users.json");
$users = json_decode($users, true);

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
        <img class="tree_icon" src="../media/icons/home.svg" alt="Домой" />
        <img class="tree_icon" src="../media/icons/user.svg" alt="Профиль" />
        <img class="tree_icon" src="../media/icons/plus.svg" alt="Выложить пост" />
    </div>
    <div class="feed">
        <?php

        foreach ($posts as $post):
            $user = $users[$post["user_id"] - 1];
            $profilePicture = $user["image"];
            $profileName = $user["name"];
            $postImagePointer = 0;
            $postImage = $post["images"][$postImagePointer];
            $postText = $post["text"];
            $postDate = date("j/n/Y", $post["timestamp"]);

        ?>
            <div class="feed__post">
                <div class="feed__post__header">
                    <img class="feed__post__header_picture" src="../media/images/<?php echo $profilePicture ?>" alt="Профиль" />
                    <span class="feed__post__header_name"><?php echo $profileName ?></span>
                    <img class="feed__post__header_icon-edit" src="../media/icons/edit.svg" alt="Изменить" />
                </div>
                <div class="feed__post__body">
                    <img class="feed__post__body_image" src="../media/images/<?php echo $postImage ?>" alt="Ошибка" />
                    <div class="feed__post__body_text">
                        <?php echo $postText ?>
                    </div>
                    <div class="feed__post__body_timestamp">
                        <?php echo $postDate ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>