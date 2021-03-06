<div class="notice">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><?php iconSvg('folder', '#337ab7'); ?><a href="<?= $siteUrl ?>/">首页</a></li>
            <li class="breadcrumb-item"><a href="<?= $siteUrl ?>/c/<?= $w['cat_slug'] ?>.html"><?= $w['cat'] ?></a></li>
            <li class="breadcrumb-item active"><?= $w['name'] ?></li>
        </ol>
    </nav>
</div>

<div class="main">
    <div class="work-header">
        <span class="title"><?= $w['name'] ?></span>
        <span class="author">
			作者：<a href="<?= $siteUrl ?>/author/<?= $w['author_id'] ?>.html"><?= $w['author'] ?></a>
		</span>
    </div>

    <div class="work-neck row">
        <div class="cover">
            <img src="<?= $uriUpload . '/' . $w['cover'] ?>" width="116px" height="150px"
                 alt="<?= $w['name'] ?>" title="<?= $w['name'] ?>"/>
        </div>

        <div class="brief">
            <div class="intro"><?= str_replace("/n", '<br>', $w['brief']) ?></div>
            <div class="relate">
                <?php if (!empty($relates)) { ?>
                    <?php iconSvg('tags', '#000000'); ?> <?= $w['author'] ?>作品：
                    <?php foreach ($relates as $r) { ?>
                        <a href="<?= $siteUrl ?>/work/<?= $r['id'] ?>.html"><?= $r['name'] ?></a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="work-body">
        <?php foreach ($vols as $vol) { ?>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 volume" id="vol_<?= $vol['id'] ?>">
                    <?php iconSvg('bookmark', '#255625'); ?> <?= $vol['name'] ?>
                </div>
                <?php foreach ($vol['chapters'] as $chp) { ?>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 chapter">
                        <a href="<?= $siteUrl ?>/chapter/<?= $chp['id'] ?>.html"><?= $chp['name'] ?></a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <?php if (!empty($volume_bottom_ad)) { ?>
        <div><?= $volume_bottom_ad ?></div>
    <?php } ?>

    <?php include_once 'comment.php'; ?>
</div>

<?php include_once 'scroll-button.php'; ?>