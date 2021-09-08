{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard_new_password.css') }}" >
    <title>Document</title>
    <style>

    </style>
</head>
<body> --}}

@extends('Auth.layouts.auth')


@section('auth-content')

    <!--New Password Page Start !-->
    <div class="for-overflow">
      <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
          <div class="for_signin_img_css">
            <img src="{{ asset('assets/images/dashboard_images/12312.svg') }}" class="img-fluid">
          </div>
        </div>

        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 for_new_password_sm">
           <div class="container pt-5">
              <div class="for_h1_color">

                <h1>New <span>Password</span> </h1>
              </div>

              <div class="for_personal_information">
                  <p>Enter your new Password</p>

              </div>

            <form action="{{ route('resetPassword') }}" id="frm_reset_password-d" method="post">
                @csrf
                <div class="for_common_email_pass pt-4">
                    <p>Password</p>
                        <div class="input-group mb-3 w-75 border-bottom">
                        <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                        <input type="password" name="password" class="inp reset_password-d" placeholder="***********"/>
                        </div>
                </div>

                <div class="for_common_email_pass pt-4">
                    <p>Password</p>
                        <div class="input-group mb-3 w-75 border-bottom">
                        <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                        <input type="password" name="password_confirmation" class="inp" placeholder="***********"/>
                        </div>
                </div>



                <div class="pt-5 text-center button_signin_css">
                    <input type="hidden" name="code" value="{{ $code ?? '' }}">
                    <input type="hidden" name="email" value="{{ $email ?? '' }}">
                    {{-- <input type="hidden" name="type_of_user" class="type_of_user-d" value="{{ $email ?? '' }}"> --}}

                    <button type="submit" class="btn  btn-lg  w-50 w-sm-25"><span>Confirm</span></button>
                </div>
            </form>

           </div>
        </div>
      </div>
    </div>

    <!--New Password Page End !-->

@endsection

@section('footer-scripts')
    <script src="{{ asset('assets/js/auth.js') }}"></script>
@endsection




{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html> --}}
