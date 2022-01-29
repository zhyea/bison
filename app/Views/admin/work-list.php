<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

<div class="container main">
	<div class="page-header">
		<h3><i class="glyphicon glyphicon-hdd"></i> 作品列表</h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<div id="workTableToolbar">
		<div class="btn-group">
			<a class="btn btn-default" href="<?= $ctx ?>admin/work/settings">
				<i class="glyphicon glyphicon-plus"></i>新增
			</a>
			<a id="btnDelete" class="btn btn-default">
				<i class="glyphicon glyphicon-minus"></i>删除
			</a>
		</div>
	</div>
	<table id="workTable"
	       data-toggle="table"
	       data-search="true"
	       data-classes="table table-hover table-borderless"
	       data-click-to-select="true"
	       data-toolbar="#workTableToolbar"
	       data-url="<?= $ctx ?>admin/work/data"
	       data-sort-name="id"
	       data-sort-order="desc"
	       data-method="post"
	       data-side-pagination='server'
	       data-pagination=true
	       data-page-size=30
	       data-page-list=[15,30,50,All]>
		<thead>
		<tr>
			<th data-align="center" data-checkbox="true"></th>
			<th data-align="left" data-sortable="true" data-field="name" data-formatter="nameFormatter">作品名称</th>
			<th data-align="left" data-sortable="false" data-field="author">作者</th>
			<th data-align="left" data-sortable="false" data-field="cat">分类</th>
			<th data-align="center" data-sortable="false" data-formatter="operateFormatter">编辑</th>
		</tr>
		</thead>
	</table>
</div>


<?php include_once 'common/footer.php'; ?>

<script>
    // 删除按钮事件
    $("#btnDelete").on("click", function () {

        let rows = $("#workTable").bootstrapTable('getSelections');// 获得要删除的数据
        if (rows.length > 0) {// rows 主要是为了判断是否选中，下面的else内容才是主要
            let ids = [];// 声明一个数组
            $(rows).each(function () {// 通过获得别选中的来进行遍历
                ids.push(this.id);// cid为获得到的整条数据中的一列
            });

            sendBootstrapTableRequest($("#workTable"), 'post', '<?=$ctx?>admin/work/delete', ids);
        }
    });

    function nameFormatter(value, row, index) {
        return '<a href="<?=$ctx?>admin/chapter/all/' + row.id + '" target="_self">' + value + '</a>';
    }

    function operateFormatter(value, row, index) {
        return '<a href="<?=$ctx?>admin/work/settings/' + row.id + '" target="_self">编辑</a>';
    }
</script>