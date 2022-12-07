-- // FILENAME: ProcCotizaciones.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para las listas.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- //////////////////////////////////
-- //// PROCEDIMIENTOS DE LISTAS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists sp_Cotizaciones;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Cotizaciones (
	in _proc varchar(16),
    in _id_cotiz varchar(36),
    in _id_publicador varchar(36),
    in _id_comprador varchar(36),
    in _id_producto varchar(36),
    in _precio decimal(8,2),
    in _cantidad int
)
begin

case (_proc)
-- //// CREAR LISTA \\\\ --
	when ('create') then
		set @_publicador = (select id_publicador from productos where id_producto = uuid_to_bin(_id_producto));
		insert into cotizaciones (
			id_cotiz,
			id_publicador,
			id_comprador,
			id_producto,
			com_precio,
			com_cantidad
		) values (
			uuid_to_bin(uuid()),
			@_publicador,
			uuid_to_bin(_id_comprador),
			uuid_to_bin(_id_producto),
			_precio,
			_cantidad
		);
-- //// MODIFICAR PRECIO OFRECIDO DEL VENDEDOR \\\\ --
    when ('set_vendor') then
		update cotizaciones set
			vend_precio = ifnull(_precio, vend_precio),
			vend_cantidad = ifnull(_cantidad, vend_cantidad),
            estado = 'O',
			fecha_modif = sysdate()
		where id_cotiz = uuid_to_bin(_id_cotiz)
        and estado != 'C';
-- //// MODIFICAR PRECIO OFRECIDO POR EL COMPRADOR \\\\ --
    when ('set_vendor') then
		update cotizaciones set
			com_precio = ifnull(_precio, com_precio),
			com_cantidad = ifnull(_cantidad, com_cantidad),
            estado = 'O',
			fecha_modif = sysdate()
		where id_cotiz = uuid_to_bin(_id_cotiz)
        and estado != 'C';
-- //// ACEPTAR COTIZACION \\\\ --
	when ('accept') then
		update cotizaciones set
			estado = 'C'
		where id_cotiz = uuid_to_bin(_id_cotiz);
		call sp_Carrito(
			'add',
            (select id_comprador from cotizaciones where id_cotiz = uuid_to_bin(_id_cotz)),
            (select id_producto from cotizaciones where id_cotiz = uuid_to_bin(_id_cotz)),
            (select vend_cantidad from cotizaciones where id_cotiz = uuid_to_bin(_id_cotz)),
            (select vend_precio from cotizaciones where id_cotiz = uuid_to_bin(_id_cotz))
		);
-- //// OBTENER LISTAS DEL USUARIO \\\\ --
	when ('get_cards_v') then
		select
			bin_to_uuid(id_cotiz) as 'out_id',
            imagen as 'out_img',
            nombre as 'out_nombre',
            descripcion as 'out_descripcion',
            privacidad as 'out_privacidad'
        from vw_cotiz_card
        where id_publicador = uuid_to_bin(id_publicador)
        and estado != 'C';
-- //// OBTENER LISTAS DEL USUARIO \\\\ --
	when ('get_cards_c') then
		select
			bin_to_uuid(id_lista) as 'out_id',
            imagen as 'out_img',
            nombre as 'out_nombre',
            descripcion as 'out_descripcion',
            privacidad as 'out_privacidad'
        from vw_cotiz_card
        where id_comprador = uuid_to_bin(_id_comprador)
        and estado != 'C';
-- //// OBTENER INFORMACION DE COTIZACION \\\\ --
	when ('get_data') then
		select
			bin_to_uuid(id_cotiz) as 'out_id',
            imagen as 'out_img',
            titulo as 'out_nombre',
            v_precio as 'out_vprecio',
            v_cantidad as 'out_vcant',
            c_precio as 'out_cprecio',
            c_cantidad as 'out_ccant'
		from vw_cotiz_info
        where id_cotiz = uuid_to_bin(_id_cotiz)
        and estado != 'C';
-- //// COMANDO NO VÁLIDO \\\\ --
	else 
		select "invalid_command" as 'result';
end case;
	
end
$$ DELIMITER ;