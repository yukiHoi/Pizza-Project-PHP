<?php
$dbName = "pizzadb";
$dbHost = "localhost";

try { 

	$pdo = new PDO('mysql:host=localhost;dbname=pizzadb; charset=utf8', 'root', ''); 
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
		
catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
	exit();
	}
?>