<?php
    require_once 'include/database.php';
    $connection = connectToDatabase();
    $posts = getPostsFromDatabase($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Создать пост</title>
</head>
<body>
    <div class="container">
        <h1>Создать пост</h1>
        <?php
            foreach ($posts as $post)
                include 'template/post.php';
        ?>
    </div>
</body>
</html>