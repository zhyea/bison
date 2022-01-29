<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

<div class="container main">
	<div class="page-header">
		<h3><i class="glyphicon glyphicon-console"></i> <?= (!empty($id) ? '编辑脚本' : '新增脚本') ?></h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<form method="post" action="<?= $ctx ?>admin/spt/maintain">

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">脚本名称</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="hidden" name="id" value="<?= (empty($id) ? 0 : $id) ?>"/>
				<input type="text" class="form-control" name="name" value="<?= (empty($name) ? '' : $name) ?>"
				       required autofocus/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">脚本代号</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="text" class="form-control" name="code" value="<?= (empty($code) ? '' : $code) ?>"
				       required autofocus/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">脚本</div>
			<div class="form-input col-md-10 col-xs-12">
					<textarea class="form-control" name="script"
					          rows="6"><?= (empty($script) ? '' : $script) ?></textarea>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">备注</div>
			<div class="form-input col-md-10 col-xs-12">
					<textarea class="form-control" name="remark"
					          rows="6"><?= (empty($remark) ? '' : $remark) ?></textarea>
			</div>
		</div>

		<div class="row">
			<div class="btn-left col-md-6 col-xs-12">
				<a href="<?= $ctx ?>admin/spt/list" class="btn btn-info">返回脚本列表</a>
			</div>
			<div class="btn-right col-md-6 col-xs-12">
				<button type="submit" class="btn btn-success">保存脚本信息</button>
			</div>
		</div>
	</form>
</div>

<?php include_once 'common/footer.php'; ?>

