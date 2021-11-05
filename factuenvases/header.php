<?php

session_start();
if (!empty($_SESSION['active']))
{
	header('location: ./home.php');
}

?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css" >
  <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">
	<title></title>
	
</head>
<body>
  <div class="header">
  <a href="#default" class="logo">JJQUIMI ENVASES (logo)</a>
  <div href="#default" class="header-center">
    <input type="text" placeholder="Search..">
  </div>
  <div class="header-right">
    <p> Colombia, <?php echo fechaC();?></p>
    <a class="active" href="#home">Home</a>
    <a href="#contact">Clientes</a>
    <a href="#about">Cotizar</a>
    <span>|</span>
				<span class="user"><?php $_SESSION['user']; ?></span>
				<img class="photouser" src="img/user.png" alt="Usuario">
				<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
  </div>
</div>

</body>
</html>
