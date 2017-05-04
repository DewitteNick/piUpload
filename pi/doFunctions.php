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
    // $password2 -> $email
    if(strlen($password) >= 13) {
    	$passCrypt = password_hash($password, PASSWORD_BCRYPT, $options);
        $success = $db->registerUser($username, $passCrypt);
    }else{
    	echo "password is too short";
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
    $allowedFileTypes = Config::getConfigInstance()->getMimetypes();
//    $allowedFileTypes = array('image/jpeg','image/png','image/gif','image/bmp','text/plain');

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
	$success = checkFile($file);
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
	/*
    $db = Upload_db::getUploadInstance();
    $files = $db->getAllFiles($_SESSION['name']);
	return $files;
	*/
	$files = $scanned;
	return $files;
}


function checkAvailability($file) {
	$valid = false;
	if (!is_null($file)) {
		if(!is_array($file)) {
			$db = Upload_db::getUploadInstance();
			$valid = $db->checkValidity($file, $_SESSION['name']);
			return $valid;
		}
		foreach($file as $item) {
			$db = Upload_db::getUploadInstance();
			$valid = $db->checkValidity($item, $_SESSION['name']);
			if($valid == false) {
				return $valid;
			}
		}
	}
    return $valid;
}


function downloadFile($file){
	$fullPath = "upload/".$_SESSION['name']."/".$file;
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
	$path = "upload/".$_SESSION['name']."/".$file;
	$success = rename($path, "upload/".$_SESSION['name']."/".$newname);
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

/*
function uploadFile() {
	if(!isset($_FILES['file'])) {    //NOTE user arrives at the page
		showUploadForm();
	} else {    //NOTE user submitted a file

		if(checkFile($_FILES['file'])) {     //NOTE legit file (img at the moment)
			if(saveFile($_FILES['file'])) {  //NOTE upload successfull
				redirect('home.php');
			} else {     //NOTE upload failed after file check
				echo "<p>There was an error processing the file</p>";
				showUploadForm();
			}
		} else {     //NOTE non-allowed file
			echo "<p>File was rejected</p>";
			var_dump($_FILES['file']);
			showUploadForm();
		}

	}

}

*/


























