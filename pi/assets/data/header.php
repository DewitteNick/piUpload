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
        echo "<h1>Welcome $name</h1>";
    }
    /**/?>
</header>