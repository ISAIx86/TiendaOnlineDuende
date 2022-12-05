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
drop view if exists vw_prod_categos;
drop view if exists vw_histo_pedidos;
drop view if exists vw_ventas_detallada;
drop view if exists vw_ventas_agrupada;
drop view if exists vw_existencias;
drop view if exists vw_reviews;

-- /////////////////////////////////////////////////
-- //// VISTA RELACION PEDIDO PRODUCTOS SOLO ID \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_rpp_prod as
select
	bin_to_uuid(id_producto) as 'id_producto'
from rel_ped_prod;

-- ////////////////////////////////////////////////
-- //// VISTA CATEGORIAS DE PRODUCTO AGRUPADAS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_prod_categos as
select
	prods.id_producto as 'id_producto',
    prods.titulo as 'titulo',
    group_concat(cat.nombre) as 'categorias'
from productos as prods
left outer join rel_cat as rlc
on prods.id_producto = rlc.id_producto
left outer join categorias as cat
on cat.id_catego = rlc.id_categoria
group by prods.id_producto;

-- ////////////////////////////////////
-- //// VISTA HISTORIAL DE PEDIDOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_histo_pedidos as
select
	peds.id_usuario as 'id_usuario',
	peds.folio as 'folio',
    multi.contenido as 'imagen',
	peds.fecha_compra as 'fecha_compra',
    pct.categorias as 'categoria',
    prods.titulo as 'producto',
    prods.calificacion as 'calificacion',
    rpp.precio as 'precio',
    rpp.cantidad as 'cantidad',
    rpp.subtotal as 'subtotal'
from pedidos as peds
left outer join rel_ped_prod as rpp
on rpp.folio_pedido = peds.folio
left outer join productos as prods
on prods.id_producto = rpp.id_producto
left outer join vw_prod_categos as pct
on pct.id_producto = prods.id_producto
left outer join multimedia as multi
on prods.id_producto = multi.id_prod
where multi.tipo = 'i'
group by peds.folio;

-- ////////////////////////////////////
-- //// VISTA HISTORIAL DE PEDIDOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_ventas_detallada as
select
	prods.id_publicador as 'id_publicador',
	peds.fecha_compra as 'fecha_compra',
    pct.categorias as 'categorias',
    prods.titulo as 'producto',
    prods.calificacion as 'calificacion',
    rpp.subtotal as 'precio',
    prods.disponibilidad as 'disponibilidad'
from rel_ped_prod as rpp
left outer join pedidos as peds
on rpp.folio_pedido = peds.folio
left outer join productos as prods
on rpp.id_producto = prods.id_producto
left outer join vw_prod_categos as pct
on prods.id_producto = pct.id_producto;

-- ////////////////////////////////////
-- //// VISTA HISTORIAL DE PEDIDOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_ventas_agrupada as
select
	prods.id_publicador as 'id_publicador',
    peds.fecha_compra as 'fecha_compra',
	month(peds.fecha_compra) as 'month',
    year(peds.fecha_compra) as 'year',
    cat.nombre as 'categorias',
    sum(rpp.subtotal) as 'ventas'
from rel_ped_prod as rpp
left outer join pedidos as peds
on rpp.folio_pedido = peds.folio
left outer join productos as prods
on rpp.id_producto = prods.id_producto
left outer join rel_cat as rlc
on prods.id_producto = rlc.id_producto
left outer join categorias as cat
on rlc.id_categoria = cat.id_catego
group by cat.id_catego;

-- ///////////////////////////
-- //// VISTA EXISTENCIAS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_existencias as
select
	prod.id_publicador as 'id_publicador',
    prod.id_producto as 'id_prod',
    multi.contenido as 'imagen',
	vpc.categorias as 'categorias',
	prod.titulo as 'titulo',
	prod.calificacion as 'calificacion',
	prod.precio as 'precio',
	prod.disponibilidad as 'disponibilidad',
    prod.fecha_elim as 'fec_elim',
    prod.id_autorizador as 'id_autorizador'
from productos as prod
left outer join vw_prod_categos as vpc
on prod.id_producto = vpc.id_producto
left outer join multimedia as multi
on prod.id_producto = multi.id_prod
where multi.tipo = 'i'
group by prod.id_producto;

-- ///////////////////////
-- //// VISTA REVIEWS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_reviews as
select
	rlr.id_producto as 'id_producto',
	usu.username as 'username',
    usu.avatar as 'avatar',
    rlr.calificacion as 'calif',
    rlr.comentario as 'comentario',
    rlr.fecha as 'fecha'
from rel_review as rlr
left outer join usuarios as usu
on rlr.id_usuario = usu.id_usuario;

-- //////////////////////////////////
-- //// VISTA LISTA AUTORIZACION \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_listaauto as
select
	prod.id_producto as 'id_prod',
    prod.id_autorizador as 'id_autorizador',
    multi.contenido as 'imagen',
    prod.titulo as 'titulo',
    prod.descripcion as 'descripcion',
    prod.cotizacion as 'cotizacion',
    prod.precio as 'precio',
    prod.fecha_elim as 'fecha_elim'
from productos as prod
left outer join multimedia as multi
on prod.id_producto = multi.id_prod
where multi.tipo = 'i'
group by prod.id_producto;