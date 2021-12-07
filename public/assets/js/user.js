$(document).ready(function() {
    // alert('helo');
    //  $('#inline-picker').mobiscroll().datepicker({
    //        calendarType: 'week',
    //         weeks: 1

    //         //   controls: ['calendar'],
    //         //     display: 'inline',
    //         //     touchUi: true
    // });

        window.isMbscDemo = true;

    //       mobiscroll.setOptions({
    //     locale: mobiscroll.localeEn,  // Specify language like: locale: mobiscroll.localePl or omit setting to use default
    //     theme: 'ios',                 // Specify theme like: theme: 'ios' or omit setting to use default
    //         themeVariant: 'light'     // More info about themeVariant: https://docs.mobiscroll.com/5-9-1/calendar#opt-themeVariant
    // });

    // var myCalendar = $('#demo').mobiscroll().datepicker({
    //         controls: ['calendar'],
    //         touchUi: true,  // More info about controls: https://docs.mobiscroll.com/5-9-1/calendar#opt-controls
    //         display: 'inline',        // Specify display mode like: display: 'bottom' or omit setting to use default
    //         calendarType: 'week',
    //         weeks: 1,                 // More info about weeks: https://docs.mobiscroll.com/5-9-1/calendar#opt-weeks
    //         renderCalendarHeader: function () {
    //             return '<div mbsc-calendar-nav class="custom-view-nav"></div><div class="custom-view">' +
    //                 '<label id="calendar_div-d"><input data-icon="material-date-range" mbsc-segmented type="radio" name="view" value="week" class="view-change" checked></label>' +
    //                 '<label><input data-icon="material-event-note" mbsc-segmented typce="radio" name="view" value="month" class="view-change"></label></div>' +
    //                 '<div mbsc-calendar-prev></div>' +
    //                 '<div mbsc-calendar-next></div>';
    //         }
    //     });

    //     document.querySelectorAll('.view-change').forEach(function (elm) {
    //         elm.addEventListener('change', function (ev) {
    //             switch (ev.target.value) {
    //                 case 'week':
    //                     myCalendar.setOptions({
    //                         calendarType: 'week'
    //                     });
    //                 break;
    //             case 'month':
    //                     myCalendar.setOptions({
    //                         calendarType: 'month'
    //                     });
    //                 break;
    //             }
    //         });
    //     });

    // $('#input-picker').mobiscroll().datepicker({
    //     controls: ['calendar'],
    //     touchUi: true
    // });

    // var change = ('.mbsc-popup-button-primary').mobiscroll().datepicker({
    //     onCellClick: function (event, inst) {
    //     alert('clicker');
    // }
    // });

    // $("").on('click', function() {
    //     alert('clicker');
    //     alert($('.date').val());
    // })


    // if($("#main_container-d").length > 0) {
    //     $("#main_container-d").remove();
    //     console.log('remove');
    // }


     $('input.calendar').pignoseCalendar({
		format: 'YYYY-MM-DD', // date format string. (2017-02-02)
        // buttons:true, //
        // date: moment(),

     click(event, context){
        let date = $("#text-calendar").val();
        let salon_uuid = $(".salon_uuid-d").val();

        // alert(SalonBookTime);
        $(".booking_date-d").val(date);

        $.ajax({
            type: "Post",
            url: SalonBookTime,
            data: {date: date, salon_uuid: salon_uuid},
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.status == true) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        console.log(response.data);

                        let all_slots = response.data.all_slots;
                            console.log('all_slots: ', all_slots);

                        // console.log($("#main_container-d").length);

                        if($("#available_slot_single_container-d").length > 0)
                        {
                            $(".available_slots_main_container-d").html("");
                            $.each(all_slots, function(i, elm){
                                    let clonedElm = $("#available_slot_single_container-d").clone();
                                    clonedElm.removeAttr('id');
                                    // $(clonedElm).find('.available_slots').text

                                    const converTime = (time) => {
                                        let hour = (time.split(':'))[0]
                                        let min = (time.split(':'))[1]
                                        let part = hour > 12 ? 'pm' : 'am';

                                        min = (min+'').length == 1 ? `0${min}` : min;
                                        hour = hour > 12 ? hour - 12 : hour;
                                        hour = (hour+'').length == 1 ? `0${hour}` : hour;

                                        return (`${hour}:${min} ${part}`)
                                        }

                                        console.log(converTime(elm), 'ok');

                                        let time = converTime(elm);

                                        let id = i+1;
                                    clonedElm.find('.available_slots').prop('id', 'newID'+id);

                                    let contract_time = elm.slice(0,5);

                                    clonedElm.find('.available_slots').val(contract_time);
                                    clonedElm.find('.available_slots-d').text(time);
                                    clonedElm.find('.available_slots-d').prop('for', 'newID'+id);

                                    // clonedElm.find('.original_time-d').val(elm);


                                    $(".available_slots_main_container-d").append(clonedElm);

                                    console.log(elm);
                                });
                            }



                            // return false;

                    });
                } else {
                    errorAlert(response.message);
                }
            }
        });


        console.log($("#text-calendar").val());

     }

	});





    function handlePermission() {
        navigator.permissions.query({ name: 'geolocation' }).then(function(result) {
            if (result.state == 'granted') {
                report(result.state);
            } else if (result.state == 'prompt') {
                report(result.state);
                navigator.geolocation.getCurrentPosition(revealPosition, positionDenied, geoSettings);
            } else if (result.state == 'denied') {
                report(result.state);
            }
            result.onchange = function() {
                report(result.state);
            }
        });

        // navigator.geolocation.getCurrentPosition(function(position) {
        //     handlePermission(position.coords.latitude, position.coords.longitude);
        //     // console.log(position.coords.latitude, position.coords.longitude);

        //     let lat = position.coords.latitude;
        //     let long = position.coords.longitude;
        //     console.log('lat: ', lat);
        //     console.log('long: ', long);

        // });

    }

    function report(state) {
        console.log('Permission ' + state);
    }

    handlePermission();


    let lat;
    let long;
    navigator.geolocation.getCurrentPosition(function(position) {
        handlePermission(position.coords.latitude, position.coords.longitude);
        // console.log(position.coords.latitude, position.coords.longitude);

        lat = position.coords.latitude;
        long = position.coords.longitude;
        // console.log('lat: ', lat);
        // console.log('long: ', long);
        if (null != lat && null != long) {
            $.ajax({
                // url: '/glitterups/',
                url: '{{ route("home") }}',
                method: 'GET',
                data: { lat: lat, long: long },
                dataType: 'text',
                success: function(response) {
                    return false;
                }
            })
        }

    });


   $("#ok").click(function () {
        alert('helo');
    });

     // open modal for user to go to login
    $('#book_modal-d').click(function () {
        $("#book_service-d").modal('show');
        // $("#signinoptionModal").modal('show');

        // switchModal('signinModal', 'signinoptionModal');
    });


    // open modal for user to go to login
    $('#check_account_modal-d').click(function () {
        $("#open_signin_modal-d").modal('show');
        // $("#signinoptionModal").modal('show');

        // switchModal('signinModal', 'signinoptionModal');
    });

    // open login modal and close previous modal
    $('#option_sign_modal-d').click(function () {
        switchModal('open_signin_modal-d', 'signin_modal-d');

    });

    // open forgot password modal and close login modal
    $('#option_forgot_modal-d').click(function () {
        $("#reset_password-d").val('user_reset_modal');
        switchModal('signin_modal-d', 'forgot_modal-d');

    });


    // // open enter password modal and cloe forogot password modal
    // $('#option_forgot_modal-d').click(function () {
    //     switchModal('signin_modal-d', 'forgot_modal-d');

    // });


    // open signup socail modal and close login modal
    $("#option_signup_socail_modal-d").click(function () {
        switchModal('signin_modal-d', 'signup_socail_modal-d');
    });

    // open signup modal and close signup socail  modal
    $("#option_signup_modal-d").click(function () {
        switchModal('signup_socail_modal-d', 'signup_modal-d');
    });



   // from forgot password code modal , if user want to go to singup modal
    $("#goto_signup_modal-d").click(function () {
        switchModal('forgot_modal-d', 'signup_modal-d');
    });


  // from singup  modal , if user want to go to login modal
    $("#goto_login_modal-d").click(function () {
        switchModal('signup_modal-d', 'signin_modal-d');
    });


    // $('.salon_service-s').click(function () {
    //     // debugger;
    //     let elm = $(this);
    //     elm.toggleClass('check_saloon_service-s');

    //     if(elm.hasClass('check_saloon_service-s'))
    //     {
    //        let service_price = elm.find("#service_price-d").val()

    //        console.log(service_price);

    //         // alert(service_price);
    //     }
    //     else {
    //         alert('error');
    //     }

    // });

    let service = [];
    $('.salon_services_main_container-d').on('click', '.single_salon_service_container-d', function(e){
        let elm = $(this);
        let service_uuid = $(elm).attr('data-service_uuid')
        let service_div = $(elm).find(".salon_service-d");

        $(service_div).toggleClass('check_saloon_service-s'); // toggle salon service selction
        let service_price = parseFloat($(service_div).find(".service_price-d").text(), 2);
        let actual_price_elm = $("#actual_price-d");
        let actual_price =  parseFloat($(actual_price_elm).text(), 2);

        if($(service_div).hasClass('check_saloon_service-s')){ // case: service is marked as selected
            service.push(service_uuid);

            actual_price = actual_price + service_price;

            $(actual_price_elm).text(actual_price);
            $("#total_price-d").text(actual_price);
            // $("#total_booking_price-d").text(actual_price);
            if(service.length > 0) {
                $("#book_modal-d").removeAttr('disabled');
            }
        }
        else{ // case: service is cancelled

            service.splice(service.indexOf(service_uuid), 1); // remove selected value from array
            actual_price = actual_price - service_price;

            $(actual_price_elm).text(actual_price);
            $("#total_price-d").text(actual_price);

            if(service.length == 0) {
                $("#book_modal-d").attr('disabled','disabled');
            }
            // $("#total_booking_price-d").text(actual_price);
            // alert('error');
            //  let service_price = parseInt(elm.find(".service_price-d").text());
            // let actualPrice =  parseInt($("#actual_price-d").text());
            //     actualPrice = actualPrice - service_price;


            // let add_service_uuid = $(this).find(".salon_service_uuid-d").val();

            // let index = service.indexOf(add_service_uuid);
            //  service.splice(index,1);
            //     // console.log(service_slice);

            // $("#actual_price-d").text(actualPrice);
            // $("#total_price-d").text(actualPrice);


            // if(service.length == 0) {
            //     $("#book_modal-d").attr('disabled',true);
            // }
        }
    });
    $('.single_salon_service_container-d').on('click',  function () {

        // let elm = $(this);
        // // console.log('elm: ', elm);

        // let innerDiv = elm.find(".salon_service-s");
        // console.log('innerDiv: ', innerDiv);



        // innerDiv.toggleClass('check_saloon_service-s');

        // if(innerDiv.hasClass('check_saloon_service-s'))
        // {
        //     let service_price = parseInt(elm.find(".service_price-d").text());
        //     let actualPrice =  parseInt($("#actual_price-d").text());

        //     let add_service_uuid = $(this).find(".salon_service_uuid-d").val();

        //     // service.push($(this).find(".salon_service_uuid-d").val());
        //     service.push(add_service_uuid);


        //     // console.log(service);

        //     // console.log(actualPrice);

        //     actualPrice = actualPrice + service_price;

        //     $("#actual_price-d").text(actualPrice);
        //     $("#total_price-d").text(actualPrice);
        //     $("#total_booking_price-d").text(actualPrice);

        //     // console.log(service_price);
        //     // console.log(actualPrice);

        //     // alert(service_price);
        // }
        // else {
        //     // alert('error');
        //      let service_price = parseInt(elm.find(".service_price-d").text());
        //     let actualPrice =  parseInt($("#actual_price-d").text());
        //         actualPrice = actualPrice - service_price;


        //     let add_service_uuid = $(this).find(".salon_service_uuid-d").val();

        //     let index = service.indexOf(add_service_uuid);
        //      service.splice(index,1);
        //         // console.log(service_slice);

        //     $("#actual_price-d").text(actualPrice);
        //     $("#total_price-d").text(actualPrice);


        //     if(service.length == 0) {
        //         $("#book_modal-d").attr('disabled',true);
        //     }


        // }
        //     // console.log(service);

        //     if($('*').hasClass('del_services'))
        //     {
        //         // console.log('hidden_service_uuid: ', hidden_service_uuid);
        //         // hidden_service_uuid = " ";
        //         $(".del_services").remove();

        //     }

        //     $.each(service, function(i,elm){

        //         let hidden_service_uuid = $(".service_uuid-d").val();


        //             console.log(elm);
        //             $('#frm_booking_service-d').prepend(`<input type="hidden" name="services_uuid[]" class="service_uuid-d del_services" value=${elm} />`);

        //     })

        //         // $('#frm_booking_service-d').prepend(`<input type="hidden" name="services_uuid[]" value=${service} />`);


        //     $(".check_service-d").val(service);


        //     // console.log(service.length);

        //        if(service.length > 0) {
        //             $("#book_modal-d").removeAttr("disabled");
        //         }


    });


    $(".pignose-calendar-button-apply").on("click", function(){
        console.log($("#text-calendar").val());
    })



    // validate book salon
    $('#frm_booking_service-d').validate({
        ignore: ".ignore",
        rules: {
            options: {
                required: true,
            }
        },
        messages: {
            options: {
                required: "Select time for booking appointment.",
            }
        },
        errorPlacement: function(error, element) {
            $('#' + error.attr('id')).remove();
            error.insertAfter(element);
            $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
        },
        success: function(label, element) {
            $(element).removeClass('error text-danger');
            $(element).parent().find('span.error').remove();
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
                        if (response.status) {
                            Swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 2000
                            }).then((result) => {
                                console.log(response);
                                let user_uuid = $(".user_uuid-d").val();
                                window.location.href = userAPpointment + '?uuid=' + user_uuid;

                            });
                        } else {
                            errorAlert(response.message);
                        }
                    },
                    error: function(xhr, message, code) {
                        console.log(message, code, xhr);
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




    //user login open modal
    $("#user_login-d").on('click', function(){
        console.log('test');
        $(`#signin_modal-d`).modal('show');
    });




    // // user search result
    // $('#frm_search-d').validate({
    //     ignore: ".ignore",
    //     rules: {
    //         keyword: {
    //             required:function(element){
    //                 return $("#location-d").val() =="";
    //             },
    //             minlength: 5,
    //         },
    //         location: {
    //             required:function(element){
    //                 return $("#keyword-d").val() =="";
    //              },
    //             minlength: 10,
    //         }

    //     },
    //     messages: {
    //         keyword: {
    //             required: "keyword required.",
    //             minlength: "keyword should have atleast 5 characters"
    //         },
    //           location: {
    //             required: "location required.",
    //             minlength: "location should have atleast 5 characters"
    //         }
    //     },
    //     errorPlacement: function(error, element) {
    //         $('#' + error.attr('id')).remove();
    //         error.insertAfter(element);
    //         $('#' + error.attr('id')).replaceWith('<span id="' + error.attr('id') + '" class="' + error.attr('class') + ' text-danger" for="' + error.attr('for') + '">' + error.text() + '</span>');
    //     },
    //     success: function(label, element) {
    //         $(element).removeClass('error text-danger');
    //         $(element).parent().find('span.error').remove();
    //     },
    //     submitHandler: function(form) {
    //             $.ajax({
    //                 url: $(form).attr('action'),
    //                 type: 'POST',
    //                 dataType: 'json',
    //                 data: $(form).serialize(),
    //                 beforeSend: function() {
    //                     showPreLoader();
    //                 },
    //                 success: function(response) {
    //                     console.log(response);
    //                     if (response.status) {

    //                         Swal.fire({
    //                             title: 'Success',
    //                             text: response.message,
    //                             icon: 'success',
    //                             showConfirmButton: false,
    //                             timer: 2000
    //                         }).then((result) => {
    //                             // console.log(response);
    //                             // let user_uuid = $(".user_uuid-d").val();
    //                             // window.location.href = userAPpointment + '?uuid=' + user_uuid;
    //                             location.reload();

    //                         });
    //                     } else {
    //                         errorAlert(response.message);
    //                     }
    //                 },
    //                 error: function(xhr, message, code) {
    //                     response = xhr.responseJSON;
    //                     Swal.fire({
    //                         title: 'Error',
    //                         text: response.message,
    //                         icon: 'error',
    //                         showConfirmButton: false,
    //                         timer: 2000
    //                     }).then((result) => {
    //                         // do nothing
    //                     });
    //                     // console.log(xhr, message, code);
    //                     hidePreLoader();
    //                 },
    //                 complete: function() {
    //                     hidePreLoader();
    //                 },
    //             });
    //             return false;
    //         }


    // });



});

