$(document).ready(function() {

    $('#form_login').submit(function(e) {
        let campos = $(this).children('[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });

        if (todoCorrecto) {
            e.preventDefault();
            $.ajax({
                url: './php/includes/login_inc.php',
                type: 'POST',
                data: $('#form_login').serialize() + "&submit=1"
            }).done(response => {
                let data = $.parseJSON(response);
                if (data.result == "error") {
                    switch(data.reason) {
                        case "empty_inputs":
                            alert("Campos capturados vacíos.");
                            break;
                        case "no_exists":
                            alert("El correo electrónico no existe.");
                            break;
                        case "not_found":
                            alert("No se pudo encontrar el usuario. Intentelo más tade.");
                            break;
                        case "wrong_password":
                            alert("Contraseña incorrecta.");
                            break;
                    }
                }
                else {
                    switch (data.role) {
                        case "comprador":
                            window.location.replace("./c-home.php");
                            break;
                        case "vendedor":
                            window.location.replace("./v-perfilVendedor.html");
                            break;
                        case "administrador":
                            window.location.replace("./a-listaAprobados.html");
                            break;
                        case "compravende":
                            window.location.replace("./landingPage.html");
                            break;
                    }
                }
            });
        }
        else {
            e.preventDefault();
            alert("Algunos campos contienen errores o están vacíos.");
        }
    });

    $('#form_registro').submit( e => {
        let campos = $('#form_registro').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });

        if (!todoCorrecto) {
            e.preventDefault();
            alert("Algunos campos contienen errores o están vacíos.");
        }
    });

    $('#form_registro_upd').submit( e => {
        e.preventDefault();
        let campos = $('#form_registro_upd').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });
        if (todoCorrecto) {
            $.ajax({
                url: './php/includes/update_data_inc.php',
                type: 'POST',
                data: $('#form_registro_upd').serialize() + "&mode=data" + "&submit=1"
            })
            .done(response => {
                let data = $.parseJSON(response);
                $('#txt_nombres').val(data.data.out_nombres);
                $('#txt_apellidos').val(data.data.out_apellidos);
                switch(data.data.out_username) {
                    case 'Hombre':
                        ("#rdb_h").attr('checked', true);
                        break;
                    case 'Mujer':
                        ("#rdb_m").attr('checked', true);
                        break;
                    case 'Otro':
                        ("#rdb_o").attr('checked', true);
                        break;
                }
                $('#txt_fechanac').val(data.data.out_fechanac);
                $('#txt_username').val(data.data.out_username);
                $('#txt_usertag').html(data.data.out_username);
                alert("Información actualizada");
            });
        }
        else {
            
        }
    });

    $('#form_correo_upd').submit( e => {
        e.preventDefault();
        let campos = $('#form_correo_upd').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });
        if (todoCorrecto) {
            $.ajax({
                url: './php/includes/update_data_inc.php',
                type: 'POST',
                data: $('#form_correo_upd').serialize() + "&mode=email" + "&submit=1"
            })
            .done(response => {
                let data = $.parseJSON(response);
                $('#txt_correo').val(data.data.out_email);
                alert("Correo electrónico actualizado");
            });
        }
        else {
            
        }
    })

    $('#form_contra_upd').submit( e => {
        e.preventDefault();
        let campos = $('#form_contra_upd').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });
        if (todoCorrecto) {
            $.ajax({
                url: './php/includes/update_data_inc.php',
                type: 'POST',
                data: $('#form_contra_upd').serialize() + "&mode=password" + "&submit=1"
            })
            .done(response => {
                let data = $.parseJSON(response);
                if (data.result == "success") {
                    emptyInputs($('#form_contra_upd'));
                    alert("Contraseña actualizada");
                }
            });
        }
        else {
            
        }
    })

});

function emptyInputs(element) {
    debugger;
    let campos = element.find('input').toArray();
    campos.forEach(element => {
        element.value = "";
    });
}