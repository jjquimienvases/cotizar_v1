    <div id="all_info">
        <div class="form-group">


            <!-- <form action="backend/funciones_php/variables.php" method="POST"> -->
            <form id="form_reporte">
                <div class="container">

                    <div class="row">
                        <div class="col-md-4">
                            <label for="fecha_ini">Escoger una Fecha inicial:</label>
                            <input type="date" id="fecha_ini" name="fecha_ini" value="" class="form-control">
                            <label for="fecha_ini">Escoger una Hora inicial:</label>
                            <input type="time" name="hora_ini" class="form-control" step="1">

                        </div>
                        <div class="col-md-4">
                            <label for="fecha_fin">Escoger una Fecha Final:</label>
                            <input type="date" id="fecha_fin" name="fecha_fin" value="" class="form-control">
                            <label for="fecha_fin">Escoger una Hora Final:</label>
                            <input type="time" name="hora_fin" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="punto_venta"><b> Escoger el punto de venta que deseas Filtrar </b></label>
                            <select name="punto_venta" id="punto_venta" class="form-control">
                                <option value="mostradorjj"><b>Punto Principal</b> - Bogota </option>
                                <option value="bancolombia">Call Center</option>
                                <option value="mostradord1">Mostrador D1</option>
                                <option value="mostrador_ibague_1">Punto Principal - Ibague</option>
                                <option value="mostrador_ibague_2">Punto Secundario - Ibague</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-group col-md-4">
                            <label for=""><b>Escoger un metodo de pago:</b></label>
                            <hr>
                            <div id="metodos_de_pago" class="form-group" name="metodos_de_pago">
                                <input class="form-check-input" type="checkbox" id="check_bancolombia" name="check[]" value="bancolombia"><label class="form-check-label" for="check_bancolombia">Bancolombia</label><br>
                                <input class="form-check-input" type="checkbox" id="check_credito" name="check[]" value="credito"><label class="form-check-label" for="check_credito">Credito</label><br>
                                <input class="form-check-input" type="checkbox" id="check_datafono" name="check[]" value="datafono"><label class="form-check-label" for="check_datafono">Datafono</label><br>
                                <input class="form-check-input" type="checkbox" id="check_davivienda" name="check[]" value="davivienda"><label class="form-check-label" for="check_davivienda">Davivienda</label><br>
                                <input class="form-check-input" type="checkbox" id="check_efectivo" name="check[]" value="efectivo"><label class="form-check-label" for="check_efectivo">Efectivo</label><br>
                                <input class="form-check-input" type="checkbox" id="check_mercado_libre" name="check[]" value="mercado"><label class="form-check-label" for="check_mercado_libre">Mercado Pago</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="buscarclient"><b> Buscar cliente:</b> </label>
                                <div class="buscarcliente">
                                    <datalist id="buscarclient">
                                        <option value="">Seleccione un cliente</option>
                                        <?php
                                        $query_clientes = $conexion->query("SELECT * FROM clientes ORDER BY nombres ASC");
                                        while ($valores = mysqli_fetch_array($query_clientes)) {
                                            echo '<option value="' . $valores["cedula"] . '">' . $valores["cedula"] . ',' . $valores["nombres"] . '</option>';
                                        }
                                        ?>
                                    </datalist>
                                    <input class="form-control" list="buscarclient" name="cedulasres" id="buscarcliente" type="text" placeholder="Buscar Cliente">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label for="comercial"><b> Seleccionar un vendedor:</b> </label>


                                <div class="buscarcomercial">
                                    <datalist id="comercial">
                                        <option value="">Seleccione un comercial</option>
                                        <option value="leidy M Velasco">Leidy</option>
                                        <option value="maria">Maria</option>
                                        <option value="sergio">sergio</option>
                                        <?php
                                        /*   $query_comerciales = $conexiones->query("SELECT * FROM factura_usuarios order by first_name WHERE id_rol != 0");
while ($valor = mysqli_fetch_array($query_comerciales)) {
    echo '<option value="' . $valor['first_name'] . '&nbsp;' . $valor['last_name'] . '">' . $valor["first_name"] . '&nbsp;' . $valores["last_name"] . '</option>';
} */
                                        ?>
                                    </datalist>
                                    <input class="form-control" list="comercial" name="comerciales_res" id="buscarcomercial" type="text" placeholder="Buscar Comercial">
                                </div>
                            </div>

                        </div>


                        <div class="form-group">

                            <div class="col-md-4">
                                <label for="estado">Escoger un estado</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="finalizado">Finalizadas</option>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="Solicitud Anular">Solicitud Anular</option>
                                    <option value="Anulada">Anulada</option>
                                    <!--     <option value="pendiente">Pendiente</option> -->
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="estado">Escoger un canal (aplica para call center)</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="finalizado">Call Center</option>
                                    <option value="pendiente">Redes Sociales</option>
                                    <option value="Solicitud Anular">Tienda Virtual</option>
                                </select>
                            </div>
                            <hr>
                        </div>
                        <button class="btn btn-primary" id="send_form" name="send_form">Consultar Reporte</button>
            </form>
        </div>

        <!-- FIN FORMULARIO-->

        <div class="container">

            <h4>Resultado de la consulta: <span id="total_count"></span> <span id="total_monto"></span> </h4>
            <br>
            <ul id="lista_metodos"></ul>
            <table class="table table-bordered">
                <tr>
                    <td id="">
                        <label for="info_monto">EL MONTO TOTAL ES:</label>
                        <input type="text" readonly id="info_monto" class="form-control">
                    </td>
                    <td id="">
                        <label for="filas">EL TOTAL DE COTIZACIONES ES:</label>
                        <input type="number" readonly id="filas" class="form-control">
                    </td>
                </tr>
            </table>
            <center>
                <div id="">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Cotizacion</th>
                                <th>Cliente</th>
                                <th>Comercial</th>
                                <th>Metodo de pago</th>
                                <th>Monto</th>
                                <th>PDF</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>

                    <hr>
                    <h4>En este apartado se muestra la informacion que el usuario decida filtrar.</h4>
                </div>
            </center>
        </div>
    </div>