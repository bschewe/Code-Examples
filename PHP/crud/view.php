<?php
	require_once "pdo.php";
    session_start();

$stmt = $pdo->prepare("SELECT make, model, mileage, year FROM autos");
$stmt->execute(array());
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
	$autos = $row;
}

if ( ! isset($_SESSION['name']) || strlen($_SESSION['name']) < 1  ) {
    die('Name parameter missing');
}

if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    exit();
}

if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}


if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])) {
	$_SESSION['make']=$_POST['make'];
	$_SESSION['model'] =$_POST['model'];
	$_SESSION['year']=$_POST['year'];
	$_SESSION['mileage']=$_POST['mileage'];
	header("Location: add.php");
	return;
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe's Automobile Tracker</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!--Optional theme -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous"> 

<!-- Custom styles for this template -->
<link href="starter-template.css" rel="stylesheet"> 

</head>
<body>
<div class="container">
<h1>Tracking Autos for <?php echo $_SESSION['name'];?> </h1>

<?php	if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
 }
?>

<p>
<?php
$statement = $pdo->prepare("select * from autos");
$statement->execute();
$rows = $statement->fetchAll();


foreach ($rows as $row){
echo ("<li>");
echo htmlentities($row['make']);
echo " ";
echo htmlentities($row['model']);
echo " / ";
echo htmlentities($row['year']);
echo "/";
echo htmlentities($row['mileage']);
echo "<br/>";
 }
?>


</p>

<p>
<a href="add.php">Add New</a> |
<a href="view.php">Cancel</a>
</p>
</div>
</body>
