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
				//NOTE nested anchor tags are illegal
				$html = "<li><a href='file.php?file=$file&action=download'>";
				$html .= "<h1><i class='fa fa-file fa-gl'></i> $file</h1>";
				$html .= "</a><ul>";
				$html .= "<li><a href='file.php?file=$file&action=rename'><i class='fa fa-pencil fa-gl'></i> Rename</a></li>";
				$html .= "<li><a href='file.php?file=$file&action=delete'><i class='fa fa-trash fa-gl'></i> Delete </a></li>";
				$html .= "</ul></li>";
				echo $html;
			}

			?>
		</ul>
	</div>
<?php

require_once "assets/data/footer.php";


















