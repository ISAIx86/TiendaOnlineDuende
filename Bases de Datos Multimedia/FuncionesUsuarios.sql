-- // FILENAME: FuncionesUsuarios.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Vistas para Usuarios.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

drop function if exists fn_totalCarrito;

-- /////////////////////////////////////////////
-- //// SUMA TOTAL DE PRODUCTOS DEL CARRITO \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
DELIMITER $$
create function fn_totalCarrito(_id_usuario binary(16)) returns decimal(8,2)
deterministic
begin
	declare _total_carrito decimal(8,2);
	select
		sum(total) into _total_carrito
	from vw_carrito
	where id_usuario = _id_usuario
	group by id_usuario;
    return _total_carrito;
end;
$$ DELIMITER ;