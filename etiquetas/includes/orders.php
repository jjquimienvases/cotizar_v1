<div class="container-fluid">
    <hr>
   <div class="d-flex contenedor_search">
       <div class="col-md-8">
           <label for="">Escribir el numero de la cotizacion que deseas consultar</label>
               <input type="text" class="form-control rounded-pill" placeholder="Escribir el numero de la cotizacion" id="search_orders">
           </div>
           <div class="col-md-4">
              
               <button class="btn btn-success rounded-pill mt-4" id="btn_search" onclick="show_orders_search()">Buscar</button>
           </div>    
   </div>
   <hr>
   <div class="container">
       <table class="table">
           <thead>
               <tr>
                   <th>Fecha</th>
                   <th>Remision</th>
                   <th>Cliente</th>
                   <th>Comercial</th>
                   <th>Generar Etiquetas</th>
               </tr>
           </thead>
           <tbody id="info_orders">

           </tbody>
       </table>
   </div>
   
</div>