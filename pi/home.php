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
    echo "<li><a href='download.php?file=$file'>$file</a></li>";
}

?>
</ul>
<?php

require_once "assets/data/footer.php";