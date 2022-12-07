-- // FILENAME: ProcCarrito.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para el carrito.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- ///////////////////////////////////
-- //// PROCEDIMIENTOS DE CARRITO \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists sp_Carrito;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Carrito (
	in _proc varchar(16),
    in _id_usuario varchar(36),
    in _id_producto varchar(36),
    in _cantidad int,
    in _subcot decimal(8,2)
)
begin
case (_proc)
	-- //// AÑADIR A CARRITO \\\\ --
	when ('add') then
		if (_cantidad <= (select disponibilidad from productos where id_producto = uuid_to_bin(_id_producto))) then
			if (_subcot is not null) then
				replace into rel_carrito (
					id_usuario,
					id_producto,
					cantidad,
					subtotal
				) values (
					uuid_to_bin(_id_usuario),
					uuid_to_bin(_id_producto),
					_cantidad,
					_subcot
				);
            else
				set @_precio_prod = (select precio from productos where id_producto = uuid_to_bin(id_producto));
				replace into rel_carrito (
					id_usuario,
					id_producto,
					cantidad,
					subtotal
				) values (
					uuid_to_bin(_id_usuario),
					uuid_to_bin(_id_producto),
					_cantidad,
					@_precio_prod
				);
            end if;
        end if;
-- //// MODIFICAR CANTIDAD \\\\ --
	when ('set') then
		if (_cantidad <= (select disponibilidad from productos where id_producto = uuid_to_bin(_id_producto))) then
			update rel_carrito set
				cantidad = ifnull(_cantidad, cantidad)
			where id_usuario = uuid_to_bin(_id_usuario) and
				  id_producto = uuid_to_bin(_id_producto);
		end if;
-- //// QUITAR PRODUCTO DEL CARRITO \\\\ --
	when ('pop') then
		delete from rel_carrito
        where id_usuario = uuid_to_bin(_id_usuario) and
			  id_producto = uuid_to_bin(_id_producto);
-- //// LIMPIAR CARRITO \\\\ --
	when ('clean') then
		delete from rel_carrito
        where id_usuario = uuid_to_bin(_id_usuario);
-- //// PRODUCTOS DEL CARRITO \\\\ --
	when ('get') then
		select
			bin_to_uuid(id_producto) as 'out_id',
            imagen as 'out_img',
            titulo as 'out_titulo',
            subtotal as 'out_precio',
            cantidad as 'out_cantidad',
            disponibilidad as 'out_dispo',
            total as 'out_total'
        from vw_carrito
        where id_usuario = uuid_to_bin(_id_usuario);
-- //// SUMA TOTAL DEL CARRITO \\\\ --
	when ('get_tot') then
		select fn_totalCarrito(uuid_to_bin(_id_usuario)) as 'out_total';
    else
		select "invalid_command" as 'result';
end case;

end
$$ DELIMITER ;