<div class="row">

    <div class="col-md-3">

        <div id="info_traslado">



            <form action="" method="post" id="formulario" name="formulario">

                <!--Tarjeta #1 este es el formulario de solicitude de mercancia -->

                <div class="">

                    <div class="card-section card-section-third border rounded">

                        <div class="card-header card-header-third rounded">

                            <center><span style="color:green;">Busca el producto que necesitas.</span></center>

                            <br>

                            <div style="text-aling: center;">

                                <select id="mibuscador" style="width:100%" class="custom-select">

                                    <option value="">Buscar un producto</option>

                                    <?php

$consulta_producto = $conexion->query("SELECT * FROM producto_av ORDER BY id ASC");
 $user_id  = $_SESSION['userid'];
while ($valores = mysqli_fetch_array($consulta_producto)) {

    echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
}

?>

                                </select>

                            </div>

                        </div>

                        <div class="card-body text-center mb-2">

                            <hr>

                            <div class="form-group">

                                <label for="codigo">Codigo:</label>

                                <input type="number" class="form-control" name="codigo" id="codigo"
                                    placeholder="Codigo del producto" readonly>

                                <label for="producto">Producto:</label>

                                <input type="text" class="form-control" name="producto" id="producto"
                                    placeholder="Nombre del producto">

                                <label for="cantidad">Cantidad:</label>

                                <input type="number" class="form-control" name="cantidad" id="cantidad"
                                    placeholder="Cantidad a solicitar">
                                <input type="hidden" class="form-control" name="categoria" id="categoria">

                            </div>

                            <hr>

                            <label for="bodega_origen" style="color:red;">Selecciona de que bodega vas a

                                solicitar la mercancia:</label>

                            <select class="custom-select" name="bodega_origen" id="bodega_origen">

                                <option value="producto_av" selected>Bodega Principal</option>

                                <option value="producto">Mostrador Principal</option>

                                <option value="producto_d1">Mostrador D1</option>

                                <option value="productos_ibague">Ibague</option>
                                <option value="productos_ibague2">Ibague 2</option>

                            </select>

                            <hr>

                            <div class="btn__form">

                                <input class="btn btn-success" type="submit" id="guardando" value="Solicitar Producto">

                                <input class="btn btn-danger" type="reset" value="Vaciar">

                            </div>

                        </div>

                    </div>

                </div>

                <input type="hidden" class="input" value="<?php echo $user_rol; ?>" name="rol">
                <input type="hidden" class="input" value="<?php echo $user_id; ?>" name="user_id">

                <!-- dependiendo el rol del usuario vamos a determinar la bodega destino-->

                <input type="hidden" class="input" value="<?php echo $user_name; ?>" name="nombre_solicitante">

                <!-- dependiendo el rol del usuario vamos a determinar la bodega destino-->

            </form>

        </div>

    </div>

    <div class="col-md-5">

        <!-- Tarjeta #2 (UBICAR AL LADO DERECHO DE LA TARJETA 1) aqui vamos a ir mostrando la informacion de los productos solicitados-->

        <div class="" id="tarjeta_2">

            <div class="card-section card-section-third border rounded">

                <div class="card-header card-header-third rounded">

                    <center>

                        <h2> Mercancia Solicitada </h2>

                    </center>

                </div>

                <div class="card-body text-center mb-2">
                    <form class="" id="fmActualizar" action="index.html" method="post">

                        <input type="hidden" name="metodo" value="UpdateTraspasos">
                        <div class="col-md-12">
                            <div id="responses"></div>
                        </div>
                        <button type="button" class="btn btn-success" name="finalizar_solicitud"
                            id="finalizar_solicitud">Finalizar Solicitud</button>

                    </form>



                </div>

            </div>

        </div>

    </div>



    <div class="col-md-4">

        <!-- tarjeta #3 (UBICAR AL LADO DERECHO DE LA TARJETA 2) aqui vamos a mostrar el panel de los chicos de bodega con el check para seleccionar la mercancia que salio y la que no. -->

        <div class="" id="">

            <div class="card-section card-section-third ">

                <div class="card-header card-header-third ">

                    <center>

                        <h4> Mercancia Pendiente por alistar </h4>

                    </center>

                </div>

                <div class="card-body text-center mb-2">

                    <div class="row">
                          <div class='col-md-4'>
                              <label>Seleccionar una bodega: </label>
                            <select name="bodega" class='form-control ' id="bodega" autocomplete="off">
                                <option value="">Todas</option>
                                 <option value="producto">Mostrador Principal</option>
                                  <option value="productos_ibague">Ibague</option>
                                   <option value="producto_d1">Mostrador D1</option>
                                <option value="producto_av">Bodega Principal</option>
                               
                               
    
                            </select>
                        </div>
                        <form class="" id="formularioTraspasos" action="" method="post">
                            <input type="hidden" name="metodo" value="FinalizarTraspasos">

                            <div id="solicitud"></div>

                            <button type="button" class="btn btn-success" name="finalizar_solicitud"
                                id="EnviarTraspasos">Enviar Traspasos</button>

                            <button type="button" class="btn btn-warning"> <a href="send_report/index.php">Consultar E
                                    imprimir </a> </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>