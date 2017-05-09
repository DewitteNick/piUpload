<?php



$httpVerb = $_SERVER['REQUEST_METHOD'];

switch($httpVerb) {
	case "GET":
		require_once "assets/data/header.php";
		showRegisterForm();
		require_once "assets/data/footer.php";
		break;
	case "POST":
		session_start();
		require_once "doFunctions.php";
		require_once "Upload_db.php";
		$success = registerUser($_POST['name'],$_POST['pass'],$_POST['email']);
		if($success) {
			//TODO User registered
			echo "succesfull registration";
		}else{
			//TODO User not registered
			echo "failed to register";
		}
		session_abort();
		break;
	default:
		echo "\"Mind your (HTTP) vocabulary!\" - Mom";
		break;
}



/*
require_once "assets/data/header.php";

if(!isset($_POST['name']) || !isset($_POST['pass'])) {
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
*/