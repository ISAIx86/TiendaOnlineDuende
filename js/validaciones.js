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
        else if (!validarPassword(contenido)) {
            setCSSFor($(this)[0], 'error', 'Formato no válido.');
            $('#pass_format').show();
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
    
})

function setCSSFor(input, _class, message) {
    const formControl = input.parentElement;
    const sm = formControl.querySelector('small');
    switch(_class) {
        case 'error':
            sm.innerText = message;
            formControl.className='form_control error';
            formControl.setAttribute('state', 'erro');
            break;
        case 'success':
            formControl.className='form_control success';
            formControl.setAttribute('state', 'succ');
            break;
        default:
            formControl.className='form_control';
            formControl.setAttribute('state', 'empt');
            break;
    }
}

function tienenNum(input) {
    return /\d/.test(input);
}

function soloNumeros(input) {
    return /[0-9]*\.?[0-9]*/.test(input);
}

function validarFechaNac(input) {
    let today = new Date();
    if (input >= today)
        return false;
    else return true;
}

function validarFechaVenc(input) {
    return /^(0[1-9]|1[0-2])\/?([0-9]{2})$/.test(input);
}

function validarCorreo(input) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1.3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(input);
}

function validarPassword(input) {
    return /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*()_+|~=`{}\[\]:";'<>?,./-]).{8,}$/.test(input);
}

function validarPrecio(input) {
    return /^[0-9]{0,6}(\.[0-9]{1,2})?$/.test(input);
}

function validarNumTarj(input) {
    return /\b(?:\d{4}[ -]?){3}(?=\d{4}\b)(?:\d{4})/.test(input);
}