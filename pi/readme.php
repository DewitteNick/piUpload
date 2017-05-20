<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 06/05/2017
 * Time: 19:04
 */

require_once "assets/data/header.php";


$readmeNotes = array(
	"When using android to download an empty file, you might get an \"[FILENAME] download failed due to an unknown error\". The download succeeded, but appears failed because a lack of content.",
	"There is a log that keeps track of file-upload attempts that failed due to an untrusted file type. This means that filetypes might get supported in the future."
);

echo "<div><ul>";

foreach($readmeNotes as $note) {
	echo "<li>$note</li>";
}

echo "</ul></div>";


require_once "assets/data/footer.php";
