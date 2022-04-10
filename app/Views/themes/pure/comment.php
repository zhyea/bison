
<div class="row comment-form">
	<form method="post" action="" enctype="multipart/form-data">
		<div class="col-md-12 col-xs-12 comment-content">
			<textarea name="content" rows="6"></textarea>
		</div>
		<div class="col-md-10 col-xs-12 comment-user">
			<input type="text" name="name" id="nickname" required autofocus/>
			<label for="nickname">昵称</label>
		</div>
		<div class="col-md-2 col-xs-12 comment-sub">
			<button type="submit" class="btn">发布</button>
		</div>
	</form>
</div>

<?php if (!empty($comments)) { ?>
    <?php foreach ($comments as $c) { ?>
		<div class="row comments">
			<div class="comment-user"></div>
			<div class="comment-content"><?= $content ?></div>
		</div>
    <?php } ?>
<?php } ?>