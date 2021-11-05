<?PHP 
   $user_rol = $_SESSION['id_rol'];

   $href = "";

   if($user_rol == 7){
       $href = "../panel_ibague.php";
   }else if($user_rol == 1){
       $href = "../asistente.php";
   }else{
       $href = "../Panel_Comerciales.php";
   }
?>


<hr>
<div class="text-center">   
 <button class="btn btn-info rounded-pill">  
     <a href="<?=$href?>" target="_blank">REGRESAR AL PANEL SELECCIONADO</a>
 </button>
</div>

<div class="container border rounded border-success mt-5">

<center>
    <div class="row text-center mt-4 container">
        <h3>Escoge el rango de fechas que deseas consultar:</h3>
       
        <div class="col-6 mt-3">
            <label for="">Escorger Fecha Inicial:</label>
            <input type="date" name="inicial" id="inicial" class="form-control rounded-pill">
        </div>
        <div class="col-6 mt-3">
        <label for="">Escorger Fecha Final:</label>
            <input type="date" name="final" id="final" class="form-control rounded-pill">
        </div>
        <br>
    </div>
    <div class="col-auto mt-3">
        <button class="btn btn-primary rounded-pill" id="search" onclick="get_ventas()">CONSULTAR</button>
    </div>
</center>
<hr>

<center>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Cotizar</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Caja</button>
  </li>

</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  <div class="row">
        <div class="col-auto">
            <label for="">Total Dinero En Efectivo:</label>
            <div>
<label for="">IBAGUE 1</label>
                <input type="text" id="rest_total_ventas" readonly class="form-control">
                <hr>
                <label for="">IBAGUE 2</label>
                <input type="text" id="rest_total_ventas_IB2" readonly class="form-control">
            </div>
        </div>
    
        <hr>
    </div>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="row">
        <div class="col-auto">
            <label for="">Total Dinero En Efectivo CAJA:</label>
            <div>
<label for="">IBAGUE 1</label>
                <input type="text" id="rest_total_ventas_cj" readonly class="form-control border-primary">
                <hr>
                <label for="">IBAGUE 2</label>
                <input type="text" id="rest_total_ventas_IB2_cj" readonly class="form-control border-danger">
            </div>
        </div>
    
        <hr>
    </div>
  </div>
    <div class="col-4 mt-4">
            <label for="">Efectivo Call:</label>
            <input type="text" id="rest_total_ventas_call" readonly class="form-control">
        </div>
        <div class="col-4 mt-4">
            <label for="">Total Dinero En Novedades:</label>
            <input type="text" id="rest_total_novedades" readonly class="form-control">
        </div>
        
        <div class="col-4 mt-4">
            <label for="">TOTAL EFECTIVO - NOVEDADES (cotizar) :</label>
            <input type="text" id="rest_total" readonly class="form-control">
        </div>
        
           <div class="col-4 mt-4">
            <label for="">TOTAL EFECTIVO - NOVEDADES (caja) :</label>
            <input type="text" id="rest_total_caja" readonly class="form-control">
        </div>
</div>


    
</center>  
<center><button class="btn btn-success rounded-pill col-10" onclick="calculate_diferencia()">Recargar Total:</button></center> 
    <hr>


    <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Ventas Ibague 1</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Ventas Ibague 2</button>
    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Ventas Call Center</button>
    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contacts" type="button" role="tab" aria-controls="nav-contacts" aria-selected="false">Gastos</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  <div id="izquierda">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cotizacion</th>
                    <th>Cliente</th>
                    <th>Monto</th>
                </tr>
            </thead>
            
            <tbody id="info">

            </tbody>
        </table>
    </div>

  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cotizacion</th>
                    <th>Cliente</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody id="info_ib2">

            </tbody>
        </table>
  </div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  <div id="middle">
        
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cotizacion</th>
                    <th>Cliente</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody id="info_3">

            </tbody>
        </table>
    </div>
</div>
  <div class="tab-pane fade" id="nav-contacts" role="tabpanel" aria-labelledby="nav-contacts-tab">
  <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Razon</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody id="info_2">

            </tbody>
        </table>
  </div>
</div>



    
</div>