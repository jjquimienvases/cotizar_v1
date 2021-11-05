
<?php
/* include '../conexion.php'; */

/* header('Content-Type: application/json'); */
$con = new mysqli ('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_prueba');

/* $sql = "SELECT pav.unidad, pav.stock, pav.id, pav.contratipo, p.codigo, p.empresa, p.telefono, p.telefono_asesor, p.asesor, pp.precio, p.nit, p.direccion FROM proveedor_producto pp INNER JOIN proveedor p ON p.codigo = pp.proveedor_id INNER JOIN producto_av pav ON pav.id = pp.producto_id WHERE pav.id = 1263";
 */
if($con){
  /*   $execute = $con->query($sql);
    foreach($execute as $data){
        $asesor = $data['asesor'];
       print_r($asesor); 
     } */

     $sql = $con->query("SELECT * FROM clientes LIMIT 20");
     foreach ($sql as $data){
         $nombres = $data['nombres'];
         print_r($nombres);
     } 
}else{
    print_r("hola  no funcinona");
}




















/* $response = new stdClass;
$fun = $_POST['key'];
$status_p = "pendiente"; 
 */
/* 
        $item_id = 41; */
        /*         $sql = "SELECT * FROM traspaso_producto_id WHERE bodega_entrada = '$bodega_entrada' AND item_status = 'pendiente'";*/
        /* $sql = "SELECT pav.unidad, pav.stock, pav.id, pav.contratipo, p.codigo, p.empresa, p.telefono, p.telefono_asesor, p.asesor, pp.precio, p.nit, p.direccion FROM proveedor_producto pp INNER JOIN proveedor p ON p.codigo = pp.proveedor_id INNER JOIN producto_av pav ON pav.id = pp.producto_id WHERE pav.id = $item_id"; */
/*         $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;

echo json_encode($response);

 */


/* $sql = $conexion->query("SELECT pav.unidad, pav.stock, pav.id, pav.contratipo, p.codigo, p.empresa, p.telefono, p.telefono_asesor, p.asesor, pp.precio, p.nit, p.direccion FROM proveedor_producto pp INNER JOIN proveedor p ON p.codigo = pp.proveedor_id INNER JOIN producto_av pav ON pav.id = pp.producto_id WHERE pav.id = 47");
$row = $sql->fetch_all(MYSQLI_ASSOC);

echo $row ;
 */