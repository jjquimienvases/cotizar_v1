<ul class="nav navbar-nav">
<li class="dropdown">
	<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Orden Compra
	<span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><a href="orden_lista.php">Tus ordenes de compra</a></li>
		<li><a href="new_create_orden.php">Crear una nueva orden</a></li>
	</ul>
</li>
<?php
if($_SESSION['userid']) { ?>
	<li class="dropdown">
		<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Conectado: <?php echo $_SESSION['user']; ?>
		<span class="caret"></span></button>
		<ul class="dropdown-menu">
			<li><a href="#">Mi Cuenta</a></li>
			<li><a href="action.php?action=logout">Salir</a></li>
		</ul>
	</li>

<?php } ?>
</ul>
<ul>
 <li> <a href="sendpdf/formulario.html"  title="Enviar Cotizacion"><div class="btn btn-success"><span class="glyphicon glyphicon-send"></span></div></a></li>
</ul>
<br /><br /><br /><br />
