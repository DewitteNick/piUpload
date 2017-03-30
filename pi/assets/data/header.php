<?php
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
    <title>PHP page</title>
    <meta name="author" content="Nick Dewitte"/>
    <link rel="stylesheet" type="text/css" href="assets/css/reset.css">
    <link rel="stylesheet" type="text/css" href="assets/css/screen.css">
</head>
<body>
<header>
    <?php
    if(isset($_SESSION["name"])) {
        $name = $_SESSION["name"];
        echo "<h1>Welcome <span>$name</span></h1>";
    } else {
        if($_SERVER['REQUEST_URI'] != '/pi/index.php' && $_SERVER['REQUEST_URI'] != '/pi/register.php') {
            redirect('index.php');
        }
		echo "<h1>Please log in</h1>";
    }
    /**/?>
	<a href="home.php" class="fa-stack fa-lg">
		<i class="fa fa-home fa-stack-1x fa-lg"></i>
		<i class="fa fa-circle-thin fa-stack-2x"></i>
	</a>
</header>