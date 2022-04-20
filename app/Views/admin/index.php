<?php
?>


<div class="container main">

    <?php if (!empty($comments)) { ?>
        <?php foreach ($comments as $c) { ?>
            <div class="row comments">
                <div class="comment-user">
                    <div class="comment-icon"><img src="<?= $uriTheme ?>/imgs/avatar.jpg"></div>
                </div>
                <div class="comment-name"><?= $c['name'] ?></div>
                <div class="comment-content"><?= $c['content'] ?></div>
            </div>
        <?php } ?>
    <?php } ?>

</div>

