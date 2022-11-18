$(document).ready(function (){

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
            data.products.forEach(prod => {
                appendElement(prod);
            });
        }
    });

});

function appendElement(prod) {
    debugger;
    $('#lst_carrito').append(
    '<li id="emt-list" prodid="'+prod.out_id+'" class="list-group-item d-flex justify-content-between align-items-start">'+
        '<div class = "row">'+
            '<div class = "col-2">'+
                '<img src="../../resources/p01.PNG" class="d-block w-100" alt="...">'+
            '</div>'+
            '<div class = "col-8">'+
                '<div class="fw-bold">'+prod.rs_titulo+'</div>'+
                '<h6>'+prod.rs_cantidad+' x '+prod.rs_precio+'</h6>'+
                '<form>'+
                    '<div class = "row">'+
                        '<div class = "col-1">'+
                            '<button class="btn btn-warning">-</button>'+
                        '</div>'+
                        '<div class = "col-1">'+
                            '<button class="btn btn-info">'+prod.rs_cantidad+'</button>'+
                        '</div>'+
                        '<div class = "col-1">'+
                            '<button class="btn btn-success">+</button>'+
                        '</div>'+
                    '</div>'+
                '</form>'+
            '</div>'+
            '<div class = "col-2">'+
                '<span class="badge bg-primary rounded-pill">'+prod.rs_total+'</span>'+
                '<form>'+
                    '<button class="btn btn-danger">Quitar</button>'+
                '</form>'+
            '</div>'+
        '</div>'+
    '</li>'
    );
}