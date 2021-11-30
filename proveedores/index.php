<?php

function formatear($num)
{
    setlocale(LC_MONETARY, 'en_US');
    return "$" . number_format($num, 2);
};

?>


<!DOCTYPE html>

<html lang="en" dir="ltr">

<head><meta charset="shift_jis">
    
    <title>Lista Proveedores</title>

    <!-- CSS -->

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="../jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/datatables.min.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</head>

<body>



    <div class="contenedor" id="app">
        <hr>
        <center>
            <h3>Lista de productos y proveedores</h3>
        </center>

        <hr>

        <center>
            <div class="form-group col-md3">
                <a href="anadir.php"><button type="button" class="btn btn-success" name="crear">Crear Proveedor</button></a>
                <a href="asignar.php"><button type="button" class="btn btn-warning" name="button">asignar productos</button> </a>
                <a href="../asistente.php"><button type="button" class="btn btn-danger" name="button">Regresar Al Panel</button> </a>
            </div>
        </center>


        <hr>

        <!-- buscador -->

        <div class="container">
            <div class="text-center">
                <button class="btn btn-info" id="mostrar" onclick="show_new_methods()">Mostrar Lista De Proveedores</button>
                <button class="btn btn-danger" id="ocultar" onclick="ocultar_new_methods()"> Ocultar lista de proveedores</button>
            </div>
            <hr>
            <div class="container" id="info_proveedor">

                <form method="post" id="my_form_proveedor" v-for="data, index in tarjetas" :key="index" @submit.prevent>

                    <div class="card mt-4 mb-4" style="width: 20rem;">
                        <div class="card-header text-center">
                            <b>NIT: <input type="text" class="form-control" name="nit" v-model="data.nit"></b>
                            <hr>
                            <b> COMPAÑIA:</b> <input type="text" class="form-control" name="empresa" v-model="data.empresa">
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>TELEFONO:</b> <input type="text" class="form-control" v-model="data.telefono" name="tel_empresa"></li>
                            <li class="list-group-item"><b>DIRECCION:</b> <input type="text" class="form-control" v-model="data.direccion" name="direccion"> </li>
                            <li class="list-group-item"><b>ASESOR:</b><input type="text" class="form-control" v-model="data.asesor" name="asesor"> </li>
                            <li class="list-group-item"><b>A/TELEFONO:</b> <input type="text" class="form-control" v-model="data.telefono_asesor" name="tel_asesor"></li>
                            <li class="list-group-item"><b>Codigo interno:</b> <input type="text" class="form-control" v-model="data.codigo" name="codigo" readonly></li>
                            <li class="list-group-item text-center">
                                <button class="btn btn-success editar" id="editar" @click="editarProveedor(data)">Editar</button>
                                <button class=" btn btn-danger delete" id="delete" @click="eliminarProveedor(data.codigo)">Eliminar</button>
                            </li>

                        </ul>
                    </div>
                </form>

            </div>


            <div class="container" id="tabla_productos_r">
                <table class="table" id="mytable">
                    <!-- Tabla de los producto relacionados-->
                    <thead class="thead-dark">
                        <tr>

                            <th>SKU</th>
                            <th>Producto</th>

                            <th>Empresa</th>
                            <th>Telefono</th>
                            <th>Asesor</th>
                            <th>Tel Asesor</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>


                        <!-- <tr v-for="data, index in proveedores.tabla" :key="index">
                            <td>{{ index +1 }}</td>
                            <td> {{data.id}} </td>
                            <td> {{data.contratipo}} </td>
                            <td> {{data.empresa}} </td>
                            <td> {{data.telefono}} </td>
                            <td> {{data.asesor}} </td>
                            <td> {{data.telefono_asesor}} </td>
                            <td> {{data.precio}} </td>

                        </tr> -->
                    </tbody>


                </table>
            </div>
        </div>

        <!-- <pre>{{ proveedores }}</pre> -->

    </div>

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                ajax: "ajax/ajax_get_proveedores.php",
                columns: [{
                        data: "id"
                    },
                    {
                        data: "contratipo"
                    },
                    {
                        data: "empresa"
                    },
                    {
                        data: "telefono"
                    },
                    {
                        data: "asesor"
                    },
                    {
                        data: "telefono_asesor",
                    },
                    {
                        data: "precio",
                    }
                ]
            });

            // $(document).ready(function() {

            $('.editar').click(function(e) {
                var datos = $('#my_form_proveedor').serialize();
                $.ajax({
                    type: "POST",
                    url: "ajax/ajax_actualizar.php",
                    data: datos,
                    success: function(r) {
                        console.log(r);
                        if (r != 0 && !isNaN(r)) { //SI ES DISTINTO A 0 Y ES UN NUMERO
                            alert("actualizado con exito");

                            console.log(datos);
                        } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                            alert("no funciona");
                            console.log(datos);
                        }
                    }
                });
                return false;
                e.preventDefault();
            });

            //eliminar
            $('.delete').click(function(e) {
                e.preventDefault();

                console.log(e.target)
                var confirmar = confirm("Estas seguro de eliminar este producto");
                if (confirmar == true) {

                    var datos = $('#my_form_proveedor').serialize();
                    $.ajax({
                        type: "POST",
                        url: "ajax/ajax_delete.php",
                        data: datos,
                        success: function(r) {
                            console.log(r);
                            if (r != 0 && !isNaN(r)) { //SI ES DISTINTO A 0 Y ES UN NUMERO
                                alert("Eliminado Con Exito");

                                console.log(datos);
                            } else { //ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
                                alert("no funciona");
                                console.log(datos);
                            }
                        }
                    });
                } else {
                    alert("Abortaste la eliminacion de este proveedor");
                }
                return false;
            });
        });
    </script>
    <script src="scripts/funciones.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <!-- <script src="./Lib/vue2/vue.min.js"></script> -->
    <script src="js/consulta_act.js"></script>
</body>

</html>