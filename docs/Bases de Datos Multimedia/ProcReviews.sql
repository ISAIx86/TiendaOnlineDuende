-- // FILENAME: ProcReviews.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para las calificaciones.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- ///////////////////////////////////
-- //// PROCEDIMIENTOS DE REVIEWS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
DELIMITER $$
drop procedure if exists sp_Reviews;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Reviews (
	in _proc varchar(16),
	in _id_usuario varchar(36),
	in _id_producto varchar(36),
    in _calificacion decimal(2,1),
    in _comentario varchar(256)
)
begin

case (_proc)
-- //// REGISTRAR PRODUCTO \\\\ --
	when ('create') then
		replace into rel_review (
			id_usuario,
            id_producto,
            calificacion,
            comentario
        ) values (
			uuid_to_bin(_id_usuario),
            uuid_to_bin(_id_producto),
            _calificacion,
            _comentario
        );
-- //// OBTENER  \\\\ --
    when ('get_by_prod') then
		select
			username as 'out_username',
            avatar as 'out_img',
            calif as 'out_val',
            comentario as 'out_comment',
            fecha as 'out_fecha'
        from vw_reviews
        where id_producto = uuid_to_bin(_id_producto)
        order by fecha desc
        limit 10;
    else
		select "invalid_command" as 'result';
end case;
    
end
$$ DELIMITER ;