<!DOCTYPE HTML>
<html>
<head>
	<title><?= empty($title) ? 'A Buffalo Site!' : $title ?> </title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="description" content="<?= empty($description) ? '' : $description ?>"/>

	<link rel="icon" href="<?= $uriTheme ?>/imgs/favicon.ico">

	<link rel="stylesheet" type="text/css"
	      href="<?= $uriStatic ?>/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $uriTheme ?>/css/style.css"/>

	<script src="<?= $uriStatic ?>/js/jquery.min.js"></script>
	<script src="<?= $uriTheme ?>/js/custom.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
        body {
        <?=(empty($bgColor) ? '' : 'background-color:'.$bgColor.';')?>
        <?=(empty($background) ? '' : 'background-image:url('.$uriUpload . '/'.$background.');')?>
        <?=(!empty($background) && !empty($bgRepeat) && 1==$bgRepeat ? 'background-repeat:repeat;' : '')?>;
        <?=(!empty($background) && !empty($bgRepeat) && 2==$bgRepeat ? 'background-position: center; background-size: 100% auto; background-attachment: fixed;' : '')?>
        }
        .header {}
	</style>
</head>
<body>
<div class="wrapper">


<?php include_once 'navigator.php'; ?>