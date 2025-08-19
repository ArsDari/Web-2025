<?php

const DB_HOST = '127.0.0.1'; // должен быть свой рут пользователь в этой базе данных, и сделать пароли
const DB_NAME = 'blog';
const DB_USER = 'root';
const DB_PASSWORD = '';

function connectToDatabase(): PDO
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    return new PDO($dsn, DB_USER, DB_PASSWORD);
}

function savePostToDatabase(PDO $connection, $userId, $postText, $images)
{
    $query = <<<SQL
        INSERT INTO
            post (
                user_id,
                text
            )
        VALUES (
            :user_id,
            :text
        )
        SQL;
    $statement = $connection->prepare($query);
    $statement->execute([
        ':user_id' => $userId,
        ':text' => $postText
    ]);
    $id = $connection->lastInsertId();
    foreach ($images as $image_path)
    {
        $query = <<<SQL
            INSERT INTO
                image (
                    post_id,
                    image_path
                )
            VALUES (
                :post_id,
                :image_path
            )
            SQL;
        $statement = $connection->prepare($query);
        $statement->execute([
            ':post_id' => $id,
            ':image_path' => $image_path
        ]);
    }
}

function getPostsFromDB(PDO $connection): ?array
{
    $query = <<<SQL
        SELECT
            id, user_id, created_timestamp, text, likes
        FROM
            post
        SQL;
    $statement = $connection->query($query);
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function getPostFromUser(PDO $connection, int $user_id): ?array
{
    $query = <<<SQL
        SELECT
            id, user_id, created_timestamp, text, likes
        FROM
            post
        WHERE
            user_id = $user_id
        SQL;
    $statement = $connection->query($query);
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function getUsersFromDB(PDO $connection): ?array
{
    $query = <<<SQL
        SELECT
            id, email, password, name, profile_picture, about_me
        FROM
            user
        SQL;
    $statement = $connection->query($query);
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function getUserFromDB(PDO $connection, int $id): ?array
{
    $query = <<<SQL
        SELECT
            id, email, password, name, profile_picture, about_me
        FROM
            user
        WHERE
            id = $id
        SQL;
    $statement = $connection->query($query);
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function getImageFromDB(PDO $connection, int $post_id): ?array
{
    $query = <<<SQL
        SELECT
            post_id, image_path
        FROM
            image
        WHERE
            post_id = $post_id
        SQL;
    $statement = $connection->query($query);
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $row ?: null;
}

?>