<?php

require_once 'pdo.php';
session_start();

$profid= $_GET['profile_id'];
$stmt = $pdo->prepare("SELECT first_name, last_name, email, headline, summary FROM profile WHERE profile_id = $profid");
$stmt->execute(array());
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
	$profid = $row;
}

if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    exit();
}

if ( isset($_POST['delete']) ) {
	$stmt = $pdo->prepare('DELETE FROM profile WHERE profile_id = :aid');
    $stmt->execute(array( ':aid' => $_GET['profile_id'] ));
    $_SESSION['success'] = "Record Deleted";
    header('Location: index.php');
    exit();
}

?>
	
<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe's Delete Page</title>
</head>
<body style="font-family: sans-serif;">

<p>
Are you sure you want to delete this entry?
</p>

<form method="POST">
	<p>
	<input type="submit" name= "delete" value="Delete"><p>
	<input type="submit" name = "cancel" value="Cancel">
</form>
</body>
</html>