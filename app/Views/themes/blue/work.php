<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="<?= $siteUrl ?>/"><i class="glyphicon glyphicon-folder-open">&nbsp;首页</i></a></li>
		<li><a href="<?= $siteUrl ?>/c/<?= $w['cat_slug'] ?>.html"><?= $w['cat'] ?></a></li>
		<li class="active"><?= $w['name'] ?></li>
	</ol>
</div>

<div class="main">
	<div class="work-header">
		<span class="title"><?= $w['name'] ?></span>
		<span class="author">作者：<a
					href="<?= $siteUrl ?>/author/<?= $w['author_id'] ?>.html"><?= $w['author'] ?></a></span>
	</div>
	
	<div class="work-neck row">
		<div class="cover">
			<img src="<?= $uriUpload . '/' . $w['cover'] ?>" width="116px" height="150px"
			     alt="<?= $w['name'] ?>" title="<?= $w['name'] ?>"/>
		</div>
		
		<div class="brief">
			<div class="intro"><?= str_replace("/n", '<br>', $w['brief']) ?></div>
            <?php if (!empty($relates)) { ?>
				<div class="relate">
					<i class="glyphicon glyphicon-tags"></i> <?= $w['author'] ?>作品：
                    <?php foreach ($relates as $r) { ?>
						<a href="<?= $siteUrl ?>/work/<?= $r['id'] ?>.html"><?= $r['name'] ?></a>
                    <?php } ?>
				</div>
            <?php } ?>
		</div>
	</div>
	
	<div class="work-body">
        <?php foreach ($vols as $vol) { ?>
			<div class="row">
				<div class="col-md-12 col-xs-12 volume" id="vol_<?= $vol['id'] ?>">
					<i class="glyphicon glyphicon-bookmark"></i> <?= $vol['name'] ?>
				</div>
                <?php foreach ($vol['chapters'] as $chp) { ?>
					<div class="col-md-4 col-xs-12 chapter">
						<a href="<?= $siteUrl ?>/chapter/<?= $chp['id'] ?>.html"><?= $chp['name'] ?></a>
					</div>
                <?php } ?>
			</div>
        <?php } ?>
	</div>

    <?php if (!empty($volume_bottom_ad)) { ?>
		<div><?= $volume_bottom_ad ?></div>
    <?php } ?>
    <?php if (!empty($third_party_comments)) { ?>
		<div><?= $third_party_comments ?></div>
    <?php } ?>
</div>

<script type="text/javascript">
    backToTop();
</script>