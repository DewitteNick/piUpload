<?php

require_once "assets/data/header.php";

if(!isset($_FILES['file'])) {    //NOTE user arrives at the page
    showUploadForm();
} else {    //NOTE user submitted a file

   if(checkFile($_FILES['file'])) {     //NOTE legit file (img at the moment)
       if(saveFile($_FILES['file'])) {  //NOTE upload successfull
           redirect('home.php');
       } else {     //NOTE upload failed after file check
           echo "<p>There was an error processing the file</p>";
           showUploadForm();
       }
   } else {     //NOTE non-allowed file
       echo "<p>File was rejected</p>";
       var_dump($_FILES['file']);
       showUploadForm();
   }
/**/
}

require_once "assets/data/footer.php";