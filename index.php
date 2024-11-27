<?php
session_start();
if (isset($_COOKIE["logincookie"])) {
    $login_session_duration = $_COOKIE["logincookie"];
} else {
    $login_session_duration = 3600; // 1 hour
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="res/css/stylesheet.css">
    <title>Assignment-Manager</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
        <a class="navbar-brand"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="mainNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item navcenter"><a class="nav-link" href="index.php?menu=home">Home</a></li>
                <?php if (@$_SESSION['userID'] == '786' or @$_SESSION['userID'] == '793' or @$_SESSION['userID'] == '435') { ?>
                    <li class="nav-item navcenter"><a class="nav-link" href="index.php?menu=upload">Upload</a></li>
                    <li class="nav-item navcenter"><a class="nav-link" href="index.php?menu=assignments">Assignments</a></li>
                    <li class="nav-item navcenter"><a class="nav-link" href="index.php?menu=logout">Logout</a></li>
                <?php } else { ?>
                    <li class="nav-item navcenter"><a class="nav-link" href="index.php?menu=login">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <header>
        <div class="container jumbotron">
            <br>
            <h1 class="display-4">Assignment-Manager</h1>
            <p class="lead">Webtechnologien</p>
            <?php

            $menu = @$_GET['menu'];
            if (@$_SESSION['userID'] == '786' or @$_SESSION['userID'] == '793' or @$_SESSION['userID'] == '435') {
                echo 'Sie sind eingeloggt. &#9989;';
            } else echo '';

            switch ($menu) {
                case 'assignments':
                    echo "<h2 class='text-center'>Assignments</h2>";
                    break;
                case 'upload':
                    echo "<h2 class='text-center'>Upload</h2>";
                    break;
            }
            ?>
        </div>
    </header>
    <main>
        <?php
        // All PHP-Pages are included using "include"
        switch ($menu) {
            case 'login':
                include 'sites/login.php';
                break;
            case 'assignments':
                include 'sites/assignments.php';
                break;
            case 'logout':
                include 'sites/logout.php';
                break;
            case 'upload':
                include 'sites/upload.php';
                break;
            case 'download':
                include 'sites/download.php';
                break;
            case 'sessionexpired':
                include 'sites/sessionexpired.php';
                break;
        }

        if (isset($_COOKIE["username"]) and isset($_COOKIE["password"]) and isset($_COOKIE["logincookie"])) {
            $_SESSION['userID'] = $_COOKIE["userID"];
        }


        if ($menu == 'home') {
            ?>
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <a href="index.php?menu=upload"><img class="imgcenter" src="res/img/upload.png" alt="Upload image"></a>
                        </div>
                        <div class="col-9 assignments">
                            <p>Welcome to the Assignment Manager. Students can upload their homework assignments here
                                and teachers can view and download them.
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>

    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>