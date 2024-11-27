<?php
session_start();
$_SESSION['lecturer'] = false;
// 3a) Check if valid lecturer is logged in.
    if(!((isset($_SESSION['userID']) && $_SESSION['userID'] === "435")))
        echo("<h1 class='red'>You are not logged in or not a lecturer.</h1>");
    else
        $_SESSION['lecturer'] = true;

// 3b) Check if session is expired.
    if(isset($_COOKIE["logincookie"])){
        $time = $_COOKIE["logincookie"];
    }
    else{
        $time = 3600;
    }
    if (isset($_SESSION['time']) && (time() - $_SESSION['time']) > $time) {
        include("./sites/sessionexpired.php");
    } else {
        $_SESSION['time'] = time();
}
?>

<?php if($_SESSION['lecturer']) : ?>
<div class="container">
   <div class="row">
      <div class="col-sm">
         <a href="index.php?menu=download"><img class="imgcenter" src="./res/img/download.png" alt="Download image"></a>
      </div>
      <div class="col-9 assignments">
         <?php
            // 3c) Open the uploads directory using an appropriate function, and read its contents
         $uploadsDir = "./uploads/";
         if(is_dir($uploadsDir)){
             $files = scandir($uploadsDir);
             $files = array_diff($files, array('.', '..', '.DS_Store'));
             if(empty($files)){
                 // If no files have been uploaded yet, display "No files uploaded yet." in red font
                 echo ("<h1 class='red'>No files uploaded yet.</h1>");
             }
             else{
                 echo("<ul class='list-group'>");
                 foreach($files as $file){
                     $filepath = $uploadsDir . "/" . $file;
                     // Link each uploaded file. Hint: keep in mind to use the correct path!
                     echo "<li class='list-group-item'> <a href='" . $filepath . "' target='_blank'>" . htmlspecialchars($file) . "</a>";
                     echo " <a class='text-center' href='" . $filepath . "' download>Download</a></li>";
                 }
                 echo("</ul>");
             }
         }
         else
            echo "<p class='red'>Uploads directory not found.</p>";
         ?>
      </div>
   </div>
</div>
<?php endif;?>