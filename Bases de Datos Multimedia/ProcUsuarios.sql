-- // FILENAME: ProcUsuarios.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para el Usuario.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- ////////////////////////////////////
-- //// PROCEDIMIENTOS DE USUARIOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists sp_Usuarios;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Usuarios (
	in _proc varchar(16),
    in _id_usuario varchar(36),
    in _nombres varchar(64),
    in _apellidos varchar(64),
    in _username varchar(32),
    in _fecha_nac datetime,
    in _sexo char(1),
    in _privacidad boolean,
    in _rol varchar(16),
    in _correo_e varchar(256),
    in _pass varchar(256),
    in _avatar blob,
    in _avatar_dir varchar(256),
    in _autorizador varchar(36),
    in _id_producto varchar(36),
    in _cantidad int
)
begin
declare excluder int;
case (_proc)
-- //// REGISTRAR USUARIO \\\\ --
	when ('create') then
		insert into usuarios (
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
			avatar_dir
		) values (
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
			_avatar_dir
		);
-- //// MODIFICAR USUARIO \\\\ --
    when ('modify') then
		update usuarios set
			nombres = ifnull(_nombres, nombres),
			apellidos = ifnull(_apellidos, apellidos),
			username = ifnull(_username, username),
			fecha_nac = ifnull(_fecha_nac, fecha_nac),
			sexo = ifnull(_sexo, sexo),
            privacidad = ifnull(_privacidad, privacidad),
			avatar = ifnull(_avatar, avatar),
			avatar_dir = ifnull(_avatar_dir, avatar_dir),
			fecha_modif = sysdate()
		where id_usuario = uuid_to_bin(_id_usuario) and fecha_elim is null;
-- //// ELIMINAR USUARIO \\\\ --
    when ('delete') then
		update usuarios set
			fecha_elim = sysdate()
		where id_usuario = uuid_to_bin(_id_usuario) and fecha_elim is null;
-- //// RECUPERAR USUARIO \\\\ --
    when ('backup') then
		update usuarios set
			fecha_elim = null
		where id_usuario = uuid_to_bin(_id_usuario) and fecha_elim is not null;
-- //// CHECAR CORREO \\\\ --
    when ('checkE') then
		select
			count(*) as "result"
			from usuarios
		where attr2 = _correo_e;
-- //// MODIFICAR CORREO ELECTRÓNICO \\\\ --
    when ('changeE') then
		update usuarios set
			attr2 = ifnull(_correo_e, attr2),
			fecha_modif = sysdate()
		where id_usuario = uuid_to_bin(_id_usuario) and fecha_elim is null;
-- //// MODIFICAR CONTRASEÑA \\\\ --
    when ('changeP') then
		update usuarios set
			attr3 = ifnull(_pass, attr3),
			fecha_modif = sysdate()
		where id_usuario = uuid_to_bin(_id_usuario) and fecha_elim is null;
-- //// INICIO DE SESIÓN \\\\ --
    when ('login') then
		if exists(select 1 from usuarios where attr2 = _correo_e) then
			if ("administrador" = (select attr1 from usuarios where attr2 = _correo_e)) then
				select
					1 as 'result',
					bin_to_uuid(id_usuario) as 'out_id',
					username as 'out_username',
					attr1 as 'out_rol',
					attr2 as 'out_correo',
					attr3 as 'out_pass',
					avatar_dir as 'out_img'
				from usuarios
				where attr2 = _correo_e and autorizador is not null;
            else
				select
					1 as 'result',
					bin_to_uuid(id_usuario) as 'out_id',
					username as 'out_username',
					attr1 as 'out_rol',
					attr2 as 'out_correo',
					attr3 as 'out_pass',
					avatar as 'out_img'
				from usuarios
				where attr2 = _correo_e;
            end if;
		else
			select 0 as 'result';
		end if;
-- //// OBTENER DATOS PARA FORMULARIO \\\\ --
	when ('get_data') then
		select
			1 as 'result',
			nombres as 'out_nombres',
            apellidos as 'out_apellidos',
            username as 'out_username',
            attr2 as 'out_correo',
            fecha_nac as 'out_fechanac',
            sexo as 'out_sexo',
            privacidad as 'out_privacidad',
            fecha_creacion as 'out_feccre'
        from usuarios
        where id_usuario = uuid_to_bin(_id_usuario);
-- //// AÑADIR A CARRITO \\\\ --
	when ('add_carrito') then
		replace into rel_carrito (
			id_usuario,
            id_producto,
            cantidad
        ) values (
			uuid_to_bin(_id_usuario),
			uuid_to_bin(_id_producto),
            _cantidad
        );
-- //// MODIFICAR CANTIDAD \\\\ --
	when ('set_carrito') then
		update rel_carrito set
			cantidad = ifnull(_cantidad, cantidad)
		where id_usuario = uuid_to_bin(_id_usuario) and
			  id_producto = uuid_to_bin(_id_producto);
		
-- //// QUITAR PRODUCTO DEL CARRITO \\\\ --
	when ('pop_carrito') then
		delete from rel_carrito
        where id_usuario = uuid_to_bin(_id_usuario) and
			  id_producto = uuid_to_bin(_id_producto);
-- //// LIMPIAR CARRITO \\\\ --
	when ('clean_carrito') then
		delete from rel_carrito
        where id_usuario = uuid_to_bin(_id_usuario);
-- //// PRODUCTOS DEL CARRITO \\\\ --
	when ('get_carrito') then
		select
			bin_to_uuid(id_producto) as 'out_id',
            titulo as 'out_titulo',
            precio as 'out_precio',
            cantidad as 'out_cantidad',
            disponibilidad as 'out_dispo',
            total as 'out_total'
        from vw_carrito
        where id_usuario = uuid_to_bin(_id_usuario);
-- //// SUMA TOTAL DEL CARRITO \\\\ --
	when ('get_carr_tot') then
		select fn_totalCarrito(uuid_to_bin(_id_usuario)) as 'out_total';
-- //// COMANDO NO VÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;
    
end
$$ DELIMITER ;