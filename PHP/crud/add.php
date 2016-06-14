<?php
require_once "pdo.php";
session_start();

if (! isset($_SESSION['email'])){
  die('ACCESS DENIED');
}

if (isset($_POST['cancel']) ){
  header('Location: index.php');
 exit();
}

if ( isset($_POST['make']) && isset($_POST['model']) && isset($_POST['mileage']) && isset($_POST['year'])) {
    if (! is_numeric($_POST['mileage']) || ! is_numeric($_POST['year'])) {
        $_SESSION['error'] = "All values are required";
        header("Location: add.php");
        return;
    }
    else if (strlen($_POST['make']) < 1  ) {
        $_SESSION['error'] = "All values are required" ;
        header("Location: add.php");
        return; 
    } 
	else if (strlen($_POST['model']) < 1  ) {
        $_SESSION['error'] = "All values are required" ;
        header("Location: add.php");
        return;
	}	
	else if (strlen($_POST['year']) < 1  ) {
        $_SESSION['error'] = "All values are required" ;
        header("Location: add.php");
        return;
	}
	else{
		$sql = "INSERT INTO autos (make, model, mileage, year) VALUES (:mk, :md, :yr, :mi)";
		$stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':mk' => $_POST['make'],
			':md' => $_POST['model'],
            ':yr' => $_POST['year'],
            ':mi' => $_POST['mileage'])
			
        );
        $_SESSION['success'] = "Added";
        header("Location: index.php");
        return;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe's Autos Tracker</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<h1>Tracking Autos for <?php echo $_SESSION['email']; ?></h1>
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
<p>Make:
<input type="text" name="make" id="make" size="60"/></p>
<p>Model:
<input type="text" name="model" id="model" size="60"/></p>
<p>Year:
<input type="text" name="year" id="year"/></p>
<p>Mileage:
<input type="text" name="mileage" id="mileage"/></p>

<p><input type="submit" value="Add New"/>
<a href="index.php">cancel</a></p>
</form>
</form>
</div>
</body>
</html>
