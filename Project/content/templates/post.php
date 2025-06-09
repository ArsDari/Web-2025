<div class="post">
    <div class="header">
        <a class="profile" href="../profile/?id=<?= $post['user_id'] ?>">
            <img class="profile__picture" src="<?= $profilePicture ?>" alt="Профиль" />
            <span class="profile__name"><?= $profileName ?></span>
        </a>
        <?php if ($showIconEdit) { ?>
            <img class="icon-edit" src="<?= PATH_ICON . 'edit.svg' ?>" alt="Изменить" />
        <?php } ?>
    </div>
    <div class="post-images">
        <?php foreach ($postImages as $postImage) { ?>
            <img class="post-image" src="<?= PATH_IMAGE . $postImage['image_path'] ?>"
                alt="Фото поста" />
        <?php } ?>
        <?php if ($postImageCounter > 1) { ?>
            <img class="icon-slider-left-button" src="<?= PATH_ICON . 'slider-button.svg' ?>" alt="Влево">
            <img class="icon-slider-right-button" src="<?= PATH_ICON . 'slider-button.svg' ?>" alt="Вправо">
            <div class="counter">1/<?= $postImageCounter ?></div>
        <?php } ?>
    </div>
    <div class="reaction-field">
        <img class="reaction-field__heart" src="<?= PATH_ICON . 'heart.svg' ?>" alt="Сердечко">
        <span class="reaction-field__counter"><?= $postLikes ?></span>
    </div>
    <div class="post__text"><?= $postText ?></div>
    <button class="post__button-expand">ещё</button>
    <div class="post__timestamp"><?= caseTime($postTime) ?></div>
</div>