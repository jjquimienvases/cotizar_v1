<!-- This is the modal -->
<div id="my-id" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Selecciona una sede</h2>
        <hr>
        <select name="sede" id="sede" class="form-control">
            <option value="producto_av" class="form-control">Call Center</option>
            <option value="producto" class="form-control">Mostrador Principal</option>
            <option value="producto_d1" class="form-control">Mostrador D1</option>
            <option value="productos_ibague" class="form-control">Mostrador Ibague</option>
            <option value="productos_ibague2" class="form-control">Mostrador Ibague 2</option>
        </select>
        <button class="uk-modal-close" id="modal_close" type="button"></button>
        <button class="btn btn-primary" onclick="select_sede()">Finalizar</button>
    </div>
</div>
