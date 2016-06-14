<?php


require_once 'pdo.php';

session_start();


if ( ! isset($_SESSION['user_id']) ) {
    die("ACCESS DENIED");
    return;
}

if ( isset($_POST['cancel']) ) {
    header('Location: index.php');
    return;
}


if ( ! isset($_REQUEST['profile_id']) ) {
    $_SESSION['error'] = "Missing profile_id";
    header('Location: index.php');
    return;
}


$stmt = $pdo->prepare('SELECT * FROM Profile
    WHERE profile_id = :prof AND user_id = :uid');
$stmt->execute(array( ':prof' => $_REQUEST['profile_id'], 
    ':uid' => $_SESSION['user_id']));
$profile = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $profile === false ) {
    $_SESSION['error'] = "Could not load profile";
    header('Location: index.php');
    return;
}

if ( isset($_POST['delete']) ) {

    $stmt = $pdo->prepare('DELETE FROM Profile
        WHERE profile_id = :prof AND user_id = :uid');
    $stmt->execute(array( ':prof' => $_REQUEST['profile_id'], 
        ':uid' => $_SESSION['user_id']));
    $_SESSION['success'] = "Profile deleted";
    header("Location: index.php");
    return;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe's Profile Add</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
<?php
if ( isset($_SESSION['error']) ) {
    echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}
?>
<h1>Deleteing Profile</h1>
<form method="post" action="delete.php">
<p>First Name:
<?= htmlentities($profile['first_name']); ?>
</p>
<p>Last Name:
<?= htmlentities($profile['last_name']); ?>
</p>
<input type="hidden" name="profile_id"
value="<?= htmlentities($_REQUEST['profile_id']); ?>"
/>
<input type="submit" name="delete" value="Delete">
<input type="submit" name="cancel" value="Cancel">
</p>
</form>
</div>
</body>
</html>
