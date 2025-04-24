<div class="feed__post">
    <div class="feed__post__header">
        <img class="feed__post__header_picture" src="<?= $profilePicture ?>" width="32" height="32" alt="Профиль" />
        <span class="feed__post__header_name"><?= $profileName ?></span>
        <?php if ($drawIconEdit) { ?>
            <img class="feed__post__header_icon-edit" src="<?= PATH_ICON . 'edit.svg' ?>" alt="Изменить" />        
        <?php } ?>
    </div>
    <div class="feed__post__body">
        <img class="feed__post__body_image" src="<?= $postImage ?>" width="474" height="474" alt="Ошибка" />
        <div class="feed__post__body_text">
            <?= $postText ?>
        </div>
        <div class="feed__post__body_timestamp">
            <?= echoTime($deltaTime, $postTime) ?>
        </div>
    </div>
</div>