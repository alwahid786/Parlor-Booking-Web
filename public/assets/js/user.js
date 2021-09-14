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

          mobiscroll.setOptions({
        locale: mobiscroll.localeEn,  // Specify language like: locale: mobiscroll.localePl or omit setting to use default
        theme: 'ios',                 // Specify theme like: theme: 'ios' or omit setting to use default
            themeVariant: 'light'     // More info about themeVariant: https://docs.mobiscroll.com/5-9-1/calendar#opt-themeVariant
    });

    var myCalendar = $('#demo').mobiscroll().datepicker({
            controls: ['calendar'],   // More info about controls: https://docs.mobiscroll.com/5-9-1/calendar#opt-controls
            display: 'inline',        // Specify display mode like: display: 'bottom' or omit setting to use default
            calendarType: 'week',
            weeks: 1,                 // More info about weeks: https://docs.mobiscroll.com/5-9-1/calendar#opt-weeks
            renderCalendarHeader: function () {
                return '<div mbsc-calendar-nav class="custom-view-nav"></div><div class="custom-view">' +
                    '<label><input data-icon="material-date-range" mbsc-segmented type="radio" name="view" value="week" class="view-change" checked></label>' +
                    '<label><input data-icon="material-event-note" mbsc-segmented typce="radio" name="view" value="month" class="view-change"></label></div>' +
                    '<div mbsc-calendar-prev></div>' +
                    '<div mbsc-calendar-next></div>';
            }
        }).mobiscroll('getInst');

        // $('.view-change').change(function (ev) {
        //     switch (ev.target.value) {
        //         case 'week':
        //             myCalendar.setOptions({
        //                 calendarType: 'week'
        //             });
        //             break;
        //         case 'month':
        //             myCalendar.setOptions({
        //                 calendarType: 'month'
        //             });
        //             break;
        //     }
        // });
    // });



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
        switchModal('signin_modal-d', 'forgot_modal-d');

    });


    // open enter password modal and cloe forogot password modal
    $('#option_forgot_modal-d').click(function () {
        switchModal('signin_modal-d', 'forgot_modal-d');

    });


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

    $('.single_salon_service_container-d').on('click',  function () {

        let elm = $(this);
        // console.log('elm: ', elm);

        let innerDiv = elm.find(".salon_service-s");
        console.log('innerDiv: ', innerDiv);



        innerDiv.toggleClass('check_saloon_service-s');

        if(innerDiv.hasClass('check_saloon_service-s'))
        {
            let service_price = parseInt(elm.find(".service_price-d").text());
            let actualPrice =  parseInt($("#actual_price-d").text());

            console.log(actualPrice);

            actualPrice = actualPrice + service_price;

            $("#actual_price-d").text(actualPrice);
            $("#total_price-d").text(actualPrice);
            // console.log(service_price);
            // console.log(actualPrice);

            // alert(service_price);
        }
        else {
            // alert('error');
             let service_price = parseInt(elm.find(".service_price-d").text());
            let actualPrice =  parseInt($("#actual_price-d").text());
                actualPrice = actualPrice - service_price;

            $("#actual_price-d").text(actualPrice);
            $("#total_price-d").text(actualPrice);

        }

    });



});

