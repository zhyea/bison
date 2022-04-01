<?php if (!empty($works)) { ?>
    <div class="row work-list">
        <?php foreach ($works as $w) { ?>
            <div class="col-md-6 col-xs-12 work">
                <div class="brief">
                    <div>
						<span class="title">
                            <a href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html"><?= $w['name'] ?></a>
                        </span>
                        <span class="author">
                            <a href="<?= $siteUrl ?>/author/<?= $w['author_id'] ?>.html"><?= $w['author'] ?></a>
                        </span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>