use cotpruebas;
SELECT SUM(order_total_after_tax) as total_tamara FROM factura_orden WHERE order_date BETWEEN '2020-01-22 08:01:00' AND '2021-01-27 19:59:59' AND order_receiver_address LIKE '%(maria omaña)%' AND metodopago ='mostradorjj' AND estado != 'anulado';
use cotpruebas;
select * from cotpruebas.factura_orden_producto where order_receiver_address="maria omaña";
select * from cotpruebas.factura_usuarios;
update  cotpruebas.factura_orden set order_receiver_address="Maria omaña" where order_receiver_address="maria omaña";

select order_receiver_address from cotpruebas.factura_orden where factura_orden.order_receiver_address != "leiner mena" and order_receiver_address!="Johan Agudelo";
select * from notificaciones;
use cotpruebas;
select * from factura_orden where order_id=948;
use cotpruebas;
select * from factura_orden_producto where order_id=998;
select id,accion as text  from perfumeria;
select * from rol;
select * from producto where id=1000;
 select * from producto_av where id_categoria=4;
select* from traspasos ;
use cotpruebas;
select * from producto_d1  where id=48;
select *  from traspasos where id_rol_bodega_entrada=4 and estado='solicitud';
SELECT  FOUND_ROWS();
select idperfumeria,accion  from perfumeria;
update  traspasos set estado='Finalizado' where id=38;

use cotpruebas;
select id,contratipo as text from producto where contratipo like '%%' or id='%%' or id_categoria=4;
select * from producto where id=265;
use cotpruebas;
select * from producto where id=39 or contratipo like '%1%' and id like '%1%';
select * from producto where id=2670;


select * from producto;
select * from solicitud_productos where solicitud;
use cotpruebas;
describe solicitud_productos;
select * from clientes where id=1;
update clientes set puntos_naturales=1 where id=1;
update producto set stock=700 where id_categoria=2;	
use cotpruebas;
update solicitud_productos set estado='solicitud';
UPDATE `solicitud_productos` SET estado="finalizado" where id=5; 

select * from solicitud_productos where fecha_solictud between '2021-02-12 ' and '2021-02-14 ';

select * from factura_usuarios;
select * from traspasos where id_categoria=4;
select * from solicitud_productos where fecha_solictud between '2021-02-12 21:33:58' and '2021-02-14 22:09:00' LIMIT 0, 1000;
SELECT * FROM traspasos WHERE (bodega_salida = 'producto_av') and (estado = 'Solicitud Finalizada') and (id_categoria=4);
SELECT * FROM traspasos WHERE (bodega_salida = 'producto_av') and (estado = 'Solicitud Finalizada') and (id_categoria=4);
