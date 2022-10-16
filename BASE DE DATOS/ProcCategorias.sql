-- // FILENAME: ProcCategorias.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para las categorías.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 

use tienda_online;

-- //////////////////////////////////////
-- //// PROCEDIMIENTOS DE CATEGORÍAS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


DELIMITER $$
drop procedure if exists `sp_Categorias`;
$$ DELIMITER ;
DELIMITER $$
create definer=`root`@`localhost` procedure `sp_Categorias`(
	in `_proc` varchar(16),
    in `_id_catego` varchar(36),
    in `_id_creador` varchar(36),
    in `_nombre` varchar(32),
    in `_descripcion` varchar(256)
)
begin

case
-- //// CREAR CATEGORÍA //// --
	when (_proc = 'create') then
		insert into `categorias`(
			`id_catego`,
			`id_creador`,
			`nombre`,
			`descripcion`
		)
		values (
			uuid_to_bin(uuid()),
			uuid_to_bin(_id_creador),
			_nombre,
			_descripcion
		);
-- //// MODIFICAR CATEGORÍA //// --
    when (_proc = 'modify') then
		update `categorias` set
			`nombre` = ifnull(_nombre, `nombre`),
			`descripcion` = ifnull(_descripcion, `descripcion`),
			`fecha_modif` = sysdate()
		where `id_catego` = uuid_to_bin(_id_catego);
-- //// ELIMINAR CATEGORÍA //// --
    when (_proc = 'delete') then
		update `categorias` set
			`fecha_elim` = sysdate()
		where `id_catego` = uuid_to_bin(_id_catego);
-- //// COMANDO NO VÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;
	
end
$$ DELIMITER ;