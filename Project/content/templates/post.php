<div class="post">
    <div class="header">
        <img class="header__picture" src="<?= $profilePicture ?>" width="32" height="32" alt="Профиль" />
        <span class="header__name"><?= $profileName ?></span>
        <?php if ($drawIconEdit) { ?>
            <img class="header__icon-edit" src="<?= PATH_ICON . 'edit.svg' ?>" alt="Изменить" />        
        <?php } ?>
    </div>
    <div class="body">
        <img class="body__image" src="<?= $postImage ?>" width="474" height="474" alt="Ошибка" />
        <div class="body__text"><?= $postText ?></div>
        <div class="body__timestamp"><?= echoTime($postTime) ?></div>
    </div>
</div>