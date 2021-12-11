<?php
session_start([
    'cookie_lifetime' => 86400,
    'gc_maxlifetime' => 86400,
]);
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName']) {
	$invoice->saveInvoice($_POST);
	header("Location:invoice_list.php");
}
?>


<!DOCTYPE html>
<html>
<head><meta charset="euc-jp">
	<?php include "includes/scripts.php"; ?>
		<title>Home Cotizar</title>
		 <link href="https://fonts.googleapis.com/css?family=roboto" rel="stylesheet">

	    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">

	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">


		 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="estilos.css">

	</head>
	<body>

	    <?php include 'barra.php' ?>
  <br>
		<section id="container">
	  <center><h4> BIENVENIDO</h4>
			<span class="user">  <?php echo $_SESSION['user']; ?></span>
	  <center><h3> ¿Que deseas hacer hoy? </h3></center>
	  <br>
	  <center><p> Colombia, <?php echo fechaC();?></p></center>
	<br></section>

		<div class="container principal">
			<div class="row">
				<div class="col-lg-12 text-center">
		            <div class="row">
	                    <!--tarjeta 1-->
										<div class="col-lg-4 col-md-12 mb-4">
 											<div class="card-section card-section-third border rounded">
 												<div class="card-header card-header-third rounded">
 														<h3 class="card-header-title mb-3 text-black"> Cotizaciones</h3>
 												</div>
 												<div class="card-body text-center mb-2">
 													 <p class="card-text">Crear o anular cotizaciones.</p>
 													 <hr>
 													<a href="../create_invoice.php"><button class="btn btn-lg btn-primary">Crear</button></a>
 													<a href="../anular_cotizacion.php"><button class="btn btn-lg btn-warning">Anular</button></a>

 													<!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


 												</div>
 											</div>
 									</div>



	                    <!--tarjeta 2-->

         <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Conversaciones</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Enviar y ver tus mensajes</p>
				                     <hr>
														<a href="../email/aplicacion/index.php"><button class="btn btn-lg btn-danger">Click Aqui</button></a>

			                    </div>
		                  	</div>
		                </div>


	                    <!--tarjeta 3-->
		                <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black"> Cotizaciones Efectivas</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text"> Ingresar aqui para ver el estado de las cotizaciones.</p>
				                     <hr>
														<a href="../bodega/index.php"><button class="btn btn-lg btn-danger">Click Aqui</button></a>

													  <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


			                    </div>
		                  	</div>
		                </div>
										<!--TARJETA 4 -->
		            <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">REPORTES</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Demos para generar reportes.</p>
				                     <hr>
				                    <!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->

                        <a href="../reporte/index.php"><button class="btn btn-lg btn-warning">general mostrador</button></a>
                        <a href="../reporte/users_report.php"><button class="btn btn-lg btn-danger">por empleado</button></a>

			                    </div>
		                  	</div>
		                </div>

								<!-- tarjeta 5 -->
								<div class="col-lg-4 col-md-12 mb-4">
												<div class="card-section card-section-third border rounded">
													<div class="card-header card-header-third rounded">
															<h3 class="card-header-title mb-3 text-black"> Productos</h3>
													</div>
													<div class="card-body text-center mb-2">
														 <p class="card-text">Ingresa aqui para ver nuestros catalogos.</p>
														 <hr>
														<!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
               <a href="catalogos/admin_productos.php"><button class="btn btn-lg btn-info">Click Aqui</button></a>

													</div>
												</div>
										</div>




               <!--tarjeta 6 -->
							 <div class="col-lg-4 col-md-12 mb-4">
						 					<div class="card-section card-section-third border rounded">
						 						<div class="card-header card-header-third rounded">
						 								<h3 class="card-header-title mb-3 text-black"> Administrador</h3>
						 						</div>
						 						<div class="card-body text-center mb-2">
						 							 <p class="card-text">Ingresar aqui si eres el administrador del sistema.</p>
						 							 <hr>
						 							<!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
						 						<a href="../panel/index.php">	<button class="btn btn-lg btn-secondary" onclick="return confirmAdmin()">Click Aqui</button></a>


						 						</div>
						 					</div>
						 			</div>
               <!-- Tarjeta 7 -->
							 <div class="col-lg-4 col-md-12 mb-4">
											<div class="card-section card-section-third border rounded">
												<div class="card-header card-header-third rounded">
														<h3 class="card-header-title mb-3 text-black"> Panel Asistente </h3>
												</div>
												<div class="card-body text-center mb-2">
													 <p class="card-text">Ingresar aqui si eres el asistente.</p>
													 <hr>
													<!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
												<a href="../asistente.php">	<button class="btn btn-lg btn-danger" onclick="return confirmAdmin()">Click Aqui</button></a>


												</div>
											</div>
									</div>

               <!-- Tarjeta 8 -->
							 <div class="col-lg-4 col-md-12 mb-4">
											<div class="card-section card-section-third border rounded">
												<div class="card-header card-header-third rounded">
														<h3 class="card-header-title mb-3 text-black"> Mostrador </h3>
												</div>
												<div class="card-body text-center mb-2">
													 <p class="card-text">Ingresar aqui para gestionar las cotizaciones del mostrador.</p>
													 <hr>
													<!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
												<a href="../panelmostrador.php">	<button class="btn btn-lg btn-warning" onclick="return confirmAdmin()">Click Aqui</button></a>


												</div>
											</div>
									</div>

 <!-- Tarjeta 9 -->
 <div class="col-lg-4 col-md-12 mb-4">
				 <div class="card-section card-section-third border rounded">
					 <div class="card-header card-header-third rounded">
							 <h3 class="card-header-title mb-3 text-black"> IBAGUE </h3>
					 </div>
					 <div class="card-body text-center mb-2">
							<p class="card-text">Ingresar aqui para gestionar ibague.</p>
							<hr>
						 <!-- <span><a href="crud/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
					 <a href="../panel_ibague.php">	<button class="btn btn-lg btn-primary" onclick="">Click Aqui</button></a>


					 </div>
				 </div>
		 </div>


		            </div>
				</div>
			</div>
		</div>
		<center><div class="container_2">
	     <div class="imgbeta">
	   <a href="https://envasesyperfumeria.com/"><img class="imgbeta" src="img/quimilogo.png" alt="" width="450px" height="200px"></a>
	   </div>
	 </div></center>

	  <div class="footer">
	   <p> llenar este footer </p>
	 </div>
	 <script src="js/script.js"></script>
	 <script languaje="javascript">

	function confirmAdmin()
	{
		var getin = confirm ("¿Eres el administrador del sistema?.")
    if (getin == true)
		 return true;
	 }
	 else {
		 alert('No puedes ingresar aqui si no eres el administrador')
		 return false;
	 }

</script>

	</body>
	</html>
