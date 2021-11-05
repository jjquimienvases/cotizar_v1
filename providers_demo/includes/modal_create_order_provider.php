<!-- Modal -->
<div class="modal fade" id="exampleModal_create_order_by_provider" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generar Orden</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="" id="form_3">
                        <div class="row">
                            <div class="">
                                <label for="">Proveedor Seleccionado:</label>
                                <input type="text" name="provider_selected_orders" id="provider_selected_orders" class="form-control rounded-pill" readonly="true" placeholder="Proveedor Seleccionado">
                            </div>
                            <div class="">
                                <label for="">Codigo Interno</label>
                                <input type="number" name="id_provider" class="form-control rounded-pill" readonly id="id_provider_">
                            </div>
                        </div>
                        <hr>
                        <div class="text-center text-success">
                         <h5>Seleccionar un producto</h5>
                        </div>
                        <input type="text"class="form-control rounded-pill border border-success" id="search_item_provider" onkeyup="get_data_items_modal_provider_filter()" name="search_item_provider" placeholder="Buscar un producto">
                        <hr>
                        <div id="list_items_data_provider">

                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger">Generar Orden</button>
            </div>
        </div>
    </div>
</div>