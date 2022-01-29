<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>
<div class="container main">

	<div class="page-header">
		<h3><i class="glyphicon glyphicon-list-alt"></i> <?= (!empty($id) && $id > 0 ? '编辑分类' : '新增分类') ?> </h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<form method="post" action="<?= $ctx ?>admin/category/maintain">
		<div class="row">
			<div class="form-label col-md-2 col-xs-12">名称</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="hidden" name="id" value="<?= $id ?>"/>
				<input type="text" class="form-control" name="name" value="<?= (empty($name) ? '' : $name) ?>"
				       required autofocus/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">缩略名</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="text" class="form-control" name="slug" value="<?= (empty($slug) ? '' : $slug) ?>"
				       required/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">父级分类</div>
			<div class="form-input col-md-10 col-xs-12">
				<select class="form-control" name="parent">
					<option value="0" selected="<?= (0 == $parent) ?>">无</option>
                    <?php if (!empty($candidates)) {
                        foreach ($candidates as $c) { ?>
							<option value="<?= $c['id'] ?>" <?= ($parent == $c['id'] ? 'selected' : '') ?>><?= $c['name'] ?></option>
                        <?php }
                    } ?>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">备注</div>
			<div class="form-input col-md-10 col-xs-12">
				<textarea class="form-control" name="remark"> <?= (empty($remark) ? '' : $remark) ?></textarea>
			</div>
		</div>

		<div class="row">
			<div class="btn-left col-md-6 col-xs-12">
				<a class="btn btn-info" href="<?= $ctx ?>admin/category/list/<?= $parent ?>">返回列表</a>
			</div>
			<div class="btn-right col-md-6 col-xs-12">
				<button type="submit" class="btn btn-success">保存分类</button>
			</div>
		</div>
	</form>
</div>

<?php include_once 'common/footer.php'; ?>

