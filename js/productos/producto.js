$(document).ready(function (){

    $('input[type="radio"][name="in_calif"]').on('change', function() {
        let value = $(this).val();
        alert("Tu calificación es de " + value + " estrellas.");
    });

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