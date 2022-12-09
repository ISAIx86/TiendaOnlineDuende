$(document).ready(function(){

    const urlParams = new URLSearchParams(window.location.search);

    $('#btn_accept').on('click', e => {
        $.ajax({
            url: "../../php/includes/cotizaciones/aceptar_inc.php",
            type: 'POST',
            data: {'in_cotid':urlParams.get('cotiz')}
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
                    case "uncaptured_admin":
                        alert("No se capturó el ID del administrador.");
                        break;
                    case "uncaptured_id":
                        alert("No se capturó el ID de categoría.");
                        break;
                    case "no_vend_offer":
                        alert("El vendedor aún no ha propuesto su precio final.");
                        break;
                }
            } else {
                alert("Cotizacion aceptada.");
                window.location.replace("c-cotizaciones.php");
            }
        });
    });

    $('#btn_cambiar_v').on('click', e => {
        const id = urlParams.get('cotiz');
        const subtotal = $('#txt_precio').val();
        const cantidad = $('#txt_cantidad').val();
        if (cantidad == "") {
            alert("El campo de cantidad está vacío.");
            return;
        } else if (cantidad == 0) {
            alert("La cantidad debe ser mayor a cero.");
            return;
        }
        if (subtotal == "") {
            alert("El campo de precio unitario está vacío.");
            return;
        }
        else if (!validarPrecio(subtotal)) {
            alert("El formato de precio es inválido.");
            return;
        }
        $.ajax({
            url: "../../php/includes/cotizaciones/cambiar_cotiz.php",
            type: 'POST',
            data: {'in_idcot':id, 'mode':'v', 'in_sub':subtotal, 'in_cant':cantidad}
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
                    case "uncaptured_admin":
                        alert("No se capturó el ID del administrador.");
                        break;
                    case "uncaptured_id":
                        alert("No se capturó el ID de categoría.");
                        break;
                }
            } else {
                alert("Cotizacion cambiada.");
                window.location.replace("v-cotizaciones.php");
            }
        });
    });

    $('#btn_cambiar_c').on('click', e => {
        const id = urlParams.get('cotiz');
        const subtotal = $('#txt_precio').val();
        const cantidad = $('#txt_cantidad').val();
        if (cantidad == "") {
            alert("El campo de cantidad está vacío.");
            return;
        } else if (cantidad == 0) {
            alert("La cantidad debe ser mayor a cero.");
            return;
        }
        if (subtotal == "") {
            alert("El campo de precio unitario está vacío.");
            return;
        }
        else if (!validarPrecio(subtotal)) {
            alert("El formato de precio es inválido.");
            return;
        }
        $.ajax({
            url: "../../php/includes/cotizaciones/cambiar_cotiz.php",
            type: 'POST',
            data: {'in_idcot':id, 'mode':'c', 'in_sub':subtotal, 'in_cant':cantidad}
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
                    case "uncaptured_admin":
                        alert("No se capturó el ID del administrador.");
                        break;
                    case "uncaptured_id":
                        alert("No se capturó el ID de categoría.");
                        break;
                }
            } else {
                alert("Cotizacion cambiada.");
                window.location.replace("c-cotizaciones.php");
            }
        });
    });

    $('#btn_deny_v').on('click', e => {
        $.ajax({
            url: "../../php/includes/cotizaciones/denegar_inc.php",
            type: 'POST',
            data: {'in_cotid':urlParams.get('cotiz')}
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
                    case "uncaptured_admin":
                        alert("No se capturó el ID del administrador.");
                        break;
                    case "uncaptured_id":
                        alert("No se capturó el ID de categoría.");
                        break;
                }
            } else {
                alert("Cotizacion denegada.");
                window.location.replace("v-cotizaciones.php");
            }
        });
    });

    $('#btn_deny_c').on('click', e => {
        $.ajax({
            url: "../../php/includes/cotizaciones/denegar_inc.php",
            type: 'POST',
            data: {'in_cotid':urlParams.get('cotiz')}
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
                    case "uncaptured_admin":
                        alert("No se capturó el ID del administrador.");
                        break;
                    case "uncaptured_id":
                        alert("No se capturó el ID de categoría.");
                        break;
                }
            } else {
                alert("Cotizacion denegada.");
                window.location.replace("c-cotizaciones.php");
            }
        });
    });

});