<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />



    <link rel="stylesheet" href="{{ asset('assets/css/asside_bar_css/asside_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/navbar_css/nav_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin_css/past_appointments.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin_css/services.css') }}">

    <title>Services</title>
    <style>
  .pic:hover{
    background-image: url("{{ asset('assets/images/saloon_dashboard_images/Grouphover.svg') }}");
    /* background-color: red; */

    margin-left: 15px;
    height: 75px;
    width: 97%;



  }


  @media (min-width: 768px) and (max-width: 1024px) {
    .pic:hover{
    background-image: url("{{ asset('assets/images/saloon_dashboard_images/Grouphover.svg') }}");
    background-size: cover;
    margin-left: 8px;
    height: 75px;
    width: 97%;
    font-size: 0px;
    position: relative;


  }

  .for_img_css_appointment span {
    margin-left: 3px;
    /* margin-top: 1px !important; */
    font-size: 10px;
}

.for_img_css_appointment span:hover{
    margin-top: 100px !important;
}

.for_img_css_appointment img {
    margin-left: 8px;
    width: 20%;
}

.for_img_css_past img {
    margin-left: 8px;
    width: 20%
}
.for_img_css_past span {
    margin-left: 1px;
    font-size: 8px;
}
}

@media (min-width: 320px) and (max-width: 767px) {
    .col-2 {
    flex: 0 0 auto;
    width: 24.666667%;
}
    .pic:hover{
    background-image: url("{{ asset('assets/images/saloon_dashboard_images/Grouphover.svg') }}");
    background-size: cover;
    margin-left: 7px;
    height: 64px;
    width: 98%;
    font-size: 9px;


  }
  .for_img_css img {
    margin-left: 5px;
    width: 22%;
    margin-top: -5px;
}
.for_img_css span {
    margin-left: 2px;
    font-size: 9px;
}

.for_img_css_appointment span {
    margin-left: 1px;
    font-size: 8px;
}

.for_img_css_appointment img {
    margin-left: 5px;
    width: 20%;
}

.for_img_css_past img {
    margin-left: 5px;
    width: 20%;
}

.for_img_css_past span {
    margin-left: 0px;
    font-size: 6px;
}
}
    </style>
