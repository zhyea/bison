<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>


<div class="container main">

	<div class="page-header">
		<h3><i class="glyphicon glyphicon-road"></i> 专题列表</h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<div id="featureTableToolbar">
		<div class="btn-group">
			<a class="btn btn-default" href="<?= $ctx ?>admin/feature/settings">
				<i class="glyphicon glyphicon-plus"></i>新增
			</a>
		</div>
	</div>
	<table id="featureTable"
	       data-toggle="table"
	       data-classes="table table-hover table-borderless"
	       data-click-to-select="true"
	       data-toolbar="#featureTableToolbar"
	       data-url="<?= $ctx ?>admin/feature/data"
	       data-single-select="true"
	       data-id-field="id"
	       data-sort-name="id"
	       data-sort-order="asc"
	       data-side-pagination='client'
	       data-pagination=true
	       data-page-size=30
	       data-page-list=[15,30,50,All]>
		<thead>
		<tr>
			<th data-align="center" data-checkbox="true" data-field=""></th>
			<th data-align="left" data-sortable="true" data-field="name" data-formatter="nameFormatter">专题名称</th>
			<th data-align="left" data-sortable="true" data-field="alias">别名</th>
			<th data-align="left" data-sortable="true" data-field="keywords">关键字</th>
			<th data-align="center" data-field="count" data-formatter="recordsFormatter">作品</th>
			<th data-align="center" data-formatter="operateFormatter">操作</th>
		</tr>
		</thead>
	</table>

</div>

<?php include_once 'common/footer.php'; ?>

<script>
    function nameFormatter(value, row, index) {
        return '<a href="<?=$ctx?>admin/feature/settings/' + row.id + '">' + value + '</a>';
    }

    function recordsFormatter(value, row, index) {
        return '<a href="<?=$ctx?>admin/feature/records/' + row.id + '"><span class="badge">' + value + '</span></a>';
    }

    function operateFormatter(value, row, index) {
        if (row.id * 1 > 1) {
            return '<a href="<?=$ctx?>admin/feature/delete/' + row.id + '">删除</a>';
        }
    }
</script>