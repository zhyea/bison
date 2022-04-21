<?php
?>


<div class="container main">

    <?php if (!empty($comments)) { ?>
        <?php foreach ($comments as $c) { ?>
            <div class="row comments">
                <div class="comment-work">
                    <a><?= $c['work_name'] ?></a>
                    <?php if (!empty($c['chapter_id']) && 0 != $c['chapter_id']) { ?>
                        / <a><?= $c['chapter_name'] ?></a>
                    <?php } ?>
                </div>
                <div class="comment-name"><?= $c['name'] ?></div>
                <div class="comment-content">
                    <?= $c['content'] ?>
                    <div class="comment-operate">
                        <div class="comment-delete">
                            <a>删除</a>
                        </div>
                        <div class="comment-approve">
                            <a>批准</a>
                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>
    <?php } ?>

</div>

