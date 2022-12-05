class Categoria {
    constructor(id, nombre) {
        this.id = id;
        this.nombre = nombre;
    }
}

let categorias = [];

$(document).ready(function() {

    bindCategos();

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
                    case "query_error":
                        alert("Hubo un error en la operación SQL. "+data.details);
                        break;
                    case "no_query_results":
                        alert("No hubo resultados en la consulta.");
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

    $('input[type="radio"][name="in_tipoprecio"]').on('change', e => {
        if ($('input[type="radio"][name="in_tipoprecio"]:checked').val() == "CT") {
            $('#txt_precio').prop('disabled', true);
            $('#txt_precio').parents('.form_control').attr('requerido', false);
        } else {
            $('#txt_precio').prop('disabled', false);
            $('#txt_precio').parents('.form_control').attr('requerido', true);
        }
    });

    $('#form_producto').submit(e => {
        e.preventDefault();
        if (!checkCorrectInputs($(e.target))) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        if (categorias.length == 0) {
            alert("Asigne al menos una categoria al producto.");
            return;
        }
        let formdata = new FormData($(e.target)[0]);
        formdata.append('in_categos', JSON.stringify(categorias));
        formdata.append('submit', 1);
        $.ajax({
            url: '../../php/includes/productos/new_prod_inc.php',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false
        }).done(response => {
            let data;
            try {
                data = $.parseJSON(response);
            } catch (err) {
                $(".container-footer").append(response);
                return;
            }
            if (data.result == "error") {
                switch(data.reason) {
                    case "query_error":
                        alert("Hubo un error en la operación SQL. "+data.details);
                        break;
                    case "no_query_result":
                        alert("No hubo resultados en la consulta.");
                        break;
                    case "empty_inputs":
                        alert("Campos capturados vacíos.");
                        break;
                    case "missing_owner":
                        alert("No se capturó el ID del publicador.");
                        break;
                    case "uncaptured_id":
                        alert("No se capturó el ID de categoría.");
                        break;
                    case "no_categos":
                        alert("El producto no tiene categorías asociadas.");
                        break;
                    case "insertion_failed":
                        alert("Hubo un error al registrar el producto.");
                        break;
                    case "empty_files":
                        alert("Archivos vacios.");
                        break;
                    case "file_error":
                        alert("Hubo un error al cargar un archivo.");
                        break;
                    case "file_oversize":
                        alert("Algún archivo es demasiado grande para cargarlo.");
                        break;
                    case "file_wrongext":
                        alert("Algún archivo presenta una extensión no permitida.");
                        break;
                }
            } else {
                alert("Producto registrado con éxito. Se publicará una vez que sea aprobado por un administrador.");
                window.location.reload();
            }
        });
    });

    bindFields();

});

// Manejo de categorias
$(document).on('click', '#item_catego', e => {
    let id = $(e.target).attr('catego_id');
    let name = $(e.target).text();
    categorias.push(new Categoria(
        id,
        name
    ));
    updateCategoList()
});

$(document).on('click', '#item_catego_list', e => {
    let id = $(e.target).attr('catego_id');
    categorias.splice(categorias.findIndex(cat => { return cat.id == id }), 1)
    updateCategoList()
});

function appendElement(htmlList, element) {
    let text='<li><a id="item_catego" catego_id="'+element["out_id"]+'" value="'+element["out_nombre"]+'">'+element["out_nombre"]+'</a></li>';
    htmlList[0] += text;
}

function updateCategoList() {
    if (categorias.length != 0) {
        $('#lbx_catego').html("");
        categorias.forEach(catego => {
            $('#lbx_catego').append('<option id="item_catego_list" catego_id="'+catego.id+'" value="'+catego.nombre+'">'+catego.nombre+'</option>');
        });
    } else {
        $('#lbx_catego').html("");
        $('#lbx_catego').append('<option>Sin categorías</option>');
    }
}

// Campos de formularios

function bindCategos() {
    let categoarr = $('#lbx_catego').children('#item_catego_list').toArray();
    categoarr.forEach(elem => {
        categorias.push(new Categoria(
            elem.getAttribute('catego_id'),
            elem.getAttribute('value')
        ))
    })
}

function bindFields() {

    $('#fle_media').on('change', e => {
        let contenido = $(e.target).get(0).files;
        let files_ok = type_media($(e.target), contenido);
        if (files_ok) loadMedia(contenido);
    });

    $('#txt_nombre').on('change', e => {
        let contenido =  $(e.target).val();
        type_textnum($(e.target), contenido, 64);
    });

    $('#txt_descrip').on('change', e => {
        let contenido =  $(e.target).val();
        type_textnum($(e.target), contenido, 256);
    });

    $('#txt_dispo').on('change', e => {
        let contenido =  $(e.target).val();
        type_numeric($(e.target), contenido);
    })

    $('#txt_precio').on('change', e => {
        let contenido =  $(e.target).val();
        type_float($(e.target), contenido);
    });

}

function loadMedia(elements) {
    const imgext = ['jpeg', 'jpg', 'png', 'gif'];
    const vidext = ['mp4'];
    $('#mda_carousel').html("");
    for (let i = 0; i < elements.length; i++) {
        let ext = elements[i].name.split('.').pop().toLowerCase()
        if ($.inArray(ext, imgext) > -1) {
            $('#mda_carousel').append(
                '<div class="carousel-item active">'+
                  '<img src="'+URL.createObjectURL(elements[i])+'" class="d-block w-100" alt="...">'+
                '</div>'
            );
        }
        else if ($.inArray(ext, vidext) > -1) {
            $('#mda_carousel').append(
                '<div class="carousel-item active">'+
                    '<video src="'+URL.createObjectURL(elements[i])+'" controls autoplay> Vídeo no es soportado... </video>'+
                '</div>'
            );
        }
    }
}