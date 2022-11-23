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
    
    avatar longblob comment "Imagen avatar del usuario",
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
    id_autorizador binary(16) comment "ID del administrador que aprueba la categoría",
    
    nombre varchar(32) not null unique comment "Nombre de la categoría",
    descripcion text not null comment "Breve descripción de lo que trata la categoría",
    
    fecha_autorizado timestamp default null comment "Fecha de autorización",
    
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

-- //// TABLA COTIZACIONES //// --
drop table if exists cotizaciones;
create table if not exists cotizaciones (
	id_cotiz binary(16) not null comment "ID del registro de cotizacion",

	id_publicador binary(16) not null comment "ID del vendedor",
    id_comprador binary(16) not null comment "ID del comprador",
	id_producto binary(16) not null comment "ID del producto",
    
    precio decimal(8,2) not null comment "Oferta de precio por el producto",
    cantidad int not null comment "Cantidad de productos a comprar",
    aprovado boolean comment "Cotización aprovada por el vendedor. 0 si no fue aprovada, 1 si fue aprovada",
    aceptado boolean comment "Cotización aceptada por el comprado. 0 si no fue aceptada, 1 si fue aceptada",
    
    fecha_creacion timestamp not null default current_timestamp comment "Fecha de registro del cotizacion",
    
    primary key(id_cotiz)
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
    
    precio decimal(8,2) not null comment "Precio unitario del producto",
    subtotal decimal(8,2) not null comment "Suma de los productos",
    cantidad int not null comment "Cantidad de productos a comprar"
);

-- //// TABLA RELACIÓN CALIFICACIONES  //// --
drop table if exists rel_review;
create table if not exists rel_review (
	id_usuario binary(16) not null comment "ID del usuario",
	id_producto binary(16) not null comment "ID del producto",
    
    calificacion decimal (2,1) not null comment "Valoración del cliente",
    comentario varchar(256) not null comment "Comentario del cliente",
    fecha timestamp not null default current_timestamp comment "Fecha y hora del comentario"
);


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
-- //// COMANDO NO VÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;
	
end
$$ DELIMITER ;
-- // FILENAME: ProcDomicilios.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para los domicilios.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- //////////////////////////////////////
-- //// PROCEDIMIENTOS DE DOMICILIOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists sp_Domicilios;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Domicilios (
	in _proc varchar(16),
	in _id_domicilio varchar(36),
	in _id_usuario varchar(36),
    in _calle varchar(32),
    in _numext varchar(16),
    in _numint varchar(16),
    in _residencial varchar(32),
    in _ciudad varchar(32),
    in _provincia varchar(32),
    in _make_default boolean
)
begin

declare id_user binary(16);

case (_proc)
-- //// CREAR DOMICILIO \\\\ --
	when ('create') then
		if (_make_default) then
			update domicilios set
				default_select = 0
			where id_usuario = uuid_to_bin(_id_usuario) and default_select = 1;
		end if;
		insert into domicilios (
			id_domicilio,
			id_usuario,
			calle,
			numext,
			numint,
			residencial,
			ciudad,
			provincia,
			default_select
		) values (
			uuid_to_bin(uuid()),
			uuid_to_bin(_id_usuario),
			_calle,
			_numext,
			_numint,
			_residencial,
			_ciudad,
			_provincia,
			_make_default
		);
-- //// MODIFICAR DOMICILIO \\\\ --
    when ('modify') then
		update domicilios set
			calle = ifnull(_calle, calle),
			numext = ifnull(_numext, numext),
			numint = _numint,
			residencial = ifnull(_residencial, residencial),
			ciudad = ifnull(_ciudad, ciudad),
			provincia = ifnull(_provincia, provincia),
			fecha_modif = sysdate()
		where id_domicilio = uuid_to_bin(_id_domicilio) and fecha_elim is null;
-- //// BORRAR DOMICILIO \\\\\ --
    when ('delete') then
		update domicilios set
			default_select = 0,
			fecha_elim = sysdate()
		where id_domicilio = uuid_to_bin(_id_domicilio) and fecha_elim is null;
-- //// PONER NUEVO DEFAULT \\\\ --
    when ('default') then
		set id_user = (select id_usuario from domicilios where id_domicilio = uuid_to_bin(_id_domicilio));
		update domicilios set
			default_select = 0
		where id_usuario = id_user and default_select = 1;
		update domicilios set
			default_select = 1
		where id_domicilio = uuid_to_bin(_id_domicilio) and default_select = 0;
