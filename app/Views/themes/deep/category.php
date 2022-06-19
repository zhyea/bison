
	<div class="container notice">
		<ol class="breadcrumb">
			<li><a href="<?= $siteUrl ?>/"><?php iconTitle('folder', '#D1D1D1', '首页') ?></a></li>
			<li><?= empty($cat) ? '不存在' : $cat['name'] ?></li>
		</ol>
	</div>
	
	<div class="container main">

        <?php include_once 'recommend.php'; ?>

        <?php if (!empty($cat)) { ?>
			<div class="page-header">
				<h3><a href="<?= $siteUrl ?>/c/<?= $cat['slug'] ?>.html">
                        <?php iconTitle('book', '#D1D1D1', $cat['name']) ?>
					</a>
				</h3>
			</div>

            <?php include_once 'work-show.php'; ?>

			<div class="pagination">
				<a>共 <?= $total ?> 页</a>
                <?php for ($i = 1; $i <= $total; $i++) { ?>
					<a href="<?= $siteUrl ?>/c/<?= $cat['slug'] ?>/<?= $i ?>.html"
					   class="<?= ($page == $i ? 'active' : '') ?>"><?= $i ?></a>
                <?php } ?>
			</div>
        <?php } ?>
	</div>
