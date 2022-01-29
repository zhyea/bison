<?php
defined('_APP_PATH_') or exit('You shall not pass!');
?>

<!DOCTYPE HTML>
<html>
<head>
	<title><?= empty($title) ? 'A Buffalo Site!' : $title ?> </title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="description" content="<?= empty($description) ? '' : $description ?>"/>

	<link rel="icon" href="<?= $uri_theme ?>/static/imgs/favicon.ico">

	<link rel="stylesheet" type="text/css"
	      href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $uri_theme ?>/static/css/style.css"/>

	<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="<?= $uri_theme ?>/static/js/custom.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
		body {
			background: <?=(empty($bg_color) ? '#F0F0F0' : $bg_color)?> <?=(empty($background) ? '' : 'url('.$uri_upload . '/'.$background.')')?> <?=(!empty($background) && !empty($bg_repeat) && 1==$bg_repeat ? 'repeat' : 'no-repeat')?>;
		<?=(!empty($background) && !empty($bg_repeat) && 2==$bg_repeat ? 'background-position: center; background-size: 100% auto; background-attachment: fixed;' : '')?>
		}

		.header {
		}
	</style>
</head>
<body>
<div class="wrapper">