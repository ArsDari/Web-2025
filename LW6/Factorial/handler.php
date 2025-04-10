<?php

function Factorial($n): int {
    if ($n === 0)
        return 1;
    else
        return $n * Factorial($n - 1);
}

$number = $_GET["number"];
echo Factorial($number);

?>