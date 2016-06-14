<?php
if (!isset($_SESSION)) {
    session_start();
}

include 'pdo.php';

if ( ! isset($_SESSION['email']) ) {
    die('Not logged in');
}

if ( ! isset($_SESSION['name']) || strlen($_SESSION['name']) < 1  ) {
    die('Name parameter missing');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    header('Location: logout.php');
    exit();
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

<h2>Automobiles</h2>
<?php if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}
?>

<pre>
    <ul>
<?php 
   $autoarray = $pdo->query('SELECT * FROM autos')->fetchAll();
   foreach ($autoarray as $value) {
       echo "<li>".htmlentities($value['year']).' '. htmlentities($value['make']).' '. htmlentities($value['mileage']) ."</li>";
   }
?>
    </ul>
</pre>
<p>
<a href="add.php">Add New</a> |
<a href="logout.php">Logout</a>
</p>
</div>
</body>
</html>
