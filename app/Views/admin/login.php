<?php
?>
<!DOCTYPE html>
<html lang="zh-CN">
<html>
<head>
    <title><?= (empty($title) ? 'Please Login' : $title) ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="icon" href="<?= $uriAdmin ?>/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="<?= $uriStatic ?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $uriStatic ?>/css/fontawesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $uriAdmin ?>/css/style.css"/>
</head>

<body>

<div class="container login">

    <form class="form-login" method="post" action="<?= $siteUrl ?>/login/check">
        <div class="logo"><img src="<?= $uriAdmin ?>/img/logo.png" width="36%"/></div>
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

<script src="<?= $uriStatic ?>/js/jquery.min.js"></script>
<script src="<?= $uriStatic ?>/js/bootstrap.min.js"></script>
<script src="<?= $uriAdmin ?>/js/custom-script.js"></script>
</body>
</html>


