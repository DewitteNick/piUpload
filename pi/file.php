<?php

//require_once "assets/data/header.php";

$httpVerb = $_SERVER['REQUEST_METHOD'];
$file = isset($_GET['file']) ? $_GET['file'] : null;
$dir = isset($_GET['dir']) ? $_GET['dir'] : null;

$guiNeeded = $httpVerb == "GET" && is_null($file) &&is_null($dir);
if($guiNeeded) {
	require_once "assets/data/header.php";
}else{
	session_start();
	require_once "showFunctions.php";
	require_once "doFunctions.php";
	require_once "Upload_db.php";
}

switch($httpVerb) {
	case "GET":
		if(!is_null($file)) {
			//NOTE download file(s)
			if(is_array($file)) {
				$zipfile = createZipFile($file);
				echo $zipfile;
			}else{
				downloadFile($file);
			}
		}elseif(!is_null($dir)) {
			//NOTE open directory -> howto? [later]

		}else{
			//NOTE show new file form
			showUploadForm();
		}
		break;
	case "UPDATE":
			//NOTE Rename file
		$newName = isset($_GET['name']) ? $_GET['name'] : null;
		echo json_encode(array("success" => renameFile($file, $newName)));
		break;
	case "DELETE":
			//NOTE Delete file
		if(is_array($file)) {
			echo json_encode(deleteMultipleFiles($file));
		}else{
				echo json_encode(array("success" => removeFile($file)));
		}
		break;
	case "POST":
			if(is_null($file)) {
				//NOTE Create a new file
				addNewFile();
			}else{
				//NOTE Create new directory
			}
		break;
	default:
		echo "Error 405. Wrong HTTP Verb.";
		break;
}

if($guiNeeded) {
	require_once "assets/data/footer.php";
}else{
	session_abort();
}


function deleteMultipleFiles($files) {
	$success = array();
	foreach($files as $item) {
		$itemSuccess = removeFile($item);
		$success[$item] = $itemSuccess;
	}
	$totalSuccess = !in_array(false, $success);
	return array("success" => $totalSuccess, "filesDeleted" => $success);
}

function addNewFile() {
	$file = isset($_FILES['file']) ? $_FILES['file'] : null;
	$success = saveFile($file);
	if($success) {
		redirect("home.php");
	}else{
		echo "<h1>File couldn't be uploaded.</h1>";
	}
}