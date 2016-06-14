<?php
require_once 'pdo.php';
$error = false;
//$success = false;
$record = "Record inserted";
$stmt = $pdo->query("SELECT * FROM autos");
$autos = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $autos[] = $row;
}
?>


<!DOCTYPE html>
<html>
<head>
<title> Blake Schewe's Autos Page</title>
</head>
<body style="font-family: sans-serif;">
<h1>Tracking Autos for <?= htmlentities($_GET['name']); ?></h1>

<?php
if ($error !== false) {
    echo('<p style="color: red;">'.htmlentities($error)."</p>\n");
} else{
    if(isset($success) && $success == true){
    echo('<p style="color: green;">'.htmlentities($record)."</p>\n"); }
}

if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}
?>

<h2>Automobiles</h2>

<p>
<?php

echo "<ul>";
foreach ($autos as $auto) {  
    echo "<li>";  
    echo htmlentities($auto['year']) . "   ";
    echo htmlentities($auto['make']) . " / "; 
    echo htmlentities($auto['mileage']);
    echo "</li>";
}

?>

<?php
session_start ();
if ( ! isset($_SESSION['name']) ) {
    die('Not logged in');
}

?>

</p>


<a href="autos.php"> Add.php </a>
<a href ="logout.php"> Logout </a>



</p>
</body>
</html>
