-- // FILENAME: ProcRelListProd.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para la relacion de listas y productos.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- //////////////////////////////////////////////////////////
-- //// PROCEDIMIENTOS DE RELACIÓN DE LISTAS Y PRODUCTOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists sp_RelListProd;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_RelListProd (
	in _proc varchar(16),
    in _id_lista varchar(36),
    in _id_producto varchar(36)
)
begin

case (_proc)
-- //// CREAR LISTA \\\\ --
	when ('create') then
		replace into rel_li_prod (
			id_lista,
			id_producto
		) values (
			uuid_to_bin(_id_lista),
			uuid_to_bin(_id_producto)
		);
-- //// ELIMINAR LISTA \\\\ --
    when ('delete') then
		delete from rel_li_prod
        where id_lista = uuid_to_bin(_id_lista)
        and id_producto = uuid_to_bin(_id_producto);
-- //// COMANDO NO VÁLIDO \\\\ --
	else
		select "invalid_command" as 'result';
end case;
	
end
$$ DELIMITER ;