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

if ( isset($_POST['title']) && isset($_POST['artist']) && isset($_POST['count']) && isset($_POST['rating']) && isset($_POST['length'])) {
    if (! is_numeric($_POST['rating'])) {
        $_SESSION['error'] = "All values are required";
        header("Location: add.php");
        return;
    }
    else if (strlen($_POST['title']) < 1  ) {
        $_SESSION['error'] = "All values are required" ;
        header("Location: add.php");
        return; 
    } 
	else if (strlen($_POST['artist']) < 1  ) {
        $_SESSION['error'] = "All values are required" ;
        header("Location: add.php");
        return;
	}	
	else if (strlen($_POST['rating']) < 1  ) {
        $_SESSION['error'] = "All values are required" ;
        header("Location: add.php");
        return;
	}	
	else if (strlen($_POST['length']) < 1  ) {
        $_SESSION['error'] = "All values are required" ;
        header("Location: add.php");
        return;
	}
	else{
		$sql = "INSERT INTO track (title, artist, rating, count, length) VALUES (:mk, :md, :yr, :mi, :ln)";
		$stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':mk' => $_POST['title'],
			':md' => $_POST['artist'],
            ':yr' => $_POST['rating'],
            ':mi' => $_POST['count'],
			':ln' => $_POST['length']
			)
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
<title>Blake Schewe's Track Database</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<h1>Tracking tracks for <?php echo $_SESSION['email']; ?></h1>
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
<p>Title:
<input type="text" name="title" id="title" size="60"/></p>
<p>Artist:
<input type="text" name="artist" id="artist" size="60"/></p>
<p>Rating:
<input type="text" name="rating" id="rating"/></p>
<p>Count:
<input type="text" name="count" id="count"/></p>
<p>Length:
<input type="text" name="length" id="length"/></p>

<p><input type="submit" value="Add New"/>
<a href="index.php">cancel</a></p>
</form>
</form>
</div>
</body>
</html>