-- //// COMANDO NO VÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;

end
$$ DELIMITER ;
-- // FILENAME: ProcListas.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para las listas.

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
drop procedure if exists sp_Listas;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Listas (
	in _proc varchar(16),
    in _id_lista varchar(36),
	in _id_usuario varchar(36),
    in _nombre varchar(32),
    in _descripcion varchar(256),
    in _privacidad boolean,
    in _imagen blob,
    in _imagen_dir varchar(256)
)
begin

case (_proc)
-- //// CREAR LISTA \\\\ --
	when ('create') then
		insert into listas (
			id_lista,
			id_usuario,
			nombre,
			descripcion,
			privacidad,
			imagen,
			imagen_dir
		) values (
			uuid_to_bin(uuid()),
			uuid_to_bin(_id_usuario),
			_nombre,
			_descripcion,
			_privacidad,
			_imagen,
			_imagen_dir
		);
-- //// MODIFICAR LISTA \\\\ --
    when ('modify') then
		update listas set
			nombre = ifnull(_nombre, nombre),
			descripcion = ifnull(_descripcion, descripcion),
			privacidad = ifnull(_privacidad, privacidad),
			imagen = ifnull(_imagen, imagen),
			imagen_dir = ifnull(_imagen_dir, imagen_dir),
			fecha_modif = sysdate()
		where id_lista = uuid_to_bin(_id_lista);
-- //// ELIMINAR LISTA \\\\ --
    when ('delete') then
		update listas set
			fecha_elim = sysdate()
		where id_lista = uuid_to_bin(_id_lista);
-- //// COMANDO NO VÁLIDO \\\\ --
	else 
		select "invalid_command" as 'result';
end case;
	
end
$$ DELIMITER ;
-- // FILENAME: ProcProductos.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para los domicilios.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- /////////////////////////////////////
-- //// PROCEDIMIENTOS DE PRODUCTOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists sp_Productos;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Productos (
	in _proc varchar(16),
	in _id_producto varchar(36),
	in _id_publicador varchar(36),
    in _titulo varchar(64),
    in _descripcion varchar(256),
    in _disponibilidad int,
    in _cotizacion boolean,
    in _precio decimal(8,2)
)
begin
	
case (_proc)
-- //// REGISTRAR PRODUCTO \\\\ --
	when ('create') then
		insert into productos(
			id_producto,
			id_publicador,
			titulo,
			descripcion,
			disponibilidad,
			cotizacion,
			precio
		)
		values(
			uuid_to_bin(uuid()),
			_id_publicador,
			_titulo,
			_descripcion,
			_disponibilidad,
			_cotizacion,
			_precio
		);
-- //// MODIFICAR PRODUCTO \\\\ --
    when ('modify') then
		update productos set
			titulo = ifnull(_titulo, titulo),
			descripcion = ifnull(_descripcion, descripcion),
			cotizacion = ifnull(_cotizacion, cotizacion),
			precio = ifnull(_precio, precio),
			fecha_modif = sysdate()
		where id_producto = uuid_to_bin(_id_producto) and fecha_elim is null;
-- //// ELIMINAR PRODUCTO \\\\ --
    when ('delete') then
		update productos set
			fecha_elim = sysdate()
		where id_producto = uuid_to_bin(_id_producto) and fecha_elim is null;
-- //// AUTORIZAR PRODUCTO \\\\ --
    when ('autho') then
		update productos set
			id_autorizador = uuid_to_bin(_id_aurorizador),
			fecha_autorizado = sysdate()
		where id_producto = uuid_to_bin(_id_producto) and fecha_elim is null;
-- //// SUMAR INVENTARIO \\\\ --
    when ('restock') then
		update productos set
			disponibilidad = disponibilidad + _disponibilidad
		where id_producto = uuid_to_bin(_id_producto) and fecha_elim is null;
    else
		select "invalid_command" as 'result';
end case;
    
end
$$ DELIMITER ;
-- // FILENAME: ProcSuperAdmin.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para el Usuario.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

