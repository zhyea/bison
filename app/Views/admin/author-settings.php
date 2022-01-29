<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

<div class="container main">

	<div class="page-header">
		<h3><i class="glyphicon glyphicon-pencil"></i> <?= (empty($id) ? '编辑作者信息' : '新增作者信息') ?> </h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<form method="post" action="<?= $ctx ?>admin/author/maintain">
		<div class="row">
			<div class="form-label col-md-2 col-xs-12">姓名</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="hidden" name="id" value="<?= (empty($id) ? 0 : $id) ?>"/>
				<input type="text" class="form-control" name="name" value="<?= (empty($name) ? '' : $name) ?>"
				       required autofocus/>
			</div>
		</div>
		<div class="row">
			<div class="form-label col-md-2 col-xs-12">国家</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="text" class="form-control" name="country"
				       value="<?= (empty($country) ? '' : $country) ?>" required/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">简介</div>
			<div class="form-input col-md-10 col-xs-12">
				<textarea class="form-control" name="bio" rows="6"><?= (empty($bio) ? '' : $bio) ?></textarea>
			</div>
		</div>

		<div class="row">
			<div class="btn-left col-md-6 col-xs-12">&nbsp;
				<a class="btn btn-info" href="<?= $ctx ?>admin/author/list">返回列表</a>
			</div>
			<div class="btn-right col-md-6 col-xs-12">
				<button type="submit" class="btn btn-success">保存作者信息</button>
			</div>
		</div>
	</form>
</div>

<?php include_once 'common/footer.php'; ?>

