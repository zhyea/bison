<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>


<div class="container notice">
	<ol class="breadcrumb">
		<li><a href="<?=$site_url?>/"><i class="glyphicon glyphicon-folder-open">&nbsp;首页</i></a></li>
		<li class="active">全部作者</li>
	</ol>
</div>

<div class="main">
	<div class="work-body">
        <?php foreach ($all as $key => $value) { ?>
			<div class="row">
				<div class="col-md-12 col-xs-12 volume">
					<i class="glyphicon glyphicon-bookmark"></i> <?= $key ?>
				</div>
                <?php foreach ($value as $author) { ?>
					<div class="col-md-3 col-xs-12 chapter">
						<a href="<?=$site_url?>/author/<?= $author['id'] ?>.html"><?= $author['name'] ?></a>
					</div>
                <?php } ?>
			</div>
        <?php } ?>
	</div>
</div>


<?php include_once 'common/footer.php'; ?>

<script type="text/javascript">
    backToTop();
</script>