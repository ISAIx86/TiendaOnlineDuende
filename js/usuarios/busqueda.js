const urlParams = new URLSearchParams(window.location.search);

$(document).ready(function() {

    const type = urlParams.get('srch_type');

    $('#txt_search').val(urlParams.get('in_search'))

    $('#srch_'+type).prop('checked', true);

});