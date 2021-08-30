$(function(event) {

    // accept appointment
    $(".main_container-d").on("click", '.approve-d', function() {
        let uuid = $(this).data("setid");
        $.ajax({
            url: "http://localhost/glitterups/accpet-appointment/" + uuid,
            type: 'POST',
            // dataType: 'json',
            data: { uuid, uuid },
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

                        setTimeout(function() {
                            $(".main_container-d").find('.single_container-d').attr("data-container").fadeOut(1500);
                        }, 5000);
                        location.reload();
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
    })

    // cancel appointment
    $(".main_container-d").on("click", '.cancel-d', function() {
        let uuid = $(this).data("setid");

        $.ajax({
            url: "http://localhost/glitterups/cancel-appointment/" + uuid,
            type: 'POST',
            // dataType: 'json',
            data: { uuid, uuid },
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

                        setTimeout(function() {
                            $(".main_container-d").find('.single_container-d').attr("data-container").fadeOut(1500);
                        }, 5000);
                        location.reload();
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
    });





    $(function() {
        // let appointments = $(`.appointment_dates`).val();
        let appointments = [];
        // console.log('appointments: ', appointments);
        $('.appointment_dates').each(function(i, elm) {
            appointments.push($(elm).val());
        });

        //impt syntax
        // (function(next) {
        //     next();
        // }(function() {
        // }));


        let current_date = (new Date()).toISOString().split('T')[0];
        // console.log(current_date);
        let past_appointments = [];
        let future_appointments = [];
        $.each(appointments, function(i, elm) {
            if (current_date > elm) {
                past_appointments.push(elm);
            } else {
                future_appointments.push(elm);
            }
            // console.log(elm);
        });

        console.log(future_appointments.length);

        if (0 != future_appointments.length) {

            $.each(future_appointments, function(i, elm) {
                $('.calendar').pignoseCalendar({
                    theme: 'blue', // light, dark, blue,
                    scheduleOptions: {
                        colors: {
                            offer: '#2fabb7',
                        }
                    },
                    schedules: [{
                        name: 'offer',
                        date: elm

                    }],
                    // date: '2021-08-29',
                    disabledDates: past_appointments
                });
                console.log('elm: ', elm);
            })
        } else {
            console.log('ok');
            $.each(past_appointments, function(i, elm) {
                $('.calendar').pignoseCalendar({
                    theme: 'blue', // light, dark, blue,

                    // date: '2021-08-29',
                    disabledDates: past_appointments
                });
                console.log('elm: ', elm);
            })
        }




        // $('.calendar').pignoseCalendar({
        //     theme: 'blue', // light, dark, blue,

        //     disabledDates: past_appointments,

        // });

    });

});