DELIMITER $$
drop procedure if exists sp_SuperAdmin;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_SuperAdmin (
	in _proc varchar(16),
    in _correo_e varchar(256),
    in _pass varchar(16),
	in _id_usuario varchar(36),
    in _us_correo varchar(256),
    in _nombres varchar(64),
    in _apellidos varchar(64),
    in _username varchar(32),
    in _new_email varchar(256),
    in _new_pass varchar(16)
)
begin
declare _id_sadmin binary(16);
select id_sadmin into _id_sadmin from super_admins where attr2 = _correo_e and attr3 = _pass and fecha_elim is null;
case (_proc)
	when ('create') then
		insert into super_admins (
			id_sadmin,
            nombres,
            apellidos,
            username,
            attr2,
            attr3
        ) values (
			uuid_to_bin(uuid()),
            _nombres,
            _apellidos,
            _username,
            _new_email,
            _new_pass
        );
    when ('modify') then
		update super_admins set
			nombres = ifnull(_nombres, nombres),
			apellidos = ifnull(_apellidos, apellidos),
			username = ifnull(_username, username),
			attr2 = ifnull(_new_email, attr2),
            attr3 = ifnull(_new_pass, attr3),
			fecha_modif = sysdate()
		where id_sadmin = _id_sadmin;
    when ('delete') then
		update super_admins set
			fecha_elim = sysdate()
		where id_sadmin = _id_sadmin;
-- //// AUTORIZAR ADMINISTRADOR \\\\ --
	when ('auto_admin') then
		update usuarios set
			autorizador = ifnull(_id_sadmin, autorizador),
			fecha_modif = sysdate()
		where id_usuario = uuid_to_bin(_id_usuario) and attr1 = "administrador" and fecha_elim is null;
	when ('get_userid') then
		select
			bin_to_uuid(id_usuario) as 'ID',
			attr2 as 'Correo'
		from usuarios
        where attr2 = _us_correo and attr1 = "administrador" and fecha_elim is null;
    else
		select "invalid_command" as 'result';
end case;

end $$
DELIMITER ;
-- // FILENAME: ProcTarjetas.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para los domicilios.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- //////////////////////////////////////
-- //// PROCEDIMIENTOS DE DOMICILIOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists sp_Tarjetas;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Tarjetas (
	in proc varchar(16),
	in _id_tarj varchar(36),
	in _id_usuario varchar(36),
    in _nombre_tarj varchar(128),
    in _num_tarj varchar(256),
    in _cad char(4),
    in _cvv char(3)
)
begin

case (_proc)
-- //// NUEVA TARJETA \\\\ --
	when ('create') then
		insert into tarjetas (
			id_tarj,
			id_usuario,
			nombre_tarj,
			num_tarj,
			cad,
			cvv,
			fecha_creacion
		) values(
			uuid_to_bin(uuid()),
			uuid_to_bin(_id_usuario),
			_nombre_tarj,
			_num_tarj,
			_cad,
			_cvv,
			sysdate()
		);
-- //// MODIFICAR TARJETA \\\\ --
    when ('modify') then
		update tarjetas set
			nombre_tarj = ifnull(_nombre_tarj, nombre_tarj),
			num_tarj = ifnull(_num_tarj, num_tarj),
			cad = ifnull(_cad, cad),
			cvv = ifnull(cvv, cvv)
		where id_tarj = uuid_to_bin(_id_tarj);
-- //// ELIMINAR TARJETA \\\\ --
    when ('delete') then
		delete from tarjetas where id_tarj = uuid_to_bin(_id_tarj);
-- //// COMANDO INVÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;

end
$$ DELIMITER ;
- // FILENAME: ProcUsuarios.sql
-- // Autor: Alexis Isaí Contreras Garza
-- // Desc: Procedimientos para el Usuario.

-- // UNIVERSIDAD AUTÓNOMA DE NUEVO LEÓN
-- // FACULTAD DE CIENCIAS FÍSICO MATEMÁTICAS

-- // Bases de datos multimedia y Programación web de capa intermedia.
-- // Alexis Isaí Contreras Garza / Matrícula 1823636
-- // Maikol Ariel Paredes Olguín / Matrícula 1687850

use tienda_online;

-- ////////////////////////////////////
-- //// PROCEDIMIENTOS DE USUARIOS \\\\
-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

