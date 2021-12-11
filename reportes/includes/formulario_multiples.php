  <div class="tab-pane fade show" id="multiple" role="tabpanel" aria-labelledby="home-tab">
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th colspan="6" class="text-center"> Cotizaciones con multiples metodos de pago</th>
              </tr>
              <tr>
                  <th>Fecha</th>
                  <th>Cotizacion</th>
                  <th>Efectivo</th>
                  <th>Datafono</th>
                  <th>Bancolombia</th>
                  <th>Davivienda</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="data in info_multiples">
                  <td>{{ data.order_date}}</td>
                  <td>{{ data.order_id }}</td>
                  <td>{{ data.efectivo | currency }}</td>
                  <td>{{ data.datafono | currency }}</td>
                  <td>{{ data.bancolombia | currency }}</td>
                  <td>{{ data.davivienda | currency }}</td>




              </tr>
          </tbody>


      </table>
  </div>