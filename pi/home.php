<?php

require_once "assets/data/header.php";

?>

    <ul>
        <li>
            <a href="upload.php">Upload</a>
        </li>
        <li>
            <a href="logout.php">Logout</a>
        </li>
    </ul>

<?php

$files = getFiles();

var_dump($files);

/*
foreach(getFiles() as $file) {
    echo "<p>FILE:</p>";
    var_dump($file);
}
/**/

require_once "assets/data/footer.php";