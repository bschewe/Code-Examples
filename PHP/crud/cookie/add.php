<?php

include 'pdo.php';
if (!isset($_SESSION)) {
    session_start();
}
if ( ! isset($_SESSION['email']) ) {
    die('ACCESS DENIED');
}

if ( ! isset($_SESSION['name']) || strlen($_SESSION['name']) < 1  ) {
    die('Name parameter missing');
}

// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    exit();
}
if (isset($_POST['mileage']) and isset($_POST['make']) and isset($_POST['year'])){
    if (! is_numeric($_POST['mileage']) || ! is_numeric($_POST['year'])) {
        $_SESSION['failure'] = "Mileage and year must be numeric";
        header("Location: add.php");
        return;
    }
    if (strlen($_POST['make']) < 1  ) {
        $_SESSION['failure'] = "Make is required" ;
        header("Location: add.php");
        return; 
    } else{
        $stmt = $pdo->prepare(htmlentities('INSERT INTO autos (make, year, mileage) VALUES ( :mk, :yr, :mi)'));
        $stmt->execute(array(
            ':mk' => $_POST['make'],
            ':yr' => $_POST['year'],
            ':mi' => $_POST['mileage'])
        );
        $_SESSION['success'] = "Record inserted";
        header("Location: view.php");
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

if (isset($_SESSION['failure'])){ 
    if ( $_SESSION['failure'] !== false ) {
        // Look closely at the use of single and double quotes
        echo '<p style="color: red">'.htmlentities(($_SESSION['failure']))."</p>\n";
        unset($_SESSION['failure']);
    }
}
?>
<form method="post">
<p>Make:
<input type="text" name="make" size="60"/></p>
<p>Model:
<input type="text" name="model" size="60"/></p>
<p>Year:
<input type="text" name="year"/></p>
<p>Mileage:
<input type="text" name="mileage"/></p>
<input type="submit" value="Add">
<input type="submit" name="logout" value="Logout">
</form>
</div>
</body>
</html>
