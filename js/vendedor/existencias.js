$(document).on('click', '#btn_addex', e => {
    let product = $(e.target).parents('tr#prod_row').attr('idprod');
    let cantidad = $(e.target).parents('tr#prod_row').find('input#txt_cant').val();
    if (cantidad == "") {
        return;
    }
    else {
        cantidad = parseInt(cantidad);
    }
    $.ajax({
        url: '../../php/includes/productos/add_exist.php',
        type: 'POST',
        data: {'in_prodid':product, 'in_cant':cantidad, 'submit':'1'}
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
                case "no_query_result":
                    alert("No hubo resultados en la consulta.");
                    break;
                case "empty_inputs":
                    alert("Alguna información no se capturó adecuadamente.");
                    break;
                case "uncaptured_id":
                    alert("No se capturó el ID del producto.");
                    break;
            }
        } else {
            alert("Productos añadidos a STOCK.");
            window.location.reload();
        }
    });
});

$(document).on('click', '$btn_del', e => {
    let product = $(e.target).parents('tr#prod_row').attr('idprod');
    $.ajax({
        url: '../../php/includes/productos/add_exist_inc.php',
        type: 'POST',
        data: {'in_prodid':product, 'submit':'1'}
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
                case "uncaptured_id":
                    alert("No se capturó el ID del producto.");
                    break;
            }
        } else {
            alert("Producto eliminado.");
            window.location.reload();
        }
    });
});