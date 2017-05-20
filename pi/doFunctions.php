<?php

require_once "Config.php";

$options = array("cost" => 12);	//NOTE 0.5 sec on pi, seems fair...

function checkLogin($name, $pass) {
    $db = Upload_db::getUploadInstance();
    $passCrypt = $db->getPass($name);
    $valid = password_verify($pass, $passCrypt);
	return $valid;
}


function redirect($url) {
    header('Location: '.$url);
    die();
}

function registerUser($username, $password, $email) {
    $success = false;
    global $options;
    $db = Upload_db::getUploadInstance();
    if(strlen($password) >= 13) {
    	$passCrypt = password_hash($password, PASSWORD_BCRYPT, $options);
        $success = $db->registerUser($username, $passCrypt, $email);
    }else{
    	echo "password is too short";
	}
    if($success) {
    	if(!mkdir("upload/".$username)) {
    		logError("Failed to create root directory.", $username);
		}
	}
    return $success;
}

function checkIfWriteableFile($file) {
	$username = $_SESSION['name'];	//TODO checks
	$filename = $file['name'];	//NOTE This is checked later on
    //NOTE See if a file was supplied
    if($file['error'] !== 0) {
        return false;
    }
    $allowedFileTypes = Config::getConfigInstance()->getMimetypes();
    $maxFileSize = 1024 * 1024 * 50;  //NOTE currently 50MB
    $targetFile = "upload/".$username."/".$filename;
    $uploadOk = 0;
    $amountOfChecks = 4;
    //NOTE Check if filename contains illegal chars
	if(checkIllegalCharacters($filename)) {
		$uploadOk++;
	}else{
		echo "Filename is illegal";
	}
    //NOTE Check if file exists already.
    if(!file_exists($targetFile)) {
        $uploadOk++;
    }else{
		echo 'File is not unique in target location';
	}
    //NOTE Check if filesize is OK.
    if($file['size'] <= $maxFileSize) {
        $uploadOk++;
    }else{
    	echo 'File was too large: ' . $file['size'] . ' out of ' . $maxFileSize . 'used.';
	}
    //NOTE Check if the filetype is OK.
	if(in_array($file['type'], $allowedFileTypes)) {
    	$uploadOk++;
	}else{
    	echo 'Filetype is not supported yet';
    	$unsupportedFileTypeError = "Failed to upload file of type: " . $file['type'];
    	logError($unsupportedFileTypeError, $_SESSION['name']);
	}
	//TODO return JSON?
    return ($uploadOk == $amountOfChecks);
}


function saveFile($file) {
	$success = checkIfWriteableFile($file);
	$targetDir = "upload/".$_SESSION['name']."/";

    if($success) {
		$success = move_uploaded_file($file['tmp_name'], $targetDir . $file['name']);
	}
    return $success;
}


function getFiles() {
	$files = null;
	$username = $_SESSION['name'];
	$scanned = scandir("upload/$username");
	array_shift($scanned);
	array_shift($scanned);
	$files = $scanned;
	return $files;
}


function downloadFile($file){
	$fullPath = "upload/".$_SESSION['name']."/".$file;
	//TODO check availibility and ownership
	try {
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
	$success = unlink($path);
	return $success;
}


function renameFile($file, $newname) {
	$success = false;
	if(checkIllegalCharacters($newname)) {
		$path = "upload/" . $_SESSION['name'] . "/" . $file;
		if (!file_exists($path)) {
			$success = rename($path, "upload/" . $_SESSION['name'] . "/" . $newname);
		}
	}
	return $success;
}

/*
 * Returns an <li> with a label + inputfield for the user to specify the value of the setting
 */
function showSettingField($setting) {
	$name = $setting['name'];
	$type = $setting['type'];
	$description = $setting['description'];

	$html = "<li>";
	$html .= "<label for='$name'>$description</label>";
	switch($type) {
		case "bool":
			$html .= "<input type='checkbox' id='$name' name='$name' value='true'>";
			break;
		default:
			//TODO ???
			break;
	}
	$html .= "</li>";
	return $html;
}


function saveSettings($setting, $state) {

}


function createZipFile($files) {
	//NOTE nice guide on zips http://www.9lessons.info/2012/06/creating-zip-file-with-php.html

	$homedir = "upload/" . $_SESSION['name'] . "/";

	$zip = new ZipArchive();
	//NOTE for now, we create a static name, and delete it before recreating it. In home.php, we will manually hide it. Not a good idea, but...
	$zipname = "download.zip"; //$zipname =  date('U') . ".zip";
	removeFile("download.zip");

	$zip->open($homedir . $zipname, ZipArchive::CREATE);

	foreach($files as $file) {
		$zip->addFile($homedir . $file, $file);
	}

	return $zipname;
}


function sanitizeInput($input) {	//Sanitizing input: Altering how the data being saved!!
	$input = trim($input);
	return $input;
}


function sanitizeOutput($output) {	//Sanitizing output: Altering how the data is being displayed
	$altCodes = chr(0xa2) . chr(0xc0);
	$output = str_replace($altCodes, ' ', $output);
	$output = stripslashes($output);
	$output = htmlentities($output, ENT_QUOTES | ENT_DISALLOWED | ENT_HTML5);
	return $output;
}


function logError($errorMessage, $user = '[no user specified]') {
	// THERE'S NO ZONE LIKE COMFORT ZONE
	date_default_timezone_set('Europe/Brussels');

	$data = $user . "\t\t" . date('Y/m/d - H:i') . "\t\t" . $errorMessage . "\n";
	file_put_contents('config/mimeTypes/errorLog.txt', $data,FILE_APPEND);

}

/**
 * @param string $string The string to be validated
 * @return bool $legalFileName True if the string is legal
 */
function checkIllegalCharacters($string) {
	$legalFileName = true;
	$forbiddenCharacters = array('..','/','\\','?');
	foreach($forbiddenCharacters as $illegal) {
		if(is_numeric(strpos($string, $illegal))) {
			$legalFileName = false;
		}
	}
	return $legalFileName;
}





















