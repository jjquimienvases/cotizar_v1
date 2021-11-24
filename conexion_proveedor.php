<?php
$database = "cotizar";
$user = 'cotizar';
$password = 'LeinerM4ster';


try {

	$con = new PDO('mysql:host=127.0.0.1;dbname=' . $database, $user, $password);
} catch (PDOException $e) {
	echo "Error" . $e->getMessage();
}
