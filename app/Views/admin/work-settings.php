<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

<div class="container main">
	<div class="page-header">
		<h3><i class="glyphicon glyphicon-hdd"></i> <?= (!empty($id) ? '编辑作品' : '新增作品') ?></h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<form method="post" action="<?= $ctx ?>admin/work/maintain" enctype="multipart/form-data">
		<div class="row">
			<div class="form-label col-md-2 col-xs-12">封面</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="hidden" name="former_cover" value="<?= (empty($cover) ? '' : $cover) ?>"/>
                <?php if (!empty($cover)) { ?>
					<div class="form-input col-md-12 col-xs-12">
						<p class="lmt"><img src="<?= $uri_upload . '/' . $cover ?>"
						                    alt="<?= (empty($name) ? 'COVER' : $name) ?>"/></p>
						<a href="<?= $ctx ?>admin/work/delete/cover/<?= $id ?>" target="_self">移除封面</a>
					</div>
                <?php } ?>
				<input type="file" class="form-control" accept="image/png, image/jpeg" name="cover"/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">作品名称</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="hidden" name="id" value="<?= (empty($id) ? 0 : $id) ?>"/>
				<input type="text" class="form-control" name="name" value="<?= (empty($name) ? '' : $name) ?>" required
				       autofocus/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">作者</div>
			<div class="form-input col-md-7 col-xs-8">
				<div class="input-group">
					<input type="hidden" name="author_id" id="authorId"
					       value="<?= (empty($author_id) ? '' : $author_id) ?>"/>
					<input type="text" class="form-control" name="author" value="<?= (empty($author) ? '' : $author) ?>"
					       id="authorSelector" required/>
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu dropdown-menu-right" role="menu">
						</ul>
					</div>
				</div>
			</div>
			<div class="form-input col-md-3 col-xs-4">
				<input type="text" class="form-control" name="country" id="authorCountry"
				       value="<?= (empty($country) ? '' : $country) ?>"
				       placeholder="作者国籍" required/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">分类</div>
			<div class="form-input col-md-10 col-xs-12">
				<div class="input-group">
					<input type="hidden" name="category_id" id="categoryId"
					       value="<?= (empty($category_id) ? 0 : $category_id) ?>"/>
					<input type="text" name="cat" id="categorySelector" class="form-control"
					       value="<?= (empty($cat) ? '' : $cat) ?>"
					       required/>
					<div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu dropdown-menu-right" role="menu">
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">概述</div>
			<div class="form-input col-md-10 col-xs-12">
				<textarea class="form-control" name="brief" rows="8"><?= (empty($brief) ? '' : $brief) ?></textarea>
			</div>
		</div>

		<div class="row">
			<div class="btn-left col-md-6 col-xs-12">
				<a href="<?= $ctx ?>admin/work/list" class="btn btn-info">返回作品列表</a>
			</div>
			<div class="btn-right col-md-6 col-xs-12">
				<button type="submit" class="btn btn-success">保存作品信息</button>
			</div>
		</div>
	</form>
</div>


<?php include_once 'common/footer.php'; ?>

<script charset="utf-8" src="<?= $uri_admin ?>/static/js/bootstrap-suggest.js"></script>
<script>
    $("#authorSelector").bsSuggest({
        allowNoKeyword: true,
        clearable: true,
        url: "<?=$ctx?>admin/author/suggest?key=",
        getDataMethod: "url",
        showBtn: true,
        showHeader: false,
        idField: "id",
        keyField: "name",
        effectiveFields: ["name", "country"]
    }).on('onSetSelectValue', function (e, keyword, data) {
        $("#authorId").val(data.id);
        $("#authorCountry").val(data.country)
    });


    $("#categorySelector").bsSuggest({
        clearable: true,
        url: "<?=$ctx?>admin/category/suggest?key",
        showHeader: false,
        showBtn: true,     //不显示下拉按钮
        idField: "id",
        keyField: "name",
        effectiveFields: ["id", "name", "slug"]
    }).on('onSetSelectValue', function (e, keyword, data) {
        $("#categoryId").val(data.id)
    });
</script>