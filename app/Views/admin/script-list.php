<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>


<div class="container main">

	<div class="page-header">
		<h3><i class="glyphicon glyphicon-console"></i> 脚本列表</h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<div id="featureTableToolbar">
		<div class="btn-group">
			<a class="btn btn-default" href="<?= $ctx ?>admin/spt/edit">
				<i class="glyphicon glyphicon-plus"></i>新增
			</a>
		</div>
	</div>
	<table id="featureTable"
	       data-toggle="table"
	       data-classes="table table-hover table-borderless"
	       data-click-to-select="true"
	       data-toolbar="#featureTableToolbar"
	       data-url="<?= $ctx ?>admin/spt/data"
	       data-single-select="true"
	       data-id-field="id"
	       data-sort-name="id"
	       data-sort-order="asc">
		<thead>
		<tr>
			<th data-align="center" data-field="" data-checkbox="true"></th>
			<th data-align="left" data-sortable="true" data-field="name" data-formatter="nameFormatter">脚本名称</th>
			<th data-align="left" data-sortable="true" data-field="code">代码</th>
			<th data-align="center" data-formatter="operateFormatter">操作</th>
		</tr>
		</thead>
	</table>

</div>


<?php include_once 'common/footer.php'; ?>

<script>
    function nameFormatter(value, row, index) {
        return '<a href="<?=$ctx?>admin/spt/edit/' + row.id + '">' + value + '</a>';
    }

    function operateFormatter(value, row, index) {
        if (row.id > 6) {
            return '<a href="<?=$ctx?>admin/spt/delete/' + row.id + '">删除</a>';
        }
        return '';
    }
</script>
