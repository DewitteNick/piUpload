<?php

require_once "assets/data/header.php";

$settings = array(
	"confirmDelete" => array("name" => "confirmDelete", "type" => "bool", "description" => "Check this to delete files witouth confirmation prompt.", "default" => false)
);


if(empty($_POST)) {
	showSettingsForm($settings);
} else {
	foreach($settings as $setting) {
		//NOTE Determine properties of the setting
		$name = $setting['name'];
		$default = $setting['default'];
		$state = null;
		//NOTE Determine the value of the setting
		if(isset($_POST[$name])){
			$state = $_POST[$name];
		}else{
			$state = $default;
		}
		//NOTE Save the setting with it's value
		$db = Upload_db::getUploadInstance();
		$db->saveSetting($name, $state, $_SESSION['name']);
	}
}



require_once "assets/data/footer.php";