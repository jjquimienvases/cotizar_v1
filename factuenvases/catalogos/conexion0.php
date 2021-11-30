<?php
$database = "cotizar";
$user = 'cotizar';
$password = 'LeinerM4ster';


try {

	$con = new PDO('mysql:host=173.230.154.140;dbname=' . $database, $user, $password);
} catch (PDOException $e) {
	echo "Error" . $e->getMessage();
}

?>
<!--$servidor="173.230.154.140";-->
<!--$nombreBd="cotizar";-->
<!--$usuario="cotizar";-->
<!--$pass="LeinerM4ster";-->