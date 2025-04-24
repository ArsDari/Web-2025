<div class="profile">
    <img class="profile__picture" src="<?= $profilePicture ?>" width="123" height="123" alt="Ошибка" />
    <div class="profile__about-me">
        <p class="profile__about-me_name"><?= $name ?></p>
        <p class="profile__about-me_text"><?= $aboutMe ?></p>
    </div>
    <div class="profile__post_counter">
        <img class="profile__post_counter_image" src="<?= PATH_ICON . 'image.svg' ?>" alt="Всего " />
        <span class="profile__post_counter_text"><?= count($userPosts) ?></span>
    </div>
    <table class="profile__posts">
        <tbody>
            <?php printPost($posts, $userPosts); ?>
        </tbody>
    </table>
</div>