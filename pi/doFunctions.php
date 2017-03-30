<?php

function checkLogin($name, $pass) {
    $db = Upload_db::getUploadInstance();
    $valid = $db->checkLogin($name, $pass);
    return $valid;
}


function redirect($url) {
    header('Location: '.$url);
    die();
}

function registerUser($username, $password, $password2) {
    $success = false;
    $db = Upload_db::getUploadInstance();
    if($password == $password2) {
        $success = $db->registerUser($username, $password);
    }
    if($success) {
    	mkdir("upload/".$username);
	}
    return $success;
}

function checkFile($file) {
    //NOTE See if a file was supplied
    if($file['error'] !== 0) {
        return false;
    }
    $allowedFileTypes = array('image/jpeg','image/png','image/gif','image/bmp','text/plain');
    $maxFileSize = 2000000000;  //NOTE php file size? (=> this is 2 GB)
    $targetFile = "upload/".$_SESSION['name']."/".$file['name'];
    $uploadOk = 0;
    $amountOfChecks = 3;
    //NOTE Check if file exists already.
    if(!file_exists($targetFile)) {
        $uploadOk++;
    }
    //NOTE Check if filesize is OK.
    if($file['size'] <= $maxFileSize) {
        $uploadOk++;
    }
    //NOTE Check if the filetype is OK.
    foreach($allowedFileTypes as $allowedType) {
        if($file['type'] == $allowedType) {
            $uploadOk++;
            break;
        }
    }
    return ($uploadOk == $amountOfChecks);
}


function saveFile($file) {
    //TODO add file to sql
    $db = Upload_db::getUploadInstance();
    $db->addFile($file);
    $targetDir = "upload/".$_SESSION['name']."/";
    $success = move_uploaded_file($file['tmp_name'], $targetDir.$file['name']);
    return $success;
}


function getFiles() {
    $db = Upload_db::getUploadInstance();
    $files = $db->getAllFiles($_SESSION['name']);
    return $files;
}


function checkAvailability($file) {
    $db = Upload_db::getUploadInstance();
    $valid = $db->checkValidity($file, $_SESSION['name']);
    return $valid;
}


function downloadFile($file){
	$fullPath = "upload/".$_SESSION['name']."/".$file;
	try {
		/*
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $file . '"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('content-length: ' . filesize('upload/' . $_SESSION['name'] . "/" . $file));
		readfile("upload/".$_SESSION['name']."/".$file);
		exit;
		*/
		header('Content-Description: File Transfer');
		header('Content-type: '.mime_content_type($fullPath));
		header('Content-Disposition: attachment; filename="'.$file.'"');
		header('Expires: -1');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('content-length: '.filesize($fullPath));
		ob_clean();
		flush();
		readfile($fullPath);
		exit(0);
	}catch(Exception $ex) {
		die($ex->getMessage());
	}
}


function removeFile($file) {
	$path = "upload/".$_SESSION['name']."/".$file;
	unlink($path);
	$db = Upload_db::getUploadInstance();
	$db->removeFile($file, $_SESSION['name']);
}






























