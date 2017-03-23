<?php

require_once "assets/data/header.php";

$db = Upload_db::getUploadInstance();
$db->closeConnection();

session_unset();

redirect('index.php');


require_once "assets/data/footer.php";