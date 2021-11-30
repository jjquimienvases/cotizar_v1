<?php
function formatear($num){
  setlocale(LC_MONETARY, 'en_US');
  return "$" . number_format($num, 2);
}
	include_once 'conexion0.php';
// 	$mysqli2 = new mysqli ('ftp.profruver.com', 'profru_jjquimi', 'LeinerM4ster', 'profru_cotpruebas');  
	
	
	//usuarios

$tamara = 32;
$nidia = 30;
$andrea = 6;
$maria = 8;
$karen = 25;
$leidy = 10;
$sergio = 9;
// $fecha_inicio =$_POST['fecha_inicio'];
// $fecha_final = $_POST['fecha_final'];

   $sentencia_select=$con->prepare('SELECT * FROM `factura_orden` WHERE metodopago = "mostradorjj AND estado = "finalizado"');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT * FROM factura_orden WHERE order_id LIKE :campo OR order_receiver_name LIKE :campo OR order_receiver_address LIKE :campo OR order_date LIKE :campo AND metodopago = "mostradorjj" AND estado != "anulado";'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();

	}	
	
	//metodo buscar cotizaciones de leidy 
		if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscamos=$con->prepare('
			SELECT * FROM factura_modificada WHERE order_date LIKE :campo AND punto_pago = "mostradorjj";'
		);

		$select_buscamos->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultados_leidy = $select_buscamos->fetchAll();

	}

	$count = 0;
	$count_call = 0;
	$mi_total_final = 0;
	

	//aqui voy a intentar sacar el reporte
	
// 	$result= $mysqli2 -> query ("SELECT count(*) as total from factura_orden WHERE user_id = '$tamara'");
//     $data=mysqli_fetch_assoc($result);
//     $cuenta_tamara = $data['total'];


//     $cuenta_tamara = $data['total'];
//     $result= $mysqli2 -> query ("SELECT count(*) as total2 from factura_orden WHERE user_id = '$nidia'");
//     $data4=mysqli_fetch_assoc($result);

//     $cuenta_tamara = $data['total'];
//     $result= $mysqli2 -> query ("SELECT count(*) as total3 from factura_orden WHERE user_id = '$andrea'");
//     $data3=mysqli_fetch_assoc($result);

//     $cuenta_tamara = $data['total'];
//     $result= $mysqli2 -> query ("SELECT count(*) as total4 from factura_orden WHERE user_id = '$maria'");
//     $data2=mysqli_fetch_assoc($result);

//     $cuenta_tamara = $data['total'];
//     $result= $mysqli2 -> query ("SELECT count(*) as total5 from factura_orden WHERE user_id = '$karen'");
//     $datas=mysqli_fetch_assoc($result);

