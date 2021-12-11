<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="6" class="text-center"> INFORMACION DEL CLIENTE Y LA COTIZACION SELECCIONADA</th>
        </tr>
        <tr>
            <th colspan="3">Cliente</th>
            <th>Cotizacion</th>
            <th colspan="2">Fecha</th>
        </tr>
        <tr v-for="data in info_cotizacion.slice (0, 1)">
            <th colspan="3">{{ data.order_receiver_name}}</th>
            <th>{{ data.order_id}}</th>
            <th colspan="2">{{ data.order_date}}</th>
        </tr>
        <hr>
        <tr>

            <th>Codigo</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Total</th>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>
    <form method="post" id="my_form_proveedor"  @submit.prevent>
        <tr v-for="data in info_cotizacion">

            <td><input type="number" class="form-control" v-model="data.item_code" name="codigo" readonly></td>
            <td><input type="text" class="form-control" v-model="data.item_name" name="producto" readonly></td>
            <td><input type="number" class="form-control" v-model="data.order_item_quantity" name="cantidad"></td>
            <td>{{data.order_item_unitario | currency}}</td>
            <td>{{data.order_item_final_amount | currency}}</td>
            <!-- <td><input type="number" class="form-control" v-model="data.order_item_unitario | currency" name="unitario" readonly></td>
            <td><input type="number" class="form-control" v-model="data.order_item_final_amount | currency" name="total" readonly></td> -->
            <td class="text-center"><button class="btn btn-warning editar" id="editar" @click="EjecutarDevolucion(data)"><i class="fas fa-share"></i></button></td>
        </tr>
        </form>
    </tbody>
</table>