-- // FILENAME: ProcPedidos.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para Pedidos.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- ///////////////////////////////////
-- //// PROCEDIMIENTOS DE PEDIDOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
DELIMITER $$
drop procedure if exists sp_Pedidos;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Pedidos (
	in _proc varchar(16),
    in _folio bigint,
    in _id_usuario varchar(36),
    in _domicilio_entr varchar(36),
    in _id_producto varchar(36),
    in _cantidad int,
    in _categos varchar(256),
    in _init_date timestamp,
    in _final_date timestamp
)
begin
declare _precio decimal(8,2);
case (_proc)
-- //// CREAR NUEVO PEDIDO \\\\ --
	when ('create') then
		insert into pedidos(
			id_usuario,
            domicilio_entr,
            total
        ) values (
			uuid_to_bin(_id_usuario),
            uuid_to_bin(_domicilio_entr),
            fn_totalCarrito(uuid_to_bin(_id_usuario))
        );
        if (row_count() != 0) then
			select last_insert_id() as 'result';
        else
			select "failed_insertion" as 'result';
        end if;
-- //// AÑADIR PRODUCTO AL PEDIDO \\\\ --
	when ('add_prod') then
		select
			subtotal into _precio
		from rel_carrito
		where id_producto = uuid_to_bin(_id_producto);
		insert into rel_ped_prod(
			folio_pedido,
            id_producto,
            cantidad,
            precio,
            subtotal
        ) values (
			_folio,
            uuid_to_bin(_id_producto),
            _cantidad,
            _precio,
            _precio * _cantidad
        );
-- //// CHECAR PRODUCTO \\\\ --
	when ('checkP') then
		select
			count(*) as "result"
		from productos
        where id_producto = uuid_to_bin(_id_producto);
-- //// CHECAR EXISTENCIA \\\\ --
	when ('checkEx') then
		select
			disponibilidad as "result"
		from productos
        where id_producto = uuid_to_bin(_id_producto);
-- //// OBTENER HISTORIAL DE PEDIDOS \\\\ --
	when ('get_histo_peds') then
		set @_start_date = "";
        set @_end_date = "";
        set @_categos = "";
        if (_categos is not null) then
			set @_categos = concat(' and categoria like "%', _categos, '%"');
		end if;
        if (_init_date is not null) then
			set @_start_date = concat(' and fecha_compra >= ', '"', _init_date, '"');
		end if;
        if (_final_date is not null) then
			set @_end_date = concat(' and fecha_compra <= ', '"', _final_date, '"');
		end if;
		set @_search_qry = concat(
			'select
				folio as out_folio,
                imagen as out_img,
				fecha_compra as out_fecha,
				categoria as out_catego,
				producto as out_prod,
				calificacion as out_calif,
				precio as out_precio,
                cantidad as out_cant,
                subtotal as out_total
			from vw_histo_pedidos
            where id_usuario = uuid_to_bin("',_id_usuario,'")',
            @_categos, @_start_date, @_end_date,
            'order by fecha_compra desc;'
		);
        prepare qry from @_search_qry;
		execute qry;
-- //// OBTENER HISTORIAL DE PEDIDOS \\\\ --
	when ('get_v_detail') then
		set @_start_date = "";
        set @_end_date = "";
        set @_categos = "";
        if (_categos is not null) then
			set @_categos = concat(' and categorias like "%', _categos, '%"');
		end if;
        if (_init_date is not null) then
			set @_start_date = concat(' and fecha_compra >= ', '"', _init_date, '"');
		end if;
        if (_final_date is not null) then
			set @_end_date = concat(' and fecha_compra <= ', '"', _final_date, '"');
		end if;
		set @_search_qry = concat(
			'select
				fecha_compra as out_fecha,
				categorias as out_catego,
				producto as out_prod,
				calificacion as out_calif,
				precio as out_precio,
                disponibilidad as out_dispo
			from vw_ventas_detallada
            where id_publicador = uuid_to_bin("',_id_usuario,'")',
            @_categos, @_start_date, @_end_date,
            'order by fecha_compra desc;'
		);
        prepare qry from @_search_qry;
		execute qry;
-- //// OBTENER HISTORIAL DE PEDIDOS \\\\ --
	when ('get_v_group') then
		set @_start_date = "";
        set @_end_date = "";
        set @_categos = "";
        if (_categos is not null) then
			set @_categos = concat(' and categorias like "%', _categos, '%"');
		end if;
        if (_init_date is not null) then
			set @_start_date = concat(' and fecha_compra >= ', '"', _init_date, '"');
		end if;
        if (_final_date is not null) then
			set @_end_date = concat(' and fecha_compra <= ', '"', _final_date, '"');
		end if;
		set @_search_qry = concat(
			'select
				month as out_month,
                year as out_year,
				categorias as out_catego,
				ventas as out_ventas
			from vw_ventas_agrupada
            where id_publicador = uuid_to_bin("',_id_usuario,'")',
            @_categos, @_start_date, @_end_date,
            'order by month, year desc;'
		);
        prepare qry from @_search_qry;
		execute qry;
-- //// COMANDO NO VÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;
end
$$ DELIMITER ;