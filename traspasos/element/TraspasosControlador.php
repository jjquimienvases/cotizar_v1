<?php
require_once "./main.php";
require_once "./conexion.php";

//consultando bodega
class TraspasosControlador
{

    // ----- Metodo para consultar Traspasos Finalizados
    public function consultar_Traspasos_controlador()
    {

        $conexion = new main();
        $bodega = $_POST['bodega'];
        $bodega_receiver_id = 0;
        $bodega_send_id = 0;
        $codigo = 0;
        $info_adicional = "";
        $estado = "solicitud";
        $rol_usuario = $_SESSION['id_rol'];
        $user_id  = $_SESSION['userid'];
        $principal = [1, 6, 4];
    
  
        if ($rol_usuario == 1) {
            $bodegaReceiver = "producto_av";
        } else if ($rol_usuario == 2) {
            $bodegaReceiver = "producto";
        } else if ($rol_usuario == 3) {
            $bodegaReceiver = "producto_d1";
        } else if ($rol_usuario == 4) {
            $bodegaReceiver = "producto_av";
        } else if ($rol_usuario == 6) {
            $bodegaReceiver = "producto_av";
        } else if ($user_id == 27){
            $bodegaReceiver = "productos_ibague2";
        } else if ($rol_usuario == 7) {
            $bodegaReceiver = "productos_ibague";
        } else if ($rol_usuario == 9) {
            $bodegaReceiver = "producto_av";
        }

        //aqui vamos a recolectar los ver_datos
        if ($rol_usuario == 9) {
            // consultar traspasos pero solo la categoria #4
            $consulta_obtener_datos = $conexion->ejecutar_consulta_simples("SELECT * FROM traspasos WHERE (estado = 'Solicitud Finalizada' ) AND bodega_salida = '$bodegaReceiver' AND id_categoria=4 or id_categoria=13 or id_categoria = 21 ");
            echo " <table class='table table-bordered'>";
            echo " <thead class='thead-dark'>";
            echo " <tr >";
            echo "<th>Codigo </th>";
            echo "<th>Fecha</th>";
            echo "<th>Bodega Destino </th>";
            echo "<th>Producto </th>";
            echo "<th>Categoria</th>";
            echo "<th>Cantidad</th>";

            echo "  </tr>";
            echo "  </thead>";
            while ($valores = $consulta_obtener_datos->fetch(PDO::FETCH_ASSOC)) {
                echo "<tbody>";
                echo "<tr>";
                echo "<th scope='row'>" . $valores['codigo'] . "</th>";
                echo " <td>" . $valores['order_date'] . "</td>";
                echo "<td>" . $valores['bodega_entrada'] . "</td>";
                echo "<td  >" . $valores['producto'] . "</td>";
                echo "<td  >" . $valores['id_categoria'] . "</td>";
                echo " <td><center>" . $valores['cantidad'] . "</center><a class='btn btn-outline-info' onclick=change_cantidad(" . $valores['id'] . ")>Cambiar Cantidad</a></td>";

                echo "</tr> ";
                echo "</tbody> ";
            }
            echo "</table> ";
        } else {
              if (isset($bodega) && $bodega != "") {

                $consulta = "SELECT * FROM traspasos WHERE bodega_salida = '$bodegaReceiver' AND estado = 'Solicitud Finalizada' AND bodega_entrada='" . $bodega . "'";
            } else {
                $consulta = "SELECT * FROM traspasos WHERE bodega_salida = '$bodegaReceiver' AND estado = 'Solicitud Finalizada'";
            }
            
            // consultar todos los trasapasos
     $conexion = main::conectar();
            $datos = $conexion->query($consulta);
            $datos = $datos->fetchAll();
            $total = $conexion->query("SELECT  FOUND_ROWS()");
            $total = (int) $total->fetchColumn();
            echo " <table class='table table-responsive'>";
            echo " <tr >";
            echo "<th scope='col'>Codigo </th>";
            echo "<th scope='col'>Fecha</th>";
            echo "<th scope='col'>Bodega Destino </th>";
            echo "<th  scope='col'>Producto </th>";
            echo "<th scope='col'>Cantidad </th>";
            echo "<th scope='col'>Seleccionar</th>";
            echo " <th scope='col'>Pendiente</th>";
            echo "  </tr>";
            if ($total >= 1) {
                $contador = 0;
                foreach ($datos as $valores) {

                    echo "<tbody>";
                    echo "<tr>";
                    echo "<th scope='row'>" . $valores['codigo'] . "</th>";
                    echo " <td>" . $valores['order_date'] . "</td>";
                    echo "<td>" . $valores['bodega_entrada'] . "</td>";
                    echo "<td >" . $valores['producto'] . "</td>";
                    echo " <td><center>" . $valores['cantidad'] . "</center>";
                    if ($valores['id_categoria'] == 4 && $valores['bodega_salida'] == "producto_av") {
                        echo "</td>";
                        echo "<td><center><input type='checkbox' name='selecionados[]' value='" . $valores['id'] . "'></center></td>";
                        echo "<td><a onclick=pendiente(" . $valores['id'] . "); class='btn btn-danger'>Pendiente</a></td>";
                        echo "</tr> ";
                    } else {
                        echo "<a class='btn btn-warning' onclick=change_cantidad(" . $valores['id'] . ")>Cambiar Cantidad</a></td>";
                        echo "<td><center><input type='checkbox' name='selecionados[]' value='" . $valores['id'] . "'></center></td>";
                        echo "<td><a onclick=pendiente(" . $valores['id'] . "); class='btn btn-danger'>Pendiente</a></td>";
                        echo "</tr> ";
                        echo "</tbody> ";
                    }
                }
            }else {

                echo '<tr><td colspan="0">No hay regristos en el sistema</td></tr>';
    
            }
            echo "</table> ";

        }

    } // ----- Fin del Metodo para consultar traspasos finalizados

