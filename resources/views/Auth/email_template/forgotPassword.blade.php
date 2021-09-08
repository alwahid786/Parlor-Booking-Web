{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard_forgot_password.css') }}" >
    <title>Document</title>
    <style>

    </style>
</head>
<body> --}}
    <!--Sign In Page Start !-->

@extends('Auth.layouts.auth')


@section('auth-content')

    <div class="for-overflow">
      <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
          <div class="for_signin_img_css">
            <img src="{{ asset('assets/images/dashboard_images/12312.svg') }}" class="img-fluid">
          </div>
        </div>

        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 for_forgot_psseord_sm_responsive">
           <div class="container pt-5">
              <div class="for_h1_color">
                <h1>Forgot <span> Password</span> </h1>
              </div>

              <div class="for_personal_information">
                  <p>Enter your Email...</p>

              </div>

                <form action="{{ route('forgotPassword') }}" class="frm_forgot_password-d" method="post">
                    <div class="for_common_email_pass">
                        <p>Email Address</p>
                            <div class="input-group mb-3 w-75 border-bottom">
                            <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                            <input type="email" name="reference" class="inp" placeholder="abcd@gmail.com"/>
                            </div>
                    </div>

                    <div class=" text-center button_signin_css ">
                        <input type="hidden" name="" id="reset_password-d" value="reset_password">
                        <button type="submit" class="btn  btn-lg  w-50 w-sm-25"><span>Send</span></button>
                    </div>
                </form>

           </div>
        </div>
      </div>
    </div>




    <!--Sign In Page End !-->

@endsection





    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html> --}}


@section('footer-scripts')
    <script src="{{ asset('assets/js/auth.js') }}"></script>
@endsection
