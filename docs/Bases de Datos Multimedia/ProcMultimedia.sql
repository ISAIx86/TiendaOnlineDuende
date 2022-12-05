-- // FILENAME: ProcMultimedia.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para Multimedia.

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
drop procedure if exists sp_Multimedia;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Multimedia (
	in _proc varchar(16),
    in _id_mult varchar(36),
    in _id_prod varchar(36),
    in _contenido mediumblob,
    in _contenido_dir varchar(256),
    in _tipo char(1)
)
begin
case (_proc)
-- //// CREAR NUEVO CONTENIDO MULTIMEDIA \\\\ --
	when ('create') then
		insert into multimedia(
			id_mult,
            id_prod,
            contenido,
            contenido_dir,
            tipo
        ) values (
			uuid_to_bin(uuid()),
            uuid_to_bin(_id_prod),
            _contenido,
            _contenido_dir,
            _tipo
        );
-- //// OBTENER TODOS LOS ARCHIVOS DE PRODUCTO \\\\ --
	when ('get_files') then
		select
			contenido as 'out_cont',
            contenido_dir as 'out_dir',
            tipo as 'out_tipo'
		from multimedia
        where id_prod = uuid_to_bin(_id_prod)
        and fecha_elim is null;
-- //// OBTENER UNA IMAGEN DEL PRODCUTO \\\\ --
	when ('get_img') then
		select
			contenido as 'out_cont',
            contenido_dir as 'out_dir',
            tipo as 'out_tipo'
		from multimedia
        where id_prod = uuid_to_bin(_id_prod) and tipo = 'i'
        and fecha_elim is null
        limit 1;
-- //// ELIMINAR ARCHIVOS DE PRODUCTO \\\\ --
	when ('clean_files') then
		update multimedia set
			fecha_elim = sysdate()
		where id_prod = uuid_to_bin(_id_prod)
        and fecha_elim is null;
-- //// COMANDO NO VÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;

end
$$ DELIMITER ;