$(document).ready(function() {

    checkAllFields();

});

function checkAllFields() {
    $('#fle_img').trigger('change');
    $('#txt_nombre').trigger('change');
    $('#txt_descrip').trigger('change');
}