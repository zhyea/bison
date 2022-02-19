<?php
?>

<?php if (!empty($recommend)) { ?>
	<div id="recommend">
		<div class="page-header">
			<h3><i class="glyphicon glyphicon-book"></i> 推荐内容</h3>
		</div>
		<div class="row recommend">
            <?php for ($i = 0; $i < 6; $i++) {
                $r = $recommend[$i] ?>
				<div class="item col-md-2 col-xs-2">
					<div class="cover">
						<a href="<?= $siteUrl ?>/work/<?= $r['id'] ?>.html">
							<img src="<?= $uriUpload . '/' . $r['cover'] ?>" width="120px" height="172px"/>
						</a>
						<div class="remark"><a href="<?= $siteUrl ?>/work/<?= $r['id'] ?>.html"><?= $r['name'] ?></a>
						</div>
						<div class="shade"><a href="<?= $siteUrl ?>/work/<?= $r['id'] ?>.html"><?= $r['name'] ?></a>
						</div>
					</div>
				</div>
            <?php } ?>
		</div>
	</div>
<?php } ?>