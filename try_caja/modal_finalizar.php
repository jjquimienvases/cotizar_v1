<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h5 class="modal-title" id="exampleModalLabel">JJ QUIMIENVASES S.A.S</h5>
                </center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <center>
                    <h3>Finalizar Compra</h3>
                </center>

                <form enctype="multipart/form-data" id="form1">

                    <hr>
                    <div class="form-group">
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" value="" class="form-control" readonly>
                                <input type="hidden" name="cotizaciones" id="cotizaciones" value="">
                                <input type="hidden" name="comercial" id="comercial" value="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Cedula:</label>
                                <input type="text" name="cedula" id="cedula" value="" class="form-control" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Monto:</label>
                                <input type="number" name="monto" id="txt_campo_2" class="form-control" readonly>
                            </div>
                            <hr>
                            <div class="form-group col-md-6" id="select_metodo_de_pago">
                                <label for="">Metodo de pago:</label>
                                <select class="form-control" name="metodo_pago" id="metodo_pago">
                                    <option value="efectivo" selected>Efectivo</option>
                                    <option value="datafono">Datafono</option>
                                    <option value="bancolombia">Bancolombia</option>
                                    <option value="davivienda">Davivienda</option>
                                    <option value="bono">Bonos</option>
                                </select>
                            </div>


                            <span class="btn btn-warning" onclick="show_new_methods()" id="openn">Dos o mas metodos de pago</span>
                            <span class="btn btn-info ml-2" onclick="show_descuento()" id="open_desc">Aplicar Descuento</span>
                            <br>
                            <span class="btn btn-danger ml-3" onclick="hide_descuento()" id="hide_desc">X</span>


                            <hr>
                            <span class="btn btn-danger" onclick="ocultar_new_methods()" id="closse">X</span>


                            <div id="nuevos_metodos_de_pago">
                                <center>
                                    <H6 id="text_info">Escribir El Valor Cancelado En Cada Metodo De Pago</H6>
                                </center>
                                <div class="form-group col-md-12">
                                    <label for="">Efectivo:</label>
                                    <input type="number" name="metodos_pago[]" id="monto_efectivo" class="form-control" value="" onkeyup="sumar_pintar()" placeholder="Escribir el monto en efectivo sin puntos">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Datafono:</label>
                                    <input type="number" name="metodos_pago[]" id="monto_datafono" class="form-control" value="" onkeyup="sumar_pintar()" placeholder="Escribir el monto en datafono sin puntos">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Bancolombia:</label>
                                    <input type="number" name="metodos_pago[]" id="monto_bancolombia" class="form-control" value="" onkeyup="sumar_pintar()" placeholder="Escribir el monto en bancolombia sin puntos">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">Davivienda:</label>
                                    <input type="number" name="metodos_pago[]" id="monto_davivienda" class="form-control" value="" onkeyup="sumar_pintar()" placeholder="Escribir el monto en davivienda sin puntos">
                                </div>
                            </div>

                            <div id="desc">
                                <div class="form-group col-md-3">
                                    <label for="">Porcentaje:</label>
                                    <input type="number" name="porcentaje" id="porcentaje" class="form-control" value="" placeholder="Escribir el procentaje">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="">Ahorro:</label>
                                    <input type="number" name="ahorro" id="ahorro" class="form-control" value="" placeholder="Ahorro">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="">Descuento:</label>
                                    <input type="number" name="total_desc" id="total_desc" class="form-control" value="" placeholder="Total Con Descuento">
                                </div>
                            </div>
                            <div class="text-center" id="apli_descuento">
                                <button class="btn btn-primary" id="desc_btn"> Aplicar Descuento </button>
                            </div>

                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input ml-2" type="checkbox" name="abono_credito" id="inlineRadio2" value="1">
                                <label class="form-check-label text-success " for="inlineRadio2">Abono o Credito</label>
                                <input class="form-check-input ml-2" type="checkbox" name="soli_fact" id="inlineRadio1" value="1">
                                <label class="form-check-label text-danger" for="inlineRadio1">Click aqui para solicitar factura</label>
                            </div>
                        </div>
                        <br>

                        <center>
                            <div class="form-group col-md-10">
                                <label for="">Cantidad que paga el cliente:</label>
                                <input type="text" name="monto_cancelado" value="" class="form-control" onkeyup="return sumar()" id="txt_campo_3">
                            </div>
                            <div class="vueltas">
                        </center>

                        <hr>
                        <div>
                            <center><span id="myspan">Completar este campo si deseas anular esta cotizacion</span></center>
                            <label>Razon:</label>
                            <input type="text" name="razon" id="razon" class="form-control" placeholder="Escribir la razon por la cual deseas anular esta cotizacion">
                        </div>
                        <center>
                            <div id="resultado"></div>
                        </center>
                    </div>


                    <!-- AQUI VAMOS A HACER EL SCRIPT DE LAS VUELTAS-->

                </form>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>-->
                <button type="button" class="btn btn-danger" id="nope">Anular</button>
                <div id="btn_etiquetas"></div>
                <button type="button" class="btn btn-success" name="button"><a href="../imprimir.php?invoice_id=" target="_blank" btn-imprimir-remision>Imprimir Remision</a> </button>
                <button type="button" class="btn btn-primary" id="finalizar">Finalizar</button>
            </div>
        </div>
    </div>
</div>