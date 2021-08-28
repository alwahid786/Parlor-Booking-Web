$(function(event) {

    // Validate and then process registeration form
    $('#frm_signup-d').validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                minlength: 6,
            },
            phone_code: {
                required: true,
                maxlength: 3,
            },
            phone_number: {
                required: true,
                minlength: 10,
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: '.pswd_password-d'
            },
        },
        messages: {

            name: {
                required: "Name is Required.",
                minlength: "Name Should have atleast 3 characters",
            },
            email: {
                required: "Email is Required",
                minlength: "Email Should have atleast 5 characters",
                email: "Email Format is not valid"
            },
            phone_code: {
                required: "Phone code is Required.",
                maxlength: "Phone code Should have max 3 digits",
            },
            phone_number: {
                required: "Phone number is Required.",
                minlength: "Phone number Should have atleast 10 digits",
            },
            password: {
                required: "Password is Required.",
                minlength: "Password Should have atleast 8 characters",
            },

        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error text-danger');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            // console.log('submit handler');
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response) {
                    if (response.status == true) {

                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            // console.log(response);
                            // return false;
                            $('.email-d').val(response.data.user.email);
                            window.location.href = verify_account_page_link + '?email=' + response.data.user.email;

                        });
                    } else {
                        errorAlert(response.message);
                    }
                },
                error: function(xhr, message, code) {
                    response = xhr.responseJSON;
                    if (404 == response.exceptionCode) {
                        let container = $('.pswd_password-d').parent();
                        if ($(container).find('.error').length > 0) {
                            $(container).find('.error').remove();
                        }
                        $(container).append("<span class='error'>" + response.message + "</span>");
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            // location.reload();
                            // $('#frm_donate-d').trigger('reset');
                        });
                    }
                    // console.log(xhr, message, code);
                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });


    // validate and process login form
    $('#frm_login-d').validate({
        ignore: ".ignore",
        rules: {
            email: {
                required: true,
                minlength: 6,
            },
            password: {
                required: true,
                minlength: 8
            },
        },
        messages: {

            email: {
                required: "Email is Required",
                minlength: "Email Should have atleast 5 characters",
                email: "Email Format is not valid"
            },
            password: {
                required: "Password is Required.",
                minlength: "Password Should have atleast 8 characters",
            },

        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error text-danger');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            // console.log('submit handler');
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response) {
                    if (response.status == true) {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            // console.log(response);
                            // return false;
                            // window.location.href = verify_account_page_link + '?email=' + response.data.user.email;
                            window.location.href = SaloonDashboard + '?uuid=' + response.data.user.uuid;

                            // return false;

                        });
                    } else {
                        errorAlert(response.message);
                    }
                },
                error: function(xhr, message, code) {
                    response = xhr.responseJSON;
                    if (404 == response.exceptionCode) {
                        let container = $('.pswd_password-d').parent();
                        if ($(container).find('.error').length > 0) {
                            $(container).find('.error').remove();
                        }
                        $(container).append("<span class='error'>" + response.message + "</span>");
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            // location.reload();
                            // $('#frm_donate-d').trigger('reset');
                        });
                    }
                    // console.log(xhr, message, code);
                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });


    // move to next input field
    $('#frm_validate_code-d').on('keydown', '.v_code-d', function(e) {
        let elm = $(this);
        let text = $(elm).val().trim();

        if (text.length > 0) {
            if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
                $(elm).val('');
            }
        }
    });


    $('#frm_validate_code-d').on('keyup', '.v_code-d', function(e) {
        let elm = $(this);
        let text = $(elm).val().trim();
        console.log('ok');

        if (text.length > 0) {
            if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)) {
                if ($(elm).hasClass('last-d') == false) {
                    $(elm).trigger('focusout');
                    let nextInputElm = $(elm).closest('.code_border-d').next().find('.v_code-d');
                    $(nextInputElm).trigger('focusin').focus();
                }
            }
        }

        // set hidden field in form to send in request
        let codeValue = '';
        $.each($('.v_code-d'), function(index, elm) {
            let elmValue = $(elm).val();
            if (elmValue == '') {
                codeValue = '';
                return;
            }
            codeValue += elmValue;
        });
        $('#hdn_activation_code-d').val(codeValue).attr('value', codeValue);
        $('#hdn_set_pass_activation_code-d').val(codeValue).attr('value', codeValue);
    });




    //validate Activation code
    $('#frm_validate_code-d').validate({
        ignore: ".ignore",
        rules: {
            email: {
                required: true,
                email: true,
                minlength: 5,
            },
            activation_code: {
                required: true,
                minlength: 4
            },
            number_box_1: {
                required: true,
                min: 0,
                max: 9,
                maxlength: 1
            },
            number_box_2: {
                required: true,
                min: 0,
                max: 9,
                maxlength: 1
            },
            number_box_3: {
                required: true,
                min: 0,
                max: 9,
                maxlength: 1
            },
            number_box_4: {
                required: true,
                min: 0,
                max: 9,
                maxlength: 1
            }
        },
        messages: {
            email: {
                required: "Email is Required",
                minlength: "Email Should have atleast 5 characters",
                email: "Email Format is not valid"
            },
            activation_code: {
                required: "Activation Code is Required.",
                minlength: "Activation Code Should have atleast 4 characters",
            },
            number_box_1: {
                required: '***',
                max: 'max 09',
                maxlength: "Length = 1"
            },
            number_box_2: {
                required: '***',
                max: 'max 09',
                maxlength: "Length = 1"
            },
            number_box_3: {
                required: '***',
                max: 'max 09',
                maxlength: "Length = 1"
            },
            number_box_4: {
                required: '***',
                max: 'max 09',
                maxlength: "Length = 1"
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error text-danger');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            // console.log('submit handler');
            let type = $('.type-d').val();
            if (type == 'reset_password') {
                // alert(ResetPassword);
                window.location.href = ResetPassword + '?code=' + $("#hdn_activation_code-d").val() + '&email=' + $(".email-d").val();
                // window.location.href = ResetPassword;
                // return false;
            } else {
                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: $(form).serialize(),
                    beforeSend: function() {
                        showPreLoader();
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                console.log(response);
                                // return false;
                                // if (type == 'reset_password') {
                                //     window.location.href = ResetPassword;
                                // } else {
                                window.location.href = SaloonDashboard;
                                // }
                            });
                        } else {
                            errorAlert(response.message);
                        }
                    },
                    error: function(xhr, message, code) {
                        response = xhr.responseJSON;
                        Swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            // do nothing
                        });
                        // console.log(xhr, message, code);
                        hidePreLoader();
                    },
                    complete: function() {
                        hidePreLoader();
                    },
                });
                return false;
            }


        }
    });


    // Forogot password
    $('#frm_forgot_password-d').validate({
        ignore: ".ignore",
        rules: {
            reference: {
                required: true,
                email: true,
                minlength: 5,
            },

        },
        messages: {
            reference: {
                required: "Email is Required",
                minlength: "Email Should have atleast 5 characters",
                email: "Email Format is not valid"
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error text-danger');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            // console.log('submit handler');

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            // return false;
                            // $('#validate_code_container-d').hide();
                            // $('#set_password_container-d').show();
                            console.log(response.data);
                            window.location.href = enterCode + '?email=' + response.data.name + '&type=' + 'reset_password';
                        });
                    } else {
                        errorAlert(response.message);
                    }
                },
                error: function(xhr, message, code) {
                    response = xhr.responseJSON;
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        // do nothing
                    });
                    // console.log(xhr, message, code);
                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });



    //Reset code
    $('#frm_reset_password-d').validate({
        ignore: ".ignore",
        rules: {
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: '.reset_password-d'
            },

        },
        messages: {
            password: {
                required: "Password is Required.",
                minlength: "Password Should have atleast 8 characters",
            },
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            // console.log(label, element);
            $(element).removeClass('error text-danger');
            $(element).parent().find('span.error').remove();
        },
        submitHandler: function(form) {
            // console.log('submit handler');

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        }).then((result) => {
                            // return false;
                            // $('#validate_code_container-d').hide();
                            // $('#set_password_container-d').show();
                            // console.log(response.data);
                            window.location.href = SaloonLogin;
                        });
                    } else {
                        errorAlert(response.message);
                    }
                },
                error: function(xhr, message, code) {
                    response = xhr.responseJSON;
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        // do nothing
                    });
                    // console.log(xhr, message, code);
                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        }
    });



});