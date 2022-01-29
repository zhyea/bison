<?php
defined('_APP_PATH_') or exit('You shall not pass!');
?>

<?php if (!empty($works)) { ?>
	<div class="row work-show">
        <?php foreach ($works as $w) { ?>
			<div class="col-md-6 col-xs-12 work">
				<div class="cover">
					<a href="<?= $site_url ?>/work/<?= $w['id'] ?>.html">
						<img src="<?= ($uri_upload . '/' . $w['cover']) ?>" width="118px" height="172px"/>
					</a>
				</div>
				<div class="brief">
					<div>
						<span class="title"><a href="<?= $site_url ?>/work/<?= $w['id'] ?>.html"><?= $w['name'] ?></a></span>
						<span class="author">
                        <a href="<?= $site_url ?>/author/<?= $w['author_id'] ?>.html"><?= $w['author'] ?></a>
                    </span>
					</div>
					<div class="intro">
                        <?php
                        if (!empty($w['brief'])) {
                            $txt = $w['brief'];
                            if (strlen($txt) > 120) {
                                $txt = sub_string($txt,  120);
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