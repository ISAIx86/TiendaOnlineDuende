-- // FILENAME: ProcProductos.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para los productos.

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
    in _id_catego varchar(36),
    in _titulo varchar(64),
    in _descripcion varchar(256),
    in _disponibilidad int,
    in _cotizacion boolean,
    in _precio decimal(8,2)
)
begin

declare _insert_id binary(16);

case (_proc)
-- //// REGISTRAR PRODUCTO \\\\ --
	when ('create') then
		set _insert_id = uuid_to_bin(uuid());
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
			_insert_id,
			uuid_to_bin(_id_publicador),
			_titulo,
			_descripcion,
			_disponibilidad,
			_cotizacion,
			_precio
		);
        if (row_count() != 0) then
			select bin_to_uuid(_insert_id) as 'result';
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
-- //// EXISTENCIAS \\\\ --
	when ('get_exist') then
        set @_categos = "";
        if (_descripcion is not null) then
			set @_categos = concat(' and categorias like "%', _descripcion, '%"');
		end if;
		set @_search_qry = concat(
			'select
				categorias as out_categos,
                bin_to_uuid(id_prod) as out_prodid,
                titulo as out_titulo,
				calificacion as out_calif,
				precio as out_precio,
                disponibilidad as out_dispo
			from vw_existencias
            where id_publicador = uuid_to_bin("',_id_publicador,'")',
            @_categos,';'
		);
        prepare qry from @_search_qry;
		execute qry;
-- //// SUMAR INVENTARIO \\\\ --
    when ('restock') then
		update productos set
			disponibilidad = disponibilidad + _disponibilidad
		where id_producto = uuid_to_bin(_id_producto) and fecha_elim is null;
-- //// OBTENER DISPONIBILIDAD \\\\ --
	when ('get_stock') then
		select
			disponibilidad as 'out_dispo'
		where id_producto = uuid_to_bin(_id_producto) and fecha_elim is null;
-- //// OBTENER INFORMACIÓN DE PRODUCTO \\\\ --
	when ('get_data') then
		select
			bin_to_uuid(id_producto) as 'out_id',
            titulo as 'out_titulo',
            descripcion as 'out_descripcion',
            cotizacion as 'out_cotiz',
            precio as 'out_precio',
            disponibilidad as 'out_dispo',
            calificacion as 'out_calif'
		from productos
        where id_producto = uuid_to_bin(_id_producto);
-- //// AÑADIR CATEGORIA \\\\ --
	when ('add_cat') then
		insert into rel_cat(
			id_producto,
			id_categoria
		)
		values (
			uuid_to_bin(_id_producto),
            uuid_to_bin(_id_catego)
		);
-- //// ELIMINAR TODA CATEGORIA \\\\ --
    when ('restart_cat') then
		delete from rel_cat
        where id_producto = uuid_to_bin(_id_producto);
    else
		select "invalid_command" as 'result';
end case;
    
end
$$ DELIMITER ;