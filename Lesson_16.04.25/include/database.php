<?php

const DB_HOST = '127.0.0.1'; // должен быть свой рут пользователь в этой базе данных, и сделать пароли
const DB_NAME = 'blog';
const DB_USER = 'root';
const DB_PASSWORD = '';

function connectToDatabase(): PDO
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;;
    return new PDO($dsn, DB_USER, DB_PASSWORD);
}

function getPostsFromDatabase(PDO $connection, int $limit = 100): array
{
    $query = <<<SQL
        SELECT
            title, image
        FROM
            post
        LIMIT {$limit}
    SQL;

    $statement = $connection->query($query);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function savePostToDatabase(PDO $connection, string $title, string $image): bool
{
    $query = <<<SQL
        INSERT INTO
            post (title, image)
        VALUES
            (:title, :image)
    SQL;
    $statement = $connection->prepare($query);
    $statement->execute([
        ':title' => $title,
        ':image' => $image
    ]);
}