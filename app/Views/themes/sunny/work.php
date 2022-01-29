<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="<?= $site_url ?>/"><i class="glyphicon glyphicon-folder-open">&nbsp;首页</i></a></li>
		<li><a href="<?= $site_url ?>/c/<?= $w['cat_slug'] ?>.html"><?= $w['cat'] ?></a></li>
		<li class="active"><?= $w['name'] ?></li>
	</ol>
</div>

<div class="main">
	<div class="work-header">
		<span class="title"><?= $w['name'] ?></span>
		<span class="author">作者：<a href="<?= $site_url ?>/author/<?= $w['author_id'] ?>.html"><?= $w['author'] ?></a></span>
	</div>

	<div class="work-neck row">
		<div class="cover">
			<img src="<?= $uri_upload . '/' . $w['cover'] ?>" width="116px" height="150px"/>
		</div>

		<div class="brief">
			<div class="intro"><?= str_replace("/n", '<br>', $w['brief']) ?></div>
			<div class="relate">
				<i class="glyphicon glyphicon-tags"></i> <?= $w['author'] ?>作品：
                <?php foreach ($relates as $r) { ?>
					<a href="<?= $site_url ?>/work/<?= $r['id'] ?>.html"><?= $r['name'] ?></a>
                <?php } ?>
			</div>
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
						<a href="<?= $site_url ?>/chapter/<?= $chp['id'] ?>.html"><?= $chp['name'] ?></a>
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


<?php include_once 'common/footer.php'; ?>

<script type="text/javascript">
    backToTop();
</script>