$(document).ready(function (){

    llenarLista();

});

$(document).on('click', '#btn_quitar', e => {
    e.preventDefault();
    let producto_id = $(e.target).parents('li#emt-list').attr('prodid');
    quitarProductoDeLista(producto_id);
});

$(document).on('click', '#btn_menos', e => {
    e.preventDefault();
    let producto_id = $(e.target).parents('li#emt-list').attr('prodid');
    let cantidad = parseInt($(e.target).parents('div#cant_control').find('button#lbl_cant').html());
    let nueva_cant = cantidad - 1;
    if (nueva_cant == 0) {
        quitarProductoDeLista(producto_id);
        llenarLista();
        return;
    }
    $.ajax({
        url: '../../php/includes/usuarios/cant_carrito_inc.php',
        type: 'POST',
        data: {'in_prodid':producto_id, 'in_cant':nueva_cant}
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
            $('#lbl_cant').html(cantidad);
        } else {
            llenarLista();
        }
    });
});

$(document).on('click', '#btn_mas', e => {
    e.preventDefault();
    let producto_id = $(e.target).parents('li#emt-list').attr('prodid');
    let cantidad = parseInt($(e.target).parents('div#cant_control').find('button#lbl_cant').html());
    let nueva_cant = cantidad + 1;
    $.ajax({
        url: '../../php/includes/usuarios/cant_carrito_inc.php',
        type: 'POST',
        data: {'in_prodid':producto_id, 'in_cant':nueva_cant}
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
            $('#lbl_cant').html(cantidad);
        } else {
            llenarLista();
        }
    });
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

function quitarProductoDeLista(producto_id) {
    $.ajax({
        url: '../../php/includes/usuarios/pop_carrito_inc.php',
        type: 'POST',
        data: {'in_prodid':producto_id}
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
            alert("Producto eliminado del carrito.");
            window.location.reload();
        }
    });
}

function appendElement(prod) {
    $('#lst_carrito').append(
    '<li id="emt-list" prodid="'+prod.rs_id+'" class="list-group-item d-flex justify-content-between align-items-start">'+
        '<div class = "row">'+
            '<div class = "col-2">'+
                '<img src="../../resources/p01.PNG" class="d-block w-100" alt="...">'+
            '</div>'+
            '<div class = "col-8">'+
                '<div class="fw-bold">'+prod.rs_titulo+'</div>'+
                '<h6>'+prod.rs_cantidad+' x '+prod.rs_precio+'</h6>'+
                '<form>'+
                    '<div id="cant_control" class = "row">'+
                        '<div class = "col-1">'+
                            '<button id="btn_menos" class="btn btn-warning">-</button>'+
                        '</div>'+
                        '<div class = "col-1">'+
                            '<button id="lbl_cant" class="btn btn-info">'+prod.rs_cantidad+'</button>'+
                        '</div>'+
                        '<div class = "col-1">'+
                            '<button id="btn_mas" class="btn btn-success">+</button>'+
                        '</div>'+
                    '</div>'+
                '</form>'+
            '</div>'+
            '<div class = "col-2">'+
                '<span class="badge bg-primary rounded-pill">'+prod.rs_total+'</span>'+
                '<form>'+
                    '<button id="btn_quitar" class="btn btn-danger">Quitar</button>'+
                '</form>'+
            '</div>'+
        '</div>'+
    '</li>'
    );
}