//     $cuenta_tamara = $data['total'];
//     $cuenta_nidia = $data4['total2'];
//     $cuenta_andrea = $data3['total3'];
//     $cuenta_maria = $data2['total4'];
//     $cuenta_karen = $datas['total5'];

 
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="euc-jp">

	<title>Cotizaciones Mostrador JJ</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
  <style>
	*{
			padding: 0;
			margin: 0px;
			box-sizing: border-box;
	}

	body{
			font-family: 'Arial',sans-serif;
			font-size: 16px;
			background: #f2f2f2;
	}

	a{
			text-decoration: none;
	}
	.contenedor{
			width: 90%;
			max-width: 1400px;
			margin: 30px auto;
			overflow: hidden;

	}

	h2{
			display: block;
			margin-top: 20px;
			margin-bottom: 20px;
			text-align: center;
			font-size: 20px;
			font-family: 'Arial', sans-serif;
			font-weight: bold;
			color: #555;
	}

	.barra__buscador{
			width: 100%;
			margin-top: 50px;
			margin-bottom: 10px;
	}

	.formulario{
			display: flex;
			width: 100%;
			overflow: hidden;
	}

	form .input__text{
			width: 100%;
			border: 1px solid #ccc;
			border-radius: 5px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #848688;
			display: block;
			font-size: 14px;
			margin-bottom: 15px;
			padding: 10px 15px;
			max-width: 30%;
			margin-right: 10px;
			outline: medium none;
	}


	form .input__text:focus{
			border: 1px solid #1b743c;
	}
	form .form-group{
			display: flex;
			width: 100%;
			flex-wrap: nowrap;
			justify-content: space-between;
	}

	form .form-group .input__text{
			max-width: 45% !important;
	}


	form .btn{
			border: 1px solid #ccc;
			border-radius: 5px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #fff;
			display: block;
			font-size: 14px;
			background: rgb(3, 113, 163);
			margin-bottom: 15px;
			padding: 10px 20px;
			margin-right: 10px;
			outline: medium none;
			cursor: pointer;
	}
	.btn__nuevo{
			float: right;
			background: #1b743c !important;
	}

	.btn__group{
			width: 100%;
			display: flex;
			flex-direction: row;
			justify-content: flex-end;
	}
	.btn__primary{
			background: rgb(3, 113, 163);
	}
	.btn__danger{
			background: #8a0505 !important;
	}


	/* table */
	table{
			width: 100%;
			border-collapse: collapse;
	}

	table .head{
			background: rgb(3, 113, 163);
	}
	table .head td{
			color: #fff;
			font-family: 'Arial',sans-serif;
			font-weight: bold;
			font-size: 15px;
			text-align: center;
	}

	table tr td{
			border:1px solid #ccc;
			padding: 7px;
			font-size: 14px;
			color: #555;
	}

	.btn__update{
			display: inline-block;
			font-size: 14px;
			background: #1b743c;
			color: #fff;
			border-radius: 5px;
			padding: 5px 10px;
	}

	.btn__delete{
			display: inline-block;
			font-size: 14px;
			background: #8a0505;
			color: #fff;
			border-radius: 5px;
			padding: 5px 10px;
	}

	</style>
	<script src="../../jquery-3.1.1.min.js"></script>
   <link rel="stylesheet" href="css/dise単o.css">
   <link href="https://fonts.googleapis.com/css2?family=Gentium+Basic&family=Julius+Sans+One&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="fonts/icomoon/style.css">
 <link rel="stylesheet" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="css/magnific-popup.css">
 <link rel="stylesheet" href="css/jquery-ui.css">
 
 <link rel="stylesheet" href="css/owl.carousel.min.css">
 <link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="css/aos.css">
