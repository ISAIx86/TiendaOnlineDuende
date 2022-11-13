class Categoria {
    constructor(id, nombre) {
        this.id = id;
        this.nombre = nombre;
    }
}

let categorias = [];

$(document).ready(function() {

    $('#txt_incatego').on('keyup', e => {
        let text = $('#txt_incatego').val();
        $.ajax({
            url: '../../php/includes/categorias/buscar_catego_inc.php',
            type: 'GET',
            data: { 'in_texto' : text }
        })
        .done(response => {
            let data;
            try {
                data = $.parseJSON(response);
            } catch (err) {
                $(".container-footer").append(response);
                return;
            }
            if (data.result == "error") {
                switch(data.reason) {
                    case "empty":
                        $('#search-list').html("");
                        break;
                }
            } else {
                let htmlList = [""];
                data.content.forEach(element => {
                    appendElement(htmlList, element);
                });
                $('#search-list').html(htmlList);
            }
        });
    })


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

function appendElement(htmlList, element) {
    let text='<li><a id="'+element["ID"]+'" value"'+element["Nombre"]+'">'+element["Nombre"]+'</a></li>';
    htmlList[0] += text;
}