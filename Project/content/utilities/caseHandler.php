<?php

const SECONDS_IN_MINUTE = 60;
const MINUTES_IN_HOUR = 60;
const HOURS_IN_DAY = 24;
const DAYS_IN_MONTH = 30;

const SECONDS_IN_HOUR = SECONDS_IN_MINUTE * MINUTES_IN_HOUR;
const SECONDS_IN_DAY = SECONDS_IN_HOUR * HOURS_IN_DAY;
const SECONDS_IN_MONTH = SECONDS_IN_DAY * DAYS_IN_MONTH;

const SECOND_CASES = ['секунду', 'секунды', 'секунд'];
const MINUTE_CASES = ['минуту', 'минуты', 'минут'];
const HOUR_CASES = ['час', 'часа', 'часов'];
const DAY_CASES = ['день', 'дня', 'дней'];
const MONTH_LIST = [
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
    $cases = [2, 0, 1, 1, 1, 2];
    return $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
}

function caseTime($timestamp)
{
    $deltaTime = time() - $timestamp + 10800; // сбросить часовые пояса
    if ($deltaTime < 0)
    {
        return 'Ошибка';
    }
    elseif ($deltaTime == 0)
    {
        return 'Только что';
    }
    elseif ($deltaTime <= SECONDS_IN_MINUTE)
    {
        return $deltaTime . ' ' . caseNumber($deltaTime, SECOND_CASES) . ' назад';
    }
    elseif (SECONDS_IN_MINUTE < $deltaTime && $deltaTime <= SECONDS_IN_HOUR)
    {
        $deltaTime = intdiv($deltaTime, SECONDS_IN_MINUTE);
        return $deltaTime . ' ' . caseNumber($deltaTime, MINUTE_CASES) . ' назад';
    }
    elseif (SECONDS_IN_HOUR < $deltaTime && $deltaTime <= SECONDS_IN_DAY)
    {
        $deltaTime = intdiv($deltaTime, SECONDS_IN_HOUR);
        return $deltaTime . ' ' . caseNumber($deltaTime, HOUR_CASES) . ' назад';
    }
    elseif (SECONDS_IN_DAY < $deltaTime && $deltaTime <= SECONDS_IN_MONTH)
    {
        $deltaTime = intdiv($deltaTime, SECONDS_IN_DAY);
        return $deltaTime . ' ' . caseNumber($deltaTime, DAY_CASES) . ' назад';
    }
    else
    {
        return date('d', $timestamp) . ' ' . MONTH_LIST[date('n', $timestamp)] . ' ' . date('Y', $timestamp);
    }
}

?>