-- // FILENAME: ViewsUsuarios.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Vistas para Usuarios.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

drop view if exists vw_carrito;

-- //////////////////////////
-- //// VISTA DE CARRITO \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_carrito as
select
	rlc.id_usuario as 'id_usuario',
    rlc.id_producto as 'id_producto',
    mult.contenido as 'imagen',
	prod.titulo as 'titulo',
    rlc.subtotal as 'subtotal',
    rlc.cantidad as 'cantidad',
    rlc.cotizado as 'cotizado',
    prod.disponibilidad as 'disponibilidad',
    rlc.subtotal * rlc.cantidad as 'total'
from rel_carrito as rlc
left outer join productos as prod
on rlc.id_producto = prod.id_producto
left outer join multimedia as mult
on rlc.id_producto = mult.id_prod
where mult.tipo = 'i'
group by rlc.id_producto;