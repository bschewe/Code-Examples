<?php

require_once 'pdo.php';
require_once "bootstrap.php";
session_start();

?>


<!DOCTYPE html>

<html>
<head>
<title>Blake Schewe's Resume Registry</title>
</head>
<h1>Welcome to Blake Schewe's Resume Registry</h1>

<p>
<?php

if (isset($_SESSION['failure'])){
	echo('<p style="color: red;">'.htmlentities($_SESSION['failure'])."</p>\n");
	unset ($_SESSION['failure']);
}

if ( isset($_SESSION['success']) ) {
    echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
    unset($_SESSION['success']);
}

if ( ! isset($_SESSION['email']) ) {
	$target = "login.php";
	echo ("<a href=$target>Please log in</a>");
} 
else {
	if (isset($_SESSION['email']) ){
		$stmt = $pdo->prepare('SELECT first_name, last_name, headline, summary, user_id FROM profile');
		$stmt->execute(array() );
		$profile = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
			$profile[] = $row;
		}
		if (count($profile) < 1){
			echo "No rows found";
		} else{
			echo ('<table border="1">'."\n");

?>
</p>
<p>
	<tbody>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Headline</th>
			<th>Summary</th>
			<th>Action</th>
		</tr>
<?php

?>
		
<?php
	foreach ($profile as $profiles) {  
	echo("<tr><td>");
    echo($profiles['first_name']);
    echo("</td><td>");
    echo($profiles['last_name']);
    echo("</td><td>");
    echo($profiles['headline']);
    echo("</td><td>");
    echo($profiles['summary']);
   	echo("</td><td>");
    echo('<a href="edit.php?profile_id='.htmlentities($profiles['user_id']).'">Edit</a> / ');
    echo('<a href="delete.php?profile_id='.htmlentities($profiles['user_id']).'">Delete</a>');
    echo("\n</form>\n");
    echo("</td></tr>\n");

			}

?>
</tbody>
</table>
<?php 
		}
		echo "<p><a href=\"add.php\">Add New Entry</a> </p>";
		echo "<p> <a href=\"logout.php\">Logout</a> </p>";
	}
	
?>
<br>
</p>

<?php 
		}

?>
</body>
</html>