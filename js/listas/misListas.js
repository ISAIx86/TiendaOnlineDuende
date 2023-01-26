$(document).ready(function() {

    $('#btn_del').on('click', e => {
        let id_list = $(e.target).parents('li#list_row').attr('listid');
        $.ajax({
            url: '../../includes/listas/del_list_inc.php',
            type: 'POST',
            data: {'id_lista':id_list, 'submit':1}
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
                    
                }
            } else {
                alert("Lista eliminada.");
                window.location.reload();
            }
        });
    })

});