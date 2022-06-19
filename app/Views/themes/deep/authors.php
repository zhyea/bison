

<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="<?=$siteUrl?>/"><?php iconTitle('folder', '#D1D1D1', '首页') ?></a></li>
		<li class="active">全部作者</li>
	</ol>
</div>

<div class="main">
	<div class="work-body">
        <?php foreach ($all as $key => $value) { ?>
			<div class="row">
				<div class="col-md-12 col-xs-12 volume">
                    <?php iconTitle('bookmark', '#D1D1D1', $key) ?>
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


<script type="text/javascript">
    backToTop();
</script>