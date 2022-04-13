<div class="row comment-form">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="col-md-12 col-xs-12 comment-content">
            <textarea name="content" rows="6"></textarea>
        </div>
        <div class="col-md-10 col-xs-12 comment-user">
            <input type="text" name="name" id="nickname" required autofocus/>
            <label for="nickname">昵称</label>
            <input type="hidden" name="work_id" value="0">
            <input type="hidden" name="chapter_id" value="0">
            <input type="hidden" name="sign" value="0">
        </div>
        <div class="col-md-2 col-xs-12 comment-sub">
            <button type="submit" class="btn">发布</button>
        </div>
    </form>
</div>

<?php if (!empty($comments)) { ?>
    <?php foreach ($comments as $c) { ?>
        <div class="row comments">
            <div class="comment-user">
                <div class="comment-icon"><img src="<?= $uriTheme ?>/imgs/avatar.jpg"></div>
                <div class="comment-name"><?= $c['content'] ?></div>
            </div>
            <div class="comment-content"><?= $c['content'] ?></div>
        </div>
    <?php } ?>
<?php } ?>