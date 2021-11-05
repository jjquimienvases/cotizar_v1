<?php 
include 'conexion.php';
session_start();

 $user_rol = $_SESSION['id_rol'];
 $user_name = $_SESSION['user'];
 $user_id = $_SESSION['userid'];
?>

<!-- CSS only -->
<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">-->
<!-- JavaScript Bundle with Popper -->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>-->
         
         
<!doctype html>
<html lang="en">
  <head>
    <title>INGRESAR NOVEDADES</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--<script src="jquery-3.1.1.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!--<script src="funciones_.js"></script>-->
    <style>
    *{
        margin:0;
        padding:0;
    }
     
        #izquierda{
            float:left;
            margin-top:30px;
            /*margin-left:400px;*/
        }
        #derecha{
            float:right;
        }
        #contenedor_principal{
            width:1200px;
            height:auto;
        }
    </style>
  </head>
  <body>
      <header>
          <hr>
          <?php 
           $boton_back = "";
           if($user_rol == 7){
               $boton_back ="<button class='btn btn-warning'> <a href='../panel_ibague.php'>Volver al panel principal </a> </button>";
           }else if($user_rol == 2){
                $boton_back ="<button class='btn btn-warning'> <a href='../panel_mostrador.php'>Volver al panel principal </a> </button>";
           }else if($user_rol == 5){
                $boton_back ="<button class='btn btn-warning'> <a href='../asistente.php'>Volver al panel principal </a> </button>";
           }
           
           echo $boton_back;
          ?>
          <hr>
      </header>
      <hr>
      <center><b>Bienvenido <?php echo $user_name ?></b></center>
      <center> <h3>ESTE APARTADO ES PARA ESCRIBIR Y DEFINIR GASTOS Y NOVEDADES</h3> </center>
      <div class="form-group" id="contenedor_principal">
		                <!--<div class="col-lg-4 col-md-12 mb-4" id="izquierda">-->
		                <!--  	<div class="card-section card-section-third border rounded">-->
			               <!--     <div class="card-header card-header-third rounded">-->
			               <!--       	<h3 class="card-header-title mb-3 text-black">$ Ingresar Monto</h3>-->
			               <!--     </div>-->
			               <!--     <div class="card-body text-center mb-2">-->
				              <!--       <p class="card-text"></p>-->
				              <!--       <hr><div class="form-row">-->
			               <!--         <form method="post" action="" id="info_1">-->
			               <!--         <div class="form-group" >-->
			               <!--             <label>Escribir la cantidad de dinero con la que iniciaste el dia.</label>-->
			               <!--             <hr>-->
			               <!--             <input class="form-control" name="monto" id="monto" placeholder="$ Ingresar Monto.">     -->
			               <!--         </div>   -->
			                        
			               <!--         </form>-->
			               <!--         <button class="btn btn-success" id="send_one">Enviar Cantidad</button>-->

			               <!--     </div>-->
			               <!--     </div>-->
			                    
			                    
			                    
		                <!--  	</div> -->
		                <!--</div>-->
		                
		                     <!--tarjeta 4-->
		                     
		                <div class="col-lg-4 col-md-12 mb-4" id="derecha">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">Ingresar Gastos</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Escribir gastos y/o novedades</p>
				                     <hr>
				                     <form method="post" action="" id="info_2">
				                        
				                    <div class="form-group">
				                        <label>Escribir Novedad:</label>
			                            <input class="form-control" name="novedad" id="razon" placeholder="Escribir gasto o novedad"> 
			                            <label>Escribir Monto:</label>
			                            <input class="form-control" name="monto" id="monto" placeholder="$ Ingresar Monto."> 
				                     </div>
				                     <hr>
				                         
				                     </form>
				              <center><button class="btn btn-warning" id="send_second">Enviar Novedad</button></center> 

			                    </div>
		                  	</div>
		                </div>
		                
		               <!-- CAJA escribe lo que recibio en efectivo -->
		                    <div class="col-lg-4 col-md-12 mb-4" id="izquierda">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black">$ Ingresar Monto</h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text"></p>
				                     <hr><div class="form-row">
			                        <form method="post" action="" id="info_1">
			                        <div class="form-group" >
			                            <label>Escribir la cantidad de dinero con el que finalizaste el dia.</label>
			                            <hr>
			                            <input class="form-control" name="monto" id="monto" placeholder="$ Ingresar Monto.">     
			                        </div>   
			                        </form>
			                        <button class="btn btn-success" id="send_one">Enviar Cantidad</button>
			                    </div>
			                    </div>
			                    
		                  	</div> 
		                </div>
    
    
    </div>

   <script>
   
       	$(document).ready(function(){

		$('#send_one').click(function(){

			var datos=$('#info_1').serialize();

			$.ajax({

				type:"POST",

				url:"send_ajax_finish_day.php",

				data:datos,

				success:function(r){

					console.log(r);

					if(r!=0 && !isNaN(r)){

						alert("Registro Enviado");
					}else{

						alert("ya existe un registro de esta bodega");

					}

				}

			});

			return false;

		});
		
		//segundo form
		
				$('#send_second').click(function(){

			var datos=$('#info_2').serialize();

			$.ajax({

				type:"POST",

				url:"send_ajax_novedad.php",

				data:datos,

				success:function(r){

					console.log(r);

					if(r!=0 && !isNaN(r)){

						alert("Novedad Enviada");
					}else{

						alert("NO FUNCIONA EL ENVIO DE LA NOVEDAD, CONTACTAR AL DESARROLLADOR");

					}

				}

			});

			return false;

		});

	});
   </script>  
  
  
  </body>
</html>
         
         
