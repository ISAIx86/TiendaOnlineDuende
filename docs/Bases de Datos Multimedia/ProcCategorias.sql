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
		where id_catego = uuid_to_bin(_id_catego);
-- //// ELIMINAR CATEGORÍA //// --
    when ('delete') then
		update categorias set
			fecha_elim = sysdate()
		where id_catego = uuid_to_bin(_id_catego);
-- //// AUTORIZAR CATEGOÍRA \\\\ --
	when ('authorize') then
		update categorias set
			id_autorizador = ifnull(uuid_to_bin(_id_creador), id_autorizador),
            fecha_autorizador = sysdate()
		where id_catego = uuid_to_bin(_id_catego);
-- //// BUSCAR CATEGORÍA POR NOMBRE \\\\ --
	when ('check') then
		select
			count(*) as "result"
			from categorias
		where nombre = _nombre;
-- /// BUSCAR POR TEXTO \\\\ --
	when ('all_cat') then
		select
			nombre as 'out_nombre'
        from categorias;
-- /// BUSCAR POR TEXTO \\\\ --
	when ('search_text') then
		select
			bin_to_uuid(id_catego) as 'ID',
            nombre as 'Nombre'
		from categorias
        where nombre like concat(_nombre, '%')
        limit 10;
        -- //// OBTENER DATOS PARA FORMULARIO \\\\ --
	when ('get_name') then
		select
			id_catego as 'out_id',
			nombre as 'out_nombres'
			from categorias
        where fecha_elim is null
        limit 10;
-- //// COMANDO NO VÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;
	
end
$$ DELIMITER ;