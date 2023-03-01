var formSubmit = 1;
$(document).ready(function () {
    /* profile forms validation logics */
    $('.profileUpdatebtn').on('click', function (e) {
        e.preventDefault();
        var formName = $(this).closest('form').attr('name');
        $('form[name="' + formName + '"]').find('.required').each(function () {
            if ($(this).val() == '') {
                formSubmit = 0;
                $(this).addClass('is-invalid');
            } else {
                formSubmit = 1;
                $(this).removeClass('is-invalid');
            }
        });
    });
})
