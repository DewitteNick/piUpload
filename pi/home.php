<?php

require_once "assets/data/header.php";

?>

	<nav>
		<ul class="inlineList">
			<li>
				<a href="upload.php"><i class="fa fa-cloud-upload fa-lg"></i> Upload </a>
			</li>
			<li>
				<a href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Sign out </a>
			</li>
		</ul>
	</nav>

<?php

$files = getFiles();

?>
	<div id="fileList">
		<ul>
			<?php

			foreach ($files as $file) {
				$html = "<li>";
				$html .= "<h1>$file</h1>";
				$html .= "<ul class='inlineList'>";
				$html .= "<li><a href='file.php?file=$file&action=download' class='download'><i class='fa fa-download fa-lg'></i> Download </a></li>";
				$html .= "<li><a href='file.php?file=$file&action=delete' class='delete'><i class='fa fa-trash fa-lg'></i> Delete </a></li>";
				$html .= "</ul></li>";
				echo $html;
			}

			?>
		</ul>
	</div>
<?php

require_once "assets/data/footer.php";