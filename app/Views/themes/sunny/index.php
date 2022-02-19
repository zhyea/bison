<div class="container notice">
	<i class="glyphicon glyphicon-volume-up" aria-hidden="true"></i> <?= $notice ?>
</div>

<div class="container main">

    <?php include_once 'recommend.php'; ?>

    <?php foreach ($all as $cat) { ?>
		<div class="page-header">
			<h3><a href="<?= $siteUrl ?>/c/<?= $cat['slug'] ?>.html">
					<i class="glyphicon glyphicon-book"></i> <?= $cat['name'] ?></a>
			</h3>
		</div>
		<div class="row popular">
            <?php foreach ($cat['works'] as $w) { ?>
				<div class="item col-md-4 col-xs-12">
					■ <a href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html"
					     title="<?= $w['name'] ?>"><?= $w['name'] ?></a>
					<span class="author">
                        <a href="<?= $siteUrl ?>/author/<?= $w['author_id'] ?>.html"
                           title="<?= $w['author'] ?>"><?= $w['author'] ?></a>
                    </span>
				</div>
            <?php } ?>
		</div>
    <?php } ?>
</div>
