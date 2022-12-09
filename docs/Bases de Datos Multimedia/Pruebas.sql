-- // Super administradores
call sp_SuperAdmin('create', null, null, 'Osvldo', 'Cazares', 'Solvow', 'osvowCaz@gmail.com', 'UTn_2222');
call sp_SuperAdmin('create', null, null, 'Adriana', 'Galvan', 'Adri', 'Adrivan_gal@gmail.com', 'UTn_2222');
call sp_SuperAdmin('create', null, null, 'Jannet', 'Elizondo', 'Elianis', 'jeannete_elianis@gmail.com', 'UTn_2222');

select * from pedidos;
select * from vw_histo_pedidos;

select * from rel_carrito;
select * from cotizaciones;