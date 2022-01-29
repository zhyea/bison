<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

<div class="container main">
	<div class="page-header">
		<h3><i class="glyphicon glyphicon-list-alt"></i> <?= $title ?></h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<form method="post" action="<?= $ctx ?>admin/nav/maintain">

		<div class="row">
			<input type="hidden" name="id" value="<?= (empty($id) ? 0 : $id) ?>"/>
			<input type="hidden" name="type" id="navType" value="<?= (empty($type) ? '' : $type) ?>"/>
			<div class="col-md-5 col-xs-12" id="candidateTree"></div>
			<div class="col-md-7 col-xs-12">
				<div class="row">
					<div class="form-label col-md-2 col-xs-12">父级</div>
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
					<div class="form-label col-md-2 col-xs-12">名称</div>
					<div class="form-input col-md-10 col-xs-12">
						<input id="navName" type="text" class="form-control" name="name"
						       value="<?= (empty($name) ? '' : $name) ?>" <?= ($type != 'custom' ? 'readonly' : '') ?>
						       required/>
					</div>
				</div>
				<div class="row">
					<div class="form-label col-md-2 col-xs-12">URL</div>
					<div class="form-input col-md-10 col-xs-12">
						<input id="navUrl" type="text" class="form-control" name="url"
						       value="<?= (empty($url) ? '' : $url) ?>" <?= ($type != 'custom' ? 'readonly' : '') ?>
						       required/>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="btn-left col-md-6 col-xs-12">
				<a class="btn btn-info" href="<?= $ctx ?>admin/nav/list/<?= $parent ?>">返回列表</a>
			</div>
			<div class="btn-right col-md-6 col-xs-12">
				<button type="submit" class="btn btn-success">保存</button>
			</div>
		</div>
	</form>
</div>

<?php include_once 'common/footer.php'; ?>


<script charset="utf-8" src="<?= $uri_admin ?>/static/js/bootstrap-treeview.js"></script>
<script>
    function renderTree() {
        $.ajax({
            type: 'post',
            contentType: "application/json",
            url: '<?=$ctx?>admin/nav/candidates',
            async: true,
            timeout: 6 * 1000,
            success: function (result) {
                if (result) {
                    $('#candidateTree').treeview({
                        levels: 1,
                        data: result,
                        onNodeSelected: function (event, node) {
                            if (node.id === 0 && node.ext2 === 'custom') {
                                $("#navName").attr('readonly', false);
                                $("#navUrl").attr('readonly', false);

                                $("#navName").val('');
                                $("#navUrl").val('');
                            } else {
                                $("#navName").val(node.name);
                                $("#navUrl").val(node.ext);
                            }
                            $("#navType").val(node.ext2);
                        },
                        onNodeUnselected: function (event, node) {
                            if (node.id === 0) {
                                $("#navName").attr('readonly', true);
                                $("#navUrl").attr('readonly', true);
                            }
                        }
                    });
                }
            },
            error: function (xhr, state, errMsg) {
                console.log("操作失败:" + xhr.responseText);
            }
        });
    }

    renderTree();
</script>