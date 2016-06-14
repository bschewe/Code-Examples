<?php
	$pdo = new PDO('mysql:host=localhost:81;port=3306;dbname=b', 'fred', 'zap');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
