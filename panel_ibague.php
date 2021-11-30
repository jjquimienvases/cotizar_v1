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
	  <center><h3> ¿Que deseas hacer hoy JJQUIMIENVASES - IBAGUE? </h3></center>
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
   								 						 <h3 class="card-header-title mb-3 text-black"> Todas las cotizaciones</h3>
   								 				 </div>
   								 				 <div class="card-body text-center mb-2">
   								 						<p class="card-text">ingresar aqui para ver todas las cotizaciones.</p>
   								 						<hr>
   								 					 <a href="search_ibague/index.php"><button class="btn btn-lg btn-warning">Click Aqui</button></a>

   								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


   								 				 </div>
   								 			 </div>
   								 	 </div>


	                    <!--tarjeta 2-->
										<div class="col-lg-4 col-md-12 mb-4">
								 			 <div class="card-section card-section-third border rounded">
								 				 <div class="card-header card-header-third rounded">
								 						 <h3 class="card-header-title mb-3 text-black"> Crear Cotizaciones</h3>
								 				 </div>
								 				 <div class="card-body text-center mb-2">
								 						<p class="card-text">Ingresa aqui para generar una nueva cotizacion</p>
								 						<hr>
								 					 <a href="create_invoice_ibague_.php"><button class="btn btn-lg btn-success">Click Aqui</button></a>		 					 <a href="create_invoice_ibague.php"><button class="btn btn-lg btn-success">Demo</button></a>

								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


								 				 </div>
								 			 </div>
								 	 </div>


	                    <!--tarjeta 3-->
		                <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">CATALOGOS</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Ingresa aqui para ver los catalogos</p>
				                     <hr>
														<a href="factuenvases/catalogos/catalogosibague/catalogos.php"><button class="btn btn-lg btn-danger">Click Aqui</button></a>

													  <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


			                    </div>
		                  	</div>
		                </div>
		      		              <!-- tarjeta 4 -->
		              
                         <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                       	<h3 class="card-header-title mb-3 text-black">Caja</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                          <p class="card-text">Ingresar personal autorizado</p>
				                     <hr>
											<a href="try_caja/index.php"><button class="btn btn-danger">Click Aqui</button></a>

			                    </div>
		                  	</div>
		                  	</div>
		                  	
		           <!--tarjeta 5 -->
		          		                     
		                <div class="col-lg-4 col-md-12 mb-5">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Stocks</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Ver Inventarios</p>
				                     <hr>
				                     <a href="items/index.php"><button class="btn btn-lg btn-danger">Click Aqui</button></a>
								
			                    </div>
		                  	</div>
		                </div>
		   
		                
		      
		           <!-- tarjeta 6 -->
		              
         <div class="col-lg-4 col-md-12 mb-5">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">TRASPASOS - demo</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Solicitar y aprobar</p>
				                     <hr>
				                     <a href="traspasos/new_demo.php"><button class="btn btn-lg btn-danger">Solicitar mercancia </button></a>
									<hr>

						        	<a href="traspasos/efectuar_traspaso.php"><button class="btn btn-lg btn-warning">Aprobar traspaso</button></a>
	
			                    </div>
		                  	</div>
		                </div>
		                
		                
		                  <!-- TARJETA CONTENEDOR NUEVOS TRASPASOS-->
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
			                      	<h3 class="card-header-title mb-3 text-black">Ingresar Nueva Mercancia</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Personal autorizado</p>
				                     <hr>
				                     <!--<a href="stock_/index.php"><button class="btn btn-lg btn-danger">Gestor Inventarios </button></a>-->
				                    <a href="factuenvases/catalogos/nuevamercancia_demo.php"><button class="btn btn-lg btn-warning">Nueva M</button></a>
									<hr>


			                    </div>
		                  	</div>
		                </div>
		                
		                        <div class="col-lg-4 col-md-12 mb-5">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Pendientes CallCenter</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Personal autorizado</p>
				                     <hr>
				                     <a href="upload/pedidos_pendientes_mostrador.php"><button class="btn btn-lg btn-info">Ingresar </button></a>
				                    
									<hr>


			                    </div>
		                  	</div>
		                </div>
		                
		                
		                
		                
		                 <div class="col-lg-4 col-md-12 mb-5">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">STOCK Gestor</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Personal autorizado</p>
				                     <hr>
				                     <a href="upload_stock/index.php"><button class="btn btn-lg btn-danger">Ingresar </button></a>
				                    
									<hr>


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
