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

if ( isset($_POST['store']) && isset($_POST['address']) && isset($_POST['best']) && isset($_POST['rating'])) {
    if (! is_numeric($_POST['rating'])) {
        $_SESSION['error'] = "All values are required";
        header("Location: add.php");
        return;
    }
    else if (strlen($_POST['store']) < 1  ) {
        $_SESSION['error'] = "All values are required" ;
        header("Location: add.php");
        return; 
    } 
	else if (strlen($_POST['address']) < 1  ) {
        $_SESSION['error'] = "All values are required" ;
        header("Location: add.php");
        return;
	}	
	else if (strlen($_POST['rating']) < 1  ) {
        $_SESSION['error'] = "All values are required" ;
        header("Location: add.php");
        return;
	}
	else{
		$sql = "INSERT INTO pizza (store, address, best, rating) VALUES (:mk, :md, :yr, :mi)";
		$stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':mk' => $_POST['store'],
			':md' => $_POST['address'],
            ':yr' => $_POST['rating'],
            ':mi' => $_POST['best'])
			
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
<title>Blake Schewe's pizza Tracker</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<h1>Tracking pizza for <?php echo $_SESSION['email']; ?></h1>
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
<p>Store:
<input type="text" name="store" id="store" size="60"/></p>
<p>Address:
<input type="text" name="address" id="address" size="60"/></p>
<p>Rating:
<input type="text" name="rating" id="rating"/></p>
<p>Best:
<input type="text" name="best" id="best"/></p>

<p><input type="submit" value="Add New"/>
<a href="index.php">cancel</a></p>
</form>
</form>
</div>
</body>
</html>
