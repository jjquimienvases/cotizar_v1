<div class="container-fluid">
    <hr>
   <div class="contenedor_search" id="search_1">
       <div class="col-md-8">
           <label for="">Escribir el numero del traspaso que deseas consultar</label>
               <input type="text" class="form-control rounded-pill" placeholder="Escribir el numero del transpaso" id="search_transfers">
           </div>
           <div class="col-md-4">
               <button class="btn btn-success rounded-pill mt-4" id="btn_search_transfers" onclick="show_transfer_search()">Buscar</button>
           </div>    
   </div>
   <hr>
   <div class="container">
       <table class="table">
           <thead>
               <tr>
                   <th>Fecha</th>
                   <th>Traspaso</th>
                   <th>Bodega Salida</th>
                   <th>Bodega Entrada</th>
                   <th>Generar Etiquetas</th>
               </tr>
           </thead>
           <tbody id="info_transfers">

           </tbody>
       </table>
   </div>
   
</div>