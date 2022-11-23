-- // FILENAME: ViewsProductos.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Vistas para Productos.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

drop view if exists vw_rpp_prod;
drop view if exists vw_histo_pedidos;

-- /////////////////////////////////////////////////
-- //// VISTA RELACION PEDIDO PRODUCTOS SOLO ID \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_rpp_prod as
select
	bin_to_uuid(id_producto) as 'id_producto'
from rel_ped_prod;

create or replace view vw_histo_pedidos as
select
	peds.fecha_compra as 'fecha_compra',
    group_concat() as 'categoria',
    prods.titulo as 'producto',
    prods.calificacion as 'calificacion',
    prods.precio as 'precio'
from rel_ped_prod as rpp
left outer join pedidos as peds
on rpp.folio_pedido = peds.folio
left outer join productos as prods
on rpp.id_producto = prods.id_producto
left outer join rel_cat as rlc
on prods.id_producto = rlc.id_producto
left outer join categorias as cat
on rlc.id_categoria = cat.id_catego;