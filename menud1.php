<div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
        Cotizaciones
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="lista_cotizacionesd1.php">Tus cotizaciones D1</a>
        <a class="dropdown-item" href="create_invoice_d1.php">Crear una nueva cotizacion</a>
    </div>
</div>

<div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
	Conectado: <?php echo $_SESSION['user']; ?>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Tu cuenta</a>
        <a class="dropdown-item" href="action.php?action=logout">Cerrar sesion</a>
    </div>
</div>