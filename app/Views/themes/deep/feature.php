<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="<?= $siteUrl ?>/"><?php iconTitle('folder', '#D1D1D1', '首页') ?></a></li>
		<li>专题</li>
		<li class="active"><?= $feature['name'] ?></li>
	</ol>
</div>

<div class="container main">
	<div class="work-block">
		<div class="work-header">
			<span class="title"><?= $feature['name'] ?></span>
		</div>
		<div class="row work-neck">
            <?= empty($feature['brief']) ? '无专题信息，待完善' : $feature['brief'] ?>
		</div>
	</div>

	<div class="page-header">
		<h3><?php iconTitle('book', '#D1D1D1', '作品列表') ?></h3>
	</div>

    <?php include_once 'work-show.php'; ?>

	<div class="pagination">
		<a>共 <?= $total ?> 页</a>
        <?php for ($i = 1; $i <= $total; $i++) { ?>
			<a href="<?= $siteUrl ?>/f/<?= $feature['alias'] ?>/<?= $i ?>.html"
			   class="<?= ($page == $i ? 'active' : '') ?>"><?= $i ?></a>
        <?php } ?>
	</div>
</div>