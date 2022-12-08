-- // Super administradores
call sp_SuperAdmin('create', null, null, 'Osvldo', 'Cazares', 'Solvow', 'osvowCaz@gmail.com', 'UTn_2222');
call sp_SuperAdmin('create', null, null, 'Adriana', 'Galvan', 'Adri', 'Adrivan_gal@gmail.com', 'UTn_2222');
call sp_SuperAdmin('create', null, null, 'Jannet', 'Elizondo', 'Elianis', 'jeannete_elianis@gmail.com', 'UTn_2222');

call sp_Pedidos('get_histo_peds', null, "cd620106-73b6-11ed-a2bc-feed01180002", null, null, null, null, null, null);

select * from productos;
select * from super_admins;
select * from categorias;
select * from usuarios;
select * from cotizaciones;

select bin_to_uuid(id_usuario), username from usuarios;

select 
	bin_to_uuid(id_publicador),
    bin_to_uuid(id_comprador),
    bin_to_uuid(id_producto),
    estado
from cotizaciones;

select
	bin_to_uuid(id_cotiz) as 'out_id',
	comp_avatar as 'out_cavatar',
	comp_username as 'out_cuser',
	imagen as 'out_img',
	titulo as 'out_titulo',
	cantidad as 'out_cantidad',
	fecha_modif as 'out_fechamod'
from vw_cotiz_card;

select * from rel_li_prod;

select * from listas;