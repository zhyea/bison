<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>


<div class="container main">

	<div class="page-header">
		<h3><i class="glyphicon glyphicon-retweet"></i> <?= $header_title ?></h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<div id="navigatorTableToolbar">
		<div class="btn-group">
			<a class="btn btn-default" href="<?= $ctx ?>admin/nav/settings/<?= $id ?>">
				<i class="glyphicon glyphicon-plus"></i>新增</a>
			<a id="btnDelete" class="btn btn-default"><i class="glyphicon glyphicon-minus"></i> 删除</a>
            <?php if (!empty($id)) { ?>
				<a class="btn btn-default" href="<?= $ctx ?>admin/nav/list/<?= $parent ?>">
					<i class="glyphicon glyphicon-chevron-left"></i> 返回上一级
				</a>
            <?php } ?>
		</div>
	</div>
	<table id="navigatorTable"
	       data-toggle="table"
	       data-search="true"
	       data-classes="table table-hover table-borderless"
	       data-click-to-select="true"
	       data-toolbar="#navigatorTableToolbar">
		<thead>
		<tr>
			<th data-align="center" data-field="" data-checkbox="true"></th>
			<th data-halign="left" data-align="left" data-field="name" data-formatter="nameFormatter">名称</th>
			<th data-halign="left" data-align="left" data-field="type">类型</th>
			<th data-halign="center" data-align="center" data-field="subCount" data-formatter="childFormatter">子项
			</th>
			<th data-halign="center" data-align="center" data-field="sn" data-formatter="orderFormatter">排序</th>
		</tr>
		</thead>
	</table>
</div>

<?php include_once 'common/footer.php'; ?>


<script>

    let $table = $('#navigatorTable');

    $table.bootstrapTable({
        url: "<?=$ctx?>admin/nav/data/<?=$id?>"
    });


    // 删除按钮事件
    $("#btnDelete").on("click", function () {
        let rows = $table.bootstrapTable('getSelections');// 获得要删除的数据
        if (rows.length > 0) {// rows 主要是为了判断是否选中，下面的else内容才是主要
            let ids = [];// 声明一个数组
            $(rows).each(function () {// 通过获得别选中的来进行遍历
                ids.push(this.id);// cid为获得到的整条数据中的一列
            });

            if (ids.length > 0) {
                sendBootstrapTableRequest($table, 'post', '<?=$ctx?>admin/nav/delete', ids);
            }
        }
    });

    function nameFormatter(value, row, index) {
        return '<a href="<?=$ctx?>admin/nav/settings/' + row.parent + '/' + row.id + '" target="_self">' + value + '</a>';
    }

    function childFormatter(value, row, index) {
        let arr = ['<span class="badge">' + row.sub_count + '</span>'];
        if (row.sub_count > 0) {
            arr.push('<a href="<?=$ctx?>admin/nav/list/' + row.id + '" target="_self">查看</a>');
        } else {
            arr.push('<a href="<?=$ctx?>admin/nav/settings/' + row.id + '" target="_self">新增</a>');
        }
        return arr.join('&nbsp;');
    }

    function orderFormatter(value, row, index) {
        let arr = [
            '<a href="javascript:changeOrder(' + row.id + ', 1)"><i class="glyphicon glyphicon-arrow-up"></i></a>',
            '<a href="javascript:changeOrder(' + row.id + ', -1)"><i class="glyphicon glyphicon-arrow-down"></i></a>'
        ];
        return arr.join('&nbsp;');
    }

    function changeOrder(id, step) {
        $table.bootstrapTable('showLoading');
        sendBootstrapTableRequest($table, 'post', '<?=$ctx?>admin/nav/change-order/' + id, step);
    }
</script>

