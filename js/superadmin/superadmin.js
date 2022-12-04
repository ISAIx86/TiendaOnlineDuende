$(document).ready(function() {

    $('#form_login').submit(e => {
        e.preventDefault();
        if (!checkCorrectInputs($(e.target))) {
            alert("Algunos campos contienen errores o están vacíos.");
            return;
        }
        let formdata = new FormData($(e.target)[0]);
        formdata.append('submit', 1);
        $.ajax({
            url: '../../php/includes/superadmin/superadmin_login_inc.php',
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false
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
                    case "empty_inputs":
                        alert("Campos capturados vacíos.");
                        break;
                    case "not_found":
                        alert("No se pudo encontrar el usuario. Intentelo más tade.");
                        break;
                    case "wrong_password":
                        alert("Contraseña incorrecta.");
                        break;
                }
            } else {
                window.location.replace("sa-home.php");
            }
        });
    })

    bindFields();

});

function bindFields() {

    $('#txt_correo').on('change', function() {
        let contenido =  $(this).val();
        type_email($(this), contenido);
    });

    $('#txt_password').on('change', function() {
        let contenido =  $(this).val();
        $('#pass_format').hide();
        type_password($(this), contenido);
        $('#txt_confirm').trigger('change');
    });

}