<?php
defined('_APP_PATH_') OR exit('You shall not pass!');
?>

<?php if (!empty($alert)) { ?>
	<div role="alert" class="alert alert-<?= $alert['type'] ?> alert-dismissible fade in">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>提示!</strong>
        <?= $alert['msg'] ?>
	</div>
<?php } ?>