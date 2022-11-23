$(document).ready(function (){

    $('#btn_pagar').on('click', e => {
        const products = $("div#lst_carrito").children().length;
        if (products == 0) {
            return;
        }
        $.ajax({
            url: '../../php/includes/pedidos/nuevo_pedido_inc.php',
            type: 'POST',
            data: {'submit':'1'}
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
                
            } else {
                window.location.replace("c-compraExitosa.php");
            }
        });
    });

    llenarLista();

});

function llenarLista() {
    $.ajax({
        url: '../../php/includes/usuarios/carrito_inc.php',
        type: 'GET'
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
                case "no_query_results": {
                    $('#lst_carrito').append(
                        '<p>Carrito vacio</p>'
                    );
                }
            }
        } else {
            $('#lst_carrito').html("");
            if (data.total_sum) {
                $('#hdr_carrito').html("$"+data.total_sum);
                $('#lbl_total').html("$"+data.total_sum);
            }
            else {
                $('#hdr_carrito').html("$0");
                $('#lbl_total').html("$0");
            } 
            data.products.forEach(prod => {
                appendElement(prod);
            });
        }
    });
}

function appendElement(prod) {
    $('#lst_carrito').append(
    '<li class="list-group-item d-flex justify-content-between align-items-start">'+
        '<div class="row">'+
            '<div class="col-2">'+
                '<img src="../../resources/p01.PNG" class="d-block w-100" alt="...">'+
            '</div>'+
            '<div class="col-8">'+
                '<div class="fw-bold">'+prod.rs_titulo+'</div>'+
                '<h6>$'+prod.rs_precio+'</h6>'+
            '</div>'+
            '<div id="cant_control" class="col-2">'+
                '<span id="lbl_cant" class="badge bg-primary rounded-pill">Unidades: '+prod.rs_cantidad+'</span>'+
                '</br>'+
                '<span class="badge bg-primary rounded-pill">Total: $'+prod.rs_total+'</span>'+
            '</div>'+
        '</div>'+
    '</li>'
    );
}