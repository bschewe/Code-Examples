<?php
	require_once "pdo.php";
    session_start();

$stmt = $pdo->prepare("SELECT first_name, last_name, email, headline, summary FROM profile");
$stmt->execute(array());
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
	$profile = $row;
}



$stmt = $pdo->prepare("SELECT year, description FROM position");
$stmt->execute(array());
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
	$pos = $row;
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


?>

<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe's Profile Information</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!--Optional theme -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous"> 

<!-- Custom styles for this template -->
<link href="starter-template.css" rel="stylesheet"> 

</head>
<body>
<div class="container">
<h1>Profile information for <?php echo $_SESSION['name'];?> </h1>

<?php	if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
 }
?>

<p>
<?php
$statement = $pdo->prepare("select first_name, last_name from PROFILE");
$statement->execute();
$rows = $statement->fetchAll();


echo "Name";
echo ("<li>");
echo htmlentities($profile['first_name']);
echo " ";
echo htmlentities($profile['last_name']);
echo "<br/>";
echo "<br/>";
echo "Email";
echo ("<li>");
echo htmlentities($profile['email']);
echo "<br/>";
echo "<br/>";
echo "Headline";
echo ("<li>");
echo htmlentities($profile['headline']);
echo "<br/>";
echo "<br/>";
echo "Summary";
echo ("<li>");
echo htmlentities($profile['summary']);
echo "<br/>";
echo "<br/>";


echo "Positions";
foreach ($pos as $pose) {
echo ("<li>");
echo htmlentities($pos['year']);
echo ": ";
echo htmlentities($pos['description']);
echo "<br/>";
}
?>


</p>

<p>
<a href="index.php">Done</a>
</p>
</div>
</body>
