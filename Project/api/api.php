<?php

const ALLOWED_EXTENSIONS = ['image/gif', 'image/jpg', 'image/jpeg', 'image/png'];
const MAX_TEXT_LENGTH = 1024;

require '../database.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST')
{
    echo "Неправильный тип запроса";
    exit(1);
}

try
{
    $connection = connectToDatabase();
}
catch (PDOException $exception)
{
    echo "Ошибка подключения к базе данных: " . $exception->getMessage();
    exit(1);
}

if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0]))
{
    $user = getUserFromDB($connection, $_POST['user_id']);
    if (!$user)
    {
        echo 'Пользователь не найден';
        exit(1);
    }
    $userId = $user[0]['id'];
    $text = trim($_POST['text']);
    if (!$text || strlen($text) > MAX_TEXT_LENGTH)
    {
        echo 'Текст поста не был передан, либо превышена максимальная длина поста';
        exit(1);
    }
    // $_FILES - глобальный массив загруженных файлов
    $paths = $_FILES['images']['tmp_name']; // путь временнего файла на сервере
    $fileTypes = $_FILES['images']['type']; // тип временного файла на сервере
    $tempFilenames = [];
    $images = [];
    foreach ($paths as $index => $tempPath)
    {
        if (array_search($fileTypes[$index], ALLOWED_EXTENSIONS))
        {
            array_push($tempFilenames, $paths[$index]);
        }
        else
        {
            echo 'Неподдерживаемый формат файла';
            exit(1);
        }
    }
    foreach ($tempFilenames as $index => $tempPath)
    {
        $movedFilename = $userId . $index . strval(time()) . '.' . substr($fileTypes[$index], 6);
        array_push($images, $movedFilename);
        if (!move_uploaded_file($tempPath, '../content/media/images/' . $movedFilename))
        {
            echo 'Возникла ошибка во время передачи файла';
            exit(1);
        }
    }
    savePostToDatabase($connection, $userId, $text, $images);
    echo 'Успех';
}
else
{
    echo 'Изображения не были переданы';
    exit(1);
}

?>