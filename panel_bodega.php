<?php
session_start();
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();

?>




<!DOCTYPE html>
<html>
<head><meta charset="euc-jp">
	<?php include "includes/scripts.php"; ?>
		<title>Bodega Principal</title>
		<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="catalogo_e/fontawesome/svg-with-js/js/fontawesome-all.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<link rel="stylesheet" href="estilos.css">

	</head>
	<body>

	    <?php include 'barra_bodega.php'; ?>
  <br> 
  
<button type="button" class="btn btn-secundary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Generar etiquetas
</button>
  <hr>
		<?php include 'generar_etiquetas.php'; ?>

	
   
		<section id="container">
	  <center><h4> BIENVENIDO PANEL BODEGA</h4>
			<span class="user">  <?php echo $_SESSION['user']; ?></span>
	  <center><h3> ���Que deseas hacer hoy? </h3></center>
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
   								 						 <h3 class="card-header-title mb-3 text-black">Pendientes</h3>
   								 				 </div>
   								 				 <div class="card-body text-center mb-2">
   								 				    
   								 				    <strong><p>Cotizaciones pendientes</p></strong>
   								 						<p class="card-text">ingresar aqui para ver empaques pendientes.</p>
   								 						<hr>
   								 					 <a href="upload/upload_guia.php"><button class="btn btn-lg btn-success">Click Aqui</button></a>

   								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


   								 				 </div>
   								 			 </div>
   								 	 </div>


	                    <!--tarjeta 2-->
										<div class="col-lg-4 col-md-12 mb-4">
								 			 <div class="card-section card-section-third border rounded">
								 				 <div class="card-header card-header-third rounded">
								 						 <h3 class="card-header-title mb-3 text-black"> Finalizados </h3>
								 				 </div>
								 				 <div class="card-body text-center mb-2">
								 						<p class="card-text">Ingresa aqui para ver empaques finalizados</p>
								 						<hr>
								 					 <a href="upload/empaques_on.php"><button class="btn btn-lg btn-success">Click Aqui</button></a>

								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


								 				 </div>
								 			 </div>
								 	 </div>


		               <!-- tarjeta 4 --> 
		               
		                        <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Conversaciones</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Enviar y ver tus mensajes</p>
				                     <hr>
														<a href="email/aplicacion/index.php"><button class="btn btn-lg btn-danger">Click Aqui</button></a>

			                    </div>
		                  	</div>
		                </div>
		                     <!-- tarjeta 5 --> 
		               
		       <!--                 <div class="col-lg-4 col-md-12 mb-4">-->
		       <!--              	<div class="card-section card-section-third border rounded">-->
			      <!--              <div class="card-header card-header-third rounded">-->
			      <!--                	<h3 class="card-header-title mb-3 text-black">Traspasos</h3>-->
			      <!--              </div>-->
			      <!--              <div class="card-body text-center mb-2">-->
				     <!--                <p class="card-text">Ver y alistar traspasos</p>-->
				     <!--                <hr>-->
									<!--<a href="traspasos/aprobar_mercancia.php"><button class="btn btn-lg btn-primary">aprobar mercancia</button></a>-->
				
									<!--<a href="traspasos/traspasos_mercancia.php"><button class="btn btn-lg btn-danger">Solicitar</button></a>-->
						   <!--     	<a href="traspasos/aprobar_traspaso_mercancia.php"><button class="btn btn-lg btn-warning">Aprobar traspaso</button></a>-->

			      <!--              </div>-->
		       <!--           	</div>-->
		       <!--         </div>     -->
		                
		                <!-- tarjeta 6 --> 
		                
		                <!-- tarjeta 6 --> 
		                
		                <div class="col-lg-4 col-md-12 mb-4">
		                     	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">STOCKS</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Ver Stocks</p>
				                     <hr>
									<a href="items/index.php"><button class="btn btn-lg btn-primary">Ver Inventarios</button></a>
	
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
		                <!-- Tarjeta 9 -->
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
		                
		                <!-- tarjeta 8 -->
		              
         <div class="col-lg-4 col-md-12 mb-5">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Solicitar Mercancia</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Solicitar y ver solicitudes</p>
				                     <hr>
				                 <a href="ordenes_de_compra/index.php"><button class="btn btn-lg btn-warning">Solicitar</button></a>
				                 <a href="ordenes_de_compra/mostrador.php"><button class="btn btn-lg btn-success">Ver</button></a>
									<hr>

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


	</body>
	</html>
