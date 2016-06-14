<?php

require_once 'pdo.php';
session_start();

$trackid = $_GET['track_id'];
$stmt = $pdo->prepare("SELECT title, artist, count, rating, length FROM track WHERE track_id = $trackid");
$stmt->execute(array());
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
	$track = $row;
}

if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    exit();
}

if ( isset($_POST['delete']) ) {
	$stmt = $pdo->prepare('DELETE FROM track WHERE track_id = :aid');
    $stmt->execute(array( ':aid' => $_GET['track_id'] ));
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
Are you sure you want to delete  <?= htmlentities($track['title']);?> ?
</p>

<form method="POST">
	<input type="submit" name= "delete" value="Delete">
	<input type="submit" name = "cancel" value="Cancel">
</form>
</body>
</html>