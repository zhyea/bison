<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>
<div class="container main">

	<div class="page-header">
		<h3><i class="glyphicon glyphicon-paperclip"></i> 网站地图 </h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<h3><a href="<?= $ctx ?>admin/sitemap/gen">生成网站地图</a></h3>
</div>

<?php include_once 'common/footer.php'; ?>

