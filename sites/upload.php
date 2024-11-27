<?php
session_start();
// 2a) Check if valid user is logged in.
if(!isset($_SESSION['userID'])){
    die("You are not logged in!");
    header('location: ./index.php');
}

// 2b) Check if session is expired.
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

<!-- 2c) Put the upload form here-->
    <main class="container my-3 flex-fill">
        <section class="gradient-custom">
            <div class="row justify-content-center align-items-center ">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="fw-bold mb-3 mx-auto text-center">Upload hinzufügen</h2>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="uploadFile" class="form-label">Upload File</label>
                                    <input type="file" class="form-control" id="uploadFile" name="uploadFile"
                                           accept="application/pdf" multiple required>
                                    <div class="text-muted mt-1" id="fileHelp">
                                        <label for="uploadFile">Nur PDF-Datei.</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Post</button>
                            </form>
                            <?php
                                $targetDir = "uploads/";
                                $fileType = "application/pdf";
                                file_upload($targetDir, $fileType);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

        <?php

        function sanitize_input($input) {
            $output = trim($input);
            $output = stripslashes($output);
            $output = htmlspecialchars($output);
            return $output;
        }

// 2d) Put the PHP-Code for handling the file here
// hint: Define useful variables.
// e.g. the target directory, the accepted file type, the file itself, etc.


function file_upload($targetDir, $fileType){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $error = false;
        if (isset($_FILES['uploadFile']) && $_FILES['uploadFile']['error'] == UPLOAD_ERR_OK) {
            $fileDir = $targetDir . $_SESSION['userID'] . "_" . basename($_FILES['uploadFile']['name']);

            // Check if the file is of the accepted file type
            if ($_FILES['uploadFile']['type'] !== $fileType) {
                echo("<h1 class='red'>Sorry, only PDF-files can be accepted!</h1>");
                $error = true;
            }

            // Check if the file size is below the maximum limit
            if ($_FILES['uploadFile']['size'] > 15000000) {
                echo("<h1 class='red'>Size Limit Reached!</h1>");
                $error = true;
            }

            // Check if the file already exists
            if (file_exists($fileDir)) {
                echo("<h1 class='red'>File already exits!</h1>");
                $error = true;
            }

            if (!$error) {
                if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $fileDir))
                    echo("<h1 class='green'>The File " . basename($_FILES['uploadFile']['name']) .  " has been uploaded!" . "</h1>");
                else
                    echo ("<h1 class='red'>File could not be uploaded!</h1>");
            }
        }else {
            echo("<h1 class='red'>File upload failed! Error code: " . $_FILES['uploadFile']['error'] . "</h1>");
        }
    }
}
?>