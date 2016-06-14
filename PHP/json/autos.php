<?php require_once "pdo.php"; ?>
<?php


session_start();

if ( ! isset($_SESSION['name']) ) {
    die('Name parameter missing');
}

if ( isset($_POST['logout']) ) {
    session_destroy();
    header('Location: index.php');
    exit();
}
    
if ( isset($_POST['make']) && isset($_POST['year'] ) && isset($_POST['mileage'] )) {
    if ( strlen($_POST['make']) < 1) {
        $_SESSION['error'] = 'Name parameter missing';
        header("Location: autos.php");
        return;
    } else {
        if( is_numeric($_POST['year']) && is_numeric($_POST['mileage']) ) {
            $stmt = $pdo->prepare('INSERT INTO autos
                (make, year, mileage) VALUES (:mk, :yr, :mi)');
            $stmt->execute(array(
                ':mk' => $_POST['make'],
                ':yr' => $_POST['year'],
                ':mi' => $_POST['mileage'])
            );
            $_SESSION['success'] = "Record inserted";
            header("Location: autos.php");
            return;
        } else {
            $_SESSION['error'] = 'Mileage and year must be numeric';
            header("Location: autos.php");
            return;
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
// Note triple not equals and think how badly double
// not equals would work here...
if ( isset($_SESSION['error']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
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