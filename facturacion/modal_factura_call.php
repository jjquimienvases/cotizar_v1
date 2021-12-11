<div class="modal fade" id="exampleModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adjuntar Factura Call Center</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="info_document" enctype="multipart/form-data">
                <div class="modal-body" id="buscarcliente">
                    <div style="text-align: center;">
                        <input type="number" class="form-control" name="remision" id="cotizacions">
                        <br>
                        <select name="bodega_descuento_stock" id="bodega_descuento_stock" class="form-control">
                            <option value="producto_av">Bodega Principal</option>
                            <option value="producto">Mostrador Principal</option>
                            <option value="producto_d1">Mostrador D1</option>
                            <option value="productos_ibague">Ibague 1</option>
                            <option value="productos_ibague2">Ibague 2</option>
                        </select>
                        <hr>
                        <input type="file" class="form-control" name="file">
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="onSubmitForm()">Subir Documento</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script>

function onSubmitForm() {
  var frm = document.getElementById('info_document');
  var data = new FormData(frm);
  console.log(frm);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
          var msg = xhttp.responseText;
          if (msg == 'success') {
              alert(msg);
              $('#exampleModal').modal('hide')
          } else {
              alert(msg);
          }

      }
  };
  xhttp.open("POST", "send_ajax_call_pdf.php", true);
  xhttp.send(data);
  $('#form1').trigger('reset');
}
</script>