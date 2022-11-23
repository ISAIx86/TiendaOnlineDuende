$(document).ready(function() {

    $('#txt_propietario').on('change', function() {
        let contenido = $('#txt_propietario').val();
        if (contenido === "") {
            setCSSFor($(this)[0]);
        }
        else if (tienenNum(contenido)) {
            setCSSFor($(this)[0], 'error', 'No debe contener números.');
        }
        else if (contenido.length > 256) {
            setCSSFor($(this)[0], 'error', 'Demasiados caracteres.');
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    });

    $('#txt_numtarj').on('change', function() {
        let contenido = $('#txt_numtarj').val();
        if (contenido === "") {
            setCSSFor($(this)[0]);
        }
        else if (!validarNumTarj(contenido)) {
            setCSSFor($(this)[0], 'error', 'El formato del número no es válido.');
        }
        else if (contenido.length > 19) {
            setCSSFor($(this)[0], 'error', 'Demasiados caracteres.');
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    });

    $('#txt_venc').on('change', function() {
        let contenido = $('#txt_venc').val();
        if (contenido === "") {
            setCSSFor($(this)[0]);
        }
        else if (!validarFechaVenc(contenido)) {
            setCSSFor($(this)[0], 'error', 'El formato de fecha no es válido.');
        }
        else if (contenido.length > 5) {
            setCSSFor($(this)[0], 'error', 'Demasiados caracteres.');
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    })

    $('#txt_cvv').on('change', function() {
        let contenido = $('#txt_cvv').val();
        if (contenido === "") {
            setCSSFor($(this)[0]);
        }
        else if (contenido.length < 3) {
            setCSSFor($(this)[0], 'error', 'Deben ser tres caracteres.');
        }
        else if (!soloNumeros(contenido)) {
            setCSSFor($(this)[0], 'error', 'Debe ingresar solo números.');
        }
        else {
            setCSSFor($(this)[0], 'success');
        }
    })

    $('#form_metopag').submit(e => {
        let campos = $('#form_metopag').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });

        if (todoCorrecto) {
            alert("Tarjeta registrada satisfactoriamente.");
        }
        else {
            e.preventDefault();
            alert("Algunos campos contienen errores o están vacíos.");
        }
    })

});