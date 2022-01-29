<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>


<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="<?=$site_url?>/"><i class="glyphicon glyphicon-folder-open">&nbsp;首页</i></a></li>
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
		<h3><i class="glyphicon glyphicon-book"></i>&nbsp;作品列表</h3>
	</div>

    <?php include_once 'common/work-show.php'; ?>

	<div class="pagination">
		<a>共 <?= $total ?> 部</a>
        <?php for ($i = 1; $i <= $total; $i++) { ?>
			<a href="<?=$site_url?>/f/<?= $feature['alias'] ?>/<?= $i ?>.html"
			   class="<?= ($page == $i ? 'active' : '') ?>"><?= $i ?></a>
        <?php } ?>
	</div>

</div>

<?php include_once 'common/footer.php'; ?>
