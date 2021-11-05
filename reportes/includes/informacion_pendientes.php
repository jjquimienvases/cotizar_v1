 <table class="table table-bordered">
     <thead>
         <tr>
             <th colspan="6" class="text-center"> Cotizaciones Efectivas <?= $punto ?></th>
         </tr>
         <tr>
             <th>Fecha</th>
             <th>Remision</th>
             <th>Cliente</th>
             <th>Comercial</th>
             <th>Metodo de pago</th>
             <th>Monto</th>
         </tr>
     </thead>
     <tbody>
         <?php
            $consulta_mostrador = getConsultaMostradorPendientes($punto);
            // print_r($consulta_mostrador);
            foreach ($consulta_mostrador as $datos_mostrador) :
                $fecha = $datos_mostrador["order_date"];
                $cotizacion = $datos_mostrador["order_id"];
                $cliente = $datos_mostrador["order_receiver_name"];
                $comercial = $datos_mostrador["order_receiver_address"];
                $metodo_de_pago = $datos_mostrador["metodo_de_pago"];
                $monto_x = 0;

                $total_tax = $datos_mostrador["order_total_after_tax"];
                $total_desc = $datos_mostrador["order_total_amount_due"];

                if ($total_desc == "0" || $total_desc == "") {
                    $monto_x = $total_tax;
                } else {
                    $monto_x = $total_desc;
                }
            ?>
             <tr>
                 <td><?= $fecha; ?></td>
                 <td><?= $cotizacion; ?></td>
                 <td><?= strtoupper($cliente); ?></td>
                 <td><?= strtoupper($comercial); ?></td>
                 <td><?= strtoupper($metodo_de_pago); ?></td>
                 <td><?= formatear($monto_x); ?></td>
             </tr>
         <?php endforeach ?>

     </tbody>


 </table>