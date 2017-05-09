<?php

//require_once "assets/data/header.php";

$httpVerb = $_SERVER['REQUEST_METHOD'];

$file = null;
if(isset($_GET['file'])) {	//NOTE GET/UPDATE/DELETE == RUD of the crud operations, all need get_file to be set
	session_start();
	require_once "showFunctions.php";
	require_once "doFunctions.php";
	require_once "Upload_db.php";

	$file = $_GET['file'];

	switch ($httpVerb) {
		case "GET":
			//NOTE User wants to read content			R	(download file)
			if(is_array($file)){
				$zipfile = createZipFile($file);
				echo $zipfile;
			}else {
				downloadFile($file);
			}
			break;
		case "UPDATE":
			//NOTE User wants to update content			U	(rename file)
			$success = renameFile($file, $_GET['name']);
			echo json_encode(array("success" => $success));
			break;
		case "DELETE":
			//NOTE User wants to delete content			D	(remove file)
			if(is_array($file)) {
				$success = array();
				foreach($file as $item) {
					$itemSuccess = removeFile($item);
					$success[$item] = $itemSuccess;
				}
				echo json_encode(array("success" => $success));
			}else {
				$success = removeFile($file);
				echo json_encode(array("success" => $success));
			}
			break;
		default:
			echo "No CRUD HTTP verb found. Please use POST/GET/UPDATE/DELETE";
			break;
	}

	session_abort();
}elseif(isset($_FILES['file'])){	//NOTE CREATE == C of the crud operations, needs the files_file to be set
	session_start();
	require_once "showFunctions.php";
	require_once "doFunctions.php";
	require_once "Upload_db.php";

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

	session_abort();
}else{			//NOTE when no files are specified, no actions can be done. This is why there is a form shown to upload a new file.
	require_once "assets/data/header.php";
	showUploadForm();
	require_once "assets/data/footer.php";
}