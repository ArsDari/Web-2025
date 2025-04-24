<?php

CONST MINUTE = 60;
CONST HOUR = 24;
CONST DAY = 30;
CONST SECOND_CASES = ['секунду', 'секунды', 'секунд'];
CONST MINUTE_CASES = ['минуту', 'минуты', 'минут'];
CONST HOUR_CASES = ['час', 'часа', 'часов'];
CONST DAY_CASES = ['день', 'дня', 'дней'];
CONST MONTH_LIST = [
	1  => 'января',
	2  => 'февраля',
	3  => 'марта',
	4  => 'апреля',
	5  => 'мая', 
	6  => 'июня',
	7  => 'июля',
	8  => 'августа',
	9  => 'сентября',
	10 => 'октября',
	11 => 'ноября',
	12 => 'декабря'
];

function caseNumber($number, $titles)
{
    $cases = array(2, 0, 1, 1, 1, 2);
    return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
}

function echoTime($deltaTime, $timestamp)
{
    $postTimeString = '';
    if ($deltaTime === 0)
    {
        return 'Только что';
    }
    elseif ($deltaTime <= MINUTE)
    {
        $postTimeString = $deltaTime . ' ' . caseNumber($deltaTime, SECOND_CASES);
    }
    elseif (MINUTE < $deltaTime && $deltaTime <= MINUTE * MINUTE)
    {
        $deltaTime = intdiv($deltaTime, MINUTE);
        $postTimeString = $deltaTime . ' ' . caseNumber($deltaTime, MINUTE_CASES);
    }
    elseif (MINUTE * MINUTE < $deltaTime && $deltaTime <= MINUTE * MINUTE * HOUR)
    {
        $deltaTime = intdiv($deltaTime, MINUTE * MINUTE);
        $postTimeString = $deltaTime . ' ' . caseNumber($deltaTime, HOUR_CASES);
    }
    elseif (MINUTE * MINUTE * HOUR < $deltaTime && $deltaTime <= MINUTE * MINUTE * HOUR * DAY)
    {
        $deltaTime = intdiv($deltaTime, MINUTE * MINUTE * HOUR);
        $postTimeString = $deltaTime . ' ' . caseNumber($deltaTime, DAY_CASES);
    }
    else
    {
        return date('d', $timestamp) . ' ' . MONTH_LIST[date('n', $timestamp)] . ' ' . date('Y', $timestamp);
    }
    return $postTimeString . ' назад';
}

function printPost($posts, $userPosts)
{
    if ($userPosts)
    {
        for ($iter = 0; $iter < count($userPosts); $iter++)
        {
            $post = $posts[$userPosts[$iter] - 1];
            $postImage = $post['images'][0];
            if (!($iter % ROW))
                echo '<tr class="profile__posts__row">';
            echo '<td class="profile__posts__row_element">';
            echo '<img class="profile__posts__post_image" src="' . PATH_IMAGE . $postImage . '" width="322" height="322" alt="Пост" />';
            echo '</td>';
            if (!($iter + 1 % ROW))
                echo '</tr>';
        }
    }    
}

?>