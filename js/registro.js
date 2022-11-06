$(document).ready(function() {

    $('#form_login').submit( e => {
        e.preventDefault();
        let campos = $(this).children('[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });

        if (!todoCorrecto) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        $.ajax({
            url: '../../php/includes/usuarios/login_inc.php',
            type: 'POST',
            data: $('#form_login').serialize() + "&submit=1"
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
            }
            else {
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
        let campos = $('#form_registro').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });

        if (!todoCorrecto) {
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
                window.location.replace("index.php");
            }
        });
    });

    $('#form_registro_upd').submit( e => {
        e.preventDefault();
        let campos = $('#form_registro_upd').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });
        if (!todoCorrecto) {
            alert("Algunos campos están incorrectos.");
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
            }
            alert("Información actualizada");
            window.location.reload();
        });
    });

    $('#form_correo_upd').submit( e => {
        e.preventDefault();
        let campos = $('#form_correo_upd').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });
        if (!todoCorrecto) {
            alert("Algunos campos están incorrectos.");
            return;
        }
        let formdata = new FormData($('#form_registro_upd')[0]);
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
            }
            alert("Correo electrónico actualizado");
        });
    })

    $('#form_contra_upd').submit( e => {
        e.preventDefault();
        let campos = $('#form_contra_upd').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });
        if (!todoCorrecto) {
            alert("Algunos campos están incorrectos.");
            return;
        }
        let formdata = new FormData($('#form_registro_upd')[0]);
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
            }
            else {
                emptyInputs($('#form_contra_upd'));
                alert("Contraseña actualizada");
            }
        });
    })

});

function emptyInputs(element) {
    debugger;
    let campos = element.find('input').toArray();
    campos.forEach(element => {
        element.value = "";
    });
}