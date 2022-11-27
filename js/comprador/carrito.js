$(document).ready(function (){

    $('#btn_pagar').on('click', e => {
        const products = $("div#lst_carrito").children().length;
        if (products > 0) {
            window.location.replace("c-pagando.php");
        }
        else {
            alert("No hay productos en el carrito.");
        }
    });

    $('#btn_clean').on('click', e => {
        const products = $("div#lst_carrito").children().length;
        if (products == 0) {
            alert("El carrito ya está vacío.");
            return;
        }
        $.ajax({
            url: '../../php/includes/carrito/limpiar_carrito_inc.php',
            type: 'POST'
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
                    case "uncaptured_id":
                        alert("No se encontró ID de usuario.");
                        break;
                }
            } else {
                alert("Carrito vaciado.");
                window.location.reload();
            }
        });
    });

});

$(document).on('click', '#btn_quitar', e => {
    e.preventDefault();
    let producto_id = $(e.target).parents('li#emt-list').attr('prodid');
    quitarProductoDeLista(producto_id);
});

$(document).on('click', '#btn_menos', e => {
    e.preventDefault();
    let producto_id = $(e.target).parents('li#emt-list').attr('prodid');
    let cantidad = parseInt($(e.target).parents('div#cant_control').children('span#lbl_cant').html());
    let nueva_cant = cantidad - 1;
    if (nueva_cant == 0) {
        quitarProductoDeLista(producto_id);
        return;
    }
    $.ajax({
        url: '../../php/includes/carrito/cant_carrito_inc.php',
        type: 'POST',
        data: {'in_prodid':producto_id, 'in_cant':nueva_cant}
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
                case "not_aviable":
                    alert("No hay suficientes productos en stock.");
                    break;
            }
        } else {
            $('#lbl_total').html('$'+data.total);
            $('#hdr_carrito').html('$'+data.total);
            setNumber($(e.target), nueva_cant);
            setSubtotal($(e.target), nueva_cant);
        }
    });
});

$(document).on('click', '#btn_mas', e => {
    e.preventDefault();
    let producto_id = $(e.target).parents('li#emt-list').attr('prodid');
    let cantidad = parseInt($(e.target).parents('div#cant_control').children('span#lbl_cant').html());
    let nueva_cant = cantidad + 1;
    $.ajax({
        url: '../../php/includes/carrito/cant_carrito_inc.php',
        type: 'POST',
        data: {'in_prodid':producto_id, 'in_cant':nueva_cant}
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
                case "not_aviable":
                    alert("No hay suficientes productos en stock.");
                    break;
            }
        } else {
            $('#lbl_total').html('$'+data.total);
            $('#hdr_carrito').html('$'+data.total);
            setNumber($(e.target), nueva_cant);
            setSubtotal($(e.target), nueva_cant);
        }
    });
});

function quitarProductoDeLista(producto_id) {
    $.ajax({
        url: '../../php/includes/carrito/pop_carrito_inc.php',
        type: 'POST',
        data: {'in_prodid':producto_id}
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
            }
        } else {
            alert("Producto eliminado del carrito.");
            window.location.reload();
        }
    });
}

function setNumber(element, cant) {
    element.parents('div#cant_control').children('span#lbl_cant').html(cant);
}

function setSubtotal(element, cant) {
    const price = parseFloat(element.parents('li#emt-list').find('h6#lbl_price').attr('value'));
    element.parents('div#cant_control').children('span#lbl_subtotal').html('$'+(price*cant).toFixed(2));
}