<link href="https://fonts.googleapis.com/css?family=roboto" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 </head>
<body>
	<div class="contenedor">

		<!--<h2>Cotizaciones Efecticas D1</h2>-->
		<!--<h4>elegir una fecha</h4>-->
		<!--<form action="" enctype="multipart/form-data" method="post">-->
		 
		<!--<label>INCIAL</label>    -->
		<!--<input type="datetime-local" name="fecha_inicio" step="1" min="2019-01-01 00:00:00" max="2022-12-31 00:00:00" value="<?php echo date("Y-m-d h:i:s");?>">-->
		<!--<hr>-->
		<!--<label>FINAL</label>   -->
		<!--<input type="datetime-local" name="fecha_final" step="1" min="2019-01-01 00:00:00" max="2022-12-31 00:00:00" value="<?php echo date("Y-m-d h:i:s");?>">-->
  <!--       <button type="submit">OK</button>		    -->
		<!--</form>-->
    <div class="barra__buscador">
      <form action="" class="formulario" method="post">
        <input type="text" name="buscar" placeholder="buscar cotizacion o cliente	"
        value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
        <input type="submit" class="btn" name="btn_buscar" value="Buscar">
      </form>
    </div>

    	<?php $count++; ?>
		<table>
			<tr class="head">
        <td>#</td>
				<td>Cotizacion</td>
				<td>Cliente</td>
				<td>Comercial</td>
                <td>Fecha</td>
                <td>Monto</td>

			</tr>
			<?php
          $totall = 0;
        ?>
			<?php foreach($resultado as $fila):?>
				<tr >
                    <td><?php echo $count++ ?> </td>
					<td><?php echo $fila['order_id']; ?></td>
					<td><?php echo $fila['order_receiver_name']; ?></td>
					<td><?php echo $fila['order_receiver_address']; ?></td>
					<td><?php echo $fila['order_date']; ?></td>
          <?php
            $monto = 0;
            $valor = $fila['order_total_after_tax'];
            $monto = $valor;
           ?>
          <td id="valores">

         <?php
        //     echo formatear($monto);?>
            
              <input type="text" id="result_mostrador" value=" <?php echo $monto; ?>" > </td>
            </td>
            <?php $totall += $monto; ?>


				</tr>





			<?php endforeach ?>
			
        <tr>
          <td colspan="5">MONTO TOTAL MOSTRADOR:</td>
          <td><?= formatear($totall)?></td>
        </tr>
    
      
		</table>
		
		    <hr>
		    <center><h2>Ventas Call Center</h2></center>
		    <hr>
		
		<?php $count_call++; ?>
		<table border="1px">
		    <tr>
		        <th>#</th>
		        <th>cotizacion</th>
		        <th>cliente</th>
		        <th>Fecha</th>
		        <th>Monto</th>
		    </tr>
		    	<?php
          $totalles = 0;
        ?>
		    	<?php foreach($resultados_leidy as $filas):?>
		   <tbody>
		    <tr>
		        <td> <?php echo $count_call++ ?> </td>
		        <td> <?php echo $filas['order_id']; ?>  </td>
		        <td> <?php echo $filas['order_receiver_name']; ?>  </td>
		        <td>  <?php echo $filas['order_date']; ?>  </td>
		        <td id="valores_2"> 
		        
		         <?php
            $monto_call = 0;
            $valor_call = $filas['total'];
            $monto_call = $valor_call;
                  ?>
		      
		   <?php   $info_call = formatear($valor_call);?>
            <?php $totalles += $monto_call; ?>
            
            <input type="text" id="result_call" value=" <?php echo $monto_call; ?>" > </td>
            
		    </tr>
		    
		 
		  
		    <?php endforeach ?>
		
		  
		  	<tr>
          <td colspan="4">MONTO TOTAL CALLCENTER:</td>
          <td> <input type="text" id="okok">
          
             
          </td>
        </tr>
		<tfoot> 
		  <th colspan="4">Ventas Totales Punto Principal:</th>
          <td><input type="text" id="total_suma">  </td>
		</tfoot>
		</table>
		
		
		
		
   <button id="actualizar">Calculo</button>
    

    <span></span>
	</div>


</body>
</html>
<script>

const options2 = { style: 'currency', currency: 'USD' };
const numberFormat2 = new Intl.NumberFormat('en-US', options2);


    $(document).on("click", "#actualizar", function(){
	 var sumatotales = [];
		$("[id^=result_call]").each(function(){
		 sumatotales.push(parseFloat($(this).val()))
		})
		 if (sumatotales != 0){totales = sumatotales.reduce(function(a,b){return a+b})}else{
			 totales = 0;
		 }
		 
		//mostrador
		
		 var sumatotales_mostrador = [];
		$("[id^=result_mostrador]").each(function(){
		 sumatotales_mostrador.push(parseFloat($(this).val()))
		})
		 if (sumatotales_mostrador != 0){totales_mostrador = sumatotales_mostrador.reduce(function(a,b){return a+b})}else{
			 totales_mostrador = 0;
		 }
		 console.log(numberFormat2.format(totales_mostrador));
// 		 var total_call_mostrador = numberFormat2.format(totales);
// 		 var total_mostrador_jj = numberFormat2.format(totales_mostrador);
		 
// 		 var total = 0:
// 		 total = total_call_mostrador + total_mostrador_jj

		 

	 document.getElementById("okok").value= numberFormat2.format(totales);
     document.getElementById("total_suma").value= numberFormat2.format(totales_mostrador + totales);
	 


})


    
</script>
