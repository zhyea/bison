<?php
defined('_APP_PATH_') or exit('You shall not pass!');
?>

<?php if (!empty($recommend)) { ?>
	<div id="recommend">
		<div class="page-header">
			<h3><i class="glyphicon glyphicon-book"></i> 推荐内容</h3>
		</div>
		<div class="row recommend">
            <?php foreach ($recommend as $r) { ?>
				<div class="item col-md-2 col-xs-2">
					<div class="cover">
						<a href="<?= $site_url ?>/work/<?= $r['id'] ?>.html">
							<img src="<?= $uri_upload . '/' . $r['cover'] ?>" width="120px" height="172px"/>
						</a>
						<div class="remark"><a href="<?= $site_url ?>/work/<?= $r['id'] ?>.html"><?= $r['name'] ?></a></div>
						<div class="shade"><a href="<?= $site_url ?>/work/<?= $r['id'] ?>.html"><?= $r['name'] ?></a></div>
					</div>
				</div>
            <?php } ?>
		</div>
	</div>
<?php } ?>