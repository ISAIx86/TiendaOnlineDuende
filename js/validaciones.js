//////////////////////////////
//// TIPOS DE VALIDADORES ////
//////////////////////////////

function type_text(element, contenido, limite) {
    if (contenido.length == 0) {
        setCSSFor(element);
    }
    else if (contenido.length > limite) {
        setCSSFor(element, 'error', 'Demasiados caracteres. No más de '+limite+' caracteres.');
    }
    else if (tienenNum(contenido)) {
        setCSSFor(element, 'error', 'No debe contener números.');
    }
    else {
        setCSSFor(element, 'success');
    }
}

function type_date(element, contenido) {
    let sep = contenido.split('-');
        let fecnac = new Date(sep[0], sep[1] - 1, sep[2]);
        if (!validarFechaNac(fecnac)) {
            setCSSFor(element, 'error', 'La fecha no debe pasar de la actual.');
        }
        else if (isNaN(fecnac)){
            setCSSFor(element, 'error', 'La fecha ingresada no existe.');
        }
        else {
            setCSSFor(element, 'success');
        }
}

function type_textnum(element, contenido, limite) {
    if (contenido.length === 0) {
        setCSSFor(element, '', '');
    }
    else if (contenido.length > limite) {
        setCSSFor(element, 'error', 'Demasiados caracteres. No mas de '+limite+' caracteres.');
    }
    else {
        setCSSFor(element, 'success', '');
    }
}

function type_email(element, contenido) {
    if (contenido.length == 0) {
        setCSSFor(element, '', '');
    }
    else if (contenido.length > 256) {
        setCSSFor(element, 'error', 'Demasiados caracteres.');
    }
    else if (!validarCorreo(contenido)) {
        setCSSFor(element, 'error', 'Correo no válido.');
    }
    else {
        setCSSFor(element, 'success', '');
    }
}

function type_password(element, contenido) {
    if (contenido.length === 0) {
        setCSSFor(element, '', '');
    }
    else if (contenido.length < 8) {
        setCSSFor(element, 'error', 'Debe contener más de 8 caracteres.');
    }
    else if (contenido.length > 16) {
        setCSSFor(element, 'error', 'Demasiados caracteres.');
    }
    else if (!validarPassword(contenido)) {
        setCSSFor(element, 'error', 'Formato no válido.');
        $('#pass_format').show();
    }
    else {
        setCSSFor(element, 'success', '');
    }
}

function type_confirm(element, contenido, confirma) {
    if (contenido.length === 0) {
        setCSSFor(element, '', '');
    }
    else if (contenido.length > 16) {
        setCSSFor(element, 'error', 'Demasiados caracteres.');
    }
    else if (contenido != confirma) {
        setCSSFor(element, 'error', 'No coinciden.');
    }
    else {
        setCSSFor(element, 'success');
    }
}

//////////////////////////
//// ESTADO DEL CAMPO ////
//////////////////////////

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

function checkCorrectInputs(form) {
    let campos = form.children('div[requerido="true"]').toArray();
    let todoCorrecto = true;
    todoCorrecto = !campos.some(campo => {
        return campo.getAttribute('state') !== "succ";
    });
    return todoCorrecto;
}

function emptyInputs(element) {
    debugger;
    let campos = element.find('input').toArray();
    campos.forEach(element => {
        element.value = "";
    });
}

/////////////////////////////
//// VALIDACION DE DATOS ////
/////////////////////////////

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