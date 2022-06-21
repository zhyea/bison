<?php
include_once 'functions.php';
?>

<!DOCTYPE HTML>
<html>
<head>
    <title><?= empty($title) ? 'Buffalo' : $title ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="icon" href="<?= $uriAdmin ?>/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="<?= $uriStatic ?>/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $uriAdmin ?>/css/bootstrap-table.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= $uriAdmin ?>/css/style.css"/>

    <script src="<?= $uriStatic ?>/js/jquery.min.js"></script>
    <script src="<?= $uriStatic ?>/js/bootstrap.min.js"></script>
    <script src="<?= $uriAdmin ?>/js/custom-script.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="wrapper">

    <?php
    include_once 'navigator.php';
    ?>
