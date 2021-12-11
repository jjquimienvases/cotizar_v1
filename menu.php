<ul class="nav navbar-nav">
<li class="dropdown">
	<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Cotizacion
	<span class="caret"></span></button>
	<ul class="dropdown-menu">
		<li><a href="invoice_list.php">Tus Cotizaciones</a></li>
		<li><a href="create_invoice.php">Crear Cotizacion</a></li>
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
