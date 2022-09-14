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
            window.location.replace("c-home.html");
        }
        else {
            e.preventDefault();
            alert("Algunos campos contienen errores o están vacíos.");
        }
    });

});