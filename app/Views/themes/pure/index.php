<div class="notice">
    <i class="glyphicon glyphicon-volume-up" aria-hidden="true"></i> <?= $notice ?>
</div>

<div class="gallery">
    <?php include_once 'recommend.php'; ?>
</div>

<div class="main">
    <?php foreach ($all as $cat) { ?>
        <div class="page-header">
            <h3>
                <a href="<?= $siteUrl ?>/c/<?= $cat['slug'] ?>.html"><?php iconTitle('book', '#255625', $cat['name']); ?></a>
            </h3>
        </div>
        <div class="row popular">
            <?php foreach ($cat['works'] as $w) { ?>
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 item">
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
