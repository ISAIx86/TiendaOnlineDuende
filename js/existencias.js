$(document).on('click', '#btn_addex', e => {
    let product = $(e.target).parents('tr#prod_row').attr('idprod');
    let cantidad = $(e.target).parents('tr#prod_row').find('input#txt_cant').val();
    if (cantidad == "") {
        return;
    }
    else {
        cantidad = parseInt(cantidad);
    }
    $.ajax({
        url: '../../php/includes/productos/add_exist.php',
        type: 'POST',
        data: {'in_prodid':product, 'in_cant':cantidad, 'submit':'1'}
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
            alert("Productos añadidos a STOCK.");
            window.location.reload();
        }
    });
});