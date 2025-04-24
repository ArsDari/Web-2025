<?php

$user_id = $_GET['id']; // сделать валидацию юзер айди, или выкидывать на home
$user = $users[$user_id];

$name = $user['name'];
$description = $user['description'];
$image = $user['image'];
$post_counter = $user['post_counter'];

?>

<div class="profile">
    <img class="profile__image" src=<?= PATH_IMAGE . $image ?>" alt="Ошибка" />
    <div class="profile__about-me">
        <p class="profile__about-me_name"><?= $name ?></p>
        <p class="profile__about-me_text"><?= $description ?></p>
    </div>
    <div class="profile__post_counter">
        <img class="profile__post_counter_image" src="../media/icons/image.svg" alt="Всего " />
        <span class="profile__post_counter_text"><?= $post_counter ?></span>
    </div>
    <table class="profile__posts">
        <tbody>
            <tr class="profile__posts__row">
                <td class="profile__posts__row_element"><img class="profile__posts__post_image"
                        src="../media/images/post_image_1.jpg" width="322" height="322" alt="Пост 1" /></td>
                <td class="profile__posts__row_element"><img class="profile__posts__post_image"
                        src="../media/images/post_image_2.jpg" width="322" height="322" alt="Пост 2" /></td>
                <td class="profile__posts__row_element"><img class="profile__posts__post_image"
                        src="../media/images/post_image_3.jpg" width="322" height="322" alt="Пост 3" /></td>
            </tr>
            <tr class="profile__posts__row">
                <td class="profile__posts__row_element"><img class="profile__posts__post_image"
                        src="../media/images/post_image_4.jpg" width="322" height="322" alt="Пост 4" /></td>
                <td class="profile__posts__row_element"><img class="profile__posts__post_image"
                        src="../media/images/post_image_5.jpg" width="322" height="322" alt="Пост 5" /></td>
                <td class="profile__posts__row_element"><img class="profile__posts__post_image"
                        src="../media/images/post_image_6.jpg" width="322" height="322" alt="Пост 6" /></td>
            </tr>
            <tr class="profile__posts__row">
                <td class="profile__posts__row_element"><img class="profile__posts__post_image"
                        src="../media/images/post_image_7.jpg" width="322" height="322" alt="Пост 7" /></td>
                <td class="profile__posts__row_element"><img class="profile__posts__post_image"
                        src="../media/images/post_image_8.jpg" width="322" height="322" alt="Пост 8" /></td>
                <td class="profile__posts__row_element"><img class="profile__posts__post_image"
                           src="../media/images/post_image_9.jpg" width="322" height="322" alt="Пост 9" /></td>
            </tr>
        </tbody>
    </table>
</div>