<?php

require_once "assets/data/header.php";

?>

	<nav class="cf" id="navigation">
		<a href="" id="menuDropper"><i class="fa fa-caret-square-o-down fa-rotate-180 fa-3x"></i></a>
		<ul id="menu">
			<li>
				<a href="file.php"><i class="fa fa-cloud-upload fa-lg"></i> Upload </a>
			</li>
			<li>
				<a href="settings.php"><i class="fa fa-gear fa-lg"></i> Settings </a>
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
		<form method="get" action="file.php">
			<input type="submit" value="Delete selected" id="massDelete" class="massButton" name="action"/>
			<input type="submit" value="Download selected" id="massDownload" class="massButton" name="action0"/>
			<ul>
				<?php

				foreach ($files as $file) {
					//NOTE nested anchor tags are illegal
					if($file != "download.zip") {	//NOTE bad practice.... really bad... fix this somehow...
						$html = "<li class='cf' id='$file'><input type='checkbox' name='file[]' value='$file' class='selector'>";

						$html .= "<a href='file.php?file=$file'>";
						$html .= "<h1><i class ='fa ";
						/*
						Switch over the icon depending on the kind of file
						getIconClass($file['filetype']);
						*/
						$html .= "fa-file";

						$html .= " fa-gl'></i> <span>$file</span></h1>";
						$html .= "</a><ul>";
						$html .= "<li><a href='#' class='renameButton'><i class='fa fa-pencil fa-gl'></i> Rename</a></li>";
						$html .= "<li><a href='#' class='deleteButton'><i class='fa fa-trash fa-gl'></i> Delete </a></li>";
						$html .= "</ul></li>";
						echo $html;
					}
				}

				?>
			</ul>
		</form>
		<!--<a href="#" class="fa fa-plus fa-lg" id="addFolder">Add a folder</a>-->
	</div>
<?php

require_once "assets/data/footer.php";


















