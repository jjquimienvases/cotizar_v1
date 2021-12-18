<div class="text-center">
    <h4>Bienvenido <?= $user; ?></h4>
    <p>En este apartado puedes generar una nueva solicitud de mercancia.</p>
    <hr>
</div>
<br>
<ul uk-tab>
    <li class="uk-active" onclick="show_form_create()"><a href="#">Crear Traspaso</a></li>
    <li onclick="show_preview()"><a href="#">Lista de productos solicitados</a></li>
</ul>

<div id="app">
    <div id="form_create">

        <div class="border-secondary border-2 container">
            <span class="text-left">
                <b>Seleccionar un producto:</b>
            </span>
            <div class="form-group">
                <div class="buscador_productos">
                    <datalist id="buscar_producto" class="uk-width-large">
                        <option value="">Seleccione un item</option>
                        <?php
                        $sql_item = $conexion->query("SELECT * FROM $bodega_entrada WHERE visibilidad = 1 ORDER BY contratipo ASC ");
                        while ($valores = mysqli_fetch_array($sql_item)) {
                            echo '<option value="' . $valores["id"] . '">' . $valores["id"] . ',' . $valores["contratipo"] . '</option>';
                        }
                        ?>
                    </datalist>
                    <input class=" form-control rounded-pill form-success" list="buscar_producto" name="item_search" id="buscador_productos" type="text" placeholder="Buscar item" onkeyup="search_item()">
                </div>
            </div>
            <div>
                <div class=" row mt-4">
                    <div class="col-auto">
                        <label for="">Codigo:</label>
                        <input class="uk-input uk-width-1-8" type="number" placeholder="Codigo o SKU" readonly>
                    </div>
                    <div class="col-auto">
                        <label for="">Contratipo:</label><br>
                        <input class="uk-input uk-width-1-8" type="text" placeholder="Nombre o Contratipo" readonly>
                    </div>
                    <div class="col-auto">
                        <label for="">Stock Actual:</label>
                        <input class="uk-input uk-width-1-8" type="number" placeholder="Stock Actual">
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-auto">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-stacked-text">Cantidad</label>
                            <div class="uk-form-controls">
                                <input class="uk-input uk-width-large" id="form-stacked-text" type="text" placeholder="Escribir aqui la cantidad que requieres...">
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-stacked-select">Seleccionar una bodega de salida:</label>
                            <div class="uk-form-controls">
                                <select class="uk-select" id="form-stacked-select">
                                    <option>Bodega Principal</option>
                                    <option>Mostrador Principal</option>
                                    <option>Mostrador D1</option>
                                    <option>Mostrador Ibague</option>
                                    <option>Mostrador Ibague 2</option>
                                </select>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <br>
            <div class="col-auto">
                <button class="uk-button uk-button-danger">Solicitar</button>
            </div>

        </div>
    </div>
</div>

<div class="preview" id="preview">
    <h3>LISTA</h3>
</div>