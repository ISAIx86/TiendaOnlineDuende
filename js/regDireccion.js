$(document).ready(function (){

    $('#cbx_estado').on('change', function() {
        setCSSFor($(this)[0], 'success');
    });

    $('#txt_municipio').on('change', function() {
        let contenido = $('#txt_municipio').val();
        if (contenido === "") {
            setCSSFor($(this)[0]);
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    });

    $('#txt_colonia').on('change', function() {
        let contenido = $('#txt_colonia').val();
        if (contenido === "") {
            setCSSFor($(this)[0]);
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    });

    $('#txt_calle').on('change', function() {
        let contenido = $('#txt_calle').val();
        if (contenido === "") {
            setCSSFor($(this)[0]);
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    });

    $('#txt_noint').on('change', function() {
        let contenido = $('#txt_calle').val();
        if (contenido === "") {
            setCSSFor($(this)[0], 'success');
        }
        else if (!soloNumeros(contenido)) {
            setCSSFor($(this)[0], 'error', 'Solo números.');
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    });

    $('#txt_noext').on('change', function() {
        let contenido = $('#txt_calle').val();
        if (contenido === "") {
            setCSSFor($(this)[0]);
        }
        else if (!soloNumeros(contenido)) {
            setCSSFor($(this)[0], 'error', 'Solo números.');
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    });

    $('#form_direc').submit(e => {
        let campos = $('#form_direc').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });

        if (todoCorrecto) {
            alert("Dirección guardada con éxito.");
        }
        else {
            e.preventDefault();
            alert("Algunos campos contienen errores o están vacíos.");
        }
    });

});