<div class="post">
    <div class="header">
        <a class="header__profile" href="../profile/?id=<?= $post['user_id'] ?>">
            <img class="header__profile__picture" src="<?= $profilePicture ?>" alt="Профиль" />
            <span class="header__profile__name"><?= $profileName ?></span>
        </a>
        <?php if ($showIconEdit) { ?>
            <img class="header__icon-edit" src="<?= PATH_ICON . 'edit.svg' ?>" alt="Изменить" />
        <?php } ?>
    </div>
    <div class="post-images">
        <?php foreach ($postImages as $postImage) { ?>
            <img class="post-image" src="<?= PATH_IMAGE . $postImage['image_path'] ?>"
                alt="Фото поста" />
        <?php } ?>
        <?php if (count($postImages) > 1) { ?>
            <img class="icon-slider left-button" src="<?= PATH_ICON . 'slider-button.svg' ?>" alt="Влево">
            <img class="icon-slider right-button" src="<?= PATH_ICON . 'slider-button.svg' ?>" alt="Вправо">
            <div class="counter-field counter-text">1/<?= count($postImages) ?></div>
        <?php } ?>
    </div>
    <div class="reaction-field">
        <img src="<?= PATH_ICON . 'heart.svg' ?>" alt="Сердечко">
        <span class="reaction-field__counter"><?= $postLikes ?></span>
    </div>
    <div class="post__text"><?= $postText ?></div>
    <div class="post__timestamp"><?= caseTime($postTime) ?></div>
</div>