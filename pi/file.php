<?php

require_once "assets/data/header.php";


$file = null;
$action = null;
if(isset($_GET['file'])) {
	$file = $_GET['file'];
}
if(isset($_GET['action'])) {
	$action = $_GET['action'];
}


if(checkAvailability($file)) {
	switch($action) {
		case "download":
			downloadFile($file);
			break;
		case "delete":
			removeFile($file);
			break;
		case "rename":
			if(isset($_GET['newname'])) {
				renameFile($file, $_GET['newname']);
			}else{
				echo "<h1>NYI</h1>";
			}
			break;
		case "Delete selected":
			foreach($file as $item) {
				removeFile($item);
			}
			break;
		default:
			//TODO nothing?
			break;
	}
}else{

}



redirect("home.php");
require_once "assets/data/footer.php";