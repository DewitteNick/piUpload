<?php

require_once "assets/data/header.php";

if(!isset($_SESSION["name"])) { //NOTE show & process login form
    if(isset($_POST["name"]) || isset($_POST["pass"])) {    //NOTE process the login form
        $name = $_POST["name"];
        $pass = $_POST["pass"];
        if(checkLogin($name, $pass)) {
            $_SESSION["name"] = $name;
            redirect('home.php');
        } else {
            showLoginForm();
        }
/**/
    } else {
        showLoginForm();
    }
} else {    //NOTE user is logged in
    redirect('home.php');
}

require_once "assets/data/footer.php";