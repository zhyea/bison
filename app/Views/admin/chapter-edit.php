<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>


<script charset="utf-8" src="https://cdn.ckeditor.com/4.14.1/basic/ckeditor.js"></script>


<div class="container main">
	<div class="page-header">
		<h3>
			<i class="glyphicon glyphicon-book"></i> <?= $work['name'] ?>
			<span class="tag"><a href="<?= $ctx ?>admin/chapter/all/<?= $work['id'] ?>">返回列表</a></span>
		</h3>

        <?php include_once 'common/alert.php'; ?>
		
		<form method="post" action="<?= $ctx ?>admin/chapter/maintain">
			<input type="hidden" name="id" value="<?= (empty($id) ? 0 : $id) ?>">
			<input type="hidden" name="work_id" value="<?= (empty($work['id']) ? 0 : $work['id']) ?>">
			<div class="row">
				<input type="text" class="form-control" placeholder="标题"
				       name="name" value="<?= (empty($name) ? '' : $name) ?>" required autofocus/>
			</div>
			
			<div class="row">
				<div class="form-input col-md-12 col-xs-12">
					<div class="input-group">
						<input type="hidden" name="volume_id" id="volume_id"
						       value="<?= (empty($volume_id) ? 0 : $volume_id) ?>"/>
						<input type="text" class="form-control" name="volume"
						       value="<?= (empty($volume) ? '' : $volume) ?>"
						       id="volumeSelector"/>
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
				<input type="text" name="new_volume" class="form-control" placeholder="新建分卷，如无必要可留空"/>
			</div>
			<div class="row">
					<textarea name="content"
					          id="calf_chapter_editor"><?= (empty($content) ? '' : $content) ?></textarea>
				<script> CKEDITOR.replace('calf_chapter_editor', {height: 480});</script>
			</div>
			
			
			<div class="row">
				<div class="btn-left col-md-6 col-xs-12">
					<a href="<?= $ctx ?>admin/chapter/all/<?= $work['id'] ?>" class="btn btn-info">返回章节列表</a>
				</div>
				<div class="btn-right col-md-6 col-xs-12">
					<button type="submit" class="btn btn-success">保存章节信息</button>
				</div>
			</div>
		</form>
	</div>
</div>


<?php include_once 'common/footer.php'; ?>

<script charset="utf-8" src="<?= $uri_admin ?>/static/js/bootstrap-suggest.js"></script>
<script>
    $("#volumeSelector").bsSuggest({
        clearable: true,
        url: "<?=$ctx?>admin/volume/suggest/<?=$work['id']?>?key=",
        showHeader: false,
        showBtn: true,     //不显示下拉按钮
        idField: "id",
        keyField: "name",
        effectiveFields: ["id", "name"]
    }).on('onSetSelectValue', function (e, keyword, data) {
        $("#volume_id").val(data.id)
    });
</script>
