<?php require_once "pdo.php"; ?>
<?php

session_start();

if ( ! isset($_SESSION['name']) ) {
    die('ACCESS DENIED');
}

if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    exit();
}

if ( isset($_POST['delete']) ) {
    $stmt = $pdo->prepare('DELETE FROM Profile WHERE profile_id=:id');
    $stmt->execute(array(
                ':id' => $_POST['profile_id'])
    );
    $_SESSION['success'] = "Record deleted";
    header("Location: index.php");
    return;
} 

if ( ! isset($_GET['profile_id']) ) {
    $_SESSION['error'] = "Missing profile_id";
    header("Location: index.php");
    return;
}

$profile_id = $_GET['profile_id'];
$query = $pdo->query("SELECT * FROM Profile WHERE profile_id=$profile_id ");
$row = $query->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe</title>

<?php require_once "bootstrap.php"; ?>

</head>
<body>
<div class="container">
<h1>Deleteing Profile</h1>
<form method="post" action="delete.php">
<p>First Name:
<?php echo htmlentities($row['first_name']); ?></p>
<p>Last Name:
<?php echo htmlentities($row['last_name']); ?></p>
<input type="hidden" name="profile_id" value="<?php echo htmlentities($row['profile_id']); ?>">
<input type="submit" name="delete" value="Delete">
<input type="submit" name="cancel" value="Cancel">
<p></p>
</form>
</div>
</body>
</html>