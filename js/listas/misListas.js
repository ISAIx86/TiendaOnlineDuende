$(document).ready(function() {

    $('#btn_del').on('click', e => {
        const urlParams = new URLSearchParams(window.location.search);
        $.ajax({
            url: '../../php/includes/listas/',
            type: 'POST',
            data: {'id_lista':urlParams.get('list'), 'submit':1}
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
                alert("Lista creada.");
                window.location.reload();
            }
        });
    })

});