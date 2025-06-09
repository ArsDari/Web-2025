<div class="profile">
    <img class="profile__picture" src="<?= $profilePicture ?>" width="123" height="123" alt="Ошибка" />
    <p class="profile__name"><?= $name ?></p>
    <p class="profile__description"><?= $aboutMe ?></p>
    <div class="post-counter">
        <img class="post-counter__image" src="<?= PATH_ICON . 'image.svg' ?>" alt="Всего " />
        <span class="post-counter__text"><?= count($userPosts) . ' ' . caseNumber(count($userPosts), POST_STRING_CASES) ?></span>
    </div>
    <div class="posts">
        <?php printGridOfPosts($userPosts, $connection); ?>
    </div>
</div>