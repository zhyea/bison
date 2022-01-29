<?php
defined('_APP_PATH_') or exit('You shall not pass!');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<html>
<head>
	<title><?= (empty($title) ? 'Please Login' : $title) ?></title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="icon" href="<?= $uri_admin ?>/static/img/favicon.ico">

	<link rel="stylesheet" type="text/css"
	      href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css"
	      href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.13.0/css/fontawesome.min.css"/>
	<link rel="stylesheet" type="text/css"
	      href="https://cdn.bootcdn.net/ajax/libs/bootstrap-table/1.16.0/bootstrap-table.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $uri_admin ?>/static/css/style.css"/>
</head>

<body>

<div class="container login">

	<form class="form-login" method="post" action="<?= $ctx ?>login/check">
		<div class="logo"><img src="<?= $uri_admin ?>/static/img/logo.png" width="36%"/></div>
		<div class="form-item">
			<span class="form-label">用户名</span>
			<input name="username" type="text" class="form-control" placeholder="Email" required autofocus/>
		</div>
		<div class="form-item">
			<span class="form-label">密码</span>
			<input name="password" type="password" class="form-control" placeholder="Password" required/>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>


        <?php if (!empty($alert)) { ?>
			<div role="alert" class="alert alert-<?= $alert['type'] ?>">
                <?= $alert['msg'] ?>
			</div>
        <?php } ?>
	</form>

</div> <!-- /container -->

<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="<?= $uri_admin ?>/static/js/custom-script.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/bootstrap-table/1.16.0/bootstrap-table.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/bootstrap-table/1.16.0/locale/bootstrap-table-zh-CN.min.js"></script>
</body>
</html>


