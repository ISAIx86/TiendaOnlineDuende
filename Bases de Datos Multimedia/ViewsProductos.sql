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

-- /////////////////////////////////////////////////
-- //// VISTA RELACION PEDIDO PRODUCTOS SOLO ID \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
create or replace view vw_rpp_prod as
select
	bin_to_uuid(id_producto) as 'id_producto'
from rel_ped_prod;