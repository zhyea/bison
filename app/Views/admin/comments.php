<?php
?>


<div class="container main">

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-list-alt"></i> 评论管理</h3>
    </div>

    <?php if (!empty($comments)) { ?>
		<div class="comment-list">
            <?php foreach ($comments as $c) { ?>
				<div class="comment">
					<div class="comment-work">
						<a href="/work/<?= $c['work_id'] ?>.html" target="_blank"><?= $c['work_name'] ?></a>
                        <?php if (!empty($c['chapter_id']) && 0 != $c['chapter_id']) { ?>
							/ <a href="/chapter/<?= $c['chapter_id'] ?>.html" target="_blank"><?= $c['chapter_name'] ?></a>
                        <?php } ?>
					</div>
					<div class="comment-user">
						<div class="comment-icon"><img src="<?= $uriAdmin ?>/img/avatar.jpg"></div>
					</div>
					<div class="comment-name"><?= $c['name'] ?></div>
					<div class="comment-content">
                        <?= $c['content'] ?>
						<div class="comment-operate">
							<a href="/admin/comment/delete/<?= $c['id'] ?>"><i class="glyphicon glyphicon-ban-circle"></i></a>
						</div>
					</div>
				</div>
            <?php } ?>
		</div>
    <?php } ?>

</div>

