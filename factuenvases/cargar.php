<?php
include ("conections.php");
$conn=conectar();
$vendedor = $_POST['vendedor'];
$cliente = $_POST['cliente'];
$cotizacion = $_POST['cotizacion'];
$estadoactual = $_POST['estadoactual'];
$metodo = $_POST['metodop'];
if(isset($_FILES['img'])){
    $nombreImg=$_FILES['img']['name'];
    $ruta=$_FILES['img']['tmp_name'];
    $destino="../imagenes/".$nombreImg;
    if(copy($ruta,$destino)){
        $sql="INSERT INTO factura_modificada (order_id, user_id, order_receiver_name, estado, metodopago, nombre, ruta) VALUES ('$vendedor','$cotizacion','$cliente','$estadoactual','$metodo','$nombreImg','$destino')";
        $res=mysqli_query($conn,$sql);
        if($res){
            echo '<script type="text/javascript"> alert("Estado de cotizacion actualizado correctamente"); window.location="bodega.php";</script>';

        }else{
            die("Error".mysqli_error($conn));
        }

    }

}
?>
