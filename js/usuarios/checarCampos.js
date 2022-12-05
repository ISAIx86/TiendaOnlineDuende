function checkAllFields() {
    $('#txt_nombres').trigger('change');
    $('#txt_apellidos').trigger('change');
    $('input[type="radio"][name="in_genero"]').trigger('change');
    $('input[type="radio"][name="in_privacidad"]').trigger('change');
    $('#cbx_rol').trigger('change');
    $('#txt_fechanac').trigger('change');
    $('#txt_correo').trigger('change');
    $('#txt_username').trigger('change');
    $('#txt_password').trigger('change');
    $('#txt_confirm').trigger('change');
}