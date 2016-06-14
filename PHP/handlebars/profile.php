<?php
// This script works even if you are not logged in
require_once 'pdo.php';
header("Content-type: application/json; charset=utf-8");
if (isset($_REQUEST['profile_id'])) {
	
	
	
	
$profiles = array();
$stmt = $pdo->prepare('SELECT * FROM Profile WHERE profile_id = :pid');
$stmt->execute(array(':pid' => $_REQUEST['profile_id']));
$profiles['profile'] = $stmt->fetchAll(PDO::FETCH_ASSOC);



$stmt = $pdo->query('SELECT year, name FROM education, institution WHERE profile_id = :pid AND institution.institution_id');
$stmt->execute(array(':pid' => $_REQUEST['profile_id']));
$profiles['schools'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT * FROM position WHERE profile_id = :pid');
$stmt->execute(array(':pid' => $_REQUEST['profile_id']));
$profiles['positions'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo(json_encode($profiles, JSON_PRETTY_PRINT));

}
else {
$profiles = array();
$stmt = $pdo->query('SELECT * FROM profile');
$position = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo(json_encode($profiles, JSON_PRETTY_PRINT));
}