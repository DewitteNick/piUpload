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
			downloadFiles($file);
		}elseif(!is_null($dir)) {
			//NOTE open directory -> howto? [later]
		}else{
			showUploadForm();
		}
		break;
	case "UPDATE":
		$result = array('legalName' => false, 'success' => false);

		if(isset($_GET['name'])){
			$result['legalName']  = checkIllegalCharacters($_GET['name']);
			if($result['legalName']) {
				$result['success'] = renameFile($file, $_GET['name']);
			}else{
				$result['success'] = false;
			}
		}
		echo json_encode($result);
		break;
	case "DELETE":
		deleteFiles($file);
		break;
	case "POST":
			if(is_null($file)) {
				addNewFile();
			}else{
				//NOTE Create new directory [later]
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
		echo "<a href='index.php'>Home</a>";
		echo "<br>";
		echo "<a href='file.php'>Back</a>";
	}
}

function downloadFiles($file) {
	if(is_array($file)) {
		$zipfile = createZipFile($file);
		echo $zipfile;
	}else{
		downloadFile($file);
	}
}

function deleteFiles($file) {
	if(is_array($file)) {
		echo json_encode(deleteMultipleFiles($file));
	}else{
		echo json_encode(array("success" => removeFile($file)));
	}
}