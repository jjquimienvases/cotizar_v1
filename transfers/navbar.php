<?php
include 'conexion.php';

$user = $_SESSION['user'];
$user_rol = $_SESSION['id_rol'];
$id_user = $_SESSION['userid'];
if ($user_rol == 2) {
 $href = "../panel_mostrador.php";
} else if ($user_rol == 3) {
$href = "../panel_d1.php";
} else if ($user_rol == 6) {
$href = "../panel_bodega.php";
} else if ($user_rol == 4) {
$href = "../Panel_Comerciales.php";
} else if ($user_rol == 27) {
$href = "../panel_ibague.php";
} else if ($user_rol == 7) {
$href = "../panel_ibague.php";
} else {
$href = "../Panel_Comerciales.php";
}

?>
  
  
  <nav>
    <div class="nav-wrapper orange darken-3">
    <a href="#" class="brand-logo center"><span>TRASPASOS JJ QUIMIENVASES SAS</span></a> 

      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="" class="brand-logo"><i class="material-icons"></i><img src="../logo.png" width="50" height="50" class="mb-2"></a></li>
        </ul>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="transfers_list.php"><i class="material-icons">format_list_bulleted</i></a></li>
            <li><a href="index.php"><i class="material-icons">launch</i></a></li>
            <li><a href="print_transfers.php"><i class="material-icons">picture_as_pdf</i></a></li>
            <li><a href="<?= $href ?>">Regresar al panel</a></li>
        </ul>
    
    </div>
  </nav>