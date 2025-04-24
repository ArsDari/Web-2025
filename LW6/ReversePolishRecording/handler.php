<?php

$input = $_GET["input"];
$input = explode(" ", $input);
$stack = [];
foreach ($input as $element)
{
    if (is_numeric($element))
        array_push($stack, $element);
    else
    {
        $b = array_pop($stack);
        $a = array_pop($stack);
        switch ($element)
        {
            case "+":
                array_push($stack, $a + $b);
                break;
            case "-":
                array_push($stack, $a - $b);
                break;
            case "*":
                array_push($stack, $a * $b);
                break;
        }
    }
}

echo array_pop($stack);

?>