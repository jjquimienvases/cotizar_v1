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
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" id="cerrar">&times;</span>
  <center>
    <div class="form-row">
      <form class="" id="client_information" action="" method="post">
          <h2> COMPLETAR TODOS LOS DATOS </h2>
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
              <td> <input type="text" name="nombre" id="nombre" placeholder="Nombre o razon social" value="" onkeyup="PasarValor();"></td>
              <td> <input type="text" name="cc" id="cc" placeholder="CC o NIT" value="" onkeyup="PasarValor();"> </td>
              <td> <input type="text" name="email" id="emails" placeholder="Correo electronico" value="" onkeyup="PasarValor();"></td>
            </tr>
          </tbody>
        </table>
         <table class="table table-bordered table-hover">
           <thead>
             <tr class="bg-warning" style="color:black">
               <th>Telefono</th>
               <th>Direccion</th>
               <th>Ciudad</th>
               <th>Puntos P</th>
             </tr>
           </thead>
           <tbody>
             <tr>
               <td> <input type="text" name="telefono" id="telefono" placeholder="Telefono" value="" onkeyup="PasarValor();"></td>
               <td> <input type="text" name="direccion" id="direcciones" placeholder="Direccion" value="" onkeyup="PasarValor();"></td>
               <td> <input type="text" name="ciudad" id="ciudades" placeholder="Ciudad" value="" onkeyup="PasarValor();"></td>           </tbody>
               
               <input type="text" name="puntos" id="puntos" placeholder="puntos" value="" ></td>           </tbody>
             </tr>
         </table>


        <button type="button" id="guardaremos" name="button" class="btn btn-primary" onclick="return PasarValor()">Guardar Cliente</button>
      </form>
    </div>
  </center>

  </div>

</div>

<script type="text/javascript">
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
  modal.style.display = "none";
}
}

$(document).on("click", "#cerrar", function ocultar(){
    document.getElementById('myModal').style.display = 'none';
  });
</script>
