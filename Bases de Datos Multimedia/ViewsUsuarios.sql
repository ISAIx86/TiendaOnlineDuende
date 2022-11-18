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

create or replace view vw_carrito as
select
	rlc.id_usuario as 'id_usuario',
    rlc.id_producto as 'id_producto',
	prod.titulo as 'titulo',
    prod.precio as 'precio',
    rlc.cantidad as 'cantidad',
    prod.precio * rlc.cantidad as 'total'
from rel_carrito as rlc
left outer join productos as prod
on rlc.id_producto = prod.id_producto;