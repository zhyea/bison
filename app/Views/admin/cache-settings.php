<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>
<div class="container main">

	<div class="page-header">
		<h3><i class="glyphicon glyphicon-cd"></i> 缓存管理 </h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<h3><a href="<?= $ctx ?>admin/cache/clean">一键清空</a></h3>
</div>

<?php include_once 'common/footer.php'; ?>

