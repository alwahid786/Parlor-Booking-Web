$(document).ready(function() {
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


});

$(function(event) {

});
