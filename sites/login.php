<h4 class="text-center">Please log in.</h4>
<div class="container form-signin login">

    <?php
    $msg = '';

    if (
        isset($_POST['login']) && !empty($_POST['username'])
        && !empty($_POST['password'])
    ) {

        if (
            $_POST['username'] == 'studA' &&
            $_POST['password'] == 'stud1'
        ) {
            $_SESSION['userID'] = '786';
            $_SESSION['login_time'] = time();
            $msg = 'Successful login!';
           header('Refresh: 1; URL = index.php?menu=upload');
        } else if (
            $_POST['username'] == 'studB' &&
            $_POST['password'] == 'stud2'
        ) {
            $_SESSION['userID'] = '793';
            $_SESSION['login_time'] = time();
            $msg = 'Successful login!';
           header('Refresh: 1; URL = index.php?menu=upload');
        } else if (
            $_POST['username'] == 'lektor' &&
            $_POST['password'] == 'lektor999'
        ) {
            $_SESSION['userID'] = '435';
            $_SESSION['login_time'] = time();
            $msg = 'Successful login!';
           header('Refresh: 1; URL = index.php?menu=assignments');
        } else {
            $msg = 'Wrong username or password!';
        }
    }
    
    if (@$_POST['safeit'] == '1') {
        $logincookieduration = 31536000; //valid for 1 year
        setcookie("userID", $_SESSION['userID'], time() + $logincookieduration);
        setcookie("username", $_POST['username'], time() + $logincookieduration);
        setcookie("password", $_POST['password'], time() + $logincookieduration);
        setcookie("logincookie", $logincookieduration, time() + $logincookieduration);
    }
    ?>

</div>

<div class="form-signin">

    <form role="form" action="" method="post">
        <h5 class="text-center"><?php echo $msg; ?></h5>
        <input type="text" class="form-control" name="username" placeholder="username" required autofocus></br>
        <input type="password" class="form-control" name="password" placeholder="passwort" required><br>
        <input type="hidden" name="safeit" value="0" />
        <input type="checkbox" name="safeit" value="1">
        <label for="safeit">Stay logged in!</label>
        <button class="btn btn-lg btn-success btn-block" type="submit" name="login">Login</button>
    </form>

</div>