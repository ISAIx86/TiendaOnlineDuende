-- // FILENAME: ProcTarjetas.sql
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
drop procedure if exists sp_Tarjetas;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Tarjetas (
	in proc varchar(16),
	in _id_tarj varchar(36),
	in _id_usuario varchar(36),
    in _nombre_tarj varchar(128),
    in _num_tarj varchar(256),
    in _cad char(4),
    in _cvv char(3)
)
begin

case (_proc)
-- //// NUEVA TARJETA \\\\ --
	when ('create') then
		insert into tarjetas (
			id_tarj,
			id_usuario,
			nombre_tarj,
			num_tarj,
			cad,
			cvv,
			fecha_creacion
		) values(
			uuid_to_bin(uuid()),
			uuid_to_bin(_id_usuario),
			_nombre_tarj,
			_num_tarj,
			_cad,
			_cvv,
			sysdate()
		);
-- //// MODIFICAR TARJETA \\\\ --
    when ('modify') then
		update tarjetas set
			nombre_tarj = ifnull(_nombre_tarj, nombre_tarj),
			num_tarj = ifnull(_num_tarj, num_tarj),
			cad = ifnull(_cad, cad),
			cvv = ifnull(cvv, cvv)
		where id_tarj = uuid_to_bin(_id_tarj);
-- //// ELIMINAR TARJETA \\\\ --
    when ('delete') then
		delete from tarjetas where id_tarj = uuid_to_bin(_id_tarj);
-- //// COMANDO INVÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;

end
$$ DELIMITER ;