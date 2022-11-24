-- // FILENAME: Pruebas.sql

select
	bin_to_uuid(id_usuario),
    folio,
    imagen,
    fecha_compra,
    categoria,
    producto,
    calificacion,
    precio
from vw_histo_pedidos;

select * from categorias;

select * from rel_ped_prod;

select * from vw_prod_categos;

select * from vw_ventas_detallada;
select * from vw_ventas_agrupada;

call sp_Pedidos('get_histo_peds', null, '96c255a7-5b1a-11ed-be92-9829a665462f', null, null, null, null, null, null);