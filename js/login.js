$(document).ready(function() {

    $('#txt_correo').on('change', function() {
        let contenido =  $(this).val();
        if (contenido.length == 0) {
            setCSSFor($(this)[0], '', '');
        }
        else if (contenido.length > 256) {
            setCSSFor($(this)[0], 'error', 'Demasiados caracteres.');
        }
        else if (!validarCorreo(contenido)) {
            setCSSFor($(this)[0], 'error', 'Correo no válido.');
        }
        else {
            setCSSFor($(this)[0], 'success', '');
        }
    });

    $('#txt_password').on('change', function() {
        let contenido =  $(this).val();
        $('#pass_format').hide();
        if (contenido.length === 0) {
            setCSSFor($(this)[0], '', '');
        }
        else if (contenido.length < 8) {
            setCSSFor($(this)[0], 'error', 'Debe contener más de 8 caracteres.');
        }
        else if (contenido.length > 16) {
            setCSSFor($(this)[0], 'error', 'Demasiados caracteres.');
        }
        else {
            setCSSFor($(this)[0], 'success', '');
        }
        $('#txt_confirm').trigger('change');
    });

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
                data: {'submit': 1, 'in_correo': $('#txt_correo').val(), 'in_password': $('#txt_password').val()},
                success: function(response) {
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
                }
            })
        }
        else {
            e.preventDefault();
            alert("Algunos campos contienen errores o están vacíos.");
        }
    });

});