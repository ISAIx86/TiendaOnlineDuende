-- // FILENAME: ProcBusquedaProds.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para los productos.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- ////////////////////////////////
-- //// BUSQUEDAS DE PRODUCTOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
DELIMITER $$
drop procedure if exists sp_BusquedaProd;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_BusquedaProd (
	in _proc varchar(16),
    in _titulo varchar(64),
    in _order_by text,
    in _catego_filter text,
    in _page int,
    in _size int
)
begin

case (_proc)
-- //// VISTA HOME MÁS VENDIDOS \\\\ --
	when ('get_vendidos') then
		select
            bin_to_uuid(p.id_producto) as 'out_id',
            m.contenido as 'out_img',
            p.titulo as 'out_titulo',
            p.descripcion as 'out_descripcion',
            p.precio as 'out_precio'
        from productos as p
        left outer join multimedia as m
        on m.id_prod = p.id_producto
        where m.tipo = 'i'
        group by p.id_producto
        order by fn_ventasProductos(id_producto) desc
        limit 10;
-- //// VISTA HOME MÁS VISITADOS \\\\\ --
	when ('get_vistos') then
		select
			bin_to_uuid(p.id_producto) as 'out_id',
            m.contenido as 'out_img',
            p.titulo as 'out_titulo',
            p.descripcion as 'out_descripcion',
            p.precio as 'out_precio'
        from productos as p
        left outer join multimedia as m
        on m.id_prod = p.id_producto
        where m.tipo = 'i'
        group by p.id_producto
        order by vistas desc
        limit 10;
-- //// VISTA HOME MÁS RECOMENDADOS \\\\\ --
    when ('get_recomend') then
		select
			bin_to_uuid(p.id_producto) as 'out_id',
            m.contenido as 'out_img',
            p.titulo as 'out_titulo',
            p.descripcion as 'out_descripcion',
            p.precio as 'out_precio'
        from productos as p
        left outer join multimedia as m
        on m.id_prod = p.id_producto
        where m.tipo = 'i'
        group by p.id_producto
        order by calificacion desc
        limit 10;
-- //// BÚSQUEDA AVANZADA \\\\\ --
	when ('adv_search') then
		set @pagem = ((_page - 1) * _size);
		set @_search_qry = concat(
			"select
				bin_to_uuid(id_producto) as 'out_id',
				titulo as 'out_titulo',
				descripcion as 'out_descripcion',
				precio as 'out_precio'
			from productos
            where titulo like concat(",_titulo,", '%')
            order by ",_order_by,"
            limit ",@pagem,", ",_size,";"
		);
		prepare qry from @_search_qry;
		execute qry;
	else
		select "invalid_command" as 'result';
end case;
	
end;
$$ DELIMITER ;