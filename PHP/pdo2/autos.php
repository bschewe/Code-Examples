<?php
require_once "pdo.php";

if ( ! isset($_GET['name']) || strlen($_GET['name']) < 1  ) {
    die('Name parameter missing');
}

if ( isset($_POST['logout']) ) {
    header('Location: index.php');
    exit();
}


$failure = false;
if ( isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) 
{
    if (strlen($_POST['make']) < 1) {
    $failure = 'Make is required';
    }
        else
		{
            if (! is_numeric($_POST['year']) || !is_numeric($_POST['mileage']))
			{
                $failure = 'Mileage and year must be numeric!';
				echo $failure;
            }
            else {
					$_POST['make'] = htmlspecialchars($_POST['make']);
					$sql = "INSERT INTO autos (make, year, mileage) 
					VALUES (:make, :year, :mileage)";
					$stmt = $pdo->prepare($sql);
					$stmt->execute(array(
					':make' => $_POST['make'],
					':year' => $_POST['year'],
					':mileage' => $_POST['year']));
					echo "Record inserted.";
			}			

		}

}
 






?>

<!DOCTYPE html>
<html>
<heads>
<title>Blake Schewe's Autos Tracker</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Custom styles for this template -->
<link href="starter-template.css" rel="stylesheet">

</head>
<body style="font-family: sans-serif;">
<h1>Tracking Autos for
<?php
	echo $_GET['name']
	?>
</h1>


<form method="POST">
<p>
<label for="make">Make:</label>
<input type="text" name="make" size="60" ><br/>
</p>
<p>
<label for="year">Year:</label>
<input type="text" name="year" ><br/>
</p>
<p>
<label for="mileage">Mileage:</label>
<input type="text" name="mileage" id="mileage" >
</p>

<input type="submit" name = "add" value="Add">
<input type="submit" name = "clear" value="Clear All">
<input type="submit" name="logout" value="Logout">
</form>

<h2>Automobiles</h2>

<p>
<?php
$statement=$pdo -> prepare("select * from autos");
$statement->execute();
$rows = $statement ->fetchALL();
    foreach ($rows as $row){
        echo ("<li>");
        echo $row['year'];
        echo " ";
        echo $row['make'];
        echo " / ";
        echo $row['mileage'];
        echo "<br/>";
    }

?>
</p>
</body>
</html>




