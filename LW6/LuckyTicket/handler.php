<?php

$start = $_GET["start"];
$end = $_GET["end"];
for ($start; $start < $end; $start++) {
    $a = intdiv($start, 100000);
    $b = intdiv($start, 10000) % 10;
    $c = intdiv($start, 1000) % 10;
    $d = intdiv($start, 100) % 10;
    $e = intdiv($start, 10) % 10;
    $f = $start % 10;
    if ($a + $b + $c === $d + $e + $f)
        echo $a . $b . $c . $d . $e . $f . "<br>";
}

?>