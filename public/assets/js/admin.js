$(document).ready(function () {

    // validate and process login form
    $('.frm_admin_login-d').validate({
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
            error.insertAfter(element.closest('div'));
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
                            console.log(response);
                           let type = response.data.type

                           if(type == 'admin')
                           {
                               window.location.href = adminDashboard;
                           }
                           else
                           {
                               return false;
                           }

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
});
