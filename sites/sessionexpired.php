<?php
$_SESSION = array();

unset($_SESSION['userID']);
setcookie("userID", @$_POST["userID"], time() - 3600);
setcookie("username", @$_POST["username"], time() - 3600);
setcookie("password", @$_POST["password"], time() - 3600);
setcookie("logincookie", @$_POST["logincookie"], time() - 3600);
session_destroy();
header('Refresh: 1; URL =index.php?menu=home');
?>

<div class="container">
   <h3 class="text-center">Your session expired!</h3>
</div>