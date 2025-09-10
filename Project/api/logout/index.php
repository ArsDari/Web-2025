<?php

session_name("auth");
session_start();
$_SESSION = [];
session_destroy();
header("Location: http://localhost:8001/login");