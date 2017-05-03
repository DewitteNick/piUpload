<?php

//require_once "assets/data/header.php";
session_start();
require_once "showFunctions.php";
require_once "doFunctions.php";
require_once "Upload_db.php";
require_once "Config.php";

$httpVerb = $_SERVER['REQUEST_METHOD'];

$file = null;
if(isset($_GET['file'])) {	//NOTE GET/UPDATE/DELETE == RUD of the crud operations, all need get_file to be set
	$file = $_GET['file'];

	switch ($httpVerb) {
		case "GET":
			//NOTE User wants to read content			R	(download file)
			downloadFile($file);
			break;
		case "UPDATE":
			//NOTE User wants to update content			U	(rename file)
			break;
		case "DELETE":
			//NOTE User wants to delete content			D	(remove file)
			$success = removeFile($file);
			echo json_encode(array("success" => $success));
			break;
		default:
			echo "No CRUD HTTP verb found. Please use POST/GET/UPDATE/DELETE";
			break;
	}
}elseif(isset($_FILES['file'])){	//NOTE CREATE == C of the crud operations, needs the files_file to be set
	$file = $_FILES['file'];
	$success = saveFile($file);
	if($success) {
		redirect('home.php');
	}else{
		echo "<h1>file couldn't be uploaded</h1>";
		var_dump($_POST);
		var_dump($_GET);
		var_dump($_FILES);
	}
}else{			//NOTE when no files are specified, no actions can be done. This is why there is a form shown to upload a new file.
	showUploadForm();
}
/*
$file = null;
$action = null;
if(isset($_GET['file'])) {
	$file = $_GET['file'];
}elseif($_){

}
if(isset($_GET['action'])) {
	$action = $_GET['action'];
}
*/

//
//if(checkAvailability($file)) {
//	switch($action) {
//		case "download":
//			downloadFile($file);
//			break;
//			/*
//		case "delete":
//			removeFile($file);
//			break;
//			*/
//		case "rename":
//			if(isset($_GET['newname'])) {
//				renameFile($file, $_GET['newname']);
//			}else{
//				echo "<h1>NYI</h1>";
//			}
//			break;
//			/*
//		case "Delete selected":
//			foreach($file as $item) {
//				removeFile($item);
//			}
//			break;
//			*/
//		default:
//			//TODO nothing?
//			break;
//	}
//}else{
//
//}


session_abort();