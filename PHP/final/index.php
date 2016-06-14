<?php

require_once 'pdo.php';
require_once "bootstrap.php";
session_start();

?>


<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe's Tracks Database</title>
</head>
<h1>Welcome to the Tracks Database</h1>

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
	echo ("<p> Attempt to <a href=\"add.php\">Add Data</a> without logging in - it should fail with an error message.</p>");
} else {
	if (isset($_SESSION['email']) ){
		$stmt = $pdo->prepare('SELECT title, artist, rating, count, length, track_id FROM track');
		$stmt->execute(array());
		$pizza = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
			$pizza[] = $row;
		}
		if (count($pizza) < 1){
			echo "No rows found";
		} else{
			echo ('<table border="1">'."\n");

?>
</p>
<p>
	<tbody>
		<tr>
			<th>Title</th>
			<th>Artist</th>
			<th>Rating</th>
			<th>Play Count</th>
			<th>Length</th>
			<th>Action</th>
		</tr>
<?php

?>
		
<?php
	foreach ($pizza as $auto) {  
	echo("<tr><td>");
    echo($auto['title']);
    echo("</td><td>");
    echo($auto['artist']);
    echo("</td><td>");
    echo($auto['count']);
    echo("</td><td>");
    echo($auto['rating']);
   	echo("</td><td>");
	echo($auto['length']);
   	echo("</td><td>");
    echo('<a href="edit.php?track_id='.htmlentities($auto['track_id']).'">Edit</a> / ');
    echo('<a href="delete.php?track_id='.htmlentities($auto['track_id']).'">Delete</a>');
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