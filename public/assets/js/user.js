$(document).ready(function () {

    $('.passwordHideShow').on('click', function () {
        $(this).find('.passwordHidden').toggleClass('d-none');
        $(this).find('.passwordShowed').toggleClass('d-none');
        var input = $(this).parent().parent().parent().find('.passwordField');
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    $('.userAddbtn').on('click', function (e) {
        e.preventDefault();
        var formSubmit = 1;
        var formName = $(this).closest('form').attr('name');
        $('form[name="' + formName + '"]').find('.required').each(function () {
            if ($(this).attr('type') == 'text') {
                if ($(this).val() == '') {
                    formSubmit = 0;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            } else if ($(this).attr('type') == 'email') {
                var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                var pattern2 = /[@]/;
                if (!pattern.test($(this).val())) {
                    formSubmit = 0;
                    $(this).attr('title', 'Please enter a valid email id');
                    $('#emailError').removeClass('d-none');
                    $('#emailError').addClass('d-block');
                    $('#emailError').html(`Please enter a valid email address`);
                    $(this).addClass('is-invalid');
                }
                else if (!pattern2.test($(this).val())) {
                    formSubmit = 0;
                    $(this).attr('title', 'An email address must contain a single @');
                    $('#emailError').removeClass('d-none');
                    $('#emailError').addClass('d-block');
                    $('#emailError').html(`An email address must contain a single @`);
                    $(this).addClass('is-invalid');
                }
                else {
                    $(this).removeAttr('title');
                    $('#emailError').removeClass('d-block');
                    $('#emailError').addClass('d-none');
                    $('#emailError').html("");
                    $(this).removeClass('is-invalid');
                }
            } else if ($(this).attr('type') == 'password') {
                var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/;
                if ((!pattern.test($(this).val()))) {
                    formSubmit = 0;
                    $(this).addClass('is-invalid');
                    $(this).attr('title', 'Your password must have a minimum of 6 characters, uppercase letter, lowercase letter and a number');
                } else {
                    $(this).removeAttr('title');
                    $(this).removeClass('is-invalid');
                }
            } else {
                if ($(this).val() == '') {
                    formSubmit = 0;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            }
        });
        if (formSubmit == 1) {
            $('form[name="' + formName + '"]').submit();
        }
    })
})
