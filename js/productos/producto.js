$(document).ready(function (){

    $('#form_calif').submit(e => {
        e.preventDefault();
        if ($('input[type="radio"][name="in_val"]').val() == ""){
            alert("Elija la cantidad de estrellas para valorar el producto.");
            return;
        }
        let formdata = new FormData($(e.target)[0]);
        formdata.append('submit', 1);
        $.ajax({
            url: '../../php/includes/calificaciones/insert_calif_inc.php',
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
                        alert("Hubo un error en la consulta:", data.details);
                        break;
                    case "no_query_results":
                        alert("No hubo resultados del la consulta.");
                        break;
                    case "empty_inputs":
                        alert("Algunos campos no se capuraron correctamente.");
                        break;
                    case "uncaptured_id":
                        alert("El ID del producto no se capturo correctamente.");
                        break;
                }
            } else {
                window.location.reload();
            }
        });
    })
    
    $('#btn_carrito').on('click', e => {
        const urlParams = new URLSearchParams(window.location.search);
        const cantidad = $('#txt_cantidad').val();
        if (cantidad == "") {
            return;
        } else if (cantidad == 0) {
            return;
        }
        $.ajax({
            url: '../../php/includes/carrito/add_carrito_inc.php',
            type: 'POST',
            data: {'in_prodid':urlParams.get('prod'), 'in_cant':cantidad},
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
                case "empty_inputs":
                    alert("Alguna información no se cargó adecuadamente.");
                    break;
                case "uncaptured_id":
                    alert("No se encontró ID de usuario.");
                    break;
                case "not_aviable": {
                    alert("No hay suficientes productos en Stock.");
                    break;
                }
            }
        } else {
            alert("Producto añadido al carrito.");
            window.location.reload();
        }
        })
    });

});