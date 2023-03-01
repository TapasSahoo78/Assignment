"use strict";
var baseUrl = APP_URL + "/";

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
    $(document).on('click', 'button.loginsubmit', function (e) {
        e.preventDefault();
        var formSubmit = 1;

        $('form[name="loginform"]').find('input').each(function () {
            if ($(this).attr('type') == 'email') {
                var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                if (!pattern.test($(this).val())) {
                    formSubmit = 0;
                    $(this).attr('title', 'Please enter a valid email id');
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeAttr('title');
                    $(this).removeClass('is-invalid');
                }
            } else if ($(this).attr('type') == 'password') {
                if ($(this).val() == '') {
                    formSubmit = 0;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            }
        });

        if (formSubmit) {
            $('form[name="loginform"]').submit();
        }
    });

    $(document).on('click', 'input.registersubmit', function (e) {
        e.preventDefault();
        var formSubmit = 1;
        $('form[name="registerform"]').find('input').each(function () {
            if ($(this).attr('type') == 'checkbox') {
                //if($(this).is(":checked") == false){
                if (!$("input[type='checkbox'][name='terms']:checked").length) {
                    formSubmit = 0;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            } else if ($(this).attr('type') == 'text') {
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
        $('form[name="registerform"]').find('.select2bs4').each(function () {
            if ($(this).val() == '') {
                formSubmit = 0;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        console.log(formSubmit);
        if (formSubmit) {
            $(this).prop('disabled', true);
            $('form[name="registerform"]').submit();
        }
    });
    //     var $this = $(this);
    //     e.preventDefault();
    //     var acceptedArray = ['image/jpg', 'image/png', 'image/jpeg'];
    //     var file = e.target.files[0];
    //     if ($.inArray(file.type.toLowerCase(), acceptedArray) < 0) {
    //         $(this).addClass('is-invalid');
    //         $(this).attr('title', 'Please enter a valid image of type png or jpg');
    //         $(this).val('');
    //         $(this).parent().find('label.custom-file-label').html('<span class="text-danger">Invalid File Type</span>');
    //     } else if (file.size > (1024 * 1024)) {
    //         $(this).addClass('is-invalid');
    //         $(this).attr('title', 'Please enter a valid image of less than 1 MB');
    //         $(this).val('');
    //         $(this).parent().find('label.custom-file-label').html('<span class="text-danger">Invalid File Size</span>');
    //     } else {
    //         var imagesize = $('#imagesize').val();
    //         var maxImageWidth = 0, maxImageHeight = 0;
    //         var imageArray = (imagesize != null) ? imagesize.split('x') : '';
    //         maxImageWidth = imageArray.length > 0 ? imageArray[0] : 0;
    //         maxImageHeight = imageArray.length > 0 ? imageArray[1] : 0;
    //         var reader = new FileReader();
    //         reader.readAsDataURL(file);
    //         reader.onload = function (e) {
    //             var image = new Image();
    //             image.src = e.target.result;
    //             image.onload = function () {
    //                 var height = this.height;
    //                 var width = this.width;
    //                 if (height > maxImageHeight || width > maxImageWidth) {
    //                     $this.addClass('is-invalid');
    //                     $this.attr('title', 'Please enter a valid image in' + imagesize);
    //                     $this.val('');
    //                     $this.parent().find('label.custom-file-label').html('<span class="text-danger">Invalid File width & height</span>');
    //                     return false;
    //                 }
    //                 $this.removeAttr('title');
    //                 $this.removeClass('is-invalid');
    //                 $this.addClass('is-valid');
    //                 $this.parent().find('label.custom-file-label').html(file.name);
    //                 return true;
    //             };
    //         }
    //     }

    // });
    // $(document).on("change", ".getDistricts", function () {
    //     populateDistrict($(this));
    // });
});
