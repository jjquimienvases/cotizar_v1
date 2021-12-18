<?php
include 'conexion.php';
session_start();
$user = $_SESSION['user'];
$user_id = $_SESSION['userid'];
$user_rol = $_SESSION['id_rol'];
function formatear($num)
{
  setlocale(LC_MONETARY, 'en_US');
  return "$" . number_format($num, 2);
}
if ($user_rol == 2) {
  $bodega_entrada = "producto";
  $bodega_salida = "producto";
} else if ($user_rol == 3) {
  $bodega_entrada = "producto_d1";
  $bodega_salida = "producto_d1";
} else if ($user_rol == 6) {
  $bodega_entrada = "producto_av";
  $bodega_salida = "producto_av";
} else if ($user_rol == 4) {
  $bodega_entrada = "producto_av";
  $bodega_salida = "producto_av";
} else if ($user_id == 27) {
  $bodega_entrada = "productos_ibague2";
  $bodega_salida = "productos_ibague2";
} else if ($user_rol == 7) {
  $bodega_entrada = "productos_ibague";
  $bodega_salida = "productos_ibague";
} else {
  $bodega_entrada = "producto_av";
  $bodega_salida = "producto_av";
}


if(!$user_id){header('Location: https://cotizar.envasesyperfumeria.com/');}else{}

if($user_rol == 5 || $user_rol == 1){
    $sql = $con->query("SELECT * FROM traspaso_orden WHERE estado != 'pendiente'   ORDER BY transfer_id DESC");
}else{
$sql = $con->query("SELECT * FROM traspaso_orden WHERE estado != 'pendiente' AND bodega_salida = '$bodega_salida' OR bodega_entrada = '$bodega_entrada'  ORDER BY transfer_id DESC");
}



?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="../Lib/fontawesome/svg-with-js/js/fontawesome-all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans+SC:wght@200&family=Marcellus+SC&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<title>Lista de traspasos</title>
<div class="container">
  <?php include 'navbar.php';
        include 'modal_notas.php';
  ?>
  <hr class="mt-2">
  <input type="hidden" value="<?= $user ?>" id="user_name" class="user_ps">
  <input type="hidden" value="<?= $user_id ?>" id="user_id" class="user_ps">
    <input type="hidden"  data-target="modal_notes" class="btn modal-trigger" id="open_notes">
  <h2 class="title">Lista de traspasos</h2>
  <table id="data-table" class="table table-condensed">
    <thead>
      <tr>
        <th width="7%">Traspaso</th>
        <th width="15%">Fecha</th>
        <th width="15%">Bodega Entrada</th>
        <th width="15%">Bodega Salida</th>
        <th width="3%">Estado</th>
        <th width="3%">Editar</th>
        <th width="3%">Imprimir</th>
        
         <th width="3%">Print</th>
        <th width="3%">Aprobar</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($sql as $invoiceDetails) :
        $invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceDetails["order_date"]));
        $transfer = $invoiceDetails["transfer_id"];
        $bodegas_entradas = $invoiceDetails["bodega_entrada"];
        $bodegas_salidas = $invoiceDetails["bodega_salida"];
      ?>

        <tr>
          <form method="post">
            <td> <input type="text" id="someId" readonly value="<?= $invoiceDetails["transfer_id"] ?>" /> </input> </td>
            <td><?= $invoiceDate ?></td>
            <td><?= $invoiceDetails["bodega_entrada"] ?></td>
            <td><?= $invoiceDetails["bodega_salida"] ?></td>
            <td><?= $invoiceDetails["estado"] ?></td>
            <?php
             $href = "";
             if($user_rol == 7 || $user_rol == 2 || $user_rol == 3){
               $href = "../print_transfer.php?order= $transfer" ;
              }else{
               $href = "../imprimir_traspaso.php?order= $transfer" ;
             }
             $href2 = "../print_transfer.php?order= $transfer";
            $estado = $invoiceDetails["estado"];
            if ($user_rol == 5 || $user_rol == 1) {
           
              echo "<td><button type='submit' onclick='getInfoUser($transfer)' name='someId' class='waves-effect waves-light btn modal-trigger deep-orange darken-1 ' id='get_info' href='#modal'><i class='fas fa-edit text-center' style='padding-top: 10px'></i></button>";
            }else if($estado != "solicitud" || $bodegas_entradas == $bodega_entrada){
              echo "<td>No puedes editar</td>";
            }
            else{
              echo "<td><button type='submit' onclick='getInfoUser($transfer)' name='someId' class='waves-effect waves-light btn modal-trigger deep-orange darken-1' id='get_info' href='#modal'><i class='fas fa-edit text-center' style='padding-top: 10px'></i></button>";
            }

            ?>
            </td>
          </form>
          <td><a href="<?= $href ?>" target="_blank" title="Imprimir Traspaso">
              <div class="btn light-blue lighten-1"><i class="fas fa-print" style="padding-top: 10px"></i></div>
            </a></td>
            
            <?php 
             if($user_rol == 6 || $user_rol == 9){
                 echo "<td><a href='$href2' target='_blank' title='Imprimir Traspaso'>
              <div class='btn pink accent-3'> <i class='far fa-file-pdf' style='padding-top: 10px'></i></div>
            </a></td>";
             }else{
                 echo "<td><a href='#' title='Imprimir Traspaso'>
              <div class='btn pink accent-3'> <i class='fas fa-question' style='padding-top: 10px'></i></div>
            </a></td>";
             }
             
            ?>
            
            <?php 
             if($estado == "transito" && $bodegas_entradas == $bodega_entrada){
                 echo "<td><div class='btn btn-success' id='finish_transfer' onclick='aprobar_traspasos($transfer)'><i class='fas fa-paper-plane' style='padding-top: 10px'></i></div></td>";
             }else{
                 
                 if($estado == "transito" && $bodegas_entradas != $bodega_entrada){
                 echo "<td style='color: #ff7f26'>$estado</td>";
                 }else if($estado == "finalizado"){
                 echo "<td style='color: #068000'>$estado</td>";
                 }else{
                 echo "<td style='color: #ed1b24'>$estado</td>";
                 }
             }
            ?>
            

        </tr>

      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include 'modal_create.php'; ?>
<script>
  $(document).ready(function() {
    $('#data-table').DataTable();
  });
</script>
<script src="js/funciones.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->