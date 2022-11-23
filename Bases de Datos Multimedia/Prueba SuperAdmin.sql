CALL `sp_SuperAdmin`('create', null, null, null, 'Karla', 'Padilla', 'KarlaP55', 'karlaP@gmail.com', '12345');
CALL `sp_SuperAdmin`('get_userid', null, null, null, 'gaby_torr0051@hotmail.com', null, null, null, null, null);
CALL `sp_SuperAdmin`('auto_admin', 'karlaP@gmail.com', '12345', '8f9a619a-4e75-11ed-9fdb-9829a665462f', null, null, null, null, null, null);
select * from `super_admins`;
select * from `usuarios`;
select
	bin_to_uuid(id_usuario) as 'ID',
    concat(nombres,' ',apellidos) as 'Nombre completo',
    username as 'Usuario',
    attr2 as 'Correo',
    attr1 as 'Rol',
    bin_to_uuid(`autorizador`) as 'Alta'
from `usuarios` where `attr1` = "administrador";
select
	bin_to_uuid(id_usuario) as 'ID',
    concat(nombres,' ',apellidos) as 'Nombre completo',
    username as 'Usuario',
    attr2 as 'Correo',
    attr1 as 'Rol'
from `usuarios`;