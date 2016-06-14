<?php
require_once "pdo.php";
session_start();

$autosid = $_GET['autos_id'];
$stmt = $pdo->prepare("SELECT make, model, mileage, year, autos_id FROM autos");

$stmt->execute(array());
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
    $autos = $row;
}

if (isset($_POST['cancel']) ){
    header('Location:index.php');
    exit();
}
if ( isset($_POST['make']) && isset($_POST['model']) && isset($_POST['mileage']) && isset($_POST['year'])) {

    if ((strlen($_POST['make']) < 1) || (strlen($_POST['model']) < 1) || (strlen($_POST['mileage']) < 1) || (strlen($_POST['year']) < 1)) {
        $_SESSION['error']= "All fields are required";
        header("Location: add.php");
        exit();
    } elseif (!is_numeric($_POST['year'])) {
      $_SESSION['error'] = "Year must be an integer";
      header('Location: add.php');
      exit();
    } elseif (!is_numeric($_POST['mileage'])) {
      $_SESSION['error'] = "Mileage must be an integer";
      header('Location: add.php');
      exit();
    } else {
        $sql = "UPDATE autos SET make = :make, model = :model, mileage = :mileage , year = :year WHERE autos_id = :autos_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
        ':make' => $_POST['make'],
        ':model' => $_POST['model'],
        ':year' => $_POST['year'],
        ':autos_id' => $_REQUEST['autos_id'],
        ':mileage' => $_POST['mileage']));
        $_SESSION['success'];
        header( 'Location: index.php' ) ;
        return;

$stmt = $pdo->prepare("SELECT * FROM autos where autos_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['autos_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['failure'] = 'Bad value for autos_id';
    header( 'Location: index.php' ) ;
    return;
}
}
}
?>

<h1>Editing Automobile</h1>
<?php
$mk = htmlentities($autos['make']);
$md = htmlentities($autos['model']);
$yr = htmlentities($autos['year']);
$ml = htmlentities($autos['mileage']);
$autos_id = htmlentities($autos['autos_id']);


if (isset($_SESSION['failure'])){
  echo('<p style="color: red;">'.htmlentities($_SESSION['failure'])."</p>\n");
  unset ($_SESSION['failure']);
}
?>
<form method="post">
<p>Make:
<input type="text" name="make" value="<?= $mk ?>"></p>
<p>Model:
<input type="text" name="model" value="<?= $md ?>"></p>
<p>Year:
<input type="text" name="year" value="<?= $yr ?>"></p>
<p>Mileage:
<input type="text" name="mileage" value="<?= $ml ?>"></p>
<input type="hidden" name="autos_id" value="<?= $autos_id ?>">
<p>
<input type="submit" name= "delete" value="Delete"><p>
<input type="submit" name:"save" value="Save"/> <input type="submit" name="cancel" value="Cancel"/></p>
</form>
