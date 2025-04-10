<?php

$input = $_GET["input"];
$input = explode(" ", $input);
$queue = [];
foreach ($input as $element)
{
    if (is_numeric($element))
        array_push($queue, $element);
    else
    {
        $b = array_pop($queue);
        $a = array_pop($queue);
        switch ($element)
        {
            case "+":
                array_push($queue, $a + $b);
                break;
            case "-":
                array_push($queue, $a - $b);
                break;
            case "*":
                array_push($queue, $a * $b);
                break;
        }
    }
}

echo array_pop($queue);

?>