<?php
session_start();
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName']) {
	$invoice->saveInvoice($_POST);
	header("Location:invoice_list.php");
}
?>
<?php
include 'conectar.php';
$mysqli2 = conectar();
//  $mysqli2 = new mysqli ('localhost', 'root', '', 'cotpruebas');  

$alistamiento = "finalizado";
  $demo_fecha = "2021-03-02 07:50:50";
  $demo_fecha_2 = "2021-03-05 18:50:50";
$result= $mysqli2 -> query ("SELECT count(*) as total from files WHERE estado = '$alistamiento' AND order_date BETWEEN '$demo_fecha' AND '$demo_fecha_2' ");
$data=mysqli_fetch_assoc($result);

$cuenta = $data['total'];

?>



<!DOCTYPE html>
<html>
<head><meta charset="euc-jp">
	<?php include "includes/scripts.php"; ?>
		<title>Bodega Principal</title>
		 <link href="https://fonts.googleapis.com/css?family=roboto" rel="stylesheet">

	    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">

	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">


		 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="estilos.css">

	</head>
	<body>


  <br>
		<section id="container">
	  <center><h4> BIENVENIDO PANEL BODEGA</h4>
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
              <!--        <div class="col-lg-4 col-md-12 mb-4">-->
   								 		<!--	 <div class="card-section card-section-third border rounded">-->
   								 		<!--		 <div class="card-header card-header-third rounded">-->
   								 		<!--				 <h3 class="card-header-title mb-3 text-black">Salida Mercancia</h3>-->
   								 		<!--		 </div>-->
   								 		<!--		 <div class="card-body text-center mb-2">-->

   								 		<!--		    <strong><p>Tienes Cotizaciones pendientes</p></strong>-->
   								 		<!--				<p class="card-text">ingresar aqui para ver cotizaciones pendientes.</p>-->
   								 		<!--				<hr>-->
   								 		<!--			 <a href="upload/salida_mercancia.php"><button class="btn btn-warning">Click Aqui</button></a>-->

   								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


   								 		<!--		 </div>-->
   								 		<!--	 </div>-->
   								 	 <!--</div>-->


	                    <!--tarjeta 2-->
										<!--<div class="col-lg-4 col-md-12 mb-4">-->
								 	<!--		 <div class="card-section card-section-third border rounded">-->
								 	<!--			 <div class="card-header card-header-third rounded">-->
								 	<!--					 <h3 class="card-header-title mb-3 text-black"> Traspasos Mercancias </h3>-->
								 	<!--			 </div>-->
								 	<!--			 <div class="card-body text-center mb-2">-->
								 	<!--					<p class="card-text">Ingresar aqui para cambiar la cantidad de gramos</p>-->
								 	<!--					<hr>-->
								 	<!--				 <a href="traspasos/new_demo.php"><button class="btn btn-lg btn-success">Click Aqui</button></a>-->

								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


								 	<!--			 </div>-->
								 	<!--		 </div>-->
								 	<!-- </div>-->

  <div class="col-lg-4 col-md-12 mb-5">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">TRASPASOS DEMO</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Solicitar y aprobar</p>
				                     <hr>
				                     <a href="transfers/transfers_list.php"><button class="btn btn-lg btn-info">Lista De Traspasos </button></a>
									<hr>
						        	<a href="transfers/index.php"><button class="btn btn-lg btn-success">Solicitar Traspaso</button></a>
	
			                    </div>
		                  	</div>
		                </div>
		                
		                  <div class="col-lg-4 col-md-12 mb-5">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">ESENCIAS</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Lista de esencias</p>
				                     <hr>

						        	<a href="check_fragancias/index.php"><button class="btn btn-lg btn-danger">Ver lista</button></a>
	
			                    </div>
		                  	</div>
		                </div>


      <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Gestor Inventario</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">ingresar personal autorizado</p>
				                     <hr>
									<a href="upload_stock/index.php"><button class="btn btn-lg btn-success">Click AQUI</button></a>
									

			                    </div>
		                  	</div>
		                </div>




		            </div>
				</div>
			</div>
		</div>


	  <div class="footer">
	   <p> llenar este footer </p>
	 </div>
	 <script src="js/script.js"></script>
	 <script languaje="javascript">



</script>

	</body>
	</html>
