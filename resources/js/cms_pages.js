$(function(event) {

    // let pageUrl = new URL(window.location.href);
    // let last_page = pageUrl.searchParams.get('last_page');
    // if (null != last_page) {
    //     if ('profile' == last_page) {
    //         $('#sidebar-wrapper').find('.list-group-item-action').hide();
    //         $('#sidebar-wrapper').find('.cms_pages-d').show();
    //         $('#sidebar-wrapper').find('.logout_link-d').show();

    //         // $('.logo_link-d').attr('href', 'javascript:void(0)');
    //         $('.notification_link-d').attr('href', 'javascript:void(0)');
    //         $('.top_nav_bar_profile_setting_link-d').hide();
    //         $('.top_nav_bar_profile_divider-d').hide();
    //     }
    // }

    $('#frm_contact_us-d').validate({
        ignore: ".ignore",
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            email: {
                required: true,
                email: true,
            },
            subject: {
                required: true,
                minlength: 3,
            },
            message: {
                required: true,
                minlength: 5,
            },
        },
        messages: {
            name:{
                required: "Name is required.",
                minlength: "minimum 3 Characters are required in Name",
            },
            email:{
                required: "Email is required.",
                email: "Email format is invalid.",
            },
            subject:{
                required: "Subject is required.",
                minlength: "minimum 3 Characters are required in Email Subject",
            },
            message:{
                required: "Email Message is required.",
                minlength: "minimum 5 Characters are required in Email Message Body",
            },
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.closest('div'));
        },
        success: function(label, element) {
            label.parent().removeClass('error');
            label.remove();
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $(form).serialize(),
                beforeSend: function() {
                    showPreLoader();
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        $(form).trigger('reset');
                        // console.log(response);
                        // let modal = $(form).parents('modal');
                        // $(modal).find('.job_uuid-d').val('');
                        // $(modal).modal('hide');
                        // window.location.href = booking_page_url;
                    });
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
                        // location.reload();
                        // $('#frm_donate-d').trigger('reset');
                    });
                    // console.log(xhr, message, code);
                    hidePreLoader();
                },
                complete: function() {
                    hidePreLoader();
                },
            });
            return false;
        },
    });
});
