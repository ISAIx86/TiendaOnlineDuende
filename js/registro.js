// Formularios de usuario.
$(document).ready(function() {

    $('#form_login').submit( e => {
        e.preventDefault();
        if (!checkCorrectInputs($('#form_login'))) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        let formdata = new FormData($('#form_login')[0]);
        formdata.append('submit', 1);
        $.ajax({
            url: '../../php/includes/usuarios/login_inc.php',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false
        }).done(response => {
            let data;
            try {
                data = $.parseJSON(response);
            } catch (err) {
                $(".container-footer").append(response);
                return;
            }
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
                    case "unauthorized_admin":
                        alert("Administrador no autorizado.");
                        break;
                }
            } else {
                switch (data.role) {
                    case "comprador":
                        window.location.replace("../usuarios/c-home.php");
                        break;
                    case "vendedor":
                        window.location.replace("../usuarios/c-profile.php");
                        break;
                    case "administrador":
                        window.location.replace("../usuarios/c-profile.php");
                        break;
                    case "compravende":
                        window.location.replace("../starting/landingPage.html");
                        break;
                }
            }
        });
    });

    $('#form_registro').submit( e => {
        e.preventDefault();
        if (!checkCorrectInputs($('#form_registro'))) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        let formdata = new FormData($('#form_registro')[0]);
        formdata.append('submit', 1);
        $.ajax({
            url: '../../php/includes/usuarios/registro_inc.php',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false
        })
        .done(response => {
            let data;
            try {
                data = $.parseJSON(response);
            } catch (err) {
                $(".container-footer").append(response);
                return;
            }
            if (data.result == "error") {
                switch (data.reason) {
                    case "empty_inputs":
                        alert("Algunos campos están vacíos.");
                        break;
                    case "unmatch_confirm":
                        alert("La contraseña confirmada no coincide.");
                        break;
                    case "already_exists":
                        alert("El correo electrónico ya ha sido registrado.");
                        break;
                    case "no_query_results":
                        alert("Hubo un problema al consultar la información.");
                        break;
                }
            } else {
                window.location.replace("landingPage.php");
            }
        });
    });

    $('#form_registro_upd').submit( e => {
        e.preventDefault();
        if (!checkCorrectInputs($('#form_registro_upd'))) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        let formdata = new FormData($('#form_registro_upd')[0]);
        formdata.append('submit', 1);
        formdata.append('mode', 'data');
        $.ajax({
            url: '../../php/includes/usuarios/update_data_inc.php',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false
        })
        .done(response => {
            let data;
            try {
                data = $.parseJSON(response);
            } catch (err) {
                $(".container-footer").append(response);
                return;
            }
            if (data.result == "error") {
                switch (data.reason) {
                    case "uncaptured_id":
                        alert("No se pudo capturar el ID");
                        break;
                    case "empty_inputs":
                        alert("Algunos campos están vacíos.");
                        break;
                    case "no_query_results":
                        alert("Hubo un problema al consultar la información.");
                        break;
                }
            } else {
                alert("Información actualizada.");
                window.location.reload();
            }
        });
    });

    $('#form_correo_upd').submit( e => {
        e.preventDefault();
        if (!checkCorrectInputs($('#form_correo_upd'))) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        let formdata = new FormData($('#form_correo_upd')[0]);
        formdata.append('submit', 1);
        formdata.append('mode', 'email');
        $.ajax({
            url: '../../php/includes/usuarios/update_data_inc.php',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false
        })
        .done(response => {
            let data;
            try {
                data = $.parseJSON(response);
            } catch (err) {
                $(".container-footer").append(response);
                return;
            }
            if (data.result == "error") {
                switch (data.reason) {
                    case "uncaptured_id":
                        alert("No se pudo capturar el ID");
                        break;
                    case "empty_inputs":
                        alert("Algunos campos están vacíos.");
                        break;
                    case "already_exists":
                        alert("Éste correo electrónico ya está registrado.");
                        break;
                    case "no_query_results":
                        alert("Hubo un problema al consultar la información.");
                        break;
                }
            } else {
                alert("Correo electrónico actualizado");
            }
        });
    });

    $('#form_contra_upd').submit( e => {
        e.preventDefault();
        if (!checkCorrectInputs($('#form_contra_upd'))) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        let formdata = new FormData($('#form_contra_upd')[0]);
        formdata.append('submit', 1);
        formdata.append('mode', 'password');
        $.ajax({
            url: '../../php/includes/usuarios/update_data_inc.php',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false
        })
        .done(response => {
            let data;
            try {
                data = $.parseJSON(response);
            } catch (err) {
                $(".container-footer").append(response);
                return;
            }
            if (data.result == "error") {
                switch (data.reason) {
                    case "uncaptured_id":
                        alert("No se pudo capturar el ID");
                        break;
                    case "empty_inputs":
                        alert("Algunos campos están vacíos.");
                        break;
                    case "already_exists":
                        alert("Éste correo electrónico ya está registrado.");
                        break;
                    case "wrong_password":
                        alert("La contraseña actual es incorrecta.");
                        break;
                    case "unmatching_psw":
                        alert("La contraseña confirmada no coincide.");
                        break;
                    case "no_query_results":
                        alert("Hubo un problema al consultar la información.");
                        break;
                }
            } else {
                emptyInputs($('#form_contra_upd'));
                alert("Contraseña actualizada");
            }
        });
    });

    bindFields();

});

// Campos de formularios

function bindFields() {

    $('#txt_nombres').on('change', function() {
        let contenido =  $(this).val();
        type_text($(this), contenido, 64);
    });

    $('#txt_apellidos').on('change', function() {
        let contenido =  $(this).val();
        type_text($(this), contenido, 64);
    });

    $('input[type="radio"][name="in_genero"]').on('change', function(){
        setCSSFor($(this), 'success');
    });

    $('input[type="radio"][name="in_privacidad"]').on('change', function(){
        setCSSFor($(this), 'success');
    });

    $('#cbx_rol').on('change', function(){
        setCSSFor($(this), 'success');
    });

    $('#txt_fechanac').change(function() {
        let contenido = $(this).val();
        type_date($(this), contenido);
    });

    $('#txt_correo').on('change', function() {
        let contenido =  $(this).val();
        type_email($(this), contenido);
    });

    $('#txt_username').on('change', function() {
        let contenido =  $(this).val();
        type_textnum($(this), contenido, 32);
    });

    $('#txt_prevpass').on('change', function() {
        let contenido =  $(this).val();
        type_password($(this), contenido);
    });

    $('#txt_password').on('change', function() {
        let contenido =  $(this).val();
        $('#pass_format').hide();
        type_password($(this), contenido);
        $('#txt_confirm').trigger('change');
    });

    $('#txt_confirm').on('change', function() {
        let contenido =  $(this).val();
        let contra = $('#txt_password').val();
        type_confirm($(this), contenido, contra);
    });
    
}