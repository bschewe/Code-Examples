<?php require_once "pdo.php"; ?>
<?php

if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}

if ( isset($_POST['logout']) ) {
	$pdo->query('DELETE FROM autos');
    header('Location: index.php');
    exit();
}
$failure = false;
$success = false;
	
if ( isset($_POST['make']) && isset($_POST['year'] ) && isset($_POST['mileage'] )) {
    if ( strlen($_POST['make']) < 1) {
    	$failure = 'Make is required';
    } else {
    	if( is_numeric($_POST['year']) && is_numeric($_POST['mileage']) ) {
    		$stmt = $pdo->prepare('INSERT INTO autos
		        (make, year, mileage) VALUES (:mk, :yr, :mi)');
		    $stmt->execute(array(
		        ':mk' => $_POST['make'],
		        ':yr' => $_POST['year'],
		        ':mi' => $_POST['mileage'])
		    );
    		$success = 'Record inserted';
    	} else {
    		$failure = 'Mileage and year must be numeric';
    	}
    }
}



?>

<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe</title>

<?php require_once "bootstrap.php"; ?>

</head>
<body>
<div class="container">
<h1>Tracking Autos for <?php echo(htmlentities($_GET['name'])); ?></h1>
<?php

if ( $failure !== false ) {

    echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
}
if ( $success !== false ) {

    echo('<p style="color: green;">'.htmlentities($success)."</p>\n");
}
?>
<form method="post">
<p>Make:
<input type="text" name="make" size="60"/></p>
<p>Year:
<input type="text" name="year"/></p>
<p>Mileage:
<input type="text" name="mileage"/></p>
<input type="submit" value="Add">
<input type="submit" name="logout" value="Logout">
</form>

<h2>Automobiles</h2>
<ul>
<p></p>
<?php
	foreach ($stmt = $pdo->query('SELECT * FROM autos') as $row) {
		print "<li>" . htmlentities($row['year']) . " ";
		print htmlentities($row['make']) . " ";
		print "/ " . htmlentities($row['mileage']) . "</li>\n";
	}
?>
</ul>
</div>
</body>
</html>