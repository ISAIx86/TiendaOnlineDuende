$(document).ready(function(){

    $('#form_categoria').submit(function(e){
        let nombre_categoria = $('#txt_nombre').val();
        let descripcion = $('#txt_descrip').val();

        let todo_correcto = true;

        if (nombre_categoria === "") {
            alert("Ingrese un nombre de categoría.");
            todo_correcto = false;
        }
        else if (tienenNum(nombre_categoria)) {
            alert("El nombre no debe contener números.");
            todo_correcto = false;
        }
        else if (nombre_categoria.length > 32) {
            alert("Demasiados caracteres en el nombre.");
            todo_correcto = false;
        }

        if (descripcion === "") {
            alert("Ingrese un descripción.");
            todo_correcto = false;
        }
        else if (descripcion.length > 256) {
            alert("Demasiados caracteres en el nombre.");
            todo_correcto = false;
        }

        if (todo_correcto) {
            alert("¡Nueva Categoría creada!");
        }
        else {
            e.preventDefault();
        }

    });

});