-- // FILENAME: ProcUsuarios.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para el Usuario.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 

use tienda_online;

-- ////////////////////////////////////
-- //// PROCEDIMIENTOS DE USUARIOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists `sp_Usuarios`;
$$ DELIMITER ;
DELIMITER $$
create definer=`root`@`localhost` procedure `sp_Usuarios`(
	in `_proc` varchar(16),
    in `_id_usuario` varchar(36),
    in `_nombres` varchar(64),
    in `_apellidos` varchar(64),
    in `_username` varchar(32),
    in `_fecha_nac` datetime,
    in `_sexo` char(1),
    in `_rol` varchar(16),
    in `_correo_e` varchar(256),
    in `_pass` varchar(256),
    in `_avatar` blob,
    in `_avatar_dir` varchar(256),
    in `_creador` varchar(36)
)
begin

case
-- //// REGISTRAR USUARIO \\\\ --
	when (_proc = 'create') then
		insert into `usuarios` (
			id_usuario,
			nombres,
			apellidos,
			username,
			fecha_nac,
			sexo,
			attr1,
			attr2,
			attr3,
			avatar,
			avatar_dir,
			creador
		)
		values (
			uuid_to_bin(uuid()),
			_nombres,
			_apellidos,
			_username,
			_fecha_nac,
			_sexo,
			_rol,
			_correo_e,
			_pass,
			_avatar,
			_avatar_dir,
			_creador
		);
-- //// MODIFICAR USUARIO \\\\ --
    when (_proc = 'modify') then
		update `usuarios` set
			`nombres` = ifnull(_nombres, `nombres`),
			`apellidos` = ifnull(_apellidos, `apellidos`),
			`username` = ifnull(_username, `username`),
			`fecha_nac` = ifnull(_fecha_nac, `fecha_nac`),
			`sexo` = ifnull(_sexo, `sexo`),
			`avatar` = ifnull(_avatar, `avatar`),
			`avatar_dir` = ifnull(_avatar_dir, `avatar_dir`),
			`fecha_modif` = sysdate()
		where `id_usuario` = uuid_to_bin(_id_usuario) and `fecha_elim` is null;
-- //// ELIMINAR USUARIO \\\\ --
    when (_proc = 'delete') then
		update `usuarios` set
			`fecha_elim` = sysdate()
		where `id_usuario` = uuid_to_bin(_id_usuario) and `fecha_elim` is null;
-- //// RECUPERAR USUARIO \\\\ --
    when (_proc = 'backup') then
		update `usuarios` set
		`fecha_elim` = null
		where `id_usuario` = uuid_to_bin(_id_usuario) and `fecha_elim` is not null;
-- //// CHECAR CORREO \\\\ --
    when (_proc = 'checkE') then
		select
			count(*) as "result"
		from `usuarios`
		where `attr2` = _correo_e;
-- //// MODIFICAR CORREO ELECTRÓNICO \\\\ --
    when (_proc = 'changeE') then
		update `usuarios` set
			`attr2` = ifnull(_correo_e, `attr2`),
			`fecha_modif` = sysdate()
		where `id_usuario` = uuid_to_bin(_id_usuario) and `fecha_elim` is null;
-- //// MODIFICAR CONTRASEÑA \\\\ --
    when (_proc = 'changeP') then
		update `usuarios` set
			`attr3` = ifnull(_pass, `attr3`),
			`fecha_modif` = sysdate()
		where `id_usuario` = uuid_to_bin(_id_usuario) and `fecha_elim` is null;
-- //// INICIO DE SESIÓN \\\\ --
    when (_proc = 'login') then
		if exists(select 1 from `usuarios` where `attr2` = _correo_e) then
			select
				1 as "result",
				bin_to_uuid(`id_usuario`) as "ID",
				`username` as "Username",
				`attr1` as "Rol",
				`attr2` as "Correo",
				`attr3` as "Pass",
				`avatar_dir` as "Imagen"
			from `usuarios`
			where `attr2` = _correo_e;
		else
			select 0 as "result";
		end if;
	when (_proc = 'get_data') then
		select
			1 as "result",
			`nombres` as "out_nombres",
            `apellidos` as "out_apellidos",
            `username` as "out_username",
            `attr2` as "out_correo",
            `fecha_nac` as "out_fechanac",
            case `sexo` when 'H' then "Hombre" when 'M' then "Mujer" end as "out_sexo",
            `fecha_creacion` as "out_feccre"
        from `usuarios`
        where `id_usuario` = uuid_to_bin(_id_usuario);
-- //// COMANDO NO VÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;
    
end
$$ DELIMITER ;