    // -----  Metodo para actualizar el traspaso a finalizado -----//
    public function actualizar_traspasos_a_finalizado()
    {
        $bodega_receiver_id = 0;
        $bodega_send_id = 0;
        $codigo = 0;
        $info_adicional = "";
        $estado = "solicitud";
        $rol_usuario = $_SESSION['id_rol'];
        $user_id = $_SESSION['userid'];

        if ($rol_usuario == 1) {
            $bodegaReceiver = "producto_av";
        } else if ($rol_usuario == 2) {
            $bodegaReceiver = "producto";
        } else if ($rol_usuario == 3) {
            $bodegaReceiver = "producto_d1";
        } else if ($rol_usuario == 4 or $rol_usuario == 6) {
            $bodegaReceiver = "producto_av";
        } else if ($user_id == 27){
            $bodegaReceiver = "productos_ibague2";
        } else if ($rol_usuario == 7) {
            $bodegaReceiver = "productos_ibague";
        } else if ($rol_usuario == 9) {
            $bodegaReceiver = "producto_av";
        }
        $conexion = new main();
        $consulta = $conexion->ejecutar_consulta_simples("SELECT * FROM traspasos WHERE estado = 'solicitud' AND bodega_entrada = '$bodegaReceiver'");
        while ($registro = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $actualizarDatos = $conexion->ejecutar_consulta_simples("UPDATE  traspasos SET estado='Solicitud Finalizada' WHERE id=" . $registro['id']);

        } //-- Termina de actualizar la tabla
    }
    // ----- Fin del metodo para actualizar el traspaso a finalizado -----//

    // ----- Metodo Para Actualizar El traspaso a transito ----- //
    public function actualizar_traspasos_a_transito()
    {
        $conexion = new main();
        foreach ($_POST['selecionados'] as $sele) {
            $actualizarDatos = $conexion->ejecutar_consulta_simples("UPDATE traspasos SET estado='Transito' where id=" . $sele);

        }

        // ----- Fin del Metodo para Actualizar el traspaso a transito ----- //

    }

    public function actualizar_cantidad_traspasos()
    {
        $id_traspasos = $_POST['id'];
        $cantidad = $_POST['cantidad'];
        $conexion = new main();
        $actualizarDatos = $conexion->ejecutar_consulta_simples("UPDATE traspasos SET cantidad='" . $cantidad . "' where id=" . $id_traspasos);
    }
}
