<?php
	$database="jjquimienvases_cotizar";
	$user='jjquimienvases_jjadmin';
	$password='LeinerM4ster';


try {

	$con=new PDO('mysql:host=ftp.jjquimienvases.com;dbname='.$database,$user,$password);

} catch (PDOException $e) {
	echo "Error".$e->getMessage();
}

?>