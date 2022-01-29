<?php
defined('_APP_PATH_') or exit('You shall not pass!');

include_once 'common/header.php';
include_once 'common/navigator.php';
?>

	<div class="container main">
		<div class="page-header">
			<h3>
				<i class="glyphicon glyphicon-book"></i> <?= $work['name'] ?>
				<span class="tag"><a href="<?= $ctx ?>admin/work/list">返回作品列表</a></span>
			</h3>
		</div>

        <?php include_once 'common/alert.php'; ?>

		<div class="row chapter-container">
			<form method="post" action="<?= $ctx ?>admin/chapter/upload" enctype="multipart/form-data">
				<input type="hidden" name="work_id" value="<?= $work['id'] ?>">
				<div class="form-input col-md-8 col-xs-12">
					<input type="file" class="form-control" accept="text/plain" name="myTxt"/>
				</div>
				<div class="col-md-4 col-xs-12">
					<button type="submit" class="btn btn-success">上传文件</button>
				</div>
			</form>
		</div>

        <?php foreach ($vols as $vol) { ?>
			<div class="row chapter-container">
			<div class="page-header">
				<h3>
					<i class="glyphicon glyphicon-bookmark"></i> <?= $vol['name'] ?>
					<span class="tag"><a
								href="<?= $ctx ?>admin/chapter/delete-vol/<?= $work['id'] ?>/<?= $vol['id'] ?>">删除</a></span>
				</h3>
			</div>

            <?php if (!empty($vol['chapters'])) {
                foreach ($vol['chapters'] as $chp) {
                    ?>
					<div class="col-md-4 col-xs-12 chapter-unit">
						<div class="chapter">
							<a href="<?= $ctx ?>admin/chapter/edit/<?= $work['id'] ?>/<?= $chp['id'] ?>"><?= $chp['name'] ?></a>
							<span class="operate">
                            <a href="<?= $ctx ?>admin/chapter/delete/<?= $work['id'] ?>/<?= $vol['id'] ?>/<?= $chp['id'] ?>">
                                <i class="glyphicon glyphicon-minus"></i>
                            </a>
                        </span>
						</div>
					</div>
                <?php } ?>
				</div>
            <?php }
        } ?>


		<div class="row chapter-container">
			<div class="col-md-4 col-xs-12 chapter-unit">
				<div class="chapter" style="background-color: #5FB878">
					<a href="<?= $ctx ?>admin/chapter/edit/<?= $work['id'] ?>">新增章节...</a>
					<span class="operate">
                            <a href="<?= $ctx ?>admin/chapter/<?= $work['id'] ?>"><i
			                            class="glyphicon glyphicon-plus"></i></a>
                    </span>
				</div>
			</div>
		</div>

		<div class="row chapter-container" if="${!#lists.isEmpty(vols)}">
			<div class="col-md-4 col-xs-12 chapter-unit">
				<div class="chapter" style="background-color: #e8434c">
					<a href="<?= $ctx ?>admin/chapter/delete-all/<?= $work['id'] ?>">删除全部章节...</a>
					<span class="operate">
                            <a href="<?= $ctx ?>admin/chapter/delete-all/<?= $work['id'] ?>">
                                <i class="glyphicon glyphicon-minus"></i></a>
                    </span>
				</div>
			</div>
		</div>
	</div>

<?php include_once 'common/footer.php'; ?>