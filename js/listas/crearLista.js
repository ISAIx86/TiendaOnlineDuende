$(document).ready(function() {

    $('#form_lista').submit(e => {
        e.preventDefault();
        if (!checkCorrectInputs(e.target)) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        let formdata = new FormData($(e.target)[0]);
        formdata.append('submit', 1);
        $.ajax({
            url: '../../php/includes/listas/add_list_inc.php',
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
                        alert("Hubo un error en la consulta de la base de datos.");
                        break;
                    case "no_query_results":
                        alert("Operación sin resultados.");
                        break;
                    case "empty_inputs":
                        alert("Campos vacíos.");
                        break;
                    case "img_error":
                        alert("Error al cargar la imagen.");
                        break;
                    case "img_oversize":
                        alert("El archivo es muy grande.");
                        break;
                    case "img_wrongext":
                        alert("El formato de archivo no es válido.");
                        break;
                }
            } else {
                alert("Lista creada.");
                window.location.reload();
            }
        });
    })

    $('#form_lista_upd').submit(e => {
        e.preventDefault();
        if (!checkCorrectInputs(e.target)) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        const urlParams = new URLSearchParams(window.location.search);
        let formdata = new FormData($(e.target)[0]);
        formdata.append('id_lista', urlParams.get('list'));
        formdata.append('submit', 1);
        $.ajax({
            url: '../../php/includes/listas/',
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
                        alert("Hubo un error en la consulta de la base de datos.");
                        break;
                    case "no_query_results":
                        alert("Operación sin resultados.");
                        break;
                    case "uncaptured_id":
                        alert("No se capturó el ID de lista.");
                        break;
                    case "empty_inputs":
                        alert("Campos vacíos.");
                        break;
                    case "img_error":
                        alert("Error al cargar la imagen.");
                        break;
                    case "img_oversize":
                        alert("El archivo es muy grande.");
                        break;
                    case "img_wrongext":
                        alert("El formato de archivo no es válido.");
                        break;
                }
            } else {
                alert("Lista editada.");
                window.location.reload();
            }
        });
    })

    bindFields();

});

function bindFields() {

    $('#fle_img').on('change', e => {
        let contenido = $(e.target).val();
        type_image($(e.target), contenido);
    });

    $('#txt_nombre').on('change', e => {
        let contenido = $(e.target).val();
        type_textnum($(e.target), contenido, 32)
    })

    $('#txt_descrip').on('change', e => {
        let contenido = $(e.target).val();
        type_textnum($(e.target), contenido, 32)
    })

}