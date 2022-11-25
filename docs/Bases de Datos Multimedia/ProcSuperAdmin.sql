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
    in _correo_e varchar(256),
    in _pass varchar(16),
	in _id_usuario varchar(36),
    in _us_correo varchar(256),
    in _nombres varchar(64),
    in _apellidos varchar(64),
    in _username varchar(32),
    in _new_email varchar(256),
    in _new_pass varchar(16)
)
begin
declare _id_sadmin binary(16);
select id_sadmin into _id_sadmin from super_admins where attr2 = _correo_e and attr3 = _pass and fecha_elim is null;
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
            _new_email,
            _new_pass
        );
    when ('modify') then
		update super_admins set
			nombres = ifnull(_nombres, nombres),
			apellidos = ifnull(_apellidos, apellidos),
			username = ifnull(_username, username),
			attr2 = ifnull(_new_email, attr2),
            attr3 = ifnull(_new_pass, attr3),
			fecha_modif = sysdate()
		where id_sadmin = _id_sadmin;
    when ('delete') then
		update super_admins set
			fecha_elim = sysdate()
		where id_sadmin = _id_sadmin;
-- //// AUTORIZAR ADMINISTRADOR \\\\ --
	when ('auto_admin') then
		update usuarios set
			autorizador = ifnull(_id_sadmin, autorizador),
			fecha_modif = sysdate()
		where id_usuario = uuid_to_bin(_id_usuario) and attr1 = "administrador" and fecha_elim is null;
	when ('get_userid') then
		select
			bin_to_uuid(id_usuario) as 'ID',
			attr2 as 'Correo'
		from usuarios
        where attr2 = _us_correo and attr1 = "administrador" and fecha_elim is null;
    else
		select "invalid_command" as 'result';
end case;

end $$
DELIMITER ;