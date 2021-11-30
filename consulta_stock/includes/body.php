<?php 
include 'modal_info_ventas_call.php'; 
include 'modal_ingresos.php'; 
include 'modal_traspasos_s_last.php';
include 'modal_traspasos_s_new.php';
include 'modal_traspasos_e_last.php';
include 'modal_traspasos_e_new.php';

?>


<div class="container mt-2 ">

    <div class="text-center titulos">
        <h5>Bienvenido <?= $user_name ?></h5>
    </div>
    <hr>
    <div class="row text-center contenedor_inputs_search">

        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label text-danger titulos">Buscar y seleccionar el item que deseas consultar:</label>
            <datalist id="search_item">

                <?php
                $query = $con->query("SELECT * FROM producto_av ORDER BY contratipo ASC");
                while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
                }
                ?>
            </datalist>
            <input type="text" class="form-control" list="search_item" name="item_select" id="item_select" placeholder="Codigo O Contratipo">
        </div>
        <div class="input-group">
            <span class="input-group-text">Seleccionar Rango de Fechas</span>
            <input type="date" aria-label="First name" name="inicial" id="fecha_inicial" class="form-control">
            <input type="date" aria-label="Last name" name="final" id="fecha_final" class="form-control">
            <button type="button" class="btn btn-primary" id="buscar">Buscar</button>
        </div>
    </div>
    <hr>
    <div class="contenedor-target-container" id="informacion_targetas">
        <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-header">Stock Actual:</div>
            <div class="card-body">
                <h5 class="card-title">Bodega Principal</h5>
                <div id="info_stock" class="info_target_1">

                </div>
            </div>
        </div>
        <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
            <div class="card-header">Ventas Call Center:</div>
            <div class="card-body">
                <!-- <h5 class="card-title"></h5> -->
                <div id="info_ventas_call" class="info_target_1"></div>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#detalles_ventas_call">Ver Detalles</button>
            </div>
        </div>
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
            <div class="card-header">Ingresos De Mercania</div>
            <div class="card-body">
                <div class="info_target_1" id="info_target_1"></div>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#detalles_ingresos">Ver Detalles</button>
            </div>
        </div>
        <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
            <div class="card-header">Traspasos Mercancia Salidas</div>
            <div class="card-body">
                <h5 class="card-title">Panel antiguo</h5>
                <div id="info_salida_t1" class="info_target_1"></div>
                <button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#detalles_traspasos_salida_anterior">Ver Detalles</button>
                <hr>
                <h5 class="cart-title">Panel Actual</h5>
                <div id="info_salida_t2" class="info_target_1"></div>
                <button class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#detalles_traspasos_salida_nuevo">Ver Detalles</button>
            </div>
        </div>
        <div class="card text-black bg-white mb-3" style="max-width: 18rem;">
            <div class="card-header">Traspasos Mercancia Entradas</div>
            <div class="card-body">
                <h5 class="card-title">Panel antiguo</h5>
                <div id="info_entrada_t1" class="info_target_1"></div>
                <button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#detalles_traspasos_entrada_nuevo">Ver Detalles</button>
                <hr>
                <h5 class="cart-title">Panel Actual</h5>
                <div id="info_entrada_t2" class="info_target_1"></div>
                <button class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#detalles_traspasos_entrada_nuevo">Ver Detalles</button>
            </div>
        </div>
        <div class="card text-black bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-header">Ventas en puntos de venta</div>
            <div class="card-body">
                <h5 class="card-title">Mostrador Principal</h5>
                <div class="info_target_1" id="info_ventas_mostrador"></div>
                <button class="btn btn-warning text-white">Ver Detalles</button>
                <hr>
                <h5 class="cart-title">Mostrador D1</h5>
                <div class="info_target_1" id="info_ventas_d1"></div>
                <button class="btn btn-primary text-white">Ver Detalles</button>
            </div>
        </div>
    </div>
    <!-- </div> -->






    <div>


        <?php
        // include 'tabs.php';
        ?>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#Callcenter_clientes">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#1">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#2">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="Callcenter_clientes" class="tab-pane active">
                <table class="table table-striped table-bordered responsive-table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Comercial</th>
                        </tr>
                    </thead>
                    <tbody id="info" class="table-bordered">

                    </tbody>
                </table>
            </div>
            <div id="1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
            </div>
            <div id="2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
            </div>
        </div>




    </div>
</div>




</div>