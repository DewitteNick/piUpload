<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 28/03/2017
 * Time: 16:27
 */

require_once "assets/data/header.php";

$file = $_GET['file'];

if(checkAvailability($file)) {
    downloadFile($file);
}else{
    redirect('home.php');
}

require_once "assets/data/footer.php";