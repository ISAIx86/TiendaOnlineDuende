$(document).ready(function() {

    $('#form_registro').submit( e => {
        let campos = $('#form_registro').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });

        if (!todoCorrecto) {
            e.preventDefault();
            alert("Algunos campos contienen errores o están vacíos.");
        }
    });

    $('#form_registro_upd').submit( e => {
        let campos = $('#form_registro_upd').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });
        if (todoCorrecto) {
            
        }
        else {
            
        }
    });

    $('#form_correo_upd').submit( e => {
        let campos = $('#form_correo_upd').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });
        if (todoCorrecto) {
            
        }
        else {
            
        }
    })

    $('#form_contra_upd').submit( e => {
        let campos = $('#form_contra_upd').children('div[requerido="true"]').toArray();
        let todoCorrecto = true;
        todoCorrecto = !campos.some(campo => {
            return campo.getAttribute('state') !== "succ";
        });
        if (todoCorrecto) {
            
        }
        else {
            
        }
    })

});