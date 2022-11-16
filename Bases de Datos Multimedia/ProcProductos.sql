-- // FILENAME: ProcProductos.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para los domicilios.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- /////////////////////////////////////
-- //// PROCEDIMIENTOS DE PRODUCTOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists sp_Productos;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Productos (
	in _proc varchar(16),
	in _id_producto varchar(36),
	in _id_publicador varchar(36),
    in _titulo varchar(64),
    in _descripcion varchar(256),
    in _disponibilidad int,
    in _cotizacion boolean,
    in _precio decimal(8,2)
)
begin
	
case (_proc)
-- //// REGISTRAR PRODUCTO \\\\ --
	when ('create') then
		insert into productos(
			id_producto,
			id_publicador,
			titulo,
			descripcion,
			disponibilidad,
			cotizacion,
			precio
		)
		values(
			uuid_to_bin(uuid()),
			_id_publicador,
			_titulo,
			_descripcion,
			_disponibilidad,
			_cotizacion,
			_precio
		);
        if (row_count() != 0) then
			select bin_to_uuid(last_insert_id()) as "result";
        else
			select "failed_insertion" as 'result';
        end if;
-- //// MODIFICAR PRODUCTO \\\\ --
    when ('modify') then
		update productos set
			titulo = ifnull(_titulo, titulo),
			descripcion = ifnull(_descripcion, descripcion),
			cotizacion = ifnull(_cotizacion, cotizacion),
			precio = ifnull(_precio, precio),
			fecha_modif = sysdate()
		where id_producto = uuid_to_bin(_id_producto) and fecha_elim is null;
-- //// ELIMINAR PRODUCTO \\\\ --
    when ('delete') then
		update productos set
			fecha_elim = sysdate()
		where id_producto = uuid_to_bin(_id_producto) and fecha_elim is null;
-- //// AUTORIZAR PRODUCTO \\\\ --
    when ('autho') then
		update productos set
			id_autorizador = uuid_to_bin(_id_aurorizador),
			fecha_autorizado = sysdate()
		where id_producto = uuid_to_bin(_id_producto) and fecha_elim is null;
-- //// SUMAR INVENTARIO \\\\ --
    when ('restock') then
		update productos set
			disponibilidad = disponibilidad + _disponibilidad
		where id_producto = uuid_to_bin(_id_producto) and fecha_elim is null;
    else
		select "invalid_command" as 'result';
end case;
    
end
$$ DELIMITER ;