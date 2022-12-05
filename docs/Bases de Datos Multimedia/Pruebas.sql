-- // Super administradores
call sp_SuperAdmin('create', null, null, 'Osvldo', 'Cazares', 'Solvow', 'osvowCaz@gmail.com', 'UTn_2222');
call sp_SuperAdmin('create', null, null, 'Adriana', 'Galvan', 'Adri', 'Adrivan_gal@gmail.com', 'UTn_2222');
call sp_SuperAdmin('create', null, null, 'Jannet', 'Elizondo', 'Elianis', 'jeannete_elianis@gmail.com', 'UTn_2222');

call sp_Pedidos('get_histo_peds', null, "cd620106-73b6-11ed-a2bc-feed01180002", null, null, null, null, null, null);

select * from productos;
select * from super_admins;
select * from categorias;
select * from usuarios;