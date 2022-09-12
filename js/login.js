$(document).ready(function() {

    $('#txt_nombres').on('change', function() {
        let contenido =  $(this).val();
        if (contenido.length == 0) {
            setCSSFor($(this)[0]);
        }
        else if (contenido.length > 64) {
            setCSSFor($(this)[0], 'error', 'Demasiados caracteres.');
        }
        else if (tienenNum(contenido)) {
            setCSSFor($(this)[0], 'error', 'No debe contener números.');
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    });

    $('#txt_apellidos').on('change', function() {
        let contenido =  $(this).val();
        if (contenido.length == 0) {
            setCSSFor($(this)[0]);
        }
        else if (contenido.length > 64) {
            setCSSFor($(this)[0], 'error', 'Demasiados caracteres.');
        }
        else if (tienenNum(contenido)) {
            setCSSFor($(this)[0], 'error', 'No debe contener números.');
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    });

    $('input[type="radio"][name="in_genero"]').on('change', function(){
        setCSSFor($(this)[0], 'success');
    });

    $('#cbx_rol').on('change', function(){
        setCSSFor($(this)[0], 'success');
    });

    $('#txt_fechanac').change(function() {
        let contenido = $(this).val();
        let sep = contenido.split('-');
        let fecnac = new Date(sep[0], sep[1] - 1, sep[2]);
        if (!validarFechaNac(fecnac)) {
            setCSSFor($(this)[0], 'error', 'La fecha no debe pasar de la actual.');
        }
        else if (isNaN(fecnac)){
            setCSSFor($(this)[0], 'error', 'La fecha ingresada no existe.');
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    });

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

    $('#txt_username').on('change', function() {
        let contenido =  $(this).val();
        if (contenido.length === 0) {
            setCSSFor($(this)[0], '', '');
        }
        else if (contenido.length > 32) {
            setCSSFor($(this)[0], 'error', 'Demasiados caracteres.');
        }
        else {
            setCSSFor($(this)[0], 'success', '');
        }
    });

    $('#txt_password').on('change', function() {
        let contenido =  $(this).val();
        if (contenido.length === 0) {
            setCSSFor($(this)[0], '', '');
        }
        else if (contenido.length > 16) {
            setCSSFor($(this)[0], 'error', 'Demasiados caracteres.');
        }
        else if (!validarPassword(contenido)) {
            setCSSFor($(this)[0], 'error', 'Contraseña no válida.');
        }
        else {
            setCSSFor($(this)[0], 'success', '');
        }
        $('#txt_confirm').trigger('change');
    });

    $('#txt_confirm').on('change', function() {
        let contenido =  $(this).val();
        let contra = $('#txt_password').val();
        if (contenido.length === 0) {
            setCSSFor($(this)[0], '', '');
        }
        else if (contenido.length > 16) {
            setCSSFor($(this)[0], 'error', 'Demasiados caracteres.');
        }
        else if (contenido != contra) {
            setCSSFor($(this)[0], 'error', 'No coinciden.');
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    });

    $('#form').submit(function(e) {
        let campos = $('#form').children('[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });

        if (todoCorrecto) {
            alert("Datos ingresados correctamente");
        }
        else {
            e.preventDefault();
            alert("Algunos campos contienen errores o están vacíos.");
        }
    });

});