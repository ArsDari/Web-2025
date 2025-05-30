<div class="post">
    <div class="header">
        <img class="header__picture" src="<?= $profilePicture ?>" width="32" height="32" alt="Профиль" />
        <span class="header__name"><?= $profileName ?></span>
        <?php if ($showIconEdit) { ?>
            <img class="header__icon-edit" src="<?= PATH_ICON . 'edit.svg' ?>" alt="Изменить" />        
        <?php } ?>
    </div>
    <div class="body">
        <div class="image">
            <?php if ($showSlider) { ?>
            <div class="indicator"></div>
            <div class="slider"></div>
            <?php } ?>
            <img class="image__current-image" src="<?= $postImage ?>" width="474" height="474" alt="Ошибка" />
        </div>
        <div class="body__text"><?= $postText ?></div>
        <div class="body__timestamp"><?= caseTime($postTime) ?></div>
    </div>
</div>