<?php if (!empty($works)) { ?>
	<div class="row work-show">
        <?php foreach ($works as $w) { ?>
			<div class="col-md-6 col-xs-12 work">
				<div class="cover">
					<a href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html">
						<img src="<?= ($uriUpload . '/' . $w['cover']) ?>" width="118px" height="172px"/>
					</a>
				</div>
				<div class="brief">
					<div>
						<span class="title"><a
									href="<?= $siteUrl ?>/work/<?= $w['id'] ?>.html"><?= $w['name'] ?></a></span>
						<span class="author">
                        <a href="<?= $siteUrl ?>/author/<?= $w['author_id'] ?>.html"><?= $w['author'] ?></a>
                    </span>
					</div>
					<div class="intro">
                        <?php
                        if (!empty($w['brief'])) {
                            $txt = $w['brief'];
                            if (strlen($txt) > 120) {
                                $txt = mb_substr($txt, 0, 240);
                            }
                            echo $txt;
                        }
                        ?>
					</div>
				</div>
			</div>
        <?php } ?>
	</div>
<?php } ?>