<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>
	<div class="container main">

		<div class="page-header">
			<h3><i class="glyphicon glyphicon-cloud"></i> 远程写</h3>
		</div>

		<p>交互码为：<strong><?= $code ?></strong></p>
		<p>交互码过期时间为：<strong><?= $expire_time ?></strong></p>
	</div>

<?php include_once 'common/footer.php'; ?>