</head>
<body>
    <!--Asside Bar Page Start !-->
    <div class="for-overflow">
      <div class="row">
            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3 for_asside_bar_bg">
                @include('includes.saloon_dashboard.saloon_dashboard_navbar',['id'=>$id])
            </div>
            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-9 col-9 for_add_services_bg">

                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="for_add_service">

                            {{-- <button type="button" class="btn "  data-bs-toggle="modal" data-bs-target="#exampleModal"> --}}
                            <button type="button" class="btn "  id="add_service-d">
                                <span>
                                <i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>
                                </span>
                                Add Service

                            </button>



                            <div>
                                <span class="pull-right">
                                    @include('includes.saloon_dashboard.nav-bar',['id'=>$id])

                                </span>
                            </div>


                            <!--After Nav Services Page Start !-->

                            <div>
                                <div class="row for_main_row_appointment ">
                                    {{--  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                                        <div class="">
                                            <div class="card-body beauty_salon_services">
                                                <h5>Beauty Salon  </h5>
                                                <h5 class="for_services_text_css">Services</h5>
                                                <p >With supporting text below as a natural lead-in to additional content...</p>

                                            </div>

                                        </div>
                                    </div>  --}}
                                    {{-- {{ dd($getServices) }} --}}
                                    @if (null != $getServices )
                                        @foreach ($getServices as $key => $service)
                                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 " >
                                                {{-- <div class="card for_border_card_dashed" data-bs-toggle="modal" data-bs-target="#example-{{ $service->uuid }}"> --}}
                                                <div class="card for_border_card_dashed" class="list_service-d">
                                                    <div class="card-body for_spa_text" id="service_list-d_{{ $key }}">
                                                        <h5 class="service_name-d"> {{ $service->name }}  </h5>
                                                            <span class="pull-right">
                                                                <img src="{{ asset('assets/images/saloon_dashboard_images/Group 356.svg') }} " class="img-fluid  for_icon_modal edit_service-d "  alt="...">
                                                            </span>

                                                        {{-- <p >With supporting text below as a natural lead-in to additional content...</p> --}}
                                                        <h4>Price</h4>
                                                        <h4 class="for_20_text service_price-d">${{ $service->price }}</h4>
                                                        <input type="hidden" name="service_uuid" class="service_uuid" value="{{ $service->uuid }}">
                                                    </div>

                                                </div>
                                            </div>


                                            <!-- Common Modal Start -->


                                            {{-- <div class="modal fade" id="example-{{ $service->uuid }}" tabindex="-1" aria-labelledby="example" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                    <div class="modal-body">
                                                        <h5 class="modal_title_services_child">Services
                                                            <span class="pull-right">
                                                                <span>
                                                                    <img src="{{ asset('assets/images/saloon_dashboard_images/Group 356.svg') }} " class="img-fluid  for_icon_modal edit_service-d" id="edit_service-d"  alt="...">

                                                                </span>
                                                                <img src="{{ asset('assets/images/saloon_dashboard_images/Group 152.svg') }} " class="img-fluid for_modal_cancel_img_services  "  data-bs-dismiss="modal" aria-label="Close" alt="...">

                                                            </span>
                                                        </h5>

                                                        <div class="mt-n5">
                                                                <p class="Menicure_Predicure">{{ $service->name }}</p>
                                                                <p class="price">
                                                                    Price
                                                                    <span class="price_thirty_dollars">
                                                                        ${{ $service->price }}
                                                                    </span>
                                                                </p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <!-- Common Modal ENd -->

                                        @endforeach
                                    @else
                                        <h5>No Services Added Yet</h5>
                                    @endif


                                    {{--  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                                        <div class="card for_border_card_dashed for_facial_w" data-bs-toggle="modal" data-bs-target="#example">
                                            <div class="card-body for_spa_text">
                                                <h5>Facial  </h5>

                                                <p >With supporting text below as a natural lead-in to additional content...</p>
                                                <h4>Price</h4>
                                                <h4 class="for_20_text">$20</h4>
                                            </div>

                                        </div>
                                    </div>  --}}

                                </div>
                            </div>


                           <!--After Nav Services Page Start !-->

                           <!-- Child One  -->

                           {{--  <div>
                                <div class="row for_main_row_appointment ">
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                                        <div class="card for_border_card_dashed" data-bs-toggle="modal" data-bs-target="#example">
                                            <div class="card-body for_spa_text">
                                                <h5>Spa  </h5>

                                                <p >With supporting text below as a natural lead-in to additional content...</p>
                                                <h4>Price</h4>
                                                <h4 class="for_20_text">$20</h4>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                                        <div class="card for_border_card_dashed" data-bs-toggle="modal" data-bs-target="#example">
                                            <div class="card-body for_spa_text">
                                                <h5>Spa  </h5>

                                                <p >With supporting text below as a natural lead-in to additional content...</p>
                                                <h4>Price</h4>
                                                <h4 class="for_20_text">$20</h4>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                                        <div class="card for_border_card_dashed for_facial_w" data-bs-toggle="modal" data-bs-target="#example">
                                            <div class="card-body for_spa_text">
                                                <h5>Facial  </h5>

                                                <p >With supporting text below as a natural lead-in to additional content...</p>
                                                <h4>Price</h4>
                                                <h4 class="for_20_text">$20</h4>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>  --}}
                           <!-- Child One  -->

                            <!-- Child Two  -->

                            {{--  <div>
                                <div class="row for_main_row_appointment ">
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                                        <div class="card for_border_card_dashed" data-bs-toggle="modal" data-bs-target="#example">
                                            <div class="card-body for_spa_text">
                                                <h5>Spa  </h5>

                                                <p >With supporting text below as a natural lead-in to additional content...</p>
                                                <h4>Price</h4>
                                                <h4 class="for_20_text">$20</h4>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                                        <div class="card for_border_card_dashed" data-bs-toggle="modal" data-bs-target="#example">
                                            <div class="card-body for_spa_text">
                                                <h5>Spa  </h5>

                                                <p >With supporting text below as a natural lead-in to additional content...</p>
                                                <h4>Price</h4>
                                                <h4 class="for_20_text">$20</h4>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                                        <div class="card for_border_card_dashed for_facial_w" data-bs-toggle="modal" data-bs-target="#example">
                                            <div class="card-body for_spa_text">
                                                <h5>Facial  </h5>

                                                <p >With supporting text below as a natural lead-in to additional content...</p>
                                                <h4>Price</h4>
                                                <h4 class="for_20_text">$20</h4>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>  --}}
                           <!-- Child Two  -->
                        </div>

                    </div>


                  </div>
            </div>
        </div>
    </div>





                <!-- Service Modal Start -->
                            <!-- Modal -->
                            {{-- <div class="modal fade" id="exampleModal edit_model-d" class="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
                            <div class="modal fade" id="exampleModal" class="edit_model-d" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <div class="modal-body">
                                                <h5 class="modal_title_services">Services
                                                    <span class="pull-right">
                                                     <img src="{{ asset('assets/images/saloon_dashboard_images/Group 152.svg') }} " class="img-fluid for_modal_cancel_img_services  "  data-bs-dismiss="modal" aria-label="Close" alt="...">

                                                    </span>
                                                </h5>

                                                <div>
                                                    <form class="pt-2" action="{{ route('addService', $id) }}" id="frm_add_service-d" method="post">
                                                        @csrf
                                                        <div class="mb-3">

                                                            <input type="text" name="service_name" class="form-control edit_service_name-d" id="recipient-name" placeholder="Service Name">
                                                        </div>

                                                        <div class="mb-3 mt-4">

                                                            <input type="text" name="price" class="form-control edit_service_price-d" id="recipient-name" placeholder="Price">
                                                        </div>

                                                        <div class="text-center pt-3 mb-5">
                                                            <button type="submit" class="btn btn-warning  px-5 edit-d"> Save</button>
                                                            <input type="hidden" name="service_id" class="edit_service_uuid-d" value="">
                                                        </div>
                                                    </form>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            <!-- Services Modal End -->










<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" ></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<script>
      $('.for-audi').click(function() {

        if ($('.toggle_show').hasClass('show')) {
            $('.toggle_show').removeClass('show')
            $('.for-audi-menu').removeClass('show')
        } else {
            $('.toggle_show').addClass('show')
            $('.for-audi-menu').addClass('show')
        }

    })

    $(document).ready(function () {
$('.navbar-light .dmenu').hover(function () {
        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
    }, function () {
        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
    });
});

$('.divID ').click(function() {
        $(this).addClass('testcolor')
        // $(this).removeClass('testcolor')
        $(this).addClass('avi')
    })

    $('.second ').click(function() {
        $(this).addClass('avi')
        // $(this).removeClass('testcolor')

    })

</script>


<script src="{{ asset('assets/js/common.js') }}"></script>
<script src="{{ asset('assets/js/profileService.js') }}"></script>



</body>
</html>
