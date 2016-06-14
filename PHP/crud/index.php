<?php

require_once 'pdo.php';
require_once "bootstrap.php";
session_start();

?>


<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe's Autos Database</title>
</head>
<h1>Welcome to Blake Schewe's Auto Database</h1>

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
		$stmt = $pdo->prepare('SELECT make, model, mileage, year, autos_id FROM autos');
		$stmt->execute(array() );
		$autos = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
			$autos[] = $row;
		}
		if (count($autos) < 1){
			echo "No rows found";
		} else{
			echo ('<table border="1">'."\n");

?>
</p>
<p>
	<tbody>
		<tr>
			<th>Make</th>
			<th>Model</th>
			<th>Year</th>
			<th>Mileage</th>
			<th>Action</th>
		</tr>
<?php

?>
		
<?php
	foreach ($autos as $auto) {  
	echo("<tr><td>");
    echo($auto['make']);
    echo("</td><td>");
    echo($auto['model']);
    echo("</td><td>");
    echo($auto['mileage']);
    echo("</td><td>");
    echo($auto['year']);
   	echo("</td><td>");
    echo('<a href="edit.php?autos_id='.htmlentities($auto['autos_id']).'">Edit</a> / ');
    echo('<a href="delete.php?autos_id='.htmlentities($auto['autos_id']).'">Delete</a>');
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