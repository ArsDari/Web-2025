<?php

const MOVE_PATH = "content/media/images/";
const IMAGE_EXTENSION = "image/";
const MAX_TEXT_LENGTH = 1024;

function sendResponse($responseCode, $response)
{
    http_response_code($responseCode);
    exit(json_encode($response));
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    sendResponse(501, ["message" => "Method Not Implemented"]);
}

require "database.php";
try {
    $connection = connectToDatabase();
} catch (PDOException $exception) {
    sendResponse(500, ["message" => "Error while connecting to db: " . $exception->getMessage()]);
}

if (empty($_POST["user_id"])) {
    sendResponse(400, ["message" => "User id is not found"]);
}
$user = getUserFromDB($connection, $_POST["user_id"]);
if (!$user) {
    sendResponse(400, ["message" => "User is not found"]);
}
$userId = $user["id"];

$text = trim($_POST["text"]);
if (empty($text) || strlen($text) > MAX_TEXT_LENGTH) {
    sendResponse(400, ["message" => "Text is either not sent or too big"]);
}

if (empty($_FILES["image"]["name"][0])) {
    sendResponse(400, ["message" => "No image or images was sent"]);
}

$tempFiles = [];
$tempPaths = $_FILES["image"]["tmp_name"]; // путь временнего файла на сервере
$fileTypes = $_FILES["image"]["type"]; // тип временного файла на сервере
$uploadErrors = $_FILES["image"]["error"];
foreach ($tempPaths as $indexPath => $tempPath) {
    if (!str_contains($fileTypes[$indexPath], IMAGE_EXTENSION)) {
        sendResponse(400, ["message" => "Wrong file extension detected"]);
    }
    if ($uploadErrors[$indexPath] != UPLOAD_ERR_OK) {
        sendResponse(400, ["message" => "Error occurred while file was uploading"]);
    }
    array_push($tempFiles, $tempPaths[$indexPath]);
}

$imageNames = [];
foreach ($tempFiles as $indexPath => $tempPath) {
    $imageType = str_replace(IMAGE_EXTENSION, "", $fileTypes[$indexPath]);
    $imageName = $userId . $indexPath . strval(time()) . "." . $imageType;
    $newPath = MOVE_PATH . $imageName;
    array_push($imageNames, $imageName);
    if (!move_uploaded_file($tempPath, $newPath)) {
        sendResponse(500, ["message" => "Error occurred while file was saving"]);
    }
}

savePostToDatabase($connection, $userId, $text, $imageNames);
sendResponse(201, ["message" => "Successfully created post"]);