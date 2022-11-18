$(document).ready(function (){

    $('input[type="radio"][name="in_calif"]').on('change', function() {
        let value = $(this).val();
        alert("Tu calificación es de " + value + " estrellas.");
    });

    $('#btn_carrito').on('click', e => {
        const urlParams = new URLSearchParams(window.location.search);
        const cantidad = $('#txt_cantidad').val();
        $.ajax({
            url: '../../php/includes/productos/home_inc.php',
        type: 'GET',
        data: {'in_prodid':urlParams.get('prod'), 'in_cant':cantidad},
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
                
            }
        } else {
            alert("Producto añadido al carrito.");
        }
        })
    });

});