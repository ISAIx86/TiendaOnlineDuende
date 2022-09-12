$(document).ready(function() {

    $('#form_producto').submit(e => {
        let todoCorrecto = true;
        todoCorrecto = checarNombre();
        todoCorrecto = checarDescripcion();
        todoCorrecto = checarCategoria();
        todoCorrecto = checarPrecio();

        if (todoCorrecto) {
            alert("Tu producto está registrado. Se publicará una vez que un administrador verifique tu producto.")
        }
        else {
            e.preventDefault();
        }
    });

});

function checarNombre() {
    let contenido = $('#txt_nombre').val();
    if (contenido === "") {
        alert("Ingrese un nombre para el producto.");
        return false;
    }
    else if (contenido.length > 64) {
        alert("Demasiados caracteres en el nombre.");
        return false;
    }
    else {
        return true;
    }
}

function checarDescripcion() {
    let contenido = $('#txt_descrip').val();
    if (contenido === "") {
        alert("Ingrese una descripción para el producto.");
        return false;
    }
    else if (contenido.length > 256) {
        alert("Demasiados caracteres en la descripción.");
        return false;
    }
    else {
        return true;
    }
}

function checarCategoria() {
    let contenido = $('#txt_catego').val();
    if (contenido === "") {
        alert("Ingrese una categoría para el producto.");
        return false;
    }
    else {
        return true;
    }
}

function checarPrecio() {
    let contenido = $('#txt_descrip').val();
    if (contenido === "") {
        alert("Ingrese una precio.");
        return false;
    }
    else {
        return true;
    }
}