$(document).ready(function() {

    $('#btn_auto').on('click', e => {
        let id_cat = $(e.target).parents('tr#cat_row').attr('idcat');
        $.ajax({
            url: "../../php/includes/categorias/authorize_catego_inc.php",
            type: 'POST',
            data: {'in_catid':id_cat, 'mode':'auto', 'submit':1}
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
                alert("Categoría aceptada.");
                window.location.reload();
            }
        });
    })

    $('#btn_deny').on('click', e => {
        let id_cat = $(e.target).parents('tr#cat_row').attr('idcat');
        $.ajax({
            url: "../../php/includes/categorias/authorize_catego_inc.php",
            type: 'POST',
            data: {'in_catid':id_cat, 'mode':'deny', 'submit':1}
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
                alert("Categoría denegada.");
                window.location.reload();
            }
        });
    })

});