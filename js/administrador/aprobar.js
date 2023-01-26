$(document).ready(function() {

    const urlParams = new URLSearchParams(window.location.search);

    $('#btn_auto').on('click', e => {
        $.ajax({
            url: "../../includes/productos/authorize_prod_inc.php",
            type: 'POST',
            data: {'in_prodid':urlParams.get('prod'), 'mode':'auto', 'submit':1}
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
                        alert("No se capturó el ID del producto.");
                        break;
                }
            } else {
                alert("Producto aceptado.");
                window.location.replace("a-listaAprobados.php");
            }
        });
    })

    $('#btn_deny').on('click', e => {
        $.ajax({
            url: "../../includes/productos/authorize_prod_inc.php",
            type: 'POST',
            data: {'in_prodid':urlParams.get('prod'), 'mode':'deny', 'submit':1}
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
                        alert("No se capturó el ID del producto.");
                        break;
                }
            } else {
                alert("Producto denegado.");
                window.location.replace("a-listaAprobados.php");
            }
        });
    })

});