  <div class="tab-pane fade show" id="novedades" role="tabpanel" aria-labelledby="home-tab">
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th colspan="6" class="text-center"> GASTOS Y NOVEDADES</th>
              </tr>
              <tr>
                  <th>Fecha</th>
                  <th>Novedad</th>
                  <th>Comercial</th>
                  <th>Punto de venta</th>
                  <th>Monto</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="data in info_novedades">
                  <td>{{ data.order_date}}</td>
                  <td>{{ data.novedad }}</td>
                  <td>{{ data.usuario }}</td>
                  <td>{{ data.punto_venta.toUpperCase() }}</td>
                  <td>{{ data.monto | currency }}</td>



              </tr>
          </tbody>


      </table>
  </div>