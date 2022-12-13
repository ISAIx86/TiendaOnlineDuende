-- // Super administradores
call sp_SuperAdmin('create', null, null, 'Osvldo', 'Cazares', 'Solvow', 'osvowCaz@gmail.com', 'UTn_2222');
call sp_SuperAdmin('create', null, null, 'Adriana', 'Galvan', 'Adri', 'Adrivan_gal@gmail.com', 'UTn_2222');
call sp_SuperAdmin('create', null, null, 'Jannet', 'Elizondo', 'Elianis', 'jeannete_elianis@gmail.com', 'UTn_2222');

select * from usuarios;

select * from pedidos;
select * from vw_histo_pedidos;

select * from rel_carrito;
select * from cotizaciones;

select
	bin_to_uuid(prods.id_producto) as 'out_id',
	multi.contenido as 'out_img',
	prods.titulo as 'out_titulo',
	prods.descripcion as 'out_descripcion',
	prods.precio as 'out_precio'
from productos as prods
left outer join multimedia as multi
on prods.id_producto = multi.id_prod
where prods.titulo like concat("C", '%') and multi.tipo = 'i'
group by prods.id_producto;