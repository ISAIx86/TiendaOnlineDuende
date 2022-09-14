$(document).ready(function() {

    $('#btn_incatego').on('click', e => {
        let contenido = $('#txt_incatego').val();
        let entrada = $('#txt_catego').val();

        if (contenido === "") {
            return;
        }
        if (entrada === "") {
            $('#txt_catego').val(contenido + "\n");
        }
        else {
            $('#txt_catego').val(entrada + contenido + "\n");
        }
        
        $('#txt_incatego').val("");
    });

    $('#form_producto').submit(e => {
        let flag1 = checarNombre();
        let flag2 = checarDescripcion();
        let flag3 = checarCategoria();
        let flag4 = true;
        if ($('input[name=in_tipoprecio]:checked', '#form_producto').val() === "PF")
            flag4 = checarPrecio();

        if (flag1 & flag2 & flag3 & flag4) {
            alert("Producto registrado con éxito. Se publicará una vez que sea aprobado por un administrador.");
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
    let contenido = $('#txt_precio').val();
    if (contenido === "") {
        alert("Ingrese una precio.");
        return false;
    }
    else if (contenido.length > 8){
        alert("El precio no debe tener más de 8 caracteres.");
        return false;
    }
    else if (!soloNumeros(contenido)) {
        alert("El precio contiene letras.");
        return false;
    }
    else if (!validarPrecio(contenido)) {
        alert("El precio es inválido.");
        return false;
    }
    else {
        return true;
    }
}