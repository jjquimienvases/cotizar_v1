  <div class="tab-pane fade show" id="abonos" role="tabpanel" aria-labelledby="home-tab">
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th colspan="6" class="text-center"> ABONOS</th>
              </tr>
              <tr>
                  <th>Fecha</th>
                  <th>Remision</th>
                  <th>Cliente</th>
                  <th>Comercial</th>
                  <th>Metodo de pago</th>
                  <th>Deuda</th>
                  <th>Abono</th>
                  <th>Restante</th>
                  <th>Ver</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="data in info_abonos">
                  <td>{{ data.order_date}}</td>
                  <td>{{ data.order_id }}</td>
                  <td>{{ data.order_receiver_name.toUpperCase() }}</td>
                  <td>{{ data.comercial.toUpperCase() }}</td>
                  <td>{{ data.metodo_de_pago.toUpperCase() }}</td>
                  <td>{{ data.deuda | currency }}</td>
                  <td>{{ data.abono | currency }}</td>
                  <td>{{ data.restante | currency }}</td>
                  <td class="text-center">
                      <a :href="`../../print_invoice.php?invoice_id=${data.order_id}`" target="_blank" class="btn btn-danger">
                          <i class="fa fa-file-pdf-o"></i>
                      </a>
                  </td>
              </tr>
          </tbody>


      </table>
  </div>