<style media="screen">
/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
background-color: #fefefe;
margin: 15% auto; /* 15% from the top and centered */
padding: 20px;
border: 1px solid #888;
width: 60%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
color: #aaa;
float: right;
font-size: 28px;
font-weight: bold;
}

.close:hover,
.close:focus {
color: black;
text-decoration: none;
cursor: pointer;
}
</style>


<!-- The Modal -->
<div id="modal_editar" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" id="cerrar" >&times;</span>
  <center>
    <div class="form-row">

			<div class="form-group">
				<div style="text-align: center;">
					<select id="buscarclientes" style="width: 100%">
						<option value="0">Buscar cliente:</option>
						<?php
						$query = $mysqli2 -> query ("SELECT * FROM clientes ORDER BY nombres ASC");
						while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores["cedula"].'">'.$valores["cedula"].','.$valores["nombres"].'</option>';
						}

						?>
					</select>
				</div>
			</div>


      <form class="" id="client_informationes" action="" method="post">


          <h2> COMPLETAR CAMPOS VACIOS </h2>
          <hr>
        <table class="table table-bordered table-hover" >
          <thead>
            <tr class="bg-danger" style="color:black">
              <th>Nombres</th>
              <th>Nit o CC</th>
              <th>Email</th>
            </tr>

          </thead>
          <tbody>
            <tr>
              <td> <input type="text" name="nombres" id="nombres" placeholder="Nombre o razon social" value="" onkeyup="PasarValores();"></td>
              <td> <input type="text" name="ccs" id="ccs" placeholder="CC o NIT" value="" onkeyup="PasarValores();"> </td>
              <td> <input type="text" name="emails" id="emailss" placeholder="Correo electronico" value="" onkeyup="PasarValor();"></td>
            </tr>
          </tbody>
        </table>
         <table class="table table-bordered table-hover">
           <thead>
             <tr class="bg-warning" style="color:black">
               <th>Telefono</th>
               <th>Direccion</th>
               <th>Ciudad</th>
             </tr>
           </thead>
           <tbody>
             <tr>
               <td> <input type="text" name="telefonos" id="telefonos" placeholder="Telefono" value="" onkeyup="PasarValores();"></td>
               <td> <input type="text" name="direccions" id="direccioness" placeholder="Direccion" value="" onkeyup="PasarValores();"></td>
               <td> <input type="text" name="ciudads" id="ciudadess" placeholder="Ciudad" value="" onkeyup="PasarValores();"></td>           </tbody>
             </tr>
         </table>


        <button type="button" id="guardaremos_edit" name="button" class="btn btn-primary" onclick="return PasarValores()" >Guardar Cliente</button>
      </form>
    </div>
  </center>

  </div>

</div>

<script type="text/javascript">
// Get the modal
var modales = document.getElementById("modal_editar");

// Get the button that opens the modal
var btn = document.getElementById("myBtnes");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
modales.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
modales.style.display = "none";
}




// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modales) {
  modales.style.display = "none";
}
}

$(document).on("click", "#cerrar", function ocultar(){
    document.getElementById('modal_editar').style.display = 'none';
  });
</script>
