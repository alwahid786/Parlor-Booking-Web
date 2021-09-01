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
            let salon_id = $('.salon_uuid-d').val();

            // alert('http://localhost/glitterups/profile-setting?uuid=' + salon_id);

            $.ajax({
                // url: '/glitterups/',
                url: 'http://localhost/glitterups/profile-setting?uuid=' + salon_id,
                method: 'GET',
                data: { lat: lat, long: long, salon_id: salon_id },
                dataType: 'text',
                success: function(response) {
                    return false;
                }
            })
        }

    });


});