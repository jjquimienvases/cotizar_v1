alter table clientes
add column puntos_perfumeria int  null;

alter table clientes
add column puntos_naturales int  null;

alter table factura_orden_producto
add column gramos int null;

alter table factura_orden_producto
add column envases int null;
alter table factura_orden_producto

add column tapa int null;

alter table factura_orden_producto 
add column gramos varchar(50) not null;

alter table factura_orden_producto 
add column envases varchar(50) not null;

alter table factura_orden_producto 
add column tapa varchar(50) not null;

alter table factura_orden_producto 
add column gramos_adiciones int not null;

alter table traspasos
add column id_categoria int not null;

alter table clientes
add column  enum('Distribuidores','Especiales','Normales') not null;
