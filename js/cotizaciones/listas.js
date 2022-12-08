$(document).ready(function(){

    $('#btn_del').on('click', e => {
        let id_cot = $(e.target).parents('li#cot_row').attr('cotid');
        $.ajax({
            url: "../../php/includes/cotizaciones/denegar_inc.php",
            type: 'POST',
            data: {'in_cotid':id_cot}
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
                window.location.reload();
            }
        });
    });

});