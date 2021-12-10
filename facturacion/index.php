<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas Pendientes</title>
    <!-- CSS -->

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="../jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.9.4/dist/js/uikit-icons.min.js"></script>



    <script src="funciones.js"></script>
</head>
<div>
    <!-- En este DIV se va a editar la informacion del cliente-->
    <div class="container">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Editar Informacion Cliente</button>
        <?php
        include 'conexion.php';
        include 'modal_clientes.php';
        include 'modal_update_fact.php';
        ?>
        <?php include 'modal_factura_call.php'; ?>
    </div>
</div>
<div class="contenedor" id="app">
    <div class="container text-center mt-2">
        <button id="show" class="btn btn-info text-center" onclick="show_new_methods()"> Ver Tarjetas Y Facturar</button>
        <button id="shows" class="btn btn-warning text-center" onclick="show_new_methods_call()"> Facturar Call Center</button>
        <button id="close" class="btn btn-danger text-center" onclick="ocultar_new_methods()"> Ver Tabla</button>
        <button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #modal-example">Actualizar # De Factura</button>

    </div>
    <div class="container" id="info_factura">

        <form method="post" id="factura" v-for="data, index in tarjetas" :key="index" @submit.prevent>

            <div class="card mt-4 mb-4" style="width: 20rem;">
                <div class="card-header text-center">
                    <b>FECHA: <input type="text" class="form-control" name="order_date" v-model="data.order_date"></b>
                    <hr>
                    <b>COTIZACION:</b> <input type="text" class="form-control" name="cotizacion" v-model="data.cotizacion">
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Cliente:</b> <input type="text" class="form-control" v-model="data.cliente" name="cliente"></li>
                    <li class="list-group-item"><b>Email:</b> <input type="text" class="form-control" v-model="data.email" name="email"> </li>
                    <li class="list-group-item"><b>Estado:</b><input type="text" class="form-control" v-model="data.estado" name="estado"> </li>
                    <li class="list-group-item"><b>Tipo de persona:</b>
                        <select class="form-control" v-model="data.persona">
                            <option value="PERSONA_NATURAL" selected>Natural </option>
                            <option value="PERSONA_JURIDICA">Juridica </option>
                        </select>
                    </li>
                    <li class="list-group-item"><b>Seleccionar Documento:</b>
                        <select class="form-control" v-model="data.document">
                            <option value="CEDULA_DE_CIUDADANIA" selected>CEDULA</option>
                            <option value="NIT">NIT</option>
                        </select>
                    </li>
                    <li class="list-group-item text-center">
                        <button class="btn btn-success editar" id="editar" @click="GenerarFactura(data)">Generar Factura</button>
                        <button class=" btn btn-danger delete" id="delete" @click="eliminarProveedor(data.id)">Eliminar</button>
                    </li>

                </ul>
            </div>
        </form>

    </div>
    <!-- Call center facturas pendientes para ejecutar-->
    <div class="container" id="info_factura_call">

        <form method="post" id="factura" v-for="data, index in target" :key="index" @submit.prevent>

            <div class="card mt-4 mb-4">
                <div class="text-center">
                    <h3>Facturar Cotizacion {{data.order_id}}</h3>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Cotizacion</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Tipo Persona</th>
                            <th>Documento</th>
                            <th>Facturar</th>
                            <th>Adjuntar Factura</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" name="order_date" v-model="data.order_date" readonly></td>
                            <td><input type="text" class="form-control id_cotizacion" name="cotizacion" v-model="data.order_id" readonly></td>
                            <td><input type="text" class="form-control" v-model="data.title" name="cliente" readonly></td>
                            <td><input type="text" class="form-control" v-model="data.estado" name="estado"></td>
                            <td><select class="form-control" v-model="data.personas">
                                    <option value="PERSONA_NATURAL" selected>Natural </option>
                                    <option value="PERSONA_JURIDICA">Juridica </option>
                                </select></td>
                            <td> <select class="form-control" v-model="data.documents">
                                    <option value="CEDULA_DE_CIUDADANIA" selected>CEDULA</option>
                                    <option value="NIT">NIT</option>
                                </select> </td>
                            <td><button class="btn btn-success editar" id="editar" @click="GenerarFacturaCall(data)">Facturar</button></td>
                            <td><button class="btn btn-warning delete" id="adjuntar" data-toggle="modal" data-target="#exampleModals">Documento</button></td>
                        </tr>
                    </tbody>

                </table>
                <!-- <div class="card-header text-center">
            <b>FECHA: <input type="text" class="form-control" name="order_date" v-model="data.order_date"></b>
            <hr>
            <b>COTIZACION:</b> <input type="text" class="form-control" name="cotizacion" v-model="data.order_id">
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Cliente:</b> <input type="text" class="form-control" v-model="data.title" name="cliente"></li>
            <li class="list-group-item"><b>Estado:</b><input type="text" class="form-control" v-model="data.estado" name="estado"> </li>
            <li class="list-group-item"><b>Tipo de persona:</b>
            <select class="form-control" v-model="data.persona">
              <option value="PERSONA_NATURAL" selected>Natural </option>
              <option value="PERSONA_JURIDICA">Juridica </option>
            </select> </li>
            <li class="list-group-item"><b>Seleccionar Documento:</b>
            <select class="form-control" v-model="data.document">
              <option value="CEDULA_DE_CIUDADANIA" selected>CEDULA</option>
              <option value="NIT">NIT</option>
            </select> </li>
            <li class="list-group-item text-center">
                <button class="btn btn-success editar" id="editar" @click="GenerarFactura(data)">Generar Factura</button>
                <button class=" btn btn-danger delete" id="delete" @click="eliminarProveedor(data.id)">Eliminar</button>
            </li>

        </ul> -->
            </div>
        </form>

    </div>



    <div class="container" id="table_info">
        <form method="post" id="info_facturas" @submit.prevent>


            <table class="table" id="mytable">
                <thead class="thead-dark">


                    <th scope="col">Fecha</th>
                    <th scope="col">Cotizacion</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Correo Electronico</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Accion</th>
                </thead>
                <tbody id="informacion">
                    <!-- <tr v-for="data, index in facturas" :key="index">
                            <td>{{ index +1 }}</td>
                            <td> {{data.order_date}} </td>
                            <td> {{data.cotizacion}} </td>
                            <td> {{data.cliente}} </td>
                            <td> {{data.email}} </td>
                            <td> {{data.estado}} </td>
                        </tr>  -->
                </tbody>
            </table>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="js/consulta.js"></script>
