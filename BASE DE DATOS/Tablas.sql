-- // FILENAME: Tablas.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Creación de tablas para base de datos de tienda en línea.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

create database if not exists tienda_online;
use tienda_online;

-- //////////////////////
-- //// TIRAR TABLAS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\

drop table if exists usuarios;
drop table if exists domicilios;
drop table if exists listas;
drop table if exists tarjetas;
drop table if exists categorias;
drop table if exists productos;
drop table if exists pedidos;
drop table if exists multimedia;
drop table if exists super_admins;
drop table if exists rel_li_prod;
drop table if exists rel_carrito;
drop table if exists rel_cat;
drop table if exists rel_ped_prod;
drop table if exists rel_calif;
drop table if exists rel_comment;

-- ////////////////////////////
-- //// CREACION DE TABLAS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\

-- //// TABLA USUARIOS //// --
drop table if exists usuarios;
create table if not exists usuarios (
	id_usuario binary(16) comment "ID de usuario",
    
    nombres varchar(64) not null comment "Nombres del usuario",
    apellidos varchar(64) not null comment "Apellidos del usuario",
    username varchar(32) not null comment "Nickname o nombre de usuario",
    fecha_nac date not null comment "Fecha de nacimiento del usuario, para obtener dinamicamente su edad",
    sexo char not null comment "Sexo del usuario, hombre/mujer/etc.",
    privacidad boolean not null default 0 comment "Privacidad del usuario. 0 si es público, 1 si es privado",
    
    attr1 varchar(16) not null comment "Rol de usuario",
    attr2 varchar(256) not null unique comment "Correo electrónico",
    attr3 varchar(256) not null comment "Contraseña",
    
    avatar blob comment "Imagen avatar del usuario",
    avatar_dir varchar(256) comment "Ruta del recurso del avatar del usuario",
    
    autorizador binary(16) default null comment "Super administrador que autoriza al usuario administrador. Solo aplica a administradores",
    fecha_creacion timestamp not null default current_timestamp comment "Fecha de registro del usuario",
    fecha_modif timestamp default null comment "Fecha de última modificacion",
    fecha_elim timestamp default null comment "Fecha de baja del usuario",
    
    primary key (id_usuario)
);

-- //// TABLA DOMICILIOS //// --
drop table if exists domicilios;
create table if not exists domicilios (
	id_domicilio binary(16) comment "ID del domicilio",
    id_usuario binary(16) not null comment "ID del usuario residente del domicilio",
    
    calle varchar(32) not null comment "Nombre de la calle",
    numext varchar(16) not null comment "Numero de edificio o casa",
    numint varchar(16) comment "Numero de departamento. Este dato es opcional. Solo si el usuario vive en un complejo departamental",
    residencial varchar(32) not null comment "Residencial o colonia",
    ciudad varchar(32) not null comment "Ciudad o localidad",
    provincia varchar(32) not null comment "Estado o provincia",
    
    default_select boolean not null default 0 comment "Domicilio de entrega por defecto. Es la selección por defecto del usuario para recibir su pedido",
    
    fecha_creacion timestamp not null default current_timestamp comment "Fecha de registro",
    fecha_modif timestamp default null comment "Fecha de última modificacion",
    fecha_elim timestamp default null comment "Fecha de baja",
    
    primary key (id_domicilio)
);

-- //// TABLA LISTAS //// --
drop table if exists listas;
create table if not exists listas (
	id_lista binary(16) comment "ID de la lista",
    id_usuario binary(16) not null comment "ID del propietario de la lista",
    
    nombre varchar(32) comment "Nombre de la lista",
    descripcion text comment "Breve descripción del contenido de la lista",
    
    privacidad boolean not null comment "Bandera de privacidad. Si es 0, la lista es pública. Si es 1, la lista es privada",
    
    imagen blob comment "Imagen miniatura de la lista",
    imagen_dir varchar(256) comment "Ruta del recurso de imagen de la lista",
    
    fecha_creacion timestamp not null default current_timestamp comment "Fecha de registro",
    fecha_modif timestamp default null comment "Fecha de última modificacion",
    fecha_elim timestamp default null comment "Fecha de baja",
    
    primary key (id_lista)
);

-- //// TABLA TARJETAS //// --
drop table if exists tarjetas;
create table if not exists tarjetas (
	id_tarj binary(16) comment "ID de la tarjeta",
    id_usuario binary(16) not null comment "ID del propietario de la tarjeta",
    
    nombre_tar varchar(128) not null comment "Nombre completo del propietario",
    num_tarj varchar(256) not null comment "Número de tarjeta",
    cad char(4) not null comment "Caducidad de la tarjeta",
    cvv char(3) not null comment "Clave de seguridad",
    
    fecha_creacion timestamp not null default current_timestamp comment "Fecha de registro",
    fecha_modif timestamp default null comment "Fecha de última modificacion",
    
    primary key (id_tarj)
);

-- //// TABLA CATEGORÍAS //// --
drop table if exists categorias;
create table if not exists categorias (
	id_catego binary(16) comment "ID de la categoría",
    id_creador binary(16) not null comment "ID del vendedor creador de la categoría",
    
    nombre varchar(32) not null unique comment "Nombre de la categoría",
    descripcion text not null comment "Breve descripción de lo que trata la categoría",
    
    fecha_creacion timestamp not null default current_timestamp comment "Fecha de registro",
    fecha_modif timestamp default null comment "Fecha de última modificacion",
    fecha_elim timestamp default null comment "Fecha de baja",
    
    primary key (id_catego)
);

