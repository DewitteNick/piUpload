<?php
	require_once 'headers.php';

    session_start();
    require_once "showFunctions.php";
    require_once "doFunctions.php";
    require_once "Upload_db.php";
    require_once "Config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GoWest drive</title>
    <meta name="author" content="Nick Dewitte"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/reset.css">
    <link rel="stylesheet" type="text/css" href="assets/css/screen.css">
	<link rel="manifest" href="/manifest.json">

	<link rel="apple-touch-icon" sizes="180x180" href="/assets/media/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/media/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/media/icons/favicon-16x16.png">
	<link rel="manifest" href="/assets/media/icons/manifest.json">
	<link rel="mask-icon" href="/assets/media/icons/safari-pinned-tab.svg" color="#50859c">
	<link rel="shortcut icon" href="/assets/media/icons/favicon.ico">
	<meta name="msapplication-TileColor" content="#50859c">
	<meta name="msapplication-TileImage" content="/assets/media/icons/mstile-144x144.png">
	<meta name="msapplication-config" content="/assets/media/icons/browserconfig.xml">
	<meta name="theme-color" content="#50859c">

</head>
<body>
<header class="cf">
    <?php
    if(isset($_SESSION["name"])) {
        $name = $_SESSION["name"];
        echo "<h1>Welcome <span>$name</span></h1>";
    } else {
        if($_SERVER['REQUEST_URI'] != '/index.php' && $_SERVER['REQUEST_URI'] != '/register.php' && $_SERVER['REQUEST_URI'] != '/readme.php') {
            redirect('index.php');
        }
		echo "<h1>Please log in</h1>";
    }
    /**/?>
	<a href="home.php" class="" id="homeButton">
		<i class="fa fa-home fa-2x"></i>
	</a>
</header>