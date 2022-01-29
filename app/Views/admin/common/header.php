<?php
defined('_APP_PATH_') or exit('You shall not pass!');
?>
<!DOCTYPE HTML>
<html>
<head>

	<title><?= empty($title) ? 'Buffalo' : $title ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<link rel="icon" href="<?= $uri_admin ?>/static/img/favicon.ico">
	
	<link rel="stylesheet" type="text/css"
	      href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css"
	      href="https://cdn.bootcdn.net/ajax/libs/font-awesome/5.13.0/css/fontawesome.min.css"/>
	<link rel="stylesheet" type="text/css"
	      href="https://cdn.bootcdn.net/ajax/libs/bootstrap-table/1.16.0/bootstrap-table.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?= $uri_admin ?>/static/css/style.css"/>
	
	<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="<?= $uri_admin ?>/static/js/custom-script.js"></script>
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<div class="wrapper">
