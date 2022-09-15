$(document).ready(function (){

    $('input[type="radio"][name="in_calif"]').on('change', function() {
        let value = $(this).val();
        alert("Tu calificación es de " + value + " estrellas.");
    });

});