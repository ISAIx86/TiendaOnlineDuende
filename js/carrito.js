$(document).ready(function (){

    $('#btn_pagar').on('click', e => {
        const products = $("div#lst_carrito").children().length;
        if (products > 0) {
            window.location.replace("c-pagando.php");
        }
    });

    $('#btn_clean').on('click', e => {
        const products = $("div#lst_carrito").children().length;
        if (products == 0) {
            return;
        }
        $.ajax({
            url: '../../php/includes/usuarios/limpiar_carrito_inc.php',
            type: 'POST'
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
                alert("Carrito vaciado.");
                window.location.reload();
            }
        });
    });

});

$(document).on('click', '#btn_quitar', e => {
    e.preventDefault();
    let producto_id = $(e.target).parents('li#emt-list').attr('prodid');
    quitarProductoDeLista(producto_id);
});

$(document).on('click', '#btn_menos', e => {
    e.preventDefault();
    let producto_id = $(e.target).parents('li#emt-list').attr('prodid');
    let cantidad = parseInt($(e.target).parents('div#cant_control').children('span#lbl_cant').html());
    let nueva_cant = cantidad - 1;
    if (nueva_cant == 0) {
        quitarProductoDeLista(producto_id);
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
            setNumber($(e.target), cantidad);
            setSubtotal($(e.target), cantidad);
        } else {
            $('#lbl_total').html('$'+data.total);
            $('#hdr_carrito').html('$'+data.total);
            setNumber($(e.target), nueva_cant);
            setSubtotal($(e.target), nueva_cant);
        }
    });
});

$(document).on('click', '#btn_mas', e => {
    e.preventDefault();
    let producto_id = $(e.target).parents('li#emt-list').attr('prodid');
    let cantidad = parseInt($(e.target).parents('div#cant_control').children('span#lbl_cant').html());
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
            setNumber($(e.target), cantidad);
            setSubtotal($(e.target), cantidad);
        } else {
            $('#lbl_total').html('$'+data.total);
            $('#hdr_carrito').html('$'+data.total);
            setNumber($(e.target), nueva_cant);
            setSubtotal($(e.target), nueva_cant);
        }
    });
});

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

function setNumber(element, cant) {
    element.parents('div#cant_control').children('span#lbl_cant').html(cant);
}

function setSubtotal(element, cant) {
    const price = parseFloat(element.parents('li#emt-list').find('h6#lbl_price').attr('value'));
    element.parents('div#cant_control').children('span#lbl_subtotal').html('$'+(price*cant).toFixed(2));
}

/*
function appendElement(prod) {
    $('#lst_carrito').append(
    '<li id="emt-list" prodid="'+prod.rs_id+'" class="list-group-item d-flex justify-content-between align-items-start">'+
        '<div class="row">'+
            '<div class="col-2">'+
                '<img src="../../'+prod.rs_img+'" class="d-block w-100" alt="...">'+
            '</div>'+
            '<div class="col-8">'+
                '<div class="fw-bold">'+prod.rs_titulo+'</div>'+
                '<h6>$'+prod.rs_precio+'</h6>'+
                '<span class="badge bg-primary rounded-pill">'+prod.rs_dispo+' disponibles</span>'+
                '</br>'+
                '<button>Guardar en lista</button>'+
                '<button>Ver productos similares</button>'+
            '</div>'+
            '<div id="cant_control" class="col-2">'+
                '<span class="badge bg-primary rounded-pill">$'+prod.rs_total+'</span>'+
                '</br>'+
                '<button id="btn_menos" class="btn btn-secondary btn-circle btn-sm">-</button>'+
                '<span id="lbl_cant" class="badge bg-primary rounded-pill">'+prod.rs_cantidad+'</span>'+
                '<button id="btn_mas" class="btn btn-secondary btn-circle btn-sm">+</button>'+
                '<form>'+
                '<button id="btn_quitar" class="btn btn-danger">Quitar</button>'+
                '</form>'+
            '</div>'+
        '</div>'+
    '</li>'
    );
}
*/