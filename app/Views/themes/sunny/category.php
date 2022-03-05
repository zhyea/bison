
	<div class="container notice">
		<ol class="breadcrumb">
			<li><a href="<?= $siteUrl ?>/"><i class="glyphicon glyphicon-folder-open">&nbsp;首页</i></a></li>
			<li><?= empty($cat) ? '不存在' : $cat['name'] ?></li>
		</ol>
	</div>
	
	<div class="container main">

        <?php include_once 'recommend.php'; ?>

        <?php if (!empty($cat)) { ?>
			<div class="page-header">
				<h3><a href="<?= $siteUrl ?>/c/<?= $cat['slug'] ?>.html">
						<i class="glyphicon glyphicon-book"></i> <?= $cat['name'] ?>
					</a>
				</h3>
			</div>

            <?php include_once 'work-show.php'; ?>

			<div class="pagination">
				<a>共 <?= $total ?> 部</a>
                <?php for ($i = 1; $i <= $total; $i++) { ?>
					<a href="<?= $siteUrl ?>/c/<?= $cat['slug'] ?>/<?= $i ?>.html"
					   class="<?= ($page == $i ? 'active' : '') ?>"><?= $i ?></a>
                <?php } ?>
			</div>
        <?php } ?>
	</div>
