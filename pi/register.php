<?php

require_once "assets/data/header.php";

if(!isset($_POST['name']) || !isset($_POST['pass'])/* || !isset($_POST['pass2'])*/) {
    showRegisterForm();
} else {
    $username = $_POST["name"];
    $password = $_POST["pass"];
    $email = $_POST["email"];
    $success = registerUser($username, $password, $email);
    if($success) {
        redirect("index.php");
    } else {
        echo "<h1>Failed to register</h1>";
    }
}

require_once "assets/data/footer.php";