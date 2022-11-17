// Formulario de categoria
$(document).ready(function() {

    $('#form_categoria').submit(function(e){
        e.preventDefault();
        if (!checkCorrectInputs($('#form_categoria'))) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        let formdata = new FormData($('#form_categoria')[0]);
        formdata.append('submit', 1);
        $.ajax({
            url: '../../php/includes/categorias/insert_catego_inc.php',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false
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
                switch (data.reason) {
                    case "uncaptured_id":
                        alert("No se pudo capturar el ID");
                        break;
                    case "empty_inputs":
                        alert("Algunos campos están vacíos.");
                        break;
                    case "no_query_results":
                        alert("Hubo un problema al consultar la información.");
                        break;
                }
            } else {
                alert("¡Categoría creada!");
                window.location.reload();
            }
        });
    });

    bindFields()

});

function bindFields() {

    $('#txt_nombre').on('change', e => {
        let contenido =  $(e.target).val();
        type_text($(e.target), contenido, 32);
    });

    $('#txt_descrip').on('change', e => {
        let contenido =  $(e.target).val();
        type_textnum($(e.target), contenido, 256);
    });
    
}