<?php // Do not put any HTML above this line
session_start();

if ( isset($_POST['cancel'] ) ) {
   
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  

$failure = false;  
if ( isset($_POST['who']) && isset($_POST['pass']) ) {
    if ( strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1 ) {
        $failure = "Email and password are required";
    } elseif ( strpos($_POST['who'], "@") == false ) {
            $failure = "Email must have an at-sign (@)";
    } else {
        $check = hash('md5', $salt.$_POST['pass']); //$md5 = hash('md5', 'XyZzy12*_php123')
        if ( $check == $stored_hash ) {
            // Redirect the browser to autos.php // $check changed to $md5
		$_SESSION['name'] = $_POST['email'];
		header("Location: view.php");
		return;
            exit();
        } else {
            $failure = "Incorrect password";
            error_log("Login fail ".$_POST['who']." $check");
        }
    }
}


// Fall through into the View
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

if ( $failure !== false ) {
    
    echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
}
?>
<form method="POST">
<label for="nam">Email</label>
<input type="text" name="who" id="nam"><br/>
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




