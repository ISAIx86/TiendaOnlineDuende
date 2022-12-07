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
    in _cantidad int,
    in _aceptado boolean
)
begin

case (_proc)
-- //// CREAR LISTA \\\\ --
	when ('create') then
		insert into cotizaciones (
			id_cotiz,
			id_publicador,
			id_comprador,
			id_producto,
			precio,
			cantidad
		) values (
			uuid_to_bin(uuid()),
			uuid_to_bin(_id_publicador),
			uuid_to_bin(_id_comprador),
			uuid_to_bin(_id_producto),
			_precio,
			_cantidad
		);
-- //// MODIFICAR LISTA \\\\ --
    when ('modify') then
		update listas set
			nombre = ifnull(_nombre, nombre),
			descripcion = ifnull(_descripcion, descripcion),
			privacidad = ifnull(_privacidad, privacidad),
			imagen = ifnull(_imagen, imagen),
			imagen_dir = ifnull(_imagen_dir, imagen_dir),
			fecha_modif = sysdate()
		where id_lista = uuid_to_bin(_id_lista)
        and fecha_elim is null and id_usuario = uuid_to_bin(_id_usuario);
-- //// ELIMINAR LISTA \\\\ --
    when ('delete') then
		update listas set
			fecha_elim = sysdate()
		where id_lista = uuid_to_bin(_id_lista)
        and fecha_elim is null and id_usuario = uuid_to_bin(_id_usuario);
-- //// OBTENER LISTAS DEL USUARIO \\\\ --
	when ('get_cards') then
		select
			bin_to_uuid(id_lista) as 'out_id',
            imagen as 'out_img',
            nombre as 'out_nombre',
            descripcion as 'out_descripcion',
            privacidad as 'out_privacidad'
        from listas
        where id_usuario = uuid_to_bin(_id_usuario)
        and fecha_elim is null;
-- //// OBTENER VISTA DE LISTAS USUARIO \\\\ --
	when ('get_cards_user') then
		select
			bin_to_uuid(id_lista) as 'out_id',
            imagen as 'out_img',
            nombre as 'out_nombre',
            descripcion as 'out_descripcion'
        from listas
        where id_usuario = uuid_to_bin(id_usuario)
        and privacidad = 0
        and fecha_elim is null;
-- //// OBTENER INFORMACIÓN DE LISTA \\\\ --
	when ('get_data') then
		select
			bin_to_uuid(id_lista) as 'out_id',
            imagen as 'out_img',
            nombre as 'out_nombre',
            descripcion as 'out_descripcion',
            privacidad as 'out_privacidad'
		from listas
        where id_lista = uuid_to_bin(_id_lista)
        and id_usuario = uuid_to_bin(_id_usuario)
        and fecha_elim is null;
-- //// OBTENER LISTA \\\\ --
	when ('get_items') then
		select
			bin_to_uuid(id_producto) as 'out_id',
            imagen as 'out_img',
            titulo as 'out_titulo',
            cotizacion as 'out_cotiz',
            precio as 'out_precio',
            disponibilidad as 'out_disponibilidad',
            calificacion as 'out_calif'
        from vw_lista
        where id_lista = uuid_to_bin(_id_lista);
-- //// COMANDO NO VÁLIDO \\\\ --
	else 
		select "invalid_command" as 'result';
end case;
	
end
$$ DELIMITER ;