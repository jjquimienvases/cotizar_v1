<?php

include_once '../conexion_proveedor.php';
include('conexion.php');
session_start();
$rol_user= $_SESSION['id_rol'];
$user_id = $_SESSION['userid'];

$tmp = array(); 
$res = array();

$status = "Transito";
/* $seleccion = $conexion ->query("SELECT * FROM traspasos WHERE estado '$status' AND id_rol_bodega_entrada = $rol_user");
 */
          if ($rol_user == 1) {
            $bodegaReceiver = "producto_av";
          }else if($rol_user == 2){
            $bodegaReceiver = "producto";
          }else if($rol_user == 3){
            $bodegaReceiver = "producto_d1";
          }else if($rol_user == 4){
            $bodegaReceiver = "producto_av";
          }else if($rol_user == 6){
            $bodegaReceiver = "producto_av";
          }else if($user_id == 27){
            $bodegaReceiver = "productos_ibague2";
              }else if($rol_user == 7){
            $bodegaReceiver = "productos_ibague";
          }
 
 
$sel = $conexion->query("SELECT * FROM traspasos WHERE estado = '$status' AND bodega_entrada = '$bodegaReceiver'");

while ($row = $sel->fetch_assoc()) {
    $tmp = $row;
    array_push($res, $tmp);

}

// echo "<pre>";
// echo "/<pre>";
// return;

if(isset($_POST['btn_buscar'])){
  $buscar_text=$_POST['buscar'];
  $select_buscar=$con->prepare('
    SELECT * FROM traspasos WHERE order_date LIKE :campo OR bodega_salida LIKE :campo OR bodega_entrada LIKE :campo OR codigo LIKE :campo OR producto LIKE :campo AND estado = "transito";'
  );
  $select_buscar->execute(array(
    ':campo' =>"%".$buscar_text."%"
  ));
  $res=$select_buscar->fetchAll();
}

?>




<html>
    <head><meta charset="gb18030">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
        <script src="jquery-3.1.1.min.js"></script>
        <title>Aprobar Traspaso</title>
         <link rel="stylesheet" href="css/estilos.css"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style media="screen">
       #inputs{
         text-decoration:none;
         border: 3px;
       }

    </style>



      </head>

    <body>
         <br>
                 <br>
    <?php 
                 $link_call = "<button class='btn btn-warning' id='boton_panel'><a href='../Panel_Comerciales.php'> Regregar a tu panel principal </a> </button>";
                 $link_bodega = "<button class='btn btn-warning' id='boton_panel'><a href='../panel_bodega.php'> Regregar a tu panel principal </a> </button>";
                 $link_ibague = "<button class='btn btn-warning' id='boton_panel'><a href='../panel_ibague.php'> Regregar a tu panel principal </a> </button>";
                 $link_d1 = "<button class='btn btn-warning' id='boton_panel'><a href='../panel_d1.php'> Regregar a tu panel principal </a> </button>";
                 $link_mostrador = "<button class='btn btn-warning' id='boton_panel'><a href='../panel_mostrador.php'> Regregar a tu panel principal </a> </button>";
                    if($rol_user == 4){
                    echo $link_call;
                    }else if($rol_user == 7){
                    echo $link_ibague;
                    }else if($rol_user == 2){
                      echo $link_mostrador;
                    }else if($rol_user == 6){
                      echo $link_bodega;
                    }else if($rol_user == 3){
                      echo $link_d1;
                    }else if($rol_user == 1){
                      echo $link_call;
                    }
                 ?>
                 <br>
                 <br>
      <h2>Aqui aprobamos la mercancia que recibimos en nuestra bodega.</h2>
      <hr>
      <br>
<div id="principal_efectuar">
    <div class="my_container">
      <center><h3>Buscar Traspasos</h3>
      <div class="barra__buscador">
        <form action="" class="formulario" method="post">
          <input type="text" name="buscar" id="input_buscador" class="mi_bucador" placeholder="buscar ID  o Fecha"
          value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
          <br>
         <button type="submit" class="btn btn-success" name="btn_buscar" value="Buscar">Buscar</button>
        </form>

      </div> </center>

      <hr>

<table class="table table-bordered table-hover" width="100%">
 <?php echo $rol_user; ?>
 <?php echo $bodegaReceiver; ?>
<thead>
    <tr class="bg-success" style="color:white">
        <th scope="col">Fecha</th>
        <th scope="col">Codigo</th>
        <th scope="col">Productos</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Bodega Despacho</th>
        <th scope="col" colspan="2">Accion</th>
    </tr>

</thead>

<tbody>
    <?php foreach ($res as $val) { ?>
            <form class="" action="finalizar_traspaso.php" method="post">
        <tr>
            <td><?php echo $val['order_date'] ?> </td>
            <input type="hidden" name="id" value="<?php echo $val['id']; ?>">
            <td> <input readonly id="inputs" type="text" class="form-control" name="id_codigo" value="<?php echo $val['codigo']; ?>">  </td>
            <td> <input readonly id="inputs" type="text" class="form-control" name="contratipo" value="<?php echo $val['producto']; ?>">  </td>
            <td> <input readonly id="inputs" type="text" class="form-control" name="cantidad" value="<?php echo $val['cantidad']; ?>" > </td>
            <td> <input readonly id="inputs" type="text"   name="bodega_salida" value="<?php echo $val['bodega_salida']; ?>">  </td>
            <input type="hidden" name="bodega_entrada" value="<?php echo $val['bodega_entrada']; ?>"> 

            <td>
                <?php 
                  $boton = "<button type='submit' name='send' id='aprobar' value='Completado' class='btn btn-success'>Aprobar</button>";
                     echo $boton;
                ?>
            </td>
            <td>
                <?php 
                  $boton_anular = "<button type='submit' name='no_send' id = 'no_aprobar' value='no llego' class='btn btn-danger'>No Llegó</button>";
                  echo $boton_anular;
                ?>
            </td>   
        </tr>
          </form>
    <?php } ?>
</tbody>
</table>
</div>
<!-- div contenedor de las tablas que van a mostrar la mercancia aprobada y la mercancia que no llego  -->
<div id="si_aprobado"> APROBADO</div>
<hr>
<div id="no_aprobado"> NO LLEGO</div>


</div>

    </body>
    </html>
    <script>
    // $(document).ready(function() {
    //         function obtener_data_pedido_aprobado(){
    //         $.ajax({
    //         url: "element/mostrar_aprobado.php",
    //         method: "POST",
    //         success: function(data) {
    //             $("#si_aprobado").html(data)
    //         }
    //     })    
    // }
    
    // $(document).on("click", "#aprobar",function(){
    //     obtener_data_pedido_aprobado();
    
        
    // })
    // }    
        
     </script>

