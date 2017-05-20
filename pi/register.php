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

		//TODO sanitize input
		$username = sanitizeInput($_POST['name']);
		$password = $_POST['pass'];		//TODO this doesn't need anything except prep statement, right?
		$email = sanitizeInput($_POST['email']);
		//TODO Check if input is valid
		if(checkIllegalCharacters($username) && checkIllegalCharacters($email)) {
			//input is safe
			$success = registerUser($username, $password, $email);
			if ($success) {
				$_SESSION['name'] = $username;
				redirect('home.php');
			} else {
				//TODO User not registered
				echo "failed to register";
			}
			session_abort();
		}else{
			//input was unsafe TODO
			echo "illegal input";
		}
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