-- // FILENAME: ProcCategorias.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para las categorías.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- //////////////////////////////////////
-- //// PROCEDIMIENTOS DE CATEGORÍAS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists sp_Categorias;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Categorias (
	in _proc varchar(16),
    in _id_catego varchar(36),
    in _id_creador varchar(36),
    in _nombre varchar(32),
    in _descripcion varchar(256)
)
begin

case (_proc)
-- //// CREAR CATEGORÍA //// --
	when ('create') then
		insert into categorias(
			id_catego,
			id_creador,
			nombre,
			descripcion
		)
		values (
			uuid_to_bin(uuid()),
			uuid_to_bin(_id_creador),
			_nombre,
			_descripcion
		);
-- //// MODIFICAR CATEGORÍA //// --
    when ('modify') then
		update categorias set
			nombre = ifnull(_nombre, nombre),
			descripcion = ifnull(_descripcion, descripcion),
			fecha_modif = sysdate()
		where id_catego = uuid_to_bin(_id_catego)
        and fecha_elim is null and id_autorizador is not null;
-- //// ELIMINAR CATEGORÍA //// --
    when ('delete') then
		update categorias set
			fecha_elim = sysdate()
		where id_catego = uuid_to_bin(_id_catego)
        and fecha_elim is null and id_autorizador is not null;
-- //// AUTORIZAR CATEGOÍRA \\\\ --
	when ('autho') then
		update categorias set
			id_autorizador = ifnull(uuid_to_bin(_id_creador), id_autorizador),
            fecha_autorizado = sysdate()
		where id_catego = uuid_to_bin(_id_catego)
        and fecha_elim is null and id_autorizador is null;
-- //// AUTORIZAR CATEGOÍRA \\\\ --
	when ('deny') then
		update categorias set
			id_autorizador = ifnull(uuid_to_bin(_id_creador), id_autorizador),
            fecha_elim = sysdate()
		where id_catego = uuid_to_bin(_id_catego)
        and fecha_elim is null and id_autorizador is null;
-- //// BUSCAR CATEGORÍA POR NOMBRE \\\\ --
	when ('check') then
		select
			count(*) as "result"
			from categorias
		where nombre = _nombre
        and fecha_elim is null and id_autorizador is not null;
-- /// BUSCAR POR TEXTO \\\\ --
	when ('all_cat') then
		select
			nombre as 'out_nombre'
        from categorias
        where fecha_elim is null and id_autorizador is not null;
-- /// BUSCAR POR TEXTO \\\\ --
	when ('search_text') then
		select
			bin_to_uuid(id_catego) as 'out_id',
            nombre as 'out_nombre'
		from categorias
        where nombre like concat(_nombre, '%')
        and fecha_elim is null and id_autorizador is not null
        limit 10;
-- //// OBTENER PETICIONES \\\\ --
	when ('get_toautho') then
		select
			bin_to_uuid(id_catego) as 'out_id',
            nombre as 'out_nombre',
            descripcion as 'out_descripcion'
		from categorias
		where fecha_elim is null and id_autorizador is null;
-- //// COMANDO NO VÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;
	
end
$$ DELIMITER ;