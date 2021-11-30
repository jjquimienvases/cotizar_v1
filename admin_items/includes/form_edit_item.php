<div class="container mt-5 mb-2">
    <div class="text-center">
        <h3>EDITAR ITEMS</h3>
    </div>
    <div class="row">
        <div class="col-auto">
            <input type="text" class="form-control rounded-pill border-success" placeholder="Buscar item por Nombre o ID">
        </div>
        <div class="col-auto">
            <button class="btn btn-success rounded-pill">Buscar</button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-4">
            <label for="" class="text-success">Escribir el ID o SKU</label>
            <input type="number" class="form-control rounded-pill border-success" id="item_code" name="item_code">
        </div>
        <div class="col-4">
            <label for="" class="text-success">Escribir Nombre del Producto:</label>
            <input type="text" class="form-control rounded-pill border-success" id="item_name" name="item_name">
        </div>
        <div class="col-4">
            <label for="" class="text-success">Costo sin iva</label>
            <input type="text" class="form-control rounded-pill border-success" id="price" id="price">
        </div>
    </div>
    <hr>
    <h4 class="text-center">CATEGORIAS</h4>
    <div class="row">
        <div class="col-4">
            <label for="" class="text-success">Categoria Principal</label>
            <select name="categoria_principal" id="categoria_principal" class="form-control rounded-pill">
                <option value="">Categoria principal</option>
            </select>
        </div>
        <div class="col-4">
            <label for="" class="text-success">Sub-Categoria</label>
            <select name="sub_categoria" id="sub_categoria" class="form-control rounded-pill">
                <option value="">Sub Categoria</option>
            </select>
        </div>
        <div class="col-4">
            <label for="" class="text-success">Sub-Categoria interna</label>
            <select name="sub_categoria_interna" id="sub_categoria_interna" class="form-control rounded-pill">
                <option value="">Sub Categoria interna</option>
            </select>
        </div>
    </div>
    <hr>
    <h4 class="text-center">INVENTARIO</h4>
    <div class="row">
        <div class="col-4">
            <label for="" class="text-success">Stock Actual</label>
            <input type="number" name="stock_actual" id="stock_actual" class="form-control rounded-pill">
        </div>
        <div class="col-4">
            <label for="" class="text-success">Stock Minimo</label>
            <input type="number" name="stock_minimo" id="stock_minimo" class="form-control rounded-pill">
        </div>
        <div class="col-4">
            <label for="" class="text-success">Stock Maximo</label>
            <input type="number" name="stock_maximo" id="stock_maximo" class="form-control rounded-pill">
        </div>
    </div>
    <hr>
    <h4 class="text-center">INFORMACION ADICIONAL</h4>
    <div class="row">
        <div class="col-4">
            <label for="" class="text-success">Ubicacion</label>
            <input type="text" name="ubicacion" id="ubicacion" class="form-control rounded-pill">
        </div>
        <div class="col-4">
            <label for="" class="text-success">Peso en gramos</label>
            <input type="text" name="peso" id="peso" class="form-control rounded-pill">
        </div>
        <div class="col-4">
            <label for="" class="text-success">Unidad de empaque</label>
            <input type="text" name="unidad_empaque" id="unidad_empaque" class="form-control rounded-pill">
        </div>
    </div>
    <h4 class="text-center">DATOS IMPORTANTES</h4>
    <div class="row">
        <div class="col-4">
            <label for="" class="text-success">Imagen del producto</label>
            <input type="file" name="file" id="file" class="form-control rounded-pill">
        </div>
        <div class="col-4">
            <label for="" class="text-success">Seleccionar Proveedor</label>
            <select name="provider" id="provider" class="form-control rounded-pill">
                <option value="">proveedor</option>
            </select>
        </div>
        <div class="col-4">
            <label for="" class="text-success">Precio del proveedor seleccionado sin iva</label>
            <input type="text" name="price_provider" id="price_provider" class="form-control rounded-pill">
        </div>
    </div>
    <hr>
    <button type="button" id="send_create_item" class="uk-button uk-button-default text-right mb-3 border-success">CARGAR INFOMACION DEL PRODUCTO</button>

</div>