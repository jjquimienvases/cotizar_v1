<?php
class ordenesControlador extends main
{

    public function actualizar_estado_finalizado()
    {
        //$id=$_POST['idsolicitud'];
        $codigo = (isset($_POST['codigo'])) ? $_POST['codigo'] : "";
        $id = (isset($_POST['idsolicitud'])) ? $_POST['idsolicitud'] : "";
        $estado = "Finalizado";

        $conexion = main::ejecutar_consulta_simples("SELECT * FROM solicitud_productos where estado='solicitud'");
        while ($registro = $conexion->fetch(PDO::FETCH_ASSOC)) {

            $agregar = main::ejecutar_consulta_simples("UPDATE `solicitud_productos` SET estado='Solicitud Finalizada'  where id=" . $registro['id']);
        }

    }
    public function consultar_ordenes_de_compra()
    {

        $estado = $_POST['estado'];
        $fechaIni = $_POST['fechaI'] . "&nbsp;" . "08:01:00";
        $fechaFin = $_POST['fechaF'] . "&nbsp;" . "19:59:59";
        $only_inicio = $_POST['fechaI'];
        $only_final = $_POST['fechaF'];
        if (isset($fechaIni) && $fechaIni != "") {
            $consulta = "SELECT * FROM solicitud_productos  where DATE(fecha_solictud) between '" . $only_inicio . "' and '" . $only_final . "';";
        }else if($estado != "" && $fechaIni != ""){
             $consulta = "SELECT * FROM solicitud_productos  where DATE(fecha_solictud) between '$only_inicio' and '$only_final and estado = '$estado'";

        }
        if (isset($estado) && $estado != "") {

            $consulta = "SELECT * FROM solicitud_productos where estado='" . $estado . "';";

        } else {
            $consulta = "SELECT * FROM solicitud_productos where estado!='Pendiente' ORDER BY `id` DESC";
        }

        $conexion = main::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT  FOUND_ROWS()");
        $total = (int) $total->fetchColumn();
        echo "<table class='table'>
        <thead>
        <th>Fecha Solicitud</th>
            <th>Orden</th>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Solicitante</th>
            <th>Fecha Aprobacion</th>
            <th>Estado</th>
            <th>Accion</th>
        </thead>";

        if ($total >= 1) {
            $contador = 0;
            foreach ($datos as $registro) {
                echo "<tr>";
                echo "<td><center>" . $registro['fecha_solicitud'] . "</center></td>";
                echo "<td><center>" . $registro['id'] . "</center></td>";
                echo "<td><center>" . $registro['item_id'] . "</center></td>";
                echo "<td><center>" . $registro['item_name'] . "</center></td>";
                echo "<td><center>" . $registro['item_quantity'] . "</center></td>";
                echo "<td><center>" . $registro['solicitante'] . "</center></td>";

                echo "<td><center>" . $registro['fecha_aprobacion'] . "</center></td>";
                echo "<td><center>" . $registro['estado'] . "</center></td>";
                if ($registro['estado'] == "Pendiente") {
                    echo "<td></td>";

                    echo "</tr>";

                }else{
                    echo "<td><a onclick=actualizar_estado_pendiente(" . $registro['id'] . ");  class='btn btn-success form-control'>Pendiente</a></td>";
                    echo "</tr>";
                }
               
                $contador++;
            }

        } else {

            echo '<tr><td colspan="0">No hay regristos en el sistema</td></tr>';

        }

        echo "</table>";
    }

    public function actualizar_estado_pendiente()
    {
        $id = $_POST['id_orden'];
        $estado = "Pendiente";
        if (isset($id)) {
            $actualizar_pendiente = main::ejecutar_consulta_simples("UPDATE solicitud_productos set estado='" . $estado . "' where id=".$id);
          
        }
    }

}
