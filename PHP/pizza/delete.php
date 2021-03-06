<?php

require_once 'pdo.php';
session_start();

$pizzaid = $_GET['pizza_id'];
$stmt = $pdo->prepare("SELECT store, address, best, rating FROM pizza WHERE pizza_id = $pizzaid");
$stmt->execute(array());
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
	$pizza = $row;
}

if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    exit();
}

if ( isset($_POST['delete']) ) {
	$stmt = $pdo->prepare('DELETE FROM pizza WHERE pizza_id = :aid');
    $stmt->execute(array( ':aid' => $_GET['pizza_id'] ));
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
Are you sure you want to delete  <?= htmlentities($pizza['store']);?> ?
</p>

<form method="POST">
	<input type="submit" name= "delete" value="Delete">
	<input type="submit" name = "cancel" value="Cancel">
</form>
</body>
</html>