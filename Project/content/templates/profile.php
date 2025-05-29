<div class="profile">
    <img class="profile__picture" src="<?= $profilePicture ?>" width="123" height="123" alt="Ошибка" />
    <div class="about-me">
        <p class="about-me__name"><?= $name ?></p>
        <p class="about-me__text"><?= $aboutMe ?></p>
    </div>
    <div class="post_counter">
        <img class="post_counter__image" src="<?= PATH_ICON . 'image.svg' ?>" alt="Всего " />
        <span class="post_counter__text"><?= count($userPosts) ?></span>
    </div>
    <table class="posts">
        <tbody>
            <?php printGridOfPosts($userPosts, ROW); ?>
        </tbody>
    </table>
</div>