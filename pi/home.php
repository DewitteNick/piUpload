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

?>
<ul>
<?php

foreach($files as $file) {
    echo "<li><a href='file.php?file=$file&action=download'>$file</a><a href='file.php?file=$file&action=delete'>Delete</a></li>";
}

?>
</ul>
<?php

require_once "assets/data/footer.php";