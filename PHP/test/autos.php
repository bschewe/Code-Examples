<?php
session_start ();
require_once 'pdo.php';
$error = false;
//$success = false;
$record = "Record inserted";
$stmt = $pdo->query("SELECT * FROM autos");
$autos = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $autos[] = $row;
}

if (! isset($_GET['name']) ) {
    die("Name Parameter Missing");
}

//go back to index.php when users requests to go back to index.php
if ( isset($_POST['logout']) ) {
    unset($_GET['name']);
    $_GET['autos'] = array();
    header('Location: index.php');
    exit();
}


if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
    if (strlen($_POST['make']) <1){
        $error = "Make is required";
    }
    else {
        if (is_numeric($_POST['year']) && is_numeric($_POST['mileage'])) {
            $stmt=$pdo->prepare('INSERT INTO autos
                (make, year, mileage) VALUES (:mk, :yr, :mi)');
            $stmt->execute(array(
                ':mk' => $_POST['make'],
                ':yr' => $_POST['year'],
                ':mi' => $_POST['mileage'])
            );
            $success = true;
        }
        else {
            $error = "Mileage and year must be numeric";
        }
    }
}
$_SESSION['success'] = "Record inserted";
header("Location: view.php");
return;


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
?>

<form method="POST" >
<p>
<label for="make">Make:</label>
<input type="text" name="make" size="60"><br/>
</p>
<p>
<label for="year">Year:</label>
<input type="text" name="year"><br/>
</p>
<p>
<label for="mileage">Mileage:</label>
<input type="text" name="mileage" id="mileage">
</p>

<input type="submit" name="add" value="Add">
<input type="submit" name="logout" value="Logout">
</form>



</p>
</body>
</html>