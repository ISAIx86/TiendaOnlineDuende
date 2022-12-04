-- // FILENAME: ProcSuperAdmin.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para el Usuario.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

DELIMITER $$
drop procedure if exists sp_SuperAdmin;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_SuperAdmin (
	in _proc varchar(16),
    in _id_sadmin varchar(36),
    in _id_usuario varchar(36),
    in _nombres varchar(64),
    in _apellidos varchar(64),
    in _username varchar(32),
    in _correo_e varchar(256),
    in _pass varchar(16)
)
begin

case (_proc)
	when ('create') then
		insert into super_admins (
			id_sadmin,
            nombres,
            apellidos,
            username,
            attr2,
            attr3
        ) values (
			uuid_to_bin(uuid()),
            _nombres,
            _apellidos,
            _username,
            _correo_e,
            _pass
        );
    when ('modify') then
		update super_admins set
			nombres = ifnull(_nombres, nombres),
			apellidos = ifnull(_apellidos, apellidos),
			username = ifnull(_username, username),
			attr2 = ifnull(_correo_e, attr2),
            attr3 = ifnull(_pass, attr3),
			fecha_modif = sysdate()
		where id_sadmin = _id_sadmin;
    when ('delete') then
		update super_admins set
			fecha_elim = sysdate()
		where id_sadmin = _id_sadmin;
-- //// INICIO DE SESIÓN \\\\ --
	when ('login') then
		if exists(select 1 from super_admins where attr2 = _correo_e) then
			select
				1 as 'result',
				bin_to_uuid(id_sadmin) as 'out_id',
				username as 'out_username',
				attr2 as 'out_correo',
				attr3 as 'out_pass'
			from super_admins
			where attr2 = _correo_e;
		else
			select 0 as 'result';
		end if;
-- //// AUTORIZAR ADMINISTRADOR \\\\ --
	when ('auto_admin') then
		set @_uuid_sadmin = uuid_to_bin(_id_sadmin);
		update usuarios set
			autorizador = ifnull(@_uuid_sadmin, autorizador),
			fecha_modif = sysdate()
		where id_usuario = uuid_to_bin(_id_usuario) and attr1 = "administrador" and fecha_elim is null;
	when ('get_admins') then
		select
			bin_to_uuid(id_usuario) as 'out_id',
			attr2 as 'out_correo',
            avatar as 'out_avatar',
            nombres as 'out_nombres',
            apellidos as 'out_apellidos',
            username as 'out_username',
            fecha_nac as 'out_fecnac',
            sexo as 'out_sexo'
        from usuarios
        where attr1 = "administrador" and autorizador is null;
    else
		select "invalid_command" as 'result';
end case;

end $$
DELIMITER ;