DELIMITER $$
drop procedure if exists sp_Usuarios;
$$ DELIMITER ;
DELIMITER $$
create procedure sp_Usuarios (
	in _proc varchar(16),
    in _id_usuario varchar(36),
    in _nombres varchar(64),
    in _apellidos varchar(64),
    in _username varchar(32),
    in _fecha_nac datetime,
    in _sexo char(1),
    in _privacidad boolean,
    in _rol varchar(16),
    in _correo_e varchar(256),
    in _pass varchar(256),
    in _avatar blob,
    in _avatar_dir varchar(256),
    in _autorizador varchar(36)
)
begin
declare excluder int;
case _proc
-- //// REGISTRAR USUARIO \\\\ --
	when ('create') then
		insert into usuarios (
			id_usuario,
			nombres,
			apellidos,
			username,
			fecha_nac,
			sexo,
			attr1,
			attr2,
			attr3,
			avatar,
			avatar_dir
		) values (
			uuid_to_bin(uuid()),
			_nombres,
			_apellidos,
			_username,
			_fecha_nac,
			_sexo,
			_rol,
			_correo_e,
			_pass,
			_avatar,
			_avatar_dir
		);
-- //// MODIFICAR USUARIO \\\\ --
    when ('modify') then
		update usuarios set
			nombres = ifnull(_nombres, nombres),
			apellidos = ifnull(_apellidos, apellidos),
			username = ifnull(_username, username),
			fecha_nac = ifnull(_fecha_nac, fecha_nac),
			sexo = ifnull(_sexo, sexo),
            privacidad = ifnull(_privacidad, privacidad),
			avatar = ifnull(_avatar, avatar),
			avatar_dir = ifnull(_avatar_dir, avatar_dir),
			fecha_modif = sysdate()
		where id_usuario = uuid_to_bin(_id_usuario) and fecha_elim is null;
-- //// ELIMINAR USUARIO \\\\ --
    when ('delete') then
		update usuarios set
			fecha_elim = sysdate()
		where id_usuario = uuid_to_bin(_id_usuario) and fecha_elim is null;
-- //// RECUPERAR USUARIO \\\\ --
    when ('backup') then
		update usuarios set
			fecha_elim = null
		where id_usuario = uuid_to_bin(_id_usuario) and fecha_elim is not null;
-- //// CHECAR CORREO \\\\ --
    when ('checkE') then
		select
			count(*) as "result"
			from usuarios
		where attr2 = _correo_e;
-- //// MODIFICAR CORREO ELECTRÓNICO \\\\ --
    when ('changeE') then
		update usuarios set
			attr2 = ifnull(_correo_e, attr2),
			fecha_modif = sysdate()
		where id_usuario = uuid_to_bin(_id_usuario) and fecha_elim is null;
-- //// MODIFICAR CONTRASEÑA \\\\ --
    when ('changeP') then
		update usuarios set
			attr3 = ifnull(_pass, attr3),
			fecha_modif = sysdate()
		where id_usuario = uuid_to_bin(_id_usuario) and fecha_elim is null;
-- //// INICIO DE SESIÓN \\\\ --
    when ('login') then
		if exists(select 1 from usuarios where attr2 = _correo_e) then
			if ("administrador" = (select attr1 from usuarios where attr2 = _correo_e)) then
				select
					1 as 'result',
					bin_to_uuid(id_usuario) as 'out_id',
					username as 'out_username',
					attr1 as 'out_rol',
					attr2 as 'out_correo',
					attr3 as 'out_pass',
					avatar_dir as 'out_img'
				from usuarios
				where attr2 = _correo_e and autorizador is not null;
            else
				select
					1 as 'result',
					bin_to_uuid(id_usuario) as 'out_id',
					username as 'out_username',
					attr1 as 'out_rol',
					attr2 as 'out_correo',
					attr3 as 'out_pass',
					avatar as 'out_img'
				from usuarios
				where attr2 = _correo_e;
            end if;
		else
			select 0 as 'result';
		end if;
-- //// OBTENER DATOS PARA FORMULARIO \\\\ --
	when ('get_data') then
		select
			1 as 'result',
			nombres as 'out_nombres',
            apellidos as 'out_apellidos',
            username as 'out_username',
            attr2 as 'out_correo',
            fecha_nac as 'out_fechanac',
            sexo as 'out_sexo',
            privacidad as 'out_privacidad',
            fecha_creacion as 'out_feccre'
        from usuarios
        where id_usuario = uuid_to_bin(_id_usuario);
-- //// COMANDO NO VÁLIDO \\\\ --
    else
		select "invalid_command" as 'result';
end case;
    
end
$$ DELIMITER ;