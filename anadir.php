
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
<script src="jquery-3.1.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<title>Registrar Proveedores</title>
<link rel="stylesheet" href="css/anadir.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


			<?php include 'barra_asistente.php'; ?>
<br>
<h3>Registra un nuevo proveedor</h3>
<br>

<div class="contenedors">
  <div class="form-group">
    <form class="" action="send_proveedor.php" method="post" id="formulario">
   <label for="">Empresa:</label>
      <input type="text" name="empresa" value="">
   <label for="">Asesor:</label>
      <input type="text" name="asesor" value="">
   <label for="">Telefono:</label>
      <input type="text" name="telefono" value="">
    <hr>

      <button class="btn btn-success" type="submit" name="button" id="try">Registrar</button>
    </form>
  </div>
</div>








