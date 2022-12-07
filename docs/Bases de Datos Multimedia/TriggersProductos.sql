-- // FILENAME: TriggersProductos.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Vistas para Usuarios.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

drop trigger if exists tr_productoCompra;
drop trigger if exists tr_promedioCalif;
drop trigger if exists tr_changePrice;

DELIMITER $$
create trigger tr_productoCompra
after insert on rel_ped_prod
for each row
begin
	update productos set
		disponibilidad = disponibilidad - new.cantidad
	where id_producto = new.id_producto;
end;
$$ DELIMITER ;

DELIMITER $$
create trigger tr_promedioCalif
after insert on rel_review
for each row
begin
	declare _reviews int;
    declare _total_calif decimal;
    select count(*) into _reviews from rel_review where id_producto = new.id_producto;
    select sum(calificacion) into _total_calif from rel_review where id_producto = new.id_producto group by id_producto;
	update productos set
		calificacion = (_total_calif / _reviews)
	where id_producto = new.id_producto;
end;
$$ DELIMITER ;

DELIMITER $$
create trigger tr_changePrice
after update on productos
for each row
begin
	if (old.cotizacion != new.cotizacion and new.cotizacion = true) then
		delete from rel_carrito where id_producto = new.id_producto;
	else
		update rel_carrito set
			subtotal = new.precio
		where id_producto = new.id_producto;
    end if;
end;
$$ DELIMITER ;