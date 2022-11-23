-- // FILENAME: ProcDomicilios.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para los domicilios.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- //////////////////////////////////////
-- //// PROCEDIMIENTOS DE DOMICILIOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists sp_Domicilios;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Domicilios (
	in _proc varchar(16),
	in _id_domicilio varchar(36),
	in _id_usuario varchar(36),
    in _calle varchar(32),
    in _numext varchar(16),
    in _numint varchar(16),
    in _residencial varchar(32),
    in _ciudad varchar(32),
    in _provincia varchar(32),
    in _make_default boolean
)
begin

declare id_user binary(16);

case (_proc)
-- //// CREAR DOMICILIO \\\\ --
	when ('create') then
		if (_make_default) then
			update domicilios set
				default_select = 0
			where id_usuario = uuid_to_bin(_id_usuario) and default_select = 1;
		end if;
		insert into domicilios (
			id_domicilio,
			id_usuario,
			calle,
			numext,
			numint,
			residencial,
			ciudad,
			provincia,
			default_select
		) values (
			uuid_to_bin(uuid()),
			uuid_to_bin(_id_usuario),
			_calle,
			_numext,
			_numint,
			_residencial,
			_ciudad,
			_provincia,
			_make_default
		);
-- //// MODIFICAR DOMICILIO \\\\ --
    when ('modify') then
		update domicilios set
			calle = ifnull(_calle, calle),
			numext = ifnull(_numext, numext),
			numint = _numint,
			residencial = ifnull(_residencial, residencial),
			ciudad = ifnull(_ciudad, ciudad),
			provincia = ifnull(_provincia, provincia),
			fecha_modif = sysdate()
		where id_domicilio = uuid_to_bin(_id_domicilio) and fecha_elim is null;
-- //// BORRAR DOMICILIO \\\\\ --
    when ('delete') then
		update domicilios set
			default_select = 0,
			fecha_elim = sysdate()
		where id_domicilio = uuid_to_bin(_id_domicilio) and fecha_elim is null;
-- //// PONER NUEVO DEFAULT \\\\ --
    when ('default') then
		set id_user = (select id_usuario from domicilios where id_domicilio = uuid_to_bin(_id_domicilio));
		update domicilios set
			default_select = 0
		where id_usuario = id_user and default_select = 1;
		update domicilios set
			default_select = 1
		where id_domicilio = uuid_to_bin(_id_domicilio) and default_select = 0;
-- //// COMANDO NO VÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;

end
$$ DELIMITER ;