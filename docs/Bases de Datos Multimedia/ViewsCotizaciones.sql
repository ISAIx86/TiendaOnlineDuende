-- // FILENAME: ViewsCotizaciones.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Vistas para Usuarios.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

drop view if exists vw_cotiz_card;
drop view if exists vw_cotiz_info;

-- ///////////////////////////////////
-- //// VISTA DE COTIZACION LISTA \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_cotiz_card as
select
	cotiz.id_cotiz as 'id_cotiz',
    cotiz.id_publicador as 'id_publicador',
    cotiz.id_comprador as 'id_comprador',
    publ.avatar as 'publ_avatar',
    publ.username as 'publ_username',
    comp.avatar as 'comp_avatar',
    comp.username as 'comp_username',
    multi.contenido as 'imagen',
    prod.titulo as 'titulo',
    cotiz.com_cantidad as 'cantidad',
    cotiz.estado as 'estado',
    cotiz.fecha_modif as 'fecha_modif'
from cotizaciones as cotiz
left outer join usuarios as publ
on cotiz.id_publicador = publ.id_usuario
left outer join usuarios as comp
on cotiz.id_comprador = comp.id_usuario
left outer join productos as prod
on cotiz.id_producto = prod.id_producto
left outer join multimedia as multi
on cotiz.id_producto = multi.id_prod
where multi.tipo = 'i'
group by cotiz.id_producto;

-- ///////////////////////////////////////
-- //// VISTA DE COTIZACIÓN DETALLADA \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_cotiz_info as
select
	cotiz.id_cotiz as 'id_cotiz',
    cotiz.id_publicador as 'id_publicador',
    publ.avatar as 'publ_avatar',
    publ.username as 'publ_username',
    comp.avatar as 'comp_avatar',
    comp.username as 'comp_username',
    cotiz.id_comprador as 'id_comprador',
    multi.contenido as 'imagen',
    prod.titulo as 'titulo',
    cotiz.vend_precio as 'v_precio',
    cotiz.vend_cantidad as 'v_cantidad',
    cotiz.com_precio as 'c_precio',
    cotiz.com_cantidad as 'c_cantidad',
    cotiz.estado as 'estado'
from cotizaciones as cotiz
left outer join usuarios as publ
on cotiz.id_publicador = publ.id_usuario
left outer join usuarios as comp
on cotiz.id_comprador = comp.id_usuario
left outer join productos as prod
on cotiz.id_producto = prod.id_producto
left outer join multimedia as multi
on cotiz.id_producto = multi.id_prod
where multi.tipo = 'i'
group by cotiz.id_producto;