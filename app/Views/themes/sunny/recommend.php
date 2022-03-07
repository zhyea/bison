
<?php if (!empty($recommend)) { ?>
	<div id="recommend">
		<div class="page-header">
			<h3><i class="glyphicon glyphicon-book"></i> 推荐内容</h3>
		</div>
		<div class="row recommend">
            <?php $len = min(7, count($recommend));
            for ($i = 0; $i < $len; $i++) {
                $r = $recommend[$i] ?>
				<div class="item ">
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