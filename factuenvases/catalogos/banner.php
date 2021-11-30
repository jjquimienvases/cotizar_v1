<!DOCTYPE html>

<html>
<head>
		<title>Productos</title>
		 <link href="https://fonts.googleapis.com/css?family=roboto" rel="stylesheet">

	    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">

	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">


		 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="estilos.css">

  <style media="screen">
  body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
 background: url(imagen.jpg);
  background-size: cover;
  background-attachment: fixed;
}
* {
  box-sizing: border-box;
}

from.formulario{
margin-bottom: 30px;

}
.contenedor{
  width: 100%;
  padding: 15px;
  margin-bottom: 100px;
}
.formulario{
  background: #fff;
  margin-top: 30px;
  padding: 3px;
  border: solid black 1px;
}
h1{
  text-align: center;
  color: #DF971A;
  font-size: 40px;
  margin-bottom: 50px;
}


.superior{
  margin-bottom: 15px;
}
input[type="text"],
input[type="password"]{
  font-size: 20px;
  width: 82%;
  padding: 10px;
  border: none;
}
.input-contenedor{
  margin-bottom: 15px;
  border: 1px solid #aaa;
}
.icon{
  min-width: 50px;
  text-align: center;
  color: #999;
}
.button{
  border: none;
  width: 100%;
  color: white;
  font-size: 20px;
  background: #E7840D;
  padding: 15px 20px;
  border-radius: 5px;
  cursor: pointer;
}
.button:hover{
  background: cadetblue;
}
p{
  text-align: center;
}
.link{
  text-decoration: none;
    color: #1a2537;
  font-weight: 600;
}
.link:hover{
   color: cadetblue;
}

.btn-primary{
  height: 50px;
}

@media(min-width:768px)
{
  .formulario{
      margin: auto;
      width: 500px;
      margin-top: 150px;
      border-radius: 2%;
  }
}

  </style>

	</head>
	<body>
   <hr><hr>
  <br>
		<div class="container principal">
       <div class="superior">
        <center>
         <h3>CATALOGOS Y STOCK </h3> </center>
         <hr>
        <center> <img src="../img/jjquimi.png" alt="" width="200px"> </center>
       </div>
			<div class="row">
				<div class="col-lg-12 text-center">
              <hr>
		            <div class="row">
	                    <!--tarjeta 1-->
										<div class="col-lg-4 col-md-12 mb-4">
 											<div class="card-section card-section-third border rounded">
 												<div class="card-header card-header-third rounded">
 														<h3 class="card-header-title mb-3 text-black"> JJ PRINCIPAL</h3>
 												</div>
 												<div class="card-body text-center mb-2">
 													 <p class="card-text">Ver stock de punto principal</p>
 													 <hr>
 													<a href="stock_principal.php"><button class="btn btn-lg btn-primary">Click Aqui</button></a>

 													<!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


 												</div>
 											</div>
 									</div>

	                    <!--tarjeta 2-->
										<div class="col-lg-4 col-md-12 mb-4">
								 			 <div class="card-section card-section-third border rounded">
								 				 <div class="card-header card-header-third rounded">
								 						 <h3 class="card-header-title mb-3 text-black"> Punto D1</h3>
								 				 </div>
								 				 <div class="card-body text-center mb-2">
								 						<p class="card-text"> Ver stock de punto D1 </p>
								 						<hr>
								 					 <a href="stock_d1.php"><button class="btn btn-lg btn-success">Click Aqui</button></a>

								 					 <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->


								 				 </div>
								 			 </div>
								 	 </div>


	                    <!--tarjeta 3-->
		                <div class="col-lg-4 col-md-12 mb-4">
		                  	<div class="card-section card-section-third border rounded">
			                    <div class="card-header card-header-third rounded">
			                      	<h3 class="card-header-title mb-3 text-black"> Bodega AV </h3>
			                    </div>
			                    <div class="card-body text-center mb-2">
				                     <p class="card-text">Ver stock bodega principal </p>
				                     <hr>
														<a href="stock_av.php"><button class="btn btn-lg btn-danger">Click Aqui</button></a>

													  <!-- <span><a href="../bodega/index.php"><i class="fas fa-cubes rounded-circle" aria-hidden="true"></i></a></span> -->
			                    </div>
		                  	</div>
		                </div>

		            </div>
				</div>
			</div>
		</div>

	 <script src="js/script.js"></script>
	</body>

<script type="text/javascript">
function confirmSave()
 {
	 var respuesta = confirm("¿Eres El Administrador de JJQUIMIENVASES?");
	 if (respuesta == true){
		 return true;
	 }
	 else {
		 return "solicitar";
	 }
 }

</script>
