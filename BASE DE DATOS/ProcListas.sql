-- // FILENAME: ProcListas.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para las listas.

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
drop procedure if exists `sp_Listas`;
$$ DELIMITER ;
DELIMITER $$
create definer=`root`@`localhost` procedure `sp_Listas`(
	in `_proc` varchar(16),
    in `_id_lista` varchar(36),
	in `_id_usuario` varchar(36),
    in `_nombre` varchar(32),
    in `_descripcion` varchar(256),
    in `_privacidad` boolean,
    in `_imagen` blob,
    in `_imagen_dir` varchar(256)
)
begin

case
-- //// CREAR LISTA \\\\ --
	when (_proc = 'create') then
		insert into `listas` (
			`id_lista`,
			`id_usuario`,
			`nombre`,
			`descripcion`,
			`privacidad`,
			`imagen`,
			`imagen_dir`
		)
		values (
			uuid_to_bin(uuid()),
			uuid_to_bin(_id_usuario),
			_nombre,
			_descripcion,
			_privacidad,
			_imagen,
			_imagen_dir
		);
-- //// MODIFICAR LISTA \\\\ --
    when (_proc = 'modify') then
		update `listas` set
			`nombre` = ifnull(_nombre, `nombre`),
			`descripcion` = ifnull(_descripcion, `descripcion`),
			`privacidad` = ifnull(_privacidad, `privacidad`),
			`imagen` = ifnull(_imagen, `imagen`),
			`imagen_dir` = ifnull(_imagen_dir, `imagen_dir`),
			`fecha_modif` = sysdate()
		where `id_lista` = uuid_to_bin(_id_lista);
-- //// ELIMINAR LISTA \\\\ --
    when (_proc = 'delete') then
		update `listas` set
			`fecha_elim` = sysdate()
		where `id_lista` = uuid_to_bin(_id_lista);
-- //// COMANDO NO VÁLIDO \\\\ --
	else 
		select "invalid_command" as 'result';
end case;
	
end
$$ DELIMITER ;