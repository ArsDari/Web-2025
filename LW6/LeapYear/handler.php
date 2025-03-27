<?php

$age = $_GET["input"];
if (($age % 4 == 0 && $age % 100 != 0) || ($age % 400 == 0)) {
    echo "YES";
} else {
    echo "NO";
}

?>