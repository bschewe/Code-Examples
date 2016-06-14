<?php
require_once "pdo.php";
session_start();

$autosid = $_GET['pizza_id'];
$stmt = $pdo->prepare("SELECT store, address, best, rating, pizza_id FROM pizza");

$stmt->execute(array());
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
    $pizza = $row;
}

if (isset($_POST['cancel']) ){
    header('Location:index.php');
    exit();
}
if ( isset($_POST['store']) && isset($_POST['address']) && isset($_POST['best']) && isset($_POST['rating'])) {

    if ((strlen($_POST['store']) < 1) || (strlen($_POST['address']) < 1) || (strlen($_POST['best']) < 1) || (strlen($_POST['rating']) < 1)) {
        $_SESSION['error']= "All fields are required";
        header("Location: edit.php");
        exit();
    } elseif (!is_numeric($_POST['rating'])) {
      $_SESSION['error'] = "rating must be an integer";
      header('Location: edit.php');
      exit();
    }
	else {
        $sql = "UPDATE pizza SET store = :store, address = :address, best = :best , rating = :rating WHERE pizza_id = :pizza_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
        ':store' => $_POST['store'],
        ':address' => $_POST['address'],
        ':rating' => $_POST['rating'],
        ':pizza_id' => $_REQUEST['pizza_id'],
        ':best' => $_POST['best']));
        $_SESSION['success'];
        header( 'Location: index.php' ) ;
        return;

$stmt = $pdo->prepare("SELECT * FROM pizza where pizza_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['pizza_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['failure'] = 'Bad value for pizza_id';
    header( 'Location: index.php' ) ;
    return;
}
}
}
?>

<h1>Editing Automobile</h1>
<?php
$mk = htmlentities($pizza['store']);
$md = htmlentities($pizza['address']);
$yr = htmlentities($pizza['rating']);
$ml = htmlentities($pizza['best']);
$pizza_id = htmlentities($pizza['pizza_id']);


if (isset($_SESSION['failure'])){
  echo('<p style="color: red;">'.htmlentities($_SESSION['failure'])."</p>\n");
  unset ($_SESSION['failure']);
}
?>
<form method="post">
<p>Store:
<input type="text" name="store" value="<?= $mk ?>"></p>
<p>Address:
<input type="text" name="address" value="<?= $md ?>"></p>
<p>Rating:
<input type="text" name="rating" value="<?= $yr ?>"></p>
<p>Best:
<input type="text" name="best" value="<?= $ml ?>"></p>
<input type="hidden" name="pizza_id" value="<?= $pizza_id ?>">
<p>
<input type="submit" name= "delete" value="Delete"><p>
<input type="submit" name:"save" value="Save"/> <input type="submit" name="cancel" value="Cancel"/></p>
</form>
