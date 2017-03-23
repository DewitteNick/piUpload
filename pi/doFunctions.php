<?php

function checkLogin($name, $pass) {
    $db = Upload_db::getUploadInstance();
    $valid = $db->checkLogin($name, $pass);
    $db->closeConnection();
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
    $db->closeConnection();
    return $success;
}

function checkFile($file) {
    //NOTE See if a file was supplied
    if($file['error'] !== 0) {
        return false;
    }
    $allowedFileTypes = array('image/jpeg','image/png','image/gif','image/bmp');
    $maxFileSize = 2000000000;  //NOTE php file size? (=> this is 2 GB)
    $targetFile = "upload/".$file['name'];
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

    return true;    //TODO remove this
}


function saveFile($file) {
    //TODO add file to sql
    $db = Upload_db::getUploadInstance();
    $db->addFile($file);
    $targetDir = "upload/";
    $success = move_uploaded_file($file['tmp_name'], $targetDir.$file['name']);
    $db->closeConnection();
    return $success;
}


function getFiles() {
    $db = Upload_db::getUploadInstance();
    $files = $db->getAllFiles($_SESSION['name']);
    $db->closeConnection();
    return $files;
}
































