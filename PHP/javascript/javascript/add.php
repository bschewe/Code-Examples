<?php
require_once "pdo.php";
session_start();


if (isset($_POST['cancel']) ){
  header('Location: index.php');
 exit();
}
if ( isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])) {
    if ((strlen($_POST['first_name']) < 1) || (strlen($_POST['last_name']) < 1) || (strlen($_POST['email']) < 1) || (strlen($_POST['headline']) < 1) || (strlen($_POST['summary']) < 1) ) {
        $_SESSION['failure'] = "All fields are required." ;
        header("Location: add.php");
        return; 
    }
else if (preg_match('/@/i', $_POST['email']) === 0)
{
	$_SESSION['failure'] = "Email must have an at sign (@)";
	header("Location: add.php");
	return;
}
	
else{
	$sql = "INSERT INTO profile (user_id, first_name, last_name, email, headline, summary) VALUES (:ui, :fn, :ln, :em, :hl, :sm)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array(
		':ui' => $_SESSION['user_id'],
		':fn' => $_POST['first_name'],
		':ln' => $_POST['last_name'],
		':em' => $_POST['email'],
		':hl' => $_POST['headline'],
		':sm' => $_POST['summary'],)
	);
	$_SESSION['success'] = "Record inserted";
	header("Location: index.php");
	return;
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe's Profile Add</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<h1>Adding Profile for <?php echo $_SESSION['email']; ?></h1>
<?php

if (isset($_SESSION['error'])){
  echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
  unset ($_SESSION['error']);
}

if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}

?>
<form method="post">
<p>First Name:
<input type="text" name="first_name" id="first_name" size="60"/></p>
<p>Last Name:
<input type="text" name="last_name" id="last_name" size="60"/></p>
<p>Email:
<input type="email" name="email" id="email" size="30"/></p>
<p>Headline:<br/>
<input type="text" name="headline" id="headline"size="80"/></p>
<p>Summary:<br/>
<textarea name="summary" rows="8" id="summary" cols="80">
</textarea>
<p>
<input type="submit" value="Add">
<input type="submit" name="cancel" value="Cancel">
</p>

<p><input type="submit" value="Add New"/>
<a href="index.php">Cancel</a></p>
</form>
</form>
</div>
</body>
</html>
