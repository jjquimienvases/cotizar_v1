<div class="modal fade" id="modal_create_provider_order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title text-danger" id="exampleModalLabel">CREAR UN NUEVO PROVEEDOR | COMPLETAR DATOS DEL FORMULARIO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="form_provider">
      <div class="modal-body">
        <div class="container text-center">
          <div class="row">
            <div class="col-4">
              <label for="">NIT</label>
              <input type="text" name="nit" id="nit_provider_orders" class="form-control rounded-pill inputs_provider_create">
            </div>
            <div class="col-4">
              <label for="">RAZON SOCIAL</label>
              <input type="text" name="razon_social" id="razon_social_orders" class="form-control rounded-pill inputs_provider_create">
            </div>
            <div class="col-4">
              <label for="">TELEFONO FIJO</label>
              <input type="number" name="telefono_fijo_orders" id="telefono_fijo_orders" class="form-control rounded-pill inputs_provider_create">
            </div>
          </div>
         
          <div class="row">
          <div class="col-4">
              <label for="">DIRECCION</label>
              <input type="text" name="direccion_provider_orders" id="direccion_provider_orders" class="form-control rounded-pill inputs_provider_create">
            </div>
            <div class="col-4">
              <label for="">ASESOR ASIGNADO</label>
              <input type="text" name="asesor_providers_orders" id="asesor_providers_orders" class="form-control rounded-pill inputs_provider_create">
            </div>
            <div class="col-4">
              <label for="">TELEFONO ASESOR</label>
              <input type="number" name="telefono_asesor_providers" id="telefono_asesor_providers" class="form-control rounded-pill inputs_provider_create">
            </div>
          </div>
        </div>
      </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close_modal_create_provider_orders">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="createProviderOrders() ">Crear Proveedor</button>
      </div>
    </div>
  </div>
</div>