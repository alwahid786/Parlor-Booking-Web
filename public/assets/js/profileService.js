$(function(event) {

    // add saloon services
    $('#frm_add_service-d').validate({
        ignore: ".ignore",
        rules: {
            service_name: {
                required: true,
                minlength: 3,
            },
            price: {
                required: true,
                minlength: 1
            },
        },
        messages: {

            service_name: {
                required: "Service name is Required",
                minlength: "Service name Should have atleast 3 characters",
            },
            price: {
                required: "Service price is Required",
                minlength: "Service price Should have atleast 1 doller",
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
                            console.log(response);
                            location.reload();
                            // return false;
                            // window.location.href = SaloonDashboard + '?uuid=' + response.data.user.uuid;
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




    $('#add_service-d').on('click', function(e) {
        let modal = $('#exampleModal').modal();
        $(modal).find('.edit_service_name-d').val('');
        $(modal).find('.edit_service_price-d').val('');
        $(modal).find('.edit_service_uuid-d').val('');
        // $("input").removeClass('edit_service_uuid-d');
        // $('input[type=hidden]').removeAttr('name');
        $(modal).find('.edit-d').text('Save');

        $("#exampleModal").modal('show');
    })


    $(`.edit_service-d`).on('click', function(e) {
        let elm = $(this);
        let parent1 = $(elm).parent().parent().attr('id');
        // console.log($(elm).parent().parent().attr('class'));

        // console.log(parent1);

        // alert($(`#${parent1}`).find('.service_name-d').text());
        // console.log($(parent1));

        let service_name = $(`#${parent1}`).find('.service_name-d').text();
        let service_price = $(`#${parent1}`).find('.service_price-d').text();
        let result_price = service_price.replace('$', '');
        let service_uuid = $(`#${parent1}`).find('.service_uuid').val();

        $(".edit_service_name-d").val(service_name);
        $(".edit_service_price-d").val(result_price);
        $(".edit_service_uuid-d").val(service_uuid);
        $(".edit-d").text('Edit');

        $("#exampleModal").modal('show');
    });

});