<script src="js/cordova.js"></script>
<script>
    // $(document).ready(function() {
    // $('.table').DataTable({
    //         ajax: "ajax/ajax_get_facturas.php",
    //         columns: [{ }]
    //         });

    //   var table =   $('.table').DataTable({
    //         ajax: "ajax/ajax_get_facturas.php",
    //         buttons: true,
    //         buttons: ['copy', 'excel', 'pdf'],
    //         columns: [{
    //             data: "order_date"
    //         },
    //         {
    //             data: "cotizacion"
    //         },
    //         {
    //             data: "cliente"
    //         },
    //         {
    //             data: "email"
    //         },
    //         {
    //             data: "estado"
    //         },
    //         { data: 'cotizacion', width: '60px', render: function (data, type, row) {
    //               return '<button id="data"  value="data:cotizacion" name="order_id" onclick="cotizar()"  class="btn btn-success btn-xs facturar">Facturar</button>';}
    //             },
    //     ]
    // });


    //Solicitar Facturacion (por ahora ejecutar consulta para mostrar datos)
    // function cotizar(){
    //     console.log("leiner");
    // }

    // $('.facturar').click(function(e) {

    // console.log("leiner");
    // var datos = $('#my_form_proveedor').serialize();


    // $.ajax({
    //     type: "POST",
    //     url: "ajax/ajax_actualizar.php",
    //     data: datos,
    //     success: function(r) {
    //         console.log(r);
    //         if (r != 0 && !isNaN(r)) { //SI ES DISTINTO A 0 Y ES UN NUMERO
    //             alert("actualizado con exito");

    //             console.log(datos);
    //         } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
    //             alert("no funciona");
    //             console.log(datos);
    //         }
    //     }
    // });
    // return false;
    // e.preventDefault();
    // });




    // }); //final del document.ready
</script>
</body>

</html>