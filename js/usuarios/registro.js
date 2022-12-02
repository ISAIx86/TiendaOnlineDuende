// Formularios de usuario.
$(document).ready(function() {

    $('#form_login').submit( e => {
        e.preventDefault();
        if (!checkCorrectInputs($(e.target))) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        let formdata = new FormData($(e.target)[0]);
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
                    case "query_error":
                        alert("Hubo un error en la operación SQL. "+data.details);
                        break;
                    case "no_query_results":
                        alert("No hubo resultados en la consulta.");
                        break
                    case "empty_inputs":
                        alert("Campos capturados vacíos.");
                        break;
                    case "not_found":
                        alert("No se pudo encontrar el usuario. Intentelo más tade.");
                        break;
                    case "no_exists":
                        alert("El correo electrónico no existe.");
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
                        window.location.replace("../comprador/c-home.php");
                        break;
                    case "vendedor":
                        window.location.replace("../usuarios/c-profile.php");
                        break;
                    case "administrador":
                        window.location.replace("../usuarios/c-profile.php");
                        break;
                    case "compravende":
                        alert("Coming soon!");
                        // TODO: Header de comprador-vendedor.
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
                    case "query_error":
                        alert("Hubo un error en la operación SQL. "+data.details);
                        break;
                    case "no_query_results":
                        alert("No hubo resultados en la consulta.");
                        break;
                    case "empty_inputs":
                        alert("Algunos campos están vacíos.");
                        break;
                    case "unmatch_confirm":
                        alert("La contraseña confirmada no coincide.");
                        break;
                    case "already_exists":
                        alert("El correo electrónico ya ha sido registrado.");
                        break;
                    case "img_error":
                        alert("No se pudo cargar el archivo de imagen.");
                        break;
                    case "img_oversize":
                        alert("El archivo de imagen es demasiado grande.");
                        break;
                    case "img_wrongext":
                        alert("La extensión de archivo no es aceptada.");
                        break;
                }
            } else {
                window.location.replace("landingPage.php");
            }
        });
    });

    $('#form_registro_upd').submit( e => {
        e.preventDefault();
        if (!checkCorrectInputs($(e.target))) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        let formdata = new FormData($(e.target)[0]);
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
                    case "query_error":
                        alert("Hubo un error en la operación SQL. "+data.details);
                        break;
                    case "no_query_results":
                        alert("No hubo resultados en la consulta.");
                        break;
                    case "empty_inputs":
                        alert("Algunos campos están vacíos.");
                        break;
                    case "uncaptured_id":
                        alert("No se pudo capturar el ID");
                        break;
                    case "img_error":
                        alert("No se pudo cargar el archivo de imagen.");
                        break;
                    case "img_oversize":
                        alert("El archivo de imagen es demasiado grande.");
                        break;
                    case "img_wrongext":
                        alert("La extensión de archivo no es aceptada.");
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
                    case "query_error":
                        alert("Hubo un error en la operación SQL. "+data.details);
                        break;
                    case "no_query_results":
                        alert("No hubo resultados en la consulta.");
                        break;
                    case "empty_inputs":
                        alert("Algunos campos están vacíos.");
                        break;
                    case "uncaptured_id":
                        alert("No se pudo capturar el ID");
                        break;
                    case "already_exists":
                        alert("Éste correo electrónico ya está registrado.");
                        break;
                    case "actual_email":
                        alert("El correo ingresado es el actual.");
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
                    case "query_error":
                        alert("Hubo un error en la operación SQL. "+data.details);
                        break;
                    case "no_query_results":
                        alert("No hubo resultados en la consulta.");
                        break;
                    case "empty_inputs":
                        alert("Algunos campos están vacíos.");
                        break;
                    case "uncaptured_id":
                        alert("No se pudo capturar el ID");
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
            }
            } else {
                emptyInputs($('#form_contra_upd'));
                alert("Contraseña actualizada");
            }
        });
    });

    bindFields();

    checkAllFields();

});

// Campos de formularios

function bindFields() {

    $('#fle_fotoperfil').on('change', function() {
        let contenido = $(this).val();
        type_image($(this), contenido);
    });

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