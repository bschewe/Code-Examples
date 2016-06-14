<?php require_once "pdo.php"; ?>
<?php
session_start();

$table = "";
$rows = $pdo->query('SELECT * FROM Profile');

if ($rows->rowCount() > 0){
	$table = "
	<table border=\"1\">
		<thead><tr>
			<th>Name</th>
			<th>Headline</th>";
			
	if ( isset($_SESSION['name']) )	$table .= "<th>Action</th>";
	
	$table .= "
		</tr></thead>
	<tbody>
	";
	foreach ($rows as $row){
		$table .= "<tr>";
		$table .= "<td>". "<a href=\"view.php?profile_id=" . htmlentities($row['profile_id']) . "\">";
		$table .= htmlentities($row['first_name']) ." ". htmlentities($row['last_name']);
		$table .= "</a>". "</td>";
		$table .= "<td>". htmlentities($row['headline']) . "</td>";
		if ( isset($_SESSION['name']) ){
			$table .= "<td>";
			$table .= "<a href=\"edit.php?profile_id=" . htmlentities($row['profile_id']) . "\">Edit</a> / ";
			$table .= "<a href=\"delete.php?profile_id=" . htmlentities($row['profile_id']) . "\">Delete</a>";
			$table .= "</td>";
		}
		$table .= "</tr>";
	}
	$table .= "
	</tbody>
	</table>
	";
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Blake Schewe</title>
<?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">

<h1>Blake Schewe's Resume Registry</h1>
<?php
    if ( isset($_SESSION['success']) ) {
        echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
        unset($_SESSION['success']);
    } 
?>



<?php if ( isset($_SESSION['name']) ):?>
	<p>
	<a href="logout.php">Logout</a>
	</p>
<?php else:?>
	<p>
	<a href="login.php">Please log in</a>
	</p>
<?php endif;?>
<?php echo $table;?>
<?php if ( isset($_SESSION['name']) ):?>
	<p><a href="add.php">Add New Entry</a></p>
<?php endif;?>

</div>
</body>