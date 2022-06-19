<div class="container notice">
    <?php iconSvg('horn', '#D1D1D1') ?> <?= $notice ?>
</div>

<div class="container main">

    <?php include_once 'recommend.php'; ?>

    <?php foreach ($all as $cat) { ?>
        <div class="page-header">
            <h3><a href="<?= $siteUrl ?>/c/<?= $cat['slug'] ?>.html">
		            <?php iconTitle('book', '#D1D1D1', $cat['name']) ?></a>
            </h3>
        </div>
        <div class="row popular">
            <?php foreach ($cat['works'] as $w) { ?>
                <div class="col-md-4 col-xs-12 item">
                    <span class="book">
                        <a href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html" title="<?= $w['name'] ?>"><div class="tag">■</div> <?= $w['name'] ?></a>
                    </span>
                    <span class="author">
                        <a href="<?= $siteUrl ?>/author/<?= $w['author_id'] ?>.html" title="<?= $w['author'] ?>"><?= $w['author'] ?></a>
                    </span>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
