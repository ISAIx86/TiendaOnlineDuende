-- // FILENAME: ProcRelCat.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para los domicilios.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- ///////////////////////////////////////
-- //// RELACION CATEGORIAS PRODUCTOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists sp_RelCat;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_RelCat (
	in _proc varchar(16),
	in _id_producto varchar(36),
	in _id_categoria varchar(36)
)
begin
	
case (_proc)
-- //// REGISTRAR PRODUCTO \\\\ --
	when ('create') then
		insert into rel_cat(
			id_producto,
			id_categoria
		)
		values (
			_id_producto,
            _id_categoria
		);
-- //// ELIMINAR PRODUCTO \\\\ --
    when ('restart') then
		delete from rel_cat
        where id_producto = uuid_to_bin(_id_producto);
-- //// OBTENER CATEGORÍAS DE PRODUCTO \\\\ --
	
    else
		select "invalid_command" as 'result';
end case;
    
end
$$ DELIMITER ;