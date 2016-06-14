<?php
require_once "pdo.php";
session_start();

$autosid = $_GET['track_id'];
$stmt = $pdo->prepare("SELECT title, artist, count, rating, length, track_id FROM track");

$stmt->execute(array());
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  
    $track = $row;
}

if (isset($_POST['cancel']) ){
    header('Location:index.php');
    exit();
}
if ( isset($_POST['title']) && isset($_POST['artist']) && isset($_POST['count']) && isset($_POST['rating']) && isset($_POST['length'])) {

    if ((strlen($_POST['title']) < 1) || (strlen($_POST['artist']) < 1) || (strlen($_POST['count']) < 1) || (strlen($_POST['rating']) < 1) || (strlen($_POST['length']) < 1)) {
        $_SESSION['error']= "All fields are required";
        header("Location: edit.php");
        exit();
    } elseif (!is_numeric($_POST['rating'])) {
      $_SESSION['error'] = "rating must be an integer";
      header('Location: edit.php');
      exit();
    }
	else {
        $sql = "UPDATE track SET title = :title, artist = :artist, count = :count , rating = :rating, length = :length WHERE track_id = :track_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
        ':title' => $_POST['title'],
        ':artist' => $_POST['artist'],
        ':rating' => $_POST['rating'],
        ':track_id' => $_REQUEST['track_id'],
        ':count' => $_POST['count'],
		':length' => $_POST['length']));
        $_SESSION['success'];
        header( 'Location: index.php' ) ;
        return;

$stmt = $pdo->prepare("SELECT * FROM track where track_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['track_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['failure'] = 'Bad value for track_id';
    header( 'Location: index.php' ) ;
    return;
}
}
}
?>

<h1>Editing Track</h1>
<?php
$mk = htmlentities($track['title']);
$md = htmlentities($track['artist']);
$yr = htmlentities($track['rating']);
$ml = htmlentities($track['count']);
$ln = htmlentities($track['length']);
$track_id = htmlentities($track['track_id']);


if (isset($_SESSION['failure'])){
  echo('<p style="color: red;">'.htmlentities($_SESSION['failure'])."</p>\n");
  unset ($_SESSION['failure']);
}
?>
<form method="post">
<p>Title:
<input type="text" name="title" value="<?= $mk ?>"></p>
<p>Artist:
<input type="text" name="artist" value="<?= $md ?>"></p>
<p>Rating:
<input type="text" name="rating" value="<?= $yr ?>"></p>
<p>Count:
<input type="text" name="count" value="<?= $ml ?>"></p>
<p>Length:
<input type="text" name="length" value="<?= $ml ?>"></p>
<input type="hidden" name="track_id" value="<?= $track_id ?>">
<p>
<input type="submit" name= "delete" value="Delete"><p>
<input type="submit" name:"save" value="Save"/> <input type="submit" name="cancel" value="Cancel"/></p>
</form>
