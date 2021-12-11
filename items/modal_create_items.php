<!-- Modal -->
<div class="modal fade" id="exampleModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="post" id="formUpload" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">ITEM ID</label>
                                <input type="number" class="form-control" id="inputEmail4" name="id" placeholder="ID O CODIGO">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">ITEM NOMBRE</label>
                                <input type="text" class="form-control" id="inputPassword4" name="contratipo" placeholder="NOMBRE DEL PRODUCTO">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">COSTO</label>
                                <input type="number" class="form-control" name="precio" id="inputCity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputGen">GENERO</label>
                                <select name="genero" id="inputGen" class="form-control">
                                    <option value="none" selected>None</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                    <option value="unisex">Unisex</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">CATEGORIA</label>
                                <select id="inputState" name="id_categoria" class="form-control">
                                    <option selected value="2">ALIMENTOS</option>
                                    <option value="1">AMBAR</option>
                                    <option value="10">PETS</option>
                                    <option value="4">PERFUMERIA</option>
                                    <option value="13">PERFUMERIA AMBIENTAL HIDROSOLUBLE</option>
                                    <option value="21">PERFUMERIA AMBIENTAL OLEOSOLUBLE</option>
                                    <option value="11">CORCHOS</option>
                                    <option value="9">ENVASES DE PERFUMERIA</option>
                                    <option value="5">UTILITARIOS</option>
                                    <option value="3">HOJA LATA</option>
                                    <option value="17">BOMBONERAS</option>
                                    <option value="18">LABORATORIO</option>
                                    <option value="100">ESTATICO / PROMOCIONES (no formula)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">UND EMPAQUE</label>
                                <input type="text" class="form-control" id="inputAddress2" name="unidadxemp" placeholder="Unidad de empaque">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">UBICACION</label>
                                <input type="text" class="form-control" id="inputAddress2" name="ubicacion" placeholder="UBICACION">

                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">PESO EN GRAMOS</label>
                                <input type="number" class="form-control" name="peso" id="Peso en gramos">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">STOCK</label>
                                <input type="number" class="form-control" name="stock" id="inputAddress2" placeholder="Stock Actual">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">STOCK MINIMO</label>
                                <input type="number" class="form-control" name="stock_minimo" id="inputAddress2" placeholder="Stock Minimo">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2">STOCK MAXIMO </label>
                                <input type="number" class="form-control" name="stock_maximo" id="inputAddress2" placeholder="Stock Maximo">
                            </div>
                        </div>
                        <div><label for="inputproveedor">Nombre con el que lo vende el proveedor</label>
                            <input type="text" id="inputproveedor" name="nombre_proveedor" class="form-control" placeholder="Nombre Proveedor">
                        </div>

                        <hr>

                        <button id="show_woo" class="btn btn-warning" type="button">Mostrar Datos WooCommerce</button>
                        <button id="hide_woo" class="btn btn-danger" type="button">Ocultar Datos WooCommerce</button>

                        <hr>
                        <div class="form-group" id="info_woo">
                            <div class="form-group col-md-12 text-left mt-2">
                                <label for="descripcion_corta">Descripcion Corta</label>
                                <input type="text" class="form-control" name="descripcion_corta" id="descripcion_corta" placeholder="Escribir una descripcion corta">
                            </div>
                            <div class="form-group col-md-12 text-left">
                                <label for="descripcion_comercial">Descripcion Comercial</label>
                                <input type="text" class="form-control" name="descripcion_comercial" id="descripcion_comercial" placeholder="Escribir una descripcion comercial">
                            </div>

                            <div class="form-group">
                                <label for="inputAddress2">Todas las categorias</label>
                                <select name="id_categoria_woo" class="form-control" id="id_categoria_woo">
                                    <option value="">Seleccionar una categoria</option>
                                    <option value="78">Alimentos</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="visibilidad" value="1" class="custom-control-input" id="customSwitch1" checked>
                                    <label class="custom-control-label" for="customSwitch1">Visibilidad</label>
                                </div>
                                <hr>
                                <div class="form-group col-md-12">
                                    <label for="imagen_">Agregar una imagen</label>
                                    <input type="file" class="form-control" name="imagen" id="imagen_">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar Modal</button>
                <button type="button" class="btn btn-primary" id="send_new_item">Crear Nuevo Producto</button>
            </div>
        </div>
    </div>
</div>
