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

function validarCorreo(input) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1.3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(input);
}

function validarPassword(input) {
    return /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*()_+|~=`{}\[\]:";'<>?,./-]).{8,}$/.test(input);
}

function validarPrecio(input) {
    return /^[0-9]{0,6}(\.[0-9]{1,2})?$/.test(input);
}