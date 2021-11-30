<!-- Modal -->
<div class="modal fade" id="detalles_traspasos_entrada_nuevo" tabindex="-1" aria-labelledby="DetallesEntradasTraspasosNuevoLabel" aria-hidden="true" width="900px">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DetallesEntradasTraspasosNuevoLabel">Informacion Traspasos de Mercancia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <H4>INFORMACION</H4>
                <table class="table table-striped table-bordered responsive-table text-center container">
                    <thead>
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Transfer id</th>
                            <th scope="col">Item</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Bodega Salida</th>
                            <!-- <th scope="col">Bodega Entrada</th> -->
                        </tr>
                    </thead>
                    <tbody id="info_t_entrada_nuevo" class="table-bordered info_target_1">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>