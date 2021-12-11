<div class="tab-pane fade show" id="comerciales" role="tabpanel" aria-labelledby="home-tab">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="6" class="text-center"> Reporte por usuario</th>
            </tr>
            <tr>
                <th>Comercial</th>
                <th>Total Dinero</th>
                <th>Total Ventas</th>
                <th>Promedio</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="data in info_comerciales">
                <td>{{ data.comercial.toUpperCase() }}</td>
                <td>{{ data.total_dinero | currency }}</td>
                <td>{{ data.total_ventas }}</td>
                <td>{{ data.promedio_ventas | currency }}</td>
            </tr>
        </tbody>


    </table>
</div>