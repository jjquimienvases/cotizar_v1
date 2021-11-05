<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver Abonos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar_data()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="buscarcliente">
                <form id="form2" method="post" enctype="multipart/form-data">
                    <div class="info_1" id="info_1">
                        <div class="row">
                            <div class="col">
                                <label class="">cotizacion</label>
                                <input type="number" name="order_ids" readonly class="form-control">
                            </div>
                            <div class="col">
                                <label class="">cliente</label>
                                <input type="text" name="cliente" readonly class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <!-- <label class="">Fecha</label>
                                <input type="text" name="fechas" class="form-control"> -->
                                <label class="">Deuda</label>
                                <input type="text" name="deuda" readonly class="form-control">
                            </div>
                            <div class="col">
                                <!-- <label class="">Fecha</label>
                                <input type="text" name="fechas" class="form-control"> -->
                                <label class="">Restante</label>
                                <input type="text" name="restante_modal" readonly class="form-control">
                            </div>
                            <div class="col">
                                <label class="">abonos</label>
                                <input type="text" name="abono" readonly class="form-control">
                                <input type="hidden" name="cotizacion">
                                <input type="hidden" name="restante_modal" id="restante_modal" class="form-control">
                            </div>
                        </div>
                        <hr>
                        <div id="tablas" class="text-center">

                            <table id="invoiceItem" class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>M-PAGO</th>
                                        <th>Abono</th>
                                        <th>Comprobante</th>
                                    </tr>
                                </thead>
                                <tbody id="my_body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-warning" id="agregar_na" onclick="showNewAbono()">Agregar un nuevo abono</button>
                    <button type="button" class="btn btn-danger" id="close_na" onclick="closeNewAbono()">Cancelar el nuevo abono</button>
                    <div class="new_abono mt-3" id="new_abono">
                        <label>El cliente Debe cancelar:</label>
                        <input class="form-control" type="number" name="restante_modal" id="restantes">
                        <br>
                        <label>Escribir la cantidad abonada por el cliente:</label>
                        <input type="number" id="nuevo_a" name="nuevo_a" class="form-control">
                        <label>Restante:</label>
                        <input type="number" id="restante_n" name="restante_n" class="form-control">
                        <br>
                        <label>Escoger un metodo de pago:</label>
                        <select name="n_metodo" id="n_metodo" class="form-control">
                            <option value="bancolombia">Bancolombia</option>
                            <option value="davivienda">Davivienda</option>
                            <option value="datafono">Datafono</option>
                            <option value="efectivo">Efectivo</option>
                        </select>
                        <br>
                        <label>Adjuntar el comprobante de pago:</label>
                        <input type="file" id="new_comprobante" name="new_comprobante" class="form-control">
                        <br>

                    </div>

                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiar_data()">Cerrar</button>
                    <button type="button" class="btn btn-info" onclick="onSubmitForm2()">Agregar Nuevo Abono</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script> 
function limpiar_data(){
      console.log("limpiando data");
  document.getElementById("my_body").innerHTML = "";
//   document.getElementById("result_venta").innerHTML = "";
}
</script>