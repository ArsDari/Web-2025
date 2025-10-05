<?php

const SALT = "ThisIsMySalt";

function sendResponse($responseCode, $response)
{
    http_response_code($responseCode);
    $response["status"] = $responseCode;
    exit(json_encode($response));
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    sendResponse(501, ["message" => "Wrong method"]);
}

if (empty($_POST["email"]) || empty($_POST["password"])) {
    sendResponse(400, ["message" => "Email or password is empty"]);
}

$email = $_POST["email"];
$password = md5(md5($_POST["password"]) . SALT);

// проверка и валидация

require "../../database.php";
try {
    $connection = connectToDatabase();
} catch (PDOException $exception) {
    sendResponse(500, ["message" => "Error while connecting to db: " . $exception->getMessage()]);
}

$user = getUserWithEmail($connection, $email);
if (empty($user)) {
    sendResponse(401, ["message" => "User not found"]);
}

$userPassword = $user["password"];
if ($password != $userPassword) {
    sendResponse(401, ["message" => "Wrong password"]);
}

session_name("auth");
session_start();
$_SESSION["user_id"] = $user["id"];
sendResponse(200, ["user_id" => $_SESSION["user_id"]]);