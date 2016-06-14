<?phpxx`xml_error_string

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['email'])){
    $_SESSION['email'] = $_POST['email'];
}

if ( isset($_POST['cancel'] ) ) {
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Password is php123

$failure = false;

if ( isset($_POST['email']) && isset($_POST['pass']) ) {
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {
        $_SESSION['failure'] = "User name and password are required";
        header("Location: login.php");
        return;
    }
    if (preg_match('/@/i', $_POST['email']) === 0 ) {
        $_SESSION['failure'] = "Email must have an at-sign (@)";
        header("Location: login.php");
        return;
    }
     else {
        $check = hash('md5', $salt.$_POST['pass']);
        if ( $check == $stored_hash ) {
            header("Location: view.php?name=".urlencode(htmlentities($_POST['email'])));
            $_SESSION['name'] = $_SESSION['email'];
            error_log("Login success ".htmlentities($_POST['email']."\n"));
            exit();
        } else {
            $_SESSION['failure'] = "Incorrect password";
            error_log("Login fail ".htmlentities($_POST['email'])." $check". "\n");
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "bootstrap.php"; ?>
<title>Blake Schewe's Login Page</title>
</head>
<body>
<div class="container">
<h1>Please Log In</h1>
<?php

if ( isset($_SESSION['failure']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['failure'])."</p>\n");
    unset($_SESSION['failure']);
}
?>
<form method="POST">
<label for="nam">User Name</label>
<input type="text" name="email" id="nam"><br/>
<label for="id_1723">Password</label>
<input type="text" name="pass" id="id_1723"><br/>
<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>
For a password hint, view source and find a password hint
in the HTML comments.
<!-- Hint: The password is php123. -->
</p>
</div>
</body>
