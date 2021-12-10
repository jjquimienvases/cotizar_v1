<!-- This is a button toggling the modal -->


<!-- This is the modal -->
<div id="modal-example" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Actualizar NUmero de Factura</h2>

  <div class="row">
      <div class="col-auto"><input type="number" class="form-control rounded-pill" id="id_" placeholder="Escribe el numero de factura"></div>
      <div class="col-auto"><input type="number" class="form-control rounded-pill" id="order_id_"placeholder="Escribe el numero de cotizacion"></div>
  </div>

        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-primary" type="button" onclick="update_factura()">Actualizar</button>
        </p>
    </div>
</div>