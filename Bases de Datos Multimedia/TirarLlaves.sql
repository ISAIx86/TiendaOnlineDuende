-- // FILENAME: TirarLlaves.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Creación de llaves foráneas.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

-- ///////////////////////////////
-- //// TIRAR LLÁVES FORÁNEAS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

-- //// LLAVES DE USUARIOS //// --
alter table usuarios
drop
	index fk_sadm_usu_idx,
drop
	constraint fk_sadm_usu;
    
-- //// LLAVES DE DOMICILIOS //// --
alter table domicilios
drop
	index fk_dom_usu_idx,
drop
	constraint fk_dom_usu;
    
-- //// LLAVES DE LISTAS //// --
alter table listas
drop
	index fk_lis_usu_idx,
drop
	constraint fk_lis_usu;

-- //// LLAVES DE TARJETAS //// --
alter table tarjetas
drop
	index fk_tar_usu_idx,
drop
	constraint fk_tar_usu;
    
-- //// LLAVES DE CATEGORÍAS //// --
alter table categorias
drop
	index fk_cat_usu_idx,
drop
	constraint fk_cat_usu;
    
-- //// LLAVES DE PRODUCTOS //// --
alter table	productos
drop
	index fk_prod_publi_idx,
drop
	constraint fk_prod_publi,
    
drop
	index fk_prod_auto_idx,
drop
	constraint fk_prod_auto;
    
-- //// LLAVES DE PEEDIDOS //// --
alter table pedidos
drop
	index fk_ped_usu_idx,
drop
	constraint fk_ped_usu,
    
drop
	index fk_ped_dom_idx,
drop
	constraint fk_ped_dom;
    
-- //// LLAVES DE MULTIMEDIA //// --
alter table multimedia
drop
	index fk_mult_prod_idx,
drop
	constraint fk_mult_prod;
    
-- /// LLAVES RELACIÓN LISTA PRODUCTO /// --
alter table rel_li_prod
drop
	index fk_rlp_lista_idx,
drop
	constraint fk_rlp_lista,
    
drop
	index fk_rlp_prod_idx,
drop
	constraint fk_rlp_prod;
    
-- /// LLAVES RELACIÓN CARRITO /// --
alter table rel_carrito
drop
	index fk_carr_usu_idx,
drop
	constraint fk_carr_usu,
    
drop
	index fk_carr_prod_idx,
drop
	constraint fk_carr_prod;
    
-- /// LLAVES RELACIÓN CATEGORÍAS /// --
alter table rel_cat
drop
	index fk_cat_prod_idx,
drop
	constraint fk_cat_prod,
    
drop
	index fk_cat_catego_idx,
drop
	constraint fk_cat_catego;
    
-- /// LLAVES RELACIÓN PEDIDOS PRODUCTOS /// --
alter table rel_ped_prod
drop
	index fk_rpp_ped_idx,
drop
	constraint fk_rpp_ped,
    
drop
	index fk_rpp_prod_idx,
drop
	constraint fk_rpp_prod;
    
-- /// LLAVES RELACIÓN CALIFICACIONES /// --
alter table rel_calif
drop
	index fk_calif_usu_idx,
drop
	constraint fk_calif_usu,
    
drop
	index fk_calif_prod_idx,
drop
	constraint fk_calif_prod;
    
-- /// LLAVES RELACIÓN COMENTARIOS /// --
alter table rel_comment
drop
	index fk_comment_usu_idx,
drop
	constraint fk_comment_usu,
    
drop
	index fk_comment_prod_idx,
drop
	constraint fk_comment_prod;