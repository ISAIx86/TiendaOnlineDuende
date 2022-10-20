-- // FILENAME: LlavesForáneas.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Creación de llaves foráneas.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- /////////////////////////
-- //// LLÁVES FORÁNEAS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\

-- //// LLAVES DE USUARIOS //// --
alter table usuarios

add
	index fk_sadm_usu_idx (autorizador asc) visible,
add
	constraint fk_sadm_usu
	foreign key (autorizador)
	references super_admins (id_sadmin)
	on delete no action
	on update no action;
    
-- //// LLAVES DE DOMICILIOS //// --
alter table domicilios

add
	index fk_dom_usu_idx (id_usuario asc) visible,
add
	constraint fk_dom_usu
	foreign key (id_usuario)
	references usuarios (id_usuario)
	on delete no action
	on update no action;
    
-- //// LLAVES DE LISTAS //// --
alter table listas

add
	index fk_lis_usu_idx (id_usuario asc) visible,
add
	constraint fk_lis_usu
	foreign key (id_usuario)
	references usuarios (id_usuario)
	on delete no action
	on update no action;
    
-- //// LLAVES DE TARJETA //// --
alter table tarjetas

add
	index fk_tar_usu_idx (id_usuario asc) visible,
add
	constraint fk_tar_usu
	foreign key (id_usuario)
	references usuarios (id_usuario)
	on delete no action
	on update no action;
    
-- //// LLAVES DE CATEGORÍAS //// --
alter table categorias

add
	index fk_cat_usu_idx (id_creador asc) visible,
add
	constraint fk_cat_usu
	foreign key (id_creador)
	references usuarios (id_usuario)
	on delete no action
	on update no action;
    
-- //// LLAVES DE PRODUCTOS //// --
alter table productos

add
	index fk_prod_publi_idx (id_publicador asc) visible,
add
	constraint fk_prod_publi
	foreign key (id_publicador)
	references usuarios (id_usuario)
	on delete no action
	on update no action,
    
add
	index fk_prod_auto_idx (id_autorizador asc) visible,
add
	constraint fk_prod_auto
	foreign key (id_autorizador)
	references usuarios (id_usuario)
	on delete no action
	on update no action;
    
-- //// LLAVES DE PEDIDOS //// --
alter table pedidos

add
	index fk_ped_usu_idx (id_usuario asc) visible,
add
	constraint fk_ped_usu
	foreign key (id_usuario)
	references usuarios (id_usuario)
	on delete no action
	on update no action,
    
add
	index fk_ped_dom_idx (domicilio_entr asc) visible,
add
	constraint fk_ped_dom
	foreign key (domicilio_entr)
	references domicilios (id_domicilio)
	on delete no action
	on update no action;
    
-- //// LLAVES DE MULTIMEDIA //// --
alter table multimedia

add
	index fk_mult_prod_idx (id_prod asc) visible,
add
	constraint fk_mult_prod
	foreign key (id_prod)
	references productos (id_producto)
	on delete no action
	on update no action;
    
-- /// LLAVES RELACIÓN LISTA PRODUCTO /// --
alter table rel_li_prod

add
	index fk_rlp_lista_idx (id_lista asc) visible,
add
	constraint fk_rlp_lista
	foreign key (id_lista)
	references listas (id_lista)
	on delete no action
	on update no action,

add
	index fk_rlp_prod_idx (id_producto asc) visible,
add
	constraint fk_rlp_prod
	foreign key (id_producto)
	references productos (id_producto)
	on delete no action
	on update no action;
    
-- /// LLAVES RELACIÓN CARRITO /// --
alter table rel_carrito

add
	index fk_carr_usu_idx (id_usuario asc) visible,
add
	constraint fk_carr_usu
	foreign key (id_usuario)
	references usuarios (id_usuario)
	on delete no action
	on update no action,
    
add
	index fk_carr_prod_idx (id_producto asc) visible,
add
	constraint fk_carr_prod
	foreign key (id_producto)
	references productos (id_producto)
	on delete no action
	on update no action;
    
-- /// LLAVES RELACIÓN CATEGORÍAS /// --
alter table rel_cat

add
	index fk_cat_prod_idx (id_producto asc) visible,
add
	constraint fk_cat_prod
	foreign key (id_producto)
	references productos (id_producto)
	on delete no action
	on update no action,
    
add
	index fk_cat_catego_idx (id_categoria asc) visible,
add
	constraint fk_cat_catego
	foreign key (id_categoria)
	references categorias (id_catego)
	on delete no action
	on update no action;
    
-- /// LLAVES RELACIÓN PEDIDOS PRODUCTOS /// --
alter table rel_ped_prod

add
	index fk_rpp_ped_idx (folio_pedido asc) visible,
add
	constraint fk_rpp_ped
	foreign key (folio_pedido)
	references pedidos (folio)
	on delete no action
	on update no action,
    
add
	index fk_rpp_prod_idx (id_producto asc) visible,
add
	constraint fk_rpp_prod
	foreign key (id_producto)
	references productos (id_producto)
	on delete no action
	on update no action;
    
-- /// LLAVES RELACIÓN CALIFICACIONES /// --
alter table rel_calif

add
	index fk_calif_usu_idx (id_usuario asc) visible,
add
	constraint fk_calif_usu
	foreign key (id_usuario)
	references usuarios (id_usuario)
	on delete no action
	on update no action,
    
add
	index fk_calif_prod_idx (id_producto asc) visible,
add
	constraint fk_calif_prod
	foreign key (id_producto)
	references productos (id_producto)
	on delete no action
	on update no action;
    
-- /// LLAVES RELACIÓN COMENTARIOS /// --
alter table rel_comment

add
	index fk_comment_usu_idx (id_usuario asc) visible,
add
	constraint fk_comment_usu
	foreign key (id_usuario)
	references usuarios (id_usuario)
	on delete no action
	on update no action,
    
add
	index fk_comment_prod_idx (id_producto asc) visible,
add
	constraint fk_comment_prod
	foreign key (id_producto)
	references productos (id_producto)
	on delete no action
	on update no action;