<div class="tab-content" id="myTabContent">
    <!-- INICIO DIV -->

    <div class="tab-pane fade show active" :id="`${item.punto}-todos`" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered" id="tables">
            <thead>
                <tr>
                    <th colspan="8" class="text-center"> Todos los items {{ item.punto }}</th>
                </tr>
                <tr>
                    <!-- <th colspan="4" class="text-center"> Total Cotizaciones: {{getTotalMonto(item.efectivas).total_ventas}}</th> -->
                    <th colspan="4" class="text-center"> Dinero Total: {{getTotalMonto(item.todos).total_dinero | currency}}</th>
                    <!-- {{getTotalMonto(item.efectivas)}} -->
                </tr>
                <tr>
                    <th>#</th>
                    <th>SKU</th>
                    <th>CONTRATIPO</th>
                    <th>CATEGORIA</th>
                    <th>STOCK</th>
                    <th>COSTO</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="data, index in item.todos">
                    <td>{{ index + 1 }}</td>
                    <td>{{ data.id }}</td>
                    <td>{{ data.contratipo.toUpperCase() }}</td>
                    <td>{{ data.id_categoria }}</td>
                    <td>{{ data.stock }}</td>
                    <td id="total_principal">{{ getMontoX(data) | currency }}</td>
                </tr>
            </tbody>


        </table>
        <!-- <paginate-links for="cotizaciones"></paginate-links> -->
    </div>
    <div class="tab-pane fade show" :id="`${item.punto}-positivo`" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th colspan="8" class="text-center"> Items Con Stock Positivo {{ item.punto }}</th>
                </tr>
                <tr>
                    <!-- <th colspan="4" class="text-center"> Total Cotizaciones: {{getTotalMonto(item.pendiente).total_ventas}}</th> -->
                    <th colspan="4" class="text-center"> Dinero Total: {{getTotalMonto(item.positivo).total_dinero | currency}}</th>
                    <!-- {{getTotalMonto(item.efectivas)}} -->
                </tr>
                <tr>
                <th>#</th>
                    <th>SKU</th>
                    <th>CONTRATIPO</th>
                    <th>CATEGORIA</th>
                    <th>STOCK</th>
                    <th>COSTO</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="data, index in item.positivo">
                    <td>{{ index + 1 }}</td>
                    <td>{{ data.id }}</td>
                    <td>{{ data.contratipo.toUpperCase() }}</td>
                    <td>{{ data.id_categoria }}</td>
                    <td>{{ data.stock }}</td>
                    <td id="total_principal">{{ getMontoX(data) | currency }}</td>
                </tr>
            </tbody>


        </table>
    </div>
    <div class="tab-pane fade show" :id="`${item.punto}-negativo`" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="8" class="text-center"> Items Con Stock Negativo {{ item.punto }}</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-center"> Dinero Total: {{getTotalMonto(item.negativo).total_dinero | currency}}</th>
                    <!-- {{getTotalMonto(item.efectivas)}} -->
                </tr>
                <tr>
                <th>#</th>
                    <th>SKU</th>
                    <th>CONTRATIPO</th>
                    <th>CATEGORIA</th>
                    <th>STOCK</th>
                    <th>COSTO</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="data, index in item.negativo">
                    <td>{{ index + 1 }}</td>
                    <td>{{ data.id }}</td>
                    <td>{{ data.contratipo.toUpperCase() }}</td>
                    <td>{{ data.id_categoria }}</td>
                    <td>{{ data.stock }}</td>
                    <td id="total_principal">{{ getMontoX(data) | currency }}</td>
                </tr>
            </tbody>


        </table>
    </div>
    <div class="tab-pane fade show" :id="`${item.punto}-items`" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="6" class="text-center"> Items de {{ item.punto }} diferentes a perfumeria</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-center"> Dinero Total: {{getTotalMonto(item.items).total_dinero | currency}}</th>
                    <!-- {{getTotalMonto(item.efectivas)}} -->
                </tr>
                <tr>
                <th>#</th>
                    <th>SKU</th>
                    <th>CONTRATIPO</th>
                    <th>CATEGORIA</th>
                    <th>STOCK</th>
                    <th>COSTO</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="data, index in item.items">
                    <td>{{ index + 1 }}</td>
                    <td>{{ data.id }}</td>
                    <td>{{ data.contratipo.toUpperCase() }}</td>
                    <td>{{ data.id_categoria }}</td>
                    <td>{{ data.stock }}</td>
                    <td id="total_principal">{{ getMontoX(data) | currency }}</td>
                </tr>
            </tbody>


        </table>
    </div>
    <div class="tab-pane fade show" :id="`${item.punto}-perfumeria`" role="tabpanel" aria-labelledby="home-tab">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="6" class="text-center"> Perfumeria</th>
                </tr>
                   <tr>
                    <th colspan="3" class="text-center"> Dinero Total: {{getTotalMonto(item.perfumeria).total_dinero | currency}}</th>
                    <!-- {{getTotalMonto(item.efectivas)}} -->
                </tr>
                <tr>
                <th>#</th>
                    <th>SKU</th>
                    <th>CONTRATIPO</th>
                    <th>CATEGORIA</th>
                    <th>STOCK</th>
                    <th>COSTO</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="data, index in item.perfumeria">
                    <td>{{ index + 1 }}</td>
                    <td>{{ data.id }}</td>
                    <td>{{ data.contratipo.toUpperCase() }}</td>
                    <td>{{ data.id_categoria }}</td>
                    <td>{{ data.stock }}</td>
                    <td id="total_principal">{{ getMontoX(data) | currency }}</td>
                </tr>
            </tbody>


        </table>

    </div>
     <div class="tab-pane fade show" :id="`${item.punto}-perfumeria_ambiental`" role="tabpanel" aria-labelledby="home-tab"> <!-- NOVEDADES Y GASTOS -->
     <table class="table table-bordered">
             <thead>
                <tr>
                    <th colspan="6" class="text-center"> Perfumeria Ambiental</th>
                </tr>
                   <tr>
                    <th colspan="3" class="text-center"> Dinero Total: {{getTotalMonto(item.perfumeria_ambiental).total_dinero | currency}}</th>
                    <!-- {{getTotalMonto(item.efectivas)}} -->
                </tr>
                <tr>
                <th>#</th>
                    <th>SKU</th>
                    <th>CONTRATIPO</th>
                    <th>CATEGORIA</th>
                    <th>STOCK</th>
                    <th>COSTO</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="data, index in item.perfumeria_ambiental">
                    <td>{{ index + 1 }}</td>
                    <td>{{ data.id }}</td>
                    <td>{{ data.contratipo.toUpperCase() }}</td>
                    <td>{{ data.id_categoria }}</td>
                    <td>{{ data.stock }}</td>
                    <td id="total_principal">{{ getMontoX(data) | currency }}</td>
                </tr>
            </tbody>


        </table>
    </div>
      

</div> <!-- fin div -->