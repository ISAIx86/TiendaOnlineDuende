$(document).ready(function() {

    $('a#btn_del').on('click', e => {
        const urlParams = new URLSearchParams(window.location.search);
        let id_prod = $(e.target).attr('idprod');
        $.ajax({
            url: '../../php/includes/listas/del_prod_inc.php',
            type: 'POST',
            data: {'id_lista':urlParams.get('list'), 'id_prod':id_prod, submit:1}
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
                        alert("No hubo resultados en la consulta.");
                        break;
                    case "uncaptured_list":
                        alert("No se encontró ID de lista.");
                        break;
                    case "uncaptured_prod":
                        alert("No se encontró ID de producto.");
                        break;
                }
            } else {
                alert("Producto quitado de la lista");
                window.location.reload();
            }
        });
    });

});