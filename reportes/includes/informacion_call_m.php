



  

<div class="tab-pane fade show" id="call_mostrador" role="tabpanel" aria-labelledby="home-tab">
<div class="tab-content" id="myTabContent">
            <div :class="index === 0 ? 'tab-pane fade show active' : 'tab-pane fade show'" :id="items_" role="tabpanel" aria-labelledby="home-tab" v-for="items_, index in info_call_m">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" :data-bs-target="`#${item}-finalizada`" type="button" role="tab" aria-controls="${items_}-finalizada" aria-selected="true">Finalizadas</button>
                    </li>
                    <li class="nav-items_" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${items_}-pendiente`" type="button" role="tab" aria-controls="${items_}-pendiente" aria-selected="false">Pendientes</button>
                    </li>
                    <li class="nav-items_" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${items_}-no_recoge`" type="button" role="tab" aria-controls="${items_}-no_recoge" aria-selected="false">No Recogio</button>
                    </li>
                    <li class="nav-items_" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" :data-bs-target="`#${items_}-pagos`" type="button" role="tab" aria-controls="${item}-pagos" aria-selected="false">Metodos De Pago</button>
                    </li>
                  
                </ul>
          
        


<div class="tab-pane fade show active" :id="`${items_}-finalizada`" role=" tabpanel" aria-labelledby="home-tab">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="8" class="text-center"> Cotizaciones CallCenter/Mostrador Finalizadas</th>
                    </tr>
                    <tr>
                    <th colspan="3" class="text-center"> Total Cotizaciones: {{getTotalMontoCall(items_.finalizada).total_ventas}}</th>
                    <th colspan="3" class="text-center"> Dinero Total: {{getTotalMontoCall(items_.finalizada).total_dinero | currency}}</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Remision</th>
                        <th>Cliente</th>
                        <th>Comercial</th>
                        <th>Metodo de pago</th>
                        <th>Monto</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="data, index in items_.finalizada">
                        <td> {{index +1}} </td>
                        <td>{{ data.order_date }}</td>
                        <td>{{ data.order_id }}</td>
                        <td>{{ data.order_receiver_name.toUpperCase() }}</td>
                        <td>{{ data.order_receiver_address.toUpperCase() }}</td>
                        <td>{{ data.metodo_de_pago.toUpperCase() }}</td>
                        <td class="text-right">{{ getMontoX(data) | currency }}</td>
                        <td class="text-center">
                            <a :href="`../../print_invoice.php?invoice_id=${data.order_id}`" target="_blank" class="btn btn-danger">
                                <i class="fa fa-file-pdf-o"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>


            </table>
        </div>
        <div class="tab-pane fade show" :id="`${items_.pendiente}`" role="tabpanel" aria-labelledby="home-tab">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="8" class="text-center"> Cotizaciones CallCenter/Mostrador Pendientes</th>
                    </tr>
                    <tr>
                    <th colspan="3" class="text-center"> Total Cotizaciones: {{getTotalMontoCall(items_.pendiente).total_ventas}}</th> 
                    <th colspan="3" class="text-center"> Dinero Total: {{getTotalMontoCall(items_.pendiente).total_dinero | currency}}</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Remision</th>
                        <th>Cliente</th>
                        <th>Comercial</th>
                        <th>Metodo de pago</th>
                        <th>Monto</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="data, index in items_.pendiente">
                        <td> {{index +1}} </td>
                        <td>{{ data.order_date }}</td>
                        <td>{{ data.order_id }}</td>
                        <td>{{ data.order_receiver_name.toUpperCase() }}</td>
                        <td>{{ data.order_receiver_address.toUpperCase() }}</td>
                        <td>{{ data.metodo_de_pago.toUpperCase() }}</td>
                        <td class="text-right">{{ getMontoX(data) | currency }}</td>
                        <td class="text-center">
                            <a :href="`../../print_invoice.php?invoice_id=${data.order_id}`" target="_blank" class="btn btn-danger">
                                <i class="fa fa-file-pdf-o"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>


            </table>
        </div>
        <div class="tab-pane fade show" :id="`${items_.no_recoge}`" role="tabpanel" aria-labelledby="home-tab">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="8" class="text-center"> Cotizaciones CallCenter/Mostrador No Recogieron</th>
                    </tr>
                    <tr>
                    <th colspan="3" class="text-center"> Total Cotizaciones: {{getTotalMontoCall(items_.no_recoge).total_ventas}}</th> 
                    <th colspan="3" class="text-center"> Dinero Total: {{getTotalMontoCall(items_.no_recoge).total_dinero | currency}}</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Remision</th>
                        <th>Cliente</th>
                        <th>Comercial</th>
                        <th>Metodo de pago</th>
                        <th>Monto</th>
                        <th>Ver</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="data, index in items_.no_recoge">
                        <td> {{index +1}} </td>
                        <td>{{ data.order_date }}</td>
                        <td>{{ data.order_id }}</td>
                        <td>{{ data.order_receiver_name.toUpperCase() }}</td>
                        <td>{{ data.order_receiver_address.toUpperCase() }}</td>
                        <td>{{ data.metodo_de_pago.toUpperCase() }}</td>
                        <td class="text-right">{{ getMontoX(data) | currency }}</td>
                        <td class="text-center">
                            <a :href="`../../print_invoice.php?invoice_id=${data.order_id}`" target="_blank" class="btn btn-danger">
                                <i class="fa fa-file-pdf-o"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>


            </table>
        </div>
        <div class="tab-pane fade show" :id="`${items_.pagos}`" role="tabpanel" aria-labelledby="home-tab">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center"> METODOS DE PAGO</th>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-center"> Total Cotizaciones: {{getTotalMontoCall(items_.finalizada).total_ventas}}</th> 
                    <th colspan="3" class="text-center"> Dinero Total: {{getTotalMontoCall(items_.finalizada).total_dinero | currency}}</th>
                    <!-- {{items_.finalizada}} -->
                    <!-- {{getTotalMontoCall(items_.finalizada).total_dinero}} -->
                    </tr>
                    <tr>
                        <th>Metodo de pago</th>
                        <th>Total Dinero</th>
                        <th>Total Ventas</th>
                        <th>Promedio</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="data in items_.pagos">
                  
                        <td>{{ data.metodo }}</td>
                        <td>{{ data.total_dinero | currency }}</td>
                        <td>{{ data.total_ventas }}</td>
                        <td>{{ data.promedio_ventas | currency }}</td>
                    </tr>
                </tbody>


            </table>
            </div>
        </div>
        </div>
       </div>

