$(document).ready(function() {
    checkAllInputs();
});

function checkAllInputs() {

    $('#fle_media').trigger('change');
    $('#txt_nombre').trigger('change');
    $('#txt_descrip').trigger('change');
    $('#txt_dispo').trigger('change');
    $('#txt_precio').trigger('change');

}