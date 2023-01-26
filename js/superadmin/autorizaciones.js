$(document).on('click', '#btn_auto', e => {
    let id_usuario = $(e.target).parents('tr#adm_row').attr('idusu');
    $.ajax({
        url: '../../includes/superadmin/authorize_admin_inc.php',
        type: 'POST',
        data: {'in_userid':id_usuario, 'submit':1}
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
                case "no_query_results":
                    alert("No hubo resultados en la base de datos.");
                    break;
                case "empty_inputs":
                    alert("Campos capturados vacíos.");
                    break;
                case "uncaptured_id":
                    alert("No se capturo correctamente el ID de super administrador.");
                    break;
            }
        } else {
            alert("Administrador autorizado.")
            window.location.reload();
        }
    });
})
