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


<!DOCTYPE html>
<html>
<head><meta charset="euc-jp">
	<?php include "includes/scripts.php"; ?>
		<title>Panel D1</title>
		 <link href="https://fonts.googleapis.com/css?family=roboto" rel="stylesheet">

	    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
		 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="estilos.css">

	</head>
	<body>

	    <?php include 'barrad1.php' ?>
  <br>
		<section id="container">
	  <center><h4> BIENVENIDO AL PANEL JJ QUIMIENVASES D1</h4>
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
   								 						 <h3 class="card-header-title mb-3 text-black">Cotizaciones</h3>
   								 				 </div>
   								 				 <div class="card-body text-center mb-2">
   								 						<p class="card-text">ingresar aqui para ver tus cotizaciones.</p>
   								 						<hr>
   								 					 <a href="search_d1/index.php"><button class="btn btn-lg btn-success">Click Aqui</button></a>
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
								 						<p class="card-text">Ingresa aqui para crear nuevas cotizaciones</p>
								 						<hr>
								 					 <a href="create_invoice_d1_.php"><button class="btn btn-lg btn-warning">Click Aqui</button></a>		 					 <a href="create_invoice_d1.php"><button class="btn btn-lg btn-danger"> Demo</button></a>
								 				 </div>
								 			 </div>
								 	 </div>


	                    <!--tarjeta 3-->
		           
		                
		                   <!-- tarjeta demo 5 -->
		                <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">DTC</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">DTC</p>
				                     <hr>
				
									<a href="cotizaciones_d1.php"><button class="btn btn-lg btn-danger">watch it</button></a>												
								
			                    </div>
		                  	</div>
		                </div>
		                	                		                		           <!-- tarjeta 7 -->
		              
         <div class="col-lg-4 col-md-12 mb-5">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">TRASPASOS</h3>
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
   
    <!-- Tarjeta 8 -->
    		             <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">STOCKS</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">stocks</p>
				                     <hr>
														<a href="items/index.php"><button class="btn btn-lg btn-warning">VER STOCKS</button></a>
									
			                    </div>
		                  	</div>
		                </div>
		                
		                
	<!-- tarjeta 9 -->
		          
		          		<div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">CAJA</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">ingresar personal autorizado</p>
				                     <hr>
									<a href="try_caja/index.php"><button class="btn btn-lg btn-danger">VER CAJA</button></a>

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
