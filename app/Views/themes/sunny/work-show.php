<?php if (!empty($works)) { ?>
    <div class="row work-show">
        <?php foreach ($works as $w) { ?>
            <div class="col-md-8 col-xs-12 work">
                <div>
						<span class="title">
                            <a href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html"><?= $w['name'] ?></a>
                        </span>
                    <span class="author">
                            <a href="<?= $siteUrl ?>/author/<?= $w['author_id'] ?>.html"><?= $w['author'] ?></a>
                        </span>
                </div>
            </div>
            <div class="col-md-4 work">
                <div class="cover">
                    <a href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html">
                        <img src="<?= ($uriUpload . '/' . $w['cover']) ?>" width="118px" height="172px"/>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>