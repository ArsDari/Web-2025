<?php

if (!function_exists('number'))
{
    function number($n, $titles)
    {
        $cases = array(2, 0, 1, 1, 1, 2);
        return $titles[($n % 100 > 4 && $n % 100 < 20) ? 2 : $cases[min($n % 10, 5)]];
    }
}

$current_user_id = 1;

$user = $users[$post['user_id'] - 1]; // смещение из-за нулевого индекса
$profileName = $user['name'];
$profilePicture = PATH_IMAGE . $user['profile_picture'];

$postImagePointer = 0;
$postImage = PATH_IMAGE . $post['images'][$postImagePointer];
$postText = $post['text'];

// $deltaTime = time() - $post['timestamp'];
// $timeNow = time();

$deltaTime = 24;
$postTime = $post['timestamp'];
$postTimeString = '';

if (0 <= $deltaTime && $deltaTime <= 5)
{
    $postTimeString = 'Только что';
}
elseif (5 < $deltaTime && $deltaTime <= 1800)
{
    $deltaTime = intdiv($postTime, 60);
    $postTimeString = $deltaTime . number($deltaTime, ['минуту', 'минуты', 'минут']);
}
elseif (1800 < $deltaTime && $deltaTime <= 3600)
{
    $postTimeString = 'Полчаса назад';
}
elseif (3600 < $deltaTime && $deltaTime <= 86400)
{
    $deltaTime = intdiv($deltaTime, 3600);
    $postTimeString = $deltaTime . number($deltaTime, array('час', 'часа', 'часов'));
    // ''''два часа назад'
    // 'три часа назад'
    // '4 часа'
    // '5 часов'
    // '6 часов'
    // '7 часов'
    // '8 часов'
    // '9 часов'
    // '10 часов'
    // '11 часов'
    // '12 часов'
    // '13 часов'
    // '14 часов'
    // '15 часов'
    // '16 часов'
    // '17 часов'
    // '18 часов'
    // '19 часов'
    // '20 часов'
    // '21 часов'
    // '22 часов'
    // '23 часа''''
}
elseif (86400 < $deltaTime && $deltaTime <= 2419200)
{
    $deltaTime = intdiv($deltaTime, 86400);
    $postTimeString = $deltaTime . number($deltaTime, ['день', 'дня', 'дней']);
    // '1 день назад'
    // '2 дня назад'
    // ..
    // '27 дней назад'
}
else
{
    $postTimeString = date("j.n.Y", $post["timestamp"]);
}

?>

<div class="feed__post">
    <div class="feed__post__header">
        <img class="feed__post__header_picture" src="<?= $profilePicture ?>" alt="Профиль" />
        <span class="feed__post__header_name"><?= $profileName ?></span>
        <?php if ($current_user_id === $post['user_id']) { ?>
            <img class="feed__post__header_icon-edit" src="<?= PATH_ICON . 'edit.svg' ?>" alt="Изменить" />        
        <?php } ?>
    </div>
    <div class="feed__post__body">
        <img class="feed__post__body_image" src="<?= $postImage ?>" alt="Ошибка" />
        <div class="feed__post__body_text">
            <?= $postText ?>
        </div>
        <div class="feed__post__body_timestamp">
            <?= $postTimeString ?>
        </div>
    </div>
</div>