

<div class="notice">
	<ol class="breadcrumb">
		<li><a href="<?=$siteUrl?>/"><i class="glyphicon glyphicon-folder-open">&nbsp;首页</i></a></li>
		<li class="active">全部作者</li>
	</ol>
</div>

<div class="main">
	<div class="work-body">
        <?php foreach ($all as $key => $value) { ?>
			<div class="row">
				<div class="col-md-12 col-xs-12 volume">
					<i class="glyphicon glyphicon-bookmark"></i> <?= $key ?>
				</div>
                <?php foreach ($value as $author) { ?>
					<div class="col-md-3 col-xs-12 chapter">
						<a href="<?=$siteUrl?>/author/<?= $author['id'] ?>.html"><?= $author['name'] ?></a>
					</div>
                <?php } ?>
			</div>
        <?php } ?>
	</div>
</div>
