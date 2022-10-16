-- // FILENAME: ProcSuperAdmins.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para Super Administradores.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula

use tienda_online;

-- ////////////////////////////////////////
-- //// PROCEDIMIENTOS DE SUPER ADMINS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists `sp_SAdmin`;
$$ DELIMITER ;
DELIMITER $$
create definer=`root`@`localhost` procedure `sp_SAdmin`(
	in `_proc` varchar(16),
	in `_id_sadmin` varchar(36),
	in `_nombres` varchar(64),
    in `_apellidos` varchar(64),
    in `_username` varchar(32),
    in `_correo` varchar(256),
    in `_pass` varchar(256)
)
begin

case
-- //// ALTA SUPER ADMIN \\\\ --
	when (_proc = 'create') then
		insert into `super_admins`(
			`id_sadmin`,
			`nombres`,
			`apellidos`,
			`username`,
			`attr2`,
			`attr3`
		)
		values (
			uuid_to_bin(uuid()),
			_nombres,
			_apellidos,
			_username,
			_correo,
			_pass
		);
-- //// MODIFICAR SUPER ADMIN \\\\ --
    when (_proc = 'modify') then
		update `super_admins` set
			`nombres` = ifnull(_nombres, `nombres`),
			`apellidos` = ifnull(_apellidos, `apellidos`),
			`username` = ifnull(_username, `username`),
			`attr2` = ifnull(_correo, `attr2`),
			`attr3` = ifnull(_pass, `attr3`),
			`fecha_modif` = sysdate()
		where `id_sadmin` = uuid_to_bin(_id_sadmin);
-- //// ELIMINAR SUPER ADMINISTRADOR \\\\ --
    when (_proc = 'delete') then
		update `super_admins` set
			fecha_elim = sysdate()
		where `id_sadmin` = uuid_to_bin(_id_sadmin);
    else
		select "invalid_command" as 'result';
end case;

end
$$ DELIMITER ;