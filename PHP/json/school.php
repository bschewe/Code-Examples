<?php 
require_once "pdo.php"; 

session_start();

if ( ! isset($_SESSION['user_id']) ) {
    die("ACCESS DENIED");
    return;
}

$stmt = $pdo->prepare('SELECT * FROM Institution
    WHERE name LIKE :prefix');
$stmt->execute(array( ':prefix' => $_REQUEST['term']."%"));

$retval = array();
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    $retval[] = $row['name'];
}

echo(json_encode($retval));

?>

