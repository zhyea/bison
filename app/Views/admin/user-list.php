<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>
<div class="container main">
	<div class="page-header">
		<h3><i class="glyphicon glyphicon-user"></i> 用户列表</h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<div id="userTableToolbar">
		<div class="btn-group">
			<a class="btn btn-default" href="<?= $ctx ?>admin/user/settings"><i class="glyphicon glyphicon-plus"></i>新增</a>
			<a id="btnDelete" class="btn btn-default"><i class="glyphicon glyphicon-minus"></i>删除</a>
		</div>
	</div>
	<table id="userTable"
	       data-toggle="table"
	       data-search="true"
	       data-classes="table table-hover table-borderless"
	       data-click-to-select="true"
	       data-toolbar="#userTableToolbar"
	       data-url="<?= $ctx ?>admin/user/data"
	       data-side-pagination='client'
	       data-pagination=true
	       data-page-size=30
	       data-page-list=[15,30,50,All]>
		<thead>
		<tr>
			<th data-align="center" data-field="" data-checkbox="true"></th>
			<th data-align="left" data-field="username" data-formatter="nameFormatter">用户名</th>
			<th data-align="left" data-field="nickname">昵称</th>
			<th data-align="left" data-field="email">电子邮件</th>
		</tr>
		</thead>
	</table>

</div>


<script>
    // 删除按钮事件
    $("#btnDelete").on("click", function () {
        let rows = $("#userTable").bootstrapTable('getSelections');// 获得要删除的数据
        if (rows.length > 0) {// rows 主要是为了判断是否选中，下面的else内容才是主要
            let ids = [];// 声明一个数组
            $(rows).each(function () {// 通过获得别选中的来进行遍历
                ids.push(this.id);// cid为获得到的整条数据中的一列
            });

            sendBootstrapTableRequest($("#userTable"), 'post', '<?= $ctx ?>admin/user/delete', ids);
        }
    });

    function nameFormatter(value, row, index) {
        return '<a href="<?= $ctx ?>admin/user/settings/' + row.id + '" target="_self">' + value + '</a>';
    }
</script>

<?php include_once 'common/footer.php'; ?>


