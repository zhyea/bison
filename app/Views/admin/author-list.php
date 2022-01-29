<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>


<div class="container main">
	<div class="page-header">
		<h3><i class="glyphicon glyphicon-pencil"></i> 作者列表</h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<div id="authorTableToolbar">
		<div class="btn-group">
			<a class="btn btn-default" href="<?= $ctx ?>admin/author/settings">
				<i class="glyphicon glyphicon-plus"></i>新增
			</a>
		</div>
	</div>
	<table id="authorTable"
	       data-toggle="table"
	       data-search="true"
	       data-show-refresh=true
	       data-classes="table table-hover table-borderless"
	       data-toolbar="#authorTableToolbar"
	       data-url="<?= $ctx ?>admin/author/data"
	       data-id-field="id"
	       data-sort-name="id"
	       data-sort-order="desc"
	       data-method="post"
	       data-side-pagination='client'
	       data-pagination=true
	       data-page-size=30
	       data-page-list=[15,30,50,All]>
		<thead>
		<tr>
			<th data-align="left" data-sortable="true" data-field="name" data-formatter="nameFormatter">姓名</th>
			<th data-align="left" data-sortable="true" data-field="country">国家</th>
			<th data-align="center" data-formatter="worksFormatter">作品</th>
			<th data-align="center" data-formatter="operateFormatter">操作</th>
		</tr>
		</thead>
	</table>
</div>

<?php include_once 'common/footer.php'; ?>

<script>
    function nameFormatter(value, row, index) {
        return '<a href="<?=$ctx?>admin/author/settings/' + row.id + '" target="_self">' + value + '</a>';
    }

    function worksFormatter(value, row, index) {
        return '<a href="<?=$ctx?>admin/author/works/' + row.id + '" target="_self"><span class="badge">' + row.work_count + '</span></a>';
    }

    function operateFormatter(value, row, index) {
        if (row.id > 1) {
            return '<a href="<?=$ctx?>admin/author/delete/' + row.id + '" target="_self">删除</a>';
        }
    }
</script>