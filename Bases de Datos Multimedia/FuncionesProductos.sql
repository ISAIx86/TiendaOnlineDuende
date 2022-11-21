-- // FILENAME: FuncionesProductos.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Vistas para Usuarios.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

drop function if exists fn_ventasProductos;

-- /////////////////////////////////////////
-- //// CANTIDAD DE VENTAS POR PRODUCTO \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
DELIMITER $$
create function fn_ventasProductos(_id_prod binary(16)) returns int
deterministic
begin
	declare _total_ventas int;
	select
		count(id_producto) into _total_ventas
	from rel_ped_prod
	where id_producto = _id_prod;
    return _total_ventas;
end;
$$ DELIMITER ;