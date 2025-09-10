<?php

const DB_HOST = '127.0.0.1'; // должен быть свой рут пользователь в этой базе данных, и сделать пароли
const DB_NAME = 'blog';
const DB_USER = 'root';
const DB_PASSWORD = ''; // заглушка

function connectToDatabase(): PDO
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    return new PDO($dsn, DB_USER, DB_PASSWORD);
}

function savePostToDatabase(PDO $connection, $userId, $text, $images)
{
    $query = <<<SQL
        INSERT INTO
            post (
                user_id,
                text,
                created_timestamp
            )
        VALUES (
            :user_id,
            :text,
            :created_timestamp
        )
        SQL;
    $statement = $connection->prepare($query);
    $statement->execute([
        ':user_id' => $userId,
        ':text' => $text,
        ':created_timestamp' => date('Y-m-d H:i:s')
    ]);
    $postId = $connection->lastInsertId();
    foreach ($images as $imagePath) {
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
            ':post_id' => $postId,
            ':image_path' => $imagePath
        ]);
    }
}

function getPostsFromDB(PDO $connection): ?array
{
    $query = <<<SQL
        SELECT
            *
        FROM
            post
        SQL;
    $statement = $connection->query($query);
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function getPostsFromUser(PDO $connection, int $userId): ?array
{
    $query = <<<SQL
        SELECT
            *
        FROM
            post
        WHERE
            user_id = $userId
        SQL;
    $statement = $connection->query($query);
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function getUsersFromDB(PDO $connection): ?array
{
    $query = <<<SQL
        SELECT
            *
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
            *
        FROM
            user
        WHERE
            id = $id
        SQL;
    $statement = $connection->query($query);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function getUserWithEmail(PDO $connection, string $email)
{
    $query = <<<SQL
        SELECT
            *
        FROM
            user
        WHERE
            email = :email;
        SQL;
    $statement = $connection->prepare($query);
    $statement->execute([
        ':email' => $email
    ]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function getImageFromDB(PDO $connection, int $postId): ?array
{
    $query = <<<SQL
        SELECT
            *
        FROM
            image
        WHERE
            post_id = $postId
        SQL;
    $statement = $connection->query($query);
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $row ?: null;
}