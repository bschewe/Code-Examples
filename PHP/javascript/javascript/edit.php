<?php
require_once "pdo.php";
session_start();

$profile = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT first_name, last_name, email, headline, summary, profile_id FROM profile");

$stmt->execute(array());
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
    $profile = $row;
}

if (isset($_POST['cancel']) ){
    header('Location:index.php');
    exit();
}
if ( isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])) {

    if ((strlen($_POST['first_name']) < 1) || (strlen($_POST['last_name']) < 1) || (strlen($_POST['email']) < 1) || (strlen($_POST['headline']) < 1)) {
        $_SESSION['failure']= "All fields are required";
        header("Location: add.php");
        exit();
    } 
	else if (preg_match('/@/i', $_POST['email']) === 0)
	{
		$_SESSION['failure'] = "Email must have an at sign (@)";
		header("Location: edit.php");
		return;
	}
	else {
        $sql = "UPDATE profile SET first_name = :fn, last_name = :ln, email = :em , headline = :hl, summary= :sm WHERE user_id = :ui";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
		':hl' => $_POST['headline'],
        ':ui' => $_SESSION['user_id'],
        ':sm' => $_POST['summary']));
        $_SESSION['success'];
        header( 'Location: index.php' ) ;
        return;

$stmt = $pdo->prepare("SELECT * FROM profile where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_SESSION['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ( $row === false ) {
    $_SESSION['failure'] = 'Bad value for profile_id';
    header( 'Location: index.php' ) ;
    return;
}
}
}
?>

<h1>Editing Entry</h1>
<?php
$fn = htmlentities($profile['first_name']);
$ln = htmlentities($profile['last_name']);
$em = htmlentities($profile['email']);
$hl = htmlentities($profile['headline']);
$sm = htmlentities($profile['summary']);
$profile_id = htmlentities($profile['profile_id']);


if (isset($_SESSION['failure'])){
  echo('<p style="color: red;">'.htmlentities($_SESSION['failure'])."</p>\n");
  unset ($_SESSION['failure']);
}
?>
<form method="post">
<p>First Name:
<input type="text" name="first_name" value="<?= $fn ?>"></p>
<p>Last Name:
<input type="text" name="last_name" value="<?= $ln ?>"></p>
<p>Email:
<input type="text" name="email" value="<?= $em ?>"></p>
<p>Headline:
<input type="text" name="headline" value="<?= $hl ?>"></p>
<p>Summary:
<input type="text" name="summary" value="<?= $sm ?>"></p>
<input type="hidden" name="profile_id" value="<?= $profile_id ?>">
<input type="submit" name= "save" value="Save"/> <input type="submit" name="cancel" value="Cancel"/></p>
</form>