-- //// TABLA PRODUCTOS //// --
drop table if exists productos;
create table if not exists productos (
	id_producto binary(16) comment "ID del producto",
    id_publicador binary(16) not null comment "ID del vendedor publicador del producto",
    id_autorizador binary(16) comment "ID del autorizador. Si es nulo, aún no está autorizado",
    
    titulo varchar(64) not null comment "Titulo del producto",
	descripcion text not null comment "Breve descripción del producto",
    cotizacion boolean not null comment "Bandera de venta o cotización. Si es 0 es venta. Si es 1 es cotizacion",
    precio decimal(8,2) not null default 0.0 comment "Precio del producto. Si es por cotización el precio será 0.0",
    
    disponibilidad int not null comment "Unidades del producto disponibles",
    calificacion decimal (2, 1) not null default 0.0 comment "Valoración del producto por los compradores",
    
    fecha_autorizado timestamp default null comment "Fecha de autorización",
    
    fecha_creacion timestamp not null default current_timestamp comment "Fecha de registro del producto",
    fecha_modif timestamp default null comment "Fecha de última modificacion",
    fecha_elim timestamp default null comment "Fecha de baja",
    
    primary key (id_producto)
);

-- //// TABLA PEDIDOS //// --
drop table if exists pedidos;
create table if not exists pedidos (
	folio bigint unsigned auto_increment comment "Folio del pedido",
    id_usuario binary(16) not null comment "ID del usuario que hizo el pedido",
    domicilio_entr binary(16) not null comment "ID del domicilio de entrega",
    
    fecha_compra timestamp not null default current_timestamp comment "Fecha y hora de la compra",
    total decimal(8,2) not null comment "Total a pagar del pedido",
    
    primary key (folio)
);
alter table pedidos auto_increment = 146231;

-- //// TABLA MULTIMEDIA //// --
drop table if exists multimedia;
create table if not exists multimedia (
	id_mult binary(16) comment "ID del contenido multimedia",
    id_prod binary(16) not null comment "ID del producto",
    
    contenido blob not null comment "Contenido multimedia",
    contenido_dir varchar(256) not null comment "Ruta del contenido multimedia",
    
    fecha_creacion timestamp not null default current_timestamp comment "Fecha de registro del producto",
    fecha_elim timestamp default null comment "Fecha de baja",
    
    primary key (id_mult)
);

-- //// TABLA SUPER ADMINISTRADORES //// --
drop table if exists super_admins;
create table if not exists super_admins (
	id_sadmin binary(16) comment "ID del super administrador",
    
    nombres varchar(64) not null comment "Nombres del super administrador",
    apellidos varchar(64) not null comment "Apellidos del super administrador",
    username varchar(32) not null comment "Nickname o nombre de usuario",
    
    attr2 varchar(256) not null comment "Correo electrónico",
    attr3 varchar(16) not null comment "Contraseña",
    
    fecha_creacion timestamp not null default current_timestamp comment "Fecha de registro del usuario",
    fecha_modif timestamp default null comment "Fecha de última modificacion",
    fecha_elim timestamp default null comment "Fecha de baja del usuario",
    
    primary key (id_sadmin)
);

-- //// TABLA RELACIÓN LISTA PRODUCTO //// --
drop table if exists rel_li_prod;
create table if not exists rel_li_prod (
	id_lista binary(16) not null comment "ID de lista",
    id_producto binary(16) not null comment "ID del producto"
);

-- //// TABLA RELACIÓN CARRITO //// --
drop table if exists rel_carrito;
create table if not exists rel_carrito (
	id_usuario binary(16) not null comment "ID del usuario",
    id_producto binary(16) not null comment "ID del producto"
);

-- //// TABLA RELACIÓN PRODUCTO CATEGORÍA //// --
drop table if exists rel_cat;
create table if not exists rel_cat (
	id_producto binary(16) not null comment "ID del producto",
    id_categoria binary(16) not null comment "ID de categoría"
);

-- //// TABLA RELACIÓN PEDIDO PRODUCTO  //// --
drop table if exists rel_ped_prod;
create table if not exists rel_ped_prod (
	folio_pedido bigint unsigned not null comment "ID del pedido",
	id_producto binary(16) not null comment "ID del producto",
    
    subtotal decimal(8,2) not null comment "Suma de los productos",
    cantidad int not null comment "Cantidad de productos a comprar"
);

-- //// TABLA RELACIÓN CALIFICACIONES  //// --
drop table if exists rel_calif;
create table if not exists rel_calif (
	id_usuario binary(16) not null comment "ID del usuario",
	id_producto binary(16) not null comment "ID del producto",
    
    calificacion decimal (2,1) not null comment "Valoración del cliente"
);

-- //// TABLA RELACIÓN CALIFICACIONES  //// --
drop table if exists rel_comment;
create table if not exists rel_comment (
	id_usuario binary(16) not null comment "ID del usuario",
	id_producto binary(16) not null comment "ID del producto",
    
    contenido varchar(256) not null comment "Comentario del cliente",
    fecha timestamp not null default current_timestamp comment "Fecha y hora del comentario"
);