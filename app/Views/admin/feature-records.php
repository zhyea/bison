<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

<div class="container main">
	<div class="page-header">
		<h3>
			<i class="glyphicon glyphicon-folder-open"></i> <?= $name ?>
			<span class="tag"><a href="<?= $ctx ?>admin/feature/list">返回专题列表</a></span>
		</h3>
	</div>
	
	<div class="row">
		<div class="form-input col-md-5 col-xs-12">
			<div class="input-group">
				<input type="text" class="form-control" id="featureRecordSelectInput" autocomplete="off"/>
				<div class="input-group-btn">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-menu-right" role="menu"></ul>
				</div>
				<!-- /btn-group -->
			</div>
		</div>
	</div>
	
	<div id="featureRecordTableToolbar">
		<div class="btn-group">
			<a id="btnDelete" class="btn btn-default">
				<i class="glyphicon glyphicon-minus"></i> 删除
			</a>
		</div>
	</div>
	<table id="featureRecordTable"
	       data-toggle="table"
	       data-search="true"
	       data-classes="table table-hover table-borderless"
	       data-click-to-select="true"
	       data-toolbar="#featureRecordTableToolbar"
	       data-url="<?= $ctx ?>admin/work/feature/<?= $alias ?>"
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
			<th data-align="left" data-sortable="true" data-field="author">作者</th>
			<th data-align="left" data-sortable="true" data-field="name">作品</th>
			<th data-halign="center" data-align="center" data-field="sn" data-formatter="orderFormatter">排序</th>
		</tr>
		</thead>
	</table>

</div>

<?php include_once 'common/footer.php'; ?>

<script charset="utf-8" src="<?= $uri_admin ?>/static/js/bootstrap-suggest.js"></script>
<script>
    let $table = $('#featureRecordTable');


    $("#featureRecordSelectInput").bsSuggest({
        clearable: true,
        url: "<?=$ctx?>admin/work/suggest?key=",
        showHeader: false,
        showBtn: true,     //不显示下拉按钮
        idField: "id",
        keyField: "name",
        effectiveFields: ["id", "name", "author"],
        allowNoKeyword: true,
        getDataMethod: 'url'
    }).on('onSetSelectValue', function (e, keyword, data) {
        $.post('<?=$ctx?>admin/feature/record/add/<?=$id?>/' + data.id,
            function (data, status) {
                if ('success' === status) {
                    $table.bootstrapTable('refresh')
                }
            });
    });


    // 删除按钮事件
    $("#btnDelete").on("click", function () {
        let rows = $table.bootstrapTable('getSelections');// 获得要删除的数据
        if (rows.length > 0) {// rows 主要是为了判断是否选中，下面的else内容才是主要
            let ids = [];// 声明一个数组
            $(rows).each(function () {// 通过获得别选中的来进行遍历
                ids.push(this.record_id);// cid为获得到的整条数据中的一列
            });

            sendBootstrapTableRequest($table, 'post', '<?=$ctx?>admin/feature/records/delete', ids);
        }
    });

    function orderFormatter(value, row, index) {
        let arr = [
            '<a href="javascript:changeOrder(' + row.record_id + ', 1)"><i class="glyphicon glyphicon-arrow-up"></i></a>',
            '<a href="javascript:changeOrder(' + row.record_id + ', -1)"><i class="glyphicon glyphicon-arrow-down"></i></a>'
        ];
        return arr.join('&nbsp;');
    }

    function changeOrder(id, step) {
        $table.bootstrapTable('showLoading');
        sendBootstrapTableRequest($table, 'post', '<?= $ctx?>admin/feature/record/change-order/' + id, step);
    }
</script>
