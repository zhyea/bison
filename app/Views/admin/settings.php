
<div class="container main">
	<div class="page-header">
		<h3><i class="glyphicon glyphicon-cog"></i> 信息维护</h3>
	</div>

    <?php include_once 'common/alert.php'; ?>

	<form method="post" action="<?= $siteUrl ?>/admin/settings/maintain" enctype="multipart/form-data">
		<div class="row">
			<div class="form-label col-md-2 col-xs-12">站点名称</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="text" class="form-control" name="siteName" value="<?= $siteName ?>" required autofocus/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">站点描述</div>
			<div class="form-input col-md-10 col-xs-12">
				<textarea class="form-control" name="description"><?= $description ?></textarea>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">首页标题</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="text" class="form-control" name="homeTitle" value="<?= $homeTitle ?>" required autofocus/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">关键词</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="text" class="form-control" name="keywords" value="<?= $keywords ?>"/>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">通知信息</div>
			<div class="form-input col-md-10 col-xs-12">
				<textarea class="form-control" name="notice"><?= $notice ?></textarea>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">LOGO</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="file" class="form-control" accept="image/png, image/jpeg" name="logo"/>
                <?php if (!empty($logo)) { ?>
					<div class="form-input col-md-12 col-xs-12">
						<br/>
						<p class="lmt"><img src="<?= $uriUpload . '/' . $logo ?>" alt="LOGO"/></p>
						<a href="<?= $siteUrl ?>/admin/settings/delete/logo" target="_self">移除LOGO</a>
						<br/>
					</div>
                <?php } ?>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">背景图片</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="file" class="form-control" accept="image/png, image/jpeg" name="background"/>
                <?php if (!empty($background)) { ?>
					<div class="form-input col-md-12 col-xs-12">
						<br/>
						<p class="lmt"><img src="<?= $uriUpload . '/' . $background ?>" alt="BG_IMG"/></p>
						<a href="<?= $siteUrl ?>/admin/settings/delete/background" target="_self">移除背景图</a>
						<br/>
					</div>
                <?php } ?>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">背景重复</div>
			<div class="form-input col-md-10 col-xs-12" style="padding-top:6px;">
				<label class="radio-inline">
					<input type="radio" name="bgRepeat" value="1" <?= $bgRepeat == "1" ? 'checked' : '' ?> > 重复
				</label>
				<label class="radio-inline">
					<input type="radio" name="bgRepeat" value="2" <?= $bgRepeat == "2" ? 'checked' : '' ?>> 不重复
				</label>
			</div>
		</div>

		<div class="row">
			<div class="form-label col-md-2 col-xs-12">背景色</div>
			<div class="form-input col-md-10 col-xs-12">
				<input type="text" class="form-control" name="bgColor" value="<?= $bgColor ?>"/>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-12">&nbsp;</div>
			<div class="form-input col-md-6 col-xs-12">
				<button type="submit" class="btn btn-success">保存设置</button>
			</div>
		</div>
	</form>
</div>
