<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

<div class="container notice">
	<i class="glyphicon glyphicon-volume-up" aria-hidden="true"></i> <?= $notice ?>
</div>

<div class="container main">

    <?php include_once 'common/recommend.php'; ?>

    <?php foreach ($all as $cat) { ?>
		<div class="page-header">
			<h3><a href="<?= $site_url ?>/c/<?= $cat['slug'] ?>.html">
					<i class="glyphicon glyphicon-book"></i> <?= $cat['name'] ?></a>
			</h3>
		</div>
		<div class="row popular">
            <?php foreach ($cat['works'] as $w) { ?>
				<div class="item col-md-4 col-xs-12">
					■ <a href="<?= $site_url ?>/work/<?= $w['id'] ?>.html" title="<?= $w['name'] ?>"><?= $w['name'] ?></a>
					<span class="author">
                        <a href="<?= $site_url ?>/author/<?= $w['author_id'] ?>.html"
                           title="<?= $w['author'] ?>"><?= $w['author'] ?></a>
                    </span>
				</div>
            <?php } ?>
		</div>
    <?php } ?>
</div>

<?php include_once 'common/footer.php'; ?>
