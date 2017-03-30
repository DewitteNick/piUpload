<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 28/03/2017
 * Time: 16:27
 */

require_once "assets/data/header.php";

$file = $_GET['file'];
$action = $_GET['action'];

if(checkAvailability($file)) {
	switch($action) {
		case "download":
			downloadFile($file);
			break;
		case "delete":
			removeFile($file);
			break;
		default:
			//TODO nothing?
			break;
	}
//    downloadFile($file);
}
redirect('home.php');

require_once "assets/data/footer.php";