<?php


require_once 'pdo.php';
require_once 'util.php';

session_start();

if ( ! isset($_GET['profile_id']) ) {
    die('ACCESS DENIED');
}

$profile_id = $_GET['profile_id'];
$query = $pdo->query("SELECT * FROM Profile WHERE profile_id=$profile_id ");
$row = $query->fetch(PDO::FETCH_ASSOC);

$positions = loadPos($pdo, $_REQUEST['profile_id']);
$educations = loadEdu($pdo, $_REQUEST['profile_id']);

?>

<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe</title>

<?php require_once "bootstrap.php"; ?>

</head>
<body>
<div class="container">

<h1>Profile information</h1>
<p>First Name:
<?php echo htmlentities($row['first_name']); ?></p>
<p>Last Name:
<?php echo htmlentities($row['last_name']); ?></p>
<p>Email:
<?php echo htmlentities($row['email']); ?></p>
<p>Headline:<br>
<?php echo htmlentities($row['headline']); ?></p>
<p>Summary:<br>
<?php echo htmlentities($row['summary']); ?></p>

<p>Education</p>
<ul>
<?php
foreach( $educations as $education ) {
    echo('<li>'.$education['year'].': '.htmlentities($education['name']).'</li>'."\n");
}
?>
</ul>

<p>Postions</p>
<ul>
<?php
foreach( $positions as $position ) {
    echo('<li>'.$position['year'].': '.htmlentities($position['description']).'</li>'."\n");
}
?>
</ul>

<p>   
<a href="index.php">Done</a>
</p>

</div>
</body>
</html>