<?php

$input = $_GET["input"];
$day = substr($input, 0, 2);
$month = substr($input, 3, 2);

if (($day >= 21 && $month === 1) || ($day <= 19 && $month === 2))
    echo "Водолей";
elseif (($day >= 20 && $month === 2) || ($day <= 20 && $month === 3))
    echo "Рыбы";
elseif (($day >= 21 && $month === 3) || ($day <= 20 && $month === 4))
    echo "Овен";
elseif (($day >= 21 && $month === 4) || ($day <= 21 && $month === 5))
    echo "Телец";
elseif (($day >= 22 && $month === 5) || ($day <= 21 && $month === 6))
    echo "Близнецы";
elseif (($day >= 22 && $month === 6) || ($day <= 22 && $month === 7))
    echo "Рак";
elseif (($day >= 23 && $month === 7) || ($day <= 21 && $month === 8))
    echo "Лев";
elseif (($day >= 22 && $month === 8) || ($day <= 23 && $month === 9))
    echo "Дева";
elseif (($day >= 24 && $month === 9) || ($day <= 23 && $month === 10))
    echo "Весы";
elseif (($day >= 24 && $month === 10) || ($day <= 22 && $month === 11))
    echo "Скорпион";
elseif (($day >= 23 && $month === 11) || ($day <= 22 && $month === 12))
    echo "Стрелец";
else
    echo "Козерог"

?>