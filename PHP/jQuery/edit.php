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
    $stmt = $pdo->prepare('UPDATE Profile SET
        first_name=:fn, last_name=:ln,
        email=:em, headline=:he, summary=:su
        WHERE profile_id=:pid AND user_id=:uid');
    $stmt->execute(array(
        ':pid' => $_REQUEST['profile_id'],
        ':uid' => $_SESSION['user_id'],
        ':fn' => $_POST['first_name'],
        ':ln' => $_POST['last_name'],
        ':em' => $_POST['email'],
        ':he' => $_POST['headline'],
        ':su' => $_POST['summary'])
    );
        $_SESSION['success'];
        header( 'Location: index.php' ) ;
        return;
		
		    // Clear out the old position entries
		$stmt = $pdo->prepare('DELETE FROM Position
			WHERE profile_id=:pid');
		$stmt->execute(array( ':pid' => $_REQUEST['profile_id']));

		// Insert the position entries
		$rank = 1;
		for($i=1; $i<=9; $i++) {
			if ( ! isset($_POST['year'.$i]) ) continue;
			if ( ! isset($_POST['desc'.$i]) ) continue;
			$year = $_POST['year'.$i];
			$desc = $_POST['desc'.$i];

			$stmt = $pdo->prepare('INSERT INTO Position
				(profile_id, rank, year, description)
			VALUES ( :pid, :rank, :year, :desc)');
			$stmt->execute(array(
				':pid' => $_REQUEST['profile_id'],
				':rank' => $rank,
				':year' => $year,
				':desc' => $desc)
			);
			$rank++;
		}

    $_SESSION['success'] = "Profile updated";
    header("Location: index.php");
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

<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe's Profile Edit</title>
<?php require_once "bootstrap.php"; ?>
</head>

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


Position: <input type="submit" id="addPos" value="+">
<div id="position_fields">
</div>
</p>
<input type="submit" name= "save" value="Save"/> <input type="submit" name="cancel" value="Cancel"/>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui-1.11.4.js"></script>
<script>
function doValidate() {
    console.log('Validating...');
    try {
        addr = document.getElementById('email').value;
        pw = document.getElementById('id_1723').value;
        console.log("Validating addr="+addr+" pw="+pw);
        if (addr == null || addr == "" || pw == null || pw == "") {
            alert("Both fields must be filled out");
            return false;
        }
        if ( addr.indexOf('@') == -1 ) {
            alert("Invalid email address");
            return false;
        }
        return true;
    } catch(e) {
        return false;
    }
    return false;
}

countPos = 0;

// http://stackoverflow.com/questions/17650776/add-remove-html-inside-div-using-javascript
$(document).ready(function(){
    window.console && console.log('Document ready called');
    $('#addPos').click(function(event){
        // http://api.jquery.com/event.preventdefault/
        event.preventDefault();
        if ( countPos >= 9 ) {
            alert("Maximum of nine position entries exceeded");
            return;
        }
        countPos++;
        window.console && console.log("Adding position "+countPos);
        $('#position_fields').append(
            '<div id="position'+countPos+'"> \
            <p>Year: <input type="text" name="year'+countPos+'" value="" /> \
            <input type="button" value="-" \
                onclick="$(\'#position'+countPos+'\').remove();return false;"></p> \
            <textarea name="desc'+countPos+'" rows="8" cols="80"></textarea>\
            </div>');
    });
});
</script>
</form>










