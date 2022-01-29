<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

<div class="container main">
	<div class="page-header">
		<h3><i class="glyphicon glyphicon-folder-open"></i> <?= (empty($id) ? '新增' : '编辑') ?> </h3>
	</div>

    <?php include_once 'common/alert.php'; ?>
	
	<form method="post" action="<?= $ctx ?>admin/feature/maintain" enctype="multipart/form-data">
		
		<div class="row">
			<div class="form-label col-md-2 col-xs-12">专题名称</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="hidden" name="id" value="<?= (empty($id) ? 0 : $id) ?>"/>
				<input type="text" class="form-control" name="name" value="<?= (empty($name) ? '' : $name) ?>" required
				       autofocus/>
			</div>
		</div>
		
		<div class="row">
			<div class="form-label col-md-2 col-xs-12">专题别名</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="text" class="form-control" name="alias" value="<?= (empty($alias) ? '' : $alias) ?>"
				       required autofocus/>
			</div>
		</div>
		
		<div class="row">
			<div class="form-label col-md-2 col-xs-12">关键字</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="text" class="form-control" name="keywords"
				       value="<?= (empty($keywords) ? '' : $keywords) ?>" required
				       autofocus/>
			</div>
		</div>
		
		<div class="row">
			<div class="form-label col-md-2 col-xs-12">概述</div>
			<div class="form-input col-md-10 col-xs-12">
				<textarea class="form-control" name="brief" rows="6"><?= (empty($brief) ? '' : $brief) ?></textarea>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">封面</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="hidden" name="former_cover" value="<?= (empty($cover) ? '' : $cover) ?>"/>
				<input type="file" class="form-control" accept="image/png, image/jpeg" name="cover"/>
                <?php if (!empty($cover)) { ?>
					<div class="form-input col-md-12 col-xs-12">
						<br/>
						<p class="lmt"><img src="<?= $uri_upload . '/' . $cover ?>" alt="专题封面"/></p>
						<a href="<?= $ctx ?>admin/feature/delete/cover/<?= $id ?>" target="_self">移除封面</a>
						<br/>
					</div>
                <?php } ?>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">背景图片</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="hidden" name="former_background" value="<?= (empty($background) ? '' : $background) ?>"/>
				<input type="file" class="form-control" accept="image/png, image/jpeg" name="background"/>
                <?php if (!empty($background)) { ?>
					<div class="form-input col-md-12 col-xs-12">
						<br/>
						<p class="lmt"><img src="<?= $uri_upload . '/' . $background ?>" alt="专题背景"/></p>
						<a href="<?= $ctx ?>admin/feature/delete/bg/<?= $id ?>" target="_self">移除背景图</a>
						<br/>
					</div>
                <?php } ?>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">背景重复</div>
			<div class="form-input col-md-10 col-xs-12" style="padding-top:6px;">
				<label class="radio-inline">
					<input type="radio" name="bg_repeat"
					       value="1" <?= (!empty($bg_repeat) && $bg_repeat == "1" ? 'checked' : '') ?> > 重复
				</label>
				<label class="radio-inline">
					<input type="radio" name="bg_repeat"
					       value="2" <?= (!empty($bg_repeat) && $bg_repeat == "2" ? 'checked' : '') ?>> 不重复
				</label>
			</div>
		</div>
		
		<div class="row">
			<div class="btn-left col-md-6 col-xs-12">
				<a href="<?= $ctx ?>admin/feature/list" class="btn btn-info">返回专题列表</a>
			</div>
			<div class="btn-right col-md-6 col-xs-12">
				<button type="submit" class="btn btn-success">保存专题信息</button>
			</div>
		</div>
	</form>

</div>

<?php include_once 'common/footer.php'; ?>

