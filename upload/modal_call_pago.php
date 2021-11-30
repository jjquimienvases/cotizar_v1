<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aprobar y alistar cotizacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <h3>Buscar Cotizacion</h3>
                    <!-- <div class="contenedor">
                        <form class="" action="" method="post">
                          <center><div class="input-contenedor">
                            <input type="text"  placeholder="Cliente o factura" name="producto" size="50" id="producto" required autocomplete="off" autofocus class="form-control">
                            <input type="hidden" name="buscar_cotizacion" size="200">
                          </div></center>
                        </form>
                      </div> -->
                    <div class="buscarcliente">
                        <datalist id="buscarclient">
                            <option value="">Seleccione una cotizacion</option>
                            <?php
                            $query = $conexion->query("SELECT * FROM factura_orden ORDER BY order_date DESC LIMIT 20");
                            // $query = $con->query("SELECT * FROM factura_orden ");
                            while ($valores = mysqli_fetch_array($query)) {
                                echo '<option value="' . $valores["order_id"] . '">' . $valores["order_id"] . ',' . $valores["order_receiver_name"] . '</option>';
                            }
                            ?>
                        </datalist>
                        <input class="form-control" list="buscarclient" name="cedulasres" id="buscarcliente" type="text" placeholder="Buscar Cotizacion">
                    </div>
                    <button class="btn btn-success rounded" id="consultor">Buscar</button>
                    <form enctype="multipart/form-data" id="form1" name="form1" method="post">
                        <div class="form-group">
                            <label for="title">Cotizacion</label>
                            <input type="text" class="form-control" id="cotizacion" name="cotizacion" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="title">Cliente</label>
                            <input type="text" class="form-control" id="title" name="title" value="" readonly>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Monto Y Fecha</span>
                            <input type="number" aria-label="Monto " name="monto" class="form-control" readonly>
                            <input type="text" aria-label="Fecha " name="fecha" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md5">
                            <label for="description">Datos adicionales</label>
                            <input type="text" class="form-control" id="description" name="description" value="" placeholder="Escribir una nota">
                            <br>
                            <!-- <input class="form-control" type="text" placeholder=" codigo de aprobacion de pago" name="codigo" value=""> -->
                        </div>

                </div>
                <div class="col-auto">
                    <div class="form-group col-md2">
                        <label for="">Selecciona Bodega de pago y/o despacho:</label>
                        <select class="form-control" name="id_bodega">
                            <option value="call center">Call Center</option>
                            <option value="mostrador principal">Mostrador Pricipal</option>
                            <option value="mostrador D1">Mostrador D1</option>
                            <option value="ibague">Ibague</option>
                            <option value="ibague2">Ibague 2</option>
                        </select>
                    </div>
                    <hr>
                    <div>
                        <label>Seleccionar Canal de venta:</label>
                        <select class="form-control" name="canal_v">
                            <option value="call center" selected>Call Center</option>
                            <option value="redes sociales">Redes Sociales</option>
                            <option value="tienda virtual">Tienda Virtual</option>
                        </select>

                    </div>

                    <hr>

                    <div class="form-group col-md2">
                        <label for="">Seleccionar un metodo de pago:</label>
                        <select class="form-control" name="pago">
                            <option value="bancolombia" Selected>Bancolombia</option>
                            <option value="davivienda">Davivienda</option>
                            <option value="efectivo">Efectivo</option>
                            <option value="contra entrega">Contra entrega</option>
                            <option value="credito">credito</option>
                            <option value="mercado libre">mercado libre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imagen">Foto del pago:</label>
                        <input type="file" class="form-control" id="imagen" name="imagen">
                    </div>
                    <input type="hidden" class="form-control" id="vendedor" name="vendedor" value="" readonly>
                    <input type="hidden" class="form-control" id="estadoactual" name="estadoactual" value="alistamiento" readonly>
                    <!-- <input type="hidden" class="" id="monto" name="monto" value="" readonly> -->

                    <!-- <input class="form-control" type="hidden" placeholder="Estado" name="estado" value="alistamiento" readonly> -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="submitForm" onclick="onSubmitForm()">Guardar</button>
                    <button type="button" class="btn btn-warning" onclick="onSubmitMostrador()">Adjuntar Mostrador</button>

                </div>
            </div>
        </div>
    </div>