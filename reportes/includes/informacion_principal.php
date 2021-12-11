<div class="tab-content" id="myTabContent">
    <!-- INICIO DIV -->

    <div class="tab-pane fade show active" :id="`${item.punto}-efectivas`" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered" id="tables">
            <thead>
                <tr>
                    <th colspan="8" class="text-center"> Cotizaciones Efectivas {{ item.punto }}</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-center"> Total Cotizaciones: {{getTotalMonto(item.efectivas).total_ventas}}</th>
                    <th colspan="4" class="text-center"> Dinero Total: {{getTotalMonto(item.efectivas).total_dinero | currency}}</th>
                    <!-- {{getTotalMonto(item.efectivas)}} -->
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
                <tr v-for="data, index in item.efectivas">
                    <td>{{ index + 1 }}</td>
                    <td>{{ data.order_date }}</td>
                    <td>{{ data.order_id }}</td>
                    <td>{{ data.order_receiver_name.toUpperCase() }}</td>
                    <td>{{ data.order_receiver_address.toUpperCase() }}</td>
                    <td>{{ data.metodo_de_pago.toUpperCase() }}</td>
                    <td id="total_principal">{{ getMontoX(data) | currency }}</td>
                    <td class="text-center">
                        <a :href="`../../print_invoice.php?invoice_id=${data.order_id}`" target="_blank" class="btn btn-danger">
                            <i class="fa fa-file-pdf-o"></i>
                        </a>
                    </td>
                </tr>
                <!-- <paginate name="cotizaciones" :list="item.efectivas" :per="2">
                    <tr v-for="data, index in paginated(item.efectivas)">
                        <td>{{ index + 1 }}</td>
                        <td>{{ data.order_date }}</td>
                        <td>{{ data.order_id }}</td>
                        <td>{{ data.order_receiver_name.toUpperCase() }}</td>
                        <td>{{ data.order_receiver_address.toUpperCase() }}</td>
                        <td>{{ data.metodo_de_pago.toUpperCase() }}</td>
                        <td id="total_principal">{{ getMontoX(data) | currency }}</td>
                        <td class="text-center">
                            <a :href="`../../print_invoice.php?invoice_id=${data.order_id}`" target="_blank" class="btn btn-danger">
                                <i class="fa fa-file-pdf-o"></i>
                            </a>
                        </td>
                    </tr>

                </paginate> -->
            </tbody>


        </table>
        <!-- <paginate-links for="cotizaciones"></paginate-links> -->
    </div>
     <div class="tab-pane fade show" :id="`${item.punto}-abono`" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="8" class="text-center"> Cotizaciones Con Abonos {{ item.punto }} </th>
                </tr>
                <tr>
                    <th colspan="4" class="text-center"> Total Cotizaciones: {{getTotalMonto(item.abono).total_ventas}}</th>
                    <th colspan="4" class="text-center"> Dinero Total: {{getTotalMonto(item.abono).total_dinero | currency}}</th>
                    <!-- {{getTotalMonto(item.efectivas)}} -->
                </tr>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Remision</th>
                    <th>Cliente</th>
                    <th>Comercial</th>
                    <th>Metodo de pago</th>
                    <th>abono</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data, index in item.abono">
                    <td>{{ index + 1 }}</td>
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
    <div class="tab-pane fade show" :id="`${item.punto}-pendientes`" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th colspan="8" class="text-center"> Cotizaciones Pendientes {{ item.punto }}</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-center"> Total Cotizaciones: {{getTotalMonto(item.pendiente).total_ventas}}</th>
                    <th colspan="4" class="text-center"> Dinero Total: {{getTotalMonto(item.pendiente).total_dinero | currency}}</th>
                    <!-- {{getTotalMonto(item.efectivas)}} -->
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
                <tr v-for="data, index in item.pendiente">
                    <td>{{ index + 1 }}</td>
                    <td>{{ data.order_date }}</td>
                    <td>{{ data.order_id }}</td>
                    <td>{{ data.order_receiver_name.toUpperCase() }}</td>
                    <td>{{ data.order_receiver_address.toUpperCase() }}</td>
                    <td>{{ data.metodo_de_pago.toUpperCase() }}</td>
                    <td>{{ getMontoX(data) | currency }}</td>
                    <td class="text-center">
                        <a :href="`../../print_invoice.php?invoice_id=${data.order_id}`" target="_blank" class="btn btn-danger">
                            <i class="fa fa-file-pdf-o"></i>
                        </a>
                    </td>
                </tr>
            </tbody>


        </table>
    </div>
    <div class="tab-pane fade show" :id="`${item.punto}-descuento`" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="8" class="text-center"> Cotizaciones {{ item.punto }} con descuento</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-center"> Total Cotizaciones: {{getTotalMonto(item.descuento).total_ventas}}</th>
                    <th colspan="4" class="text-center"> Dinero Total: {{getTotalMonto(item.descuento).total_dinero | currency}}</th>
                    <!-- {{getTotalMonto(item.efectivas)}} -->
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
                <tr v-for="data, index in item.descuento">
                    <td>{{ index + 1 }}</td>
                    <td>{{ data.order_date }}</td>
                    <td>{{ data.order_id }}</td>
                    <td>{{ data.order_receiver_name.toUpperCase() }}</td>
                    <td>{{ data.order_receiver_address.toUpperCase() }}</td>
                    <td>{{ data.metodopago.toUpperCase() }}</td>
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
    <div class="tab-pane fade show" :id="`${item.punto}-anuladas`" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="6" class="text-center"> Cotizaciones {{ item.punto }} anuladas</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-center"> Total Cotizaciones: {{getTotalMonto(item.anulada).total_ventas}}</th>
                    <th colspan="4" class="text-center"> Dinero Total: {{getTotalMonto(item.anulada).total_dinero | currency}}</th>
                    <!-- {{getTotalMonto(item.efectivas)}} -->
                </tr>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Razon</th>
                    <th>Remision</th>
                    <th>Cliente</th>
                    <th>Comercial</th>
                    <!--<th>Metodo de pago</th>-->
                    <th>Monto</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data, index in item.anulada">
                    <th> {{index + 1}} </th>
                    <td>{{ data.order_date }}</td>
                    <td>{{ data.razon.toUpperCase() }}</td>
                    <td>{{ data.order_id }}</td>
                    <td>{{ data.order_receiver_name.toUpperCase() }}</td>
                    <td>{{ data.order_receiver_address.toUpperCase() }}</td>
                    <!--<td>{{ data.metodopago.toUpperCase() }}</td>-->
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
    <div class="tab-pane fade show" :id="`${item.punto}-metodos`" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="6" class="text-center"> METODOS DE PAGO</th>
                </tr>
                   <tr>
                    <th colspan="1" class="text-center"> Total Cotizaciones: {{getTotalMonto(item.efectivas).total_ventas}}</th>
                    <th colspan="2" class="text-center"> Dinero Total: {{getTotalMonto(item.efectivas).total_dinero | currency}}</th>
                    <th colspan="1" class="text-center"> <button onclick="detalles()" class="btn btn-success"> Ver Detalles Abonos </button> </th>
                    <!-- {{getTotalMonto(item.efectivas)}} -->
                </tr>
                <tr>
                    <th>Metodo de pago</th>
                    <th>Total Dinero</th>
                    <th>Total Ventas</th>
                    <th>Promedio</th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="data in item.pagos">
                    <td>{{ data.metodo }}</td>
                    <td>{{ data.total_dinero | currency }}</td>
                    <td>{{ data.total_ventas }}</td>
                    <td>{{ data.promedio_ventas | currency }}</td>
                </tr>
            </tbody>


        </table>
            <!-- ABONOS PS-->
         
             <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="6" class="text-center"> Cierre Caja</th>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Efectivo</th>
                    <th>Datafono</th>
                    <th>Davivienda</th>
                    <th>Bancolombia</th>


                </tr>
            </thead>
            <tbody>
                <tr v-for="data in item.finish">
                    <td>{{ data.order_date }}</td>
                    <td>{{ data.usuario }}</td>
                    <td>{{ data.efectivo | currency }}</td>
                    <td>{{ data.datafono | currency }}</td>
                    <td>{{ data.davivienda | currency }}</td>
                    <td>{{ data.bancolombia | currency }}</td>

                </tr>
            </tbody>


        </table>
    
        
        
    </div>
     <div class="tab-pane fade show" :id="`${item.punto}-novedades`" role="tabpanel" aria-labelledby="home-tab"> <!-- NOVEDADES Y GASTOS -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="6" class="text-center"> Cotizaciones {{ item.punto }} Gastos y Novedades</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-center"> Total Novedades: {{getTotalMonto(item.novedades).total_ventas}}</th>
                    <th colspan="4" class="text-center"> Dinero Total: {{getTotalMonto(item.novedades).total_dinero | currency}}</th>
                 
                </tr>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Novedad</th>
                    <th>Comercial</th>
                    <th>Punto de venta</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data, index in item.novedades">
                    <th> {{index + 1}} </th>
                    <td>{{ data.order_date }}</td>
                    <td>{{ data.novedad }}</td>
                    <td>{{ data.usuario.toUpperCase() }}</td>
                    <td>{{ data.punto_venta.toUpperCase() }}</td>
                    <td>{{ data.monto | currency }}</td>
                </tr>
            </tbody>


        </table>
    </div>
        <div class="tab-pane fade show" :id="`${item.punto}-finish`" role="tabpanel" aria-labelledby="home-tab">
     <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="6" class="text-center"> Cierre Caja</th>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Efectivo</th>
                    <th>Datafono</th>
                    <th>Davivienda</th>
                    <th>Bancolombia</th>


                </tr>
            </thead>
            <tbody>
                <tr v-for="data in item.finish">
                    <td>{{ data.order_date }}</td>
                    <td>{{ data.usuario }}</td>
                    <td>{{ data.efectivo | currency }}</td>
                    <td>{{ data.datafono | currency }}</td>
                    <td>{{ data.davivienda | currency }}</td>
                    <td>{{ data.bancolombia | currency }}</td>

                </tr>
            </tbody>


        </table>
    </div>

</div> <!-- fin div -->