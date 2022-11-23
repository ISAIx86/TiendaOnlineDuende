$(document).ready(function (){

    /*
    $.ajax({
        url: '../../php/includes/productos/home_inc.php',
        type: 'GET',
        data: {'mode':'vendidos'},
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
            setHtmlProdList($('#disp_vendidos'), data.products);
        }
    });

    $.ajax({
        url: '../../php/includes/productos/home_inc.php',
        type: 'GET',
        data: {'mode':'vistos'},
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
            setHtmlProdList($('#disp_vistos'), data.products);
        }
    });

    $.ajax({
        url: '../../php/includes/productos/home_inc.php',
        type: 'GET',
        data: {'mode':'recomendados'},
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
            setHtmlProdList($('#disp_recomend'), data.products);
        }
    });
    */

});

function setHtmlProdList(element, prods) {
    let allhtml = [""];
    let count = 0;
    let size = prods.length
    let rows = Math.ceil(size / 3.0);
    for (let i = 0; i < rows; i++) {
        allhtml[0] +=
        '<div class="carousel-item active">'+
        '   <div class = "row">';
        for (let j = 0; j < 3; j++) {
            if (count >= size) break;
            appendElement(allhtml, prods[count]);
            count++;
        }
        allhtml[0] +=
        '    </div>'+
        '</div>';
    }
    element.append(allhtml[0]);
}

function appendElement(htmltext, info) {
    htmltext[0] +=
    '<div class = "col-4">' +
        '<div class="card" style="width: 18rem;">'+
            '<img src="../../'+info.rs_img+'" class="card-img-top" alt="...">'+
            '<div class="card-body">'+
                '<h5 class="card-title">'+info.rs_titulo+'</h5>'+
                '<p class="card-text">'+info.rs_descripcion+'</p>'+
                '<p class="card-text">$ '+info.rs_precio+'</p>'+
                '<a href="../producto/c-producto.php?prod='+info.rs_id+'" class="btn btn-primary">Ver detalles</a>'+
            '</div>'+
        '</div>'+
    '</div>';
}