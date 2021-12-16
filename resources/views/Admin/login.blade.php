
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard_signin.css') }}" >
    <title>Sign In</title>
    <style>

    </style>
</head>
<body>
    <!--Sign In Page Start !-->

    <div class="for-overflow">
      <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
          <div class="for_signin_img_css">
            <img src="{{ asset('assets/images/dashboard_images/12312.svg') }}" class="img-fluid">
          </div>
        </div>

        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 for_sinin_sm_responsive_main_div">
           <div class="container pt-5">
              <div class="for_h1_color">
                <h1>WELLCOME TO</h1>
                <h1>GLITTER<span>UPS</span> </h1>
              </div>

              <div class="for_personal_information">
                  <p>Please Login with your personal information</p>

              </div>

              <form action="{{ route('adminLogin') }}" class="frm_admin_login-d" method="post">
                @csrf
                <div class="for_common_email_pass pt-4">
                    <p>Email Address</p>
                      <div class="input-group mb-3 w-75 ">
                        <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                        <input type="email" class="inp w-100 border-bottom" name="email" placeholder="abcd@gmail.com" />
                      </div>
                </div>

                <div class="for_common_email_pass ">
                    <p>Password</p>
                      <div class="input-group mb-3 w-75">
                        <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                        <input type="password" class="inp w-100 border-bottom" name="password" placeholder="" />
                      </div>
                </div>

                {{-- <div class="form-check forgot_password_css">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Remember Me
                      <span class=""><a href="{{ route('forgotPassword') }}">Forgot Password?</a></span>
                  </label>

                </div> --}}

                <div class="pt-5 text-center button_signin_css">
                <button type="submit" class="btn  btn-lg  w-50 w-sm-25"><span>Sign In</span></button>
                </div>
                <input type="hidden" name="type" value="admin">
              </form>

            {{-- <div class="pt-5 text-center button_signin_css">
              <label for="">Don't have an account</label>
              <a href="{{ route('signup') }}"  class="btn  btn-lg  w-50 w-sm-25"><span>Sign Up</span></a>
            </div> --}}
           </div>
        </div>
      </div>
    </div>


        {{--  {{ dd('auth-content') }}  --}}


    <!--Sign In Page End !-->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('assets/js/common.js') }}"></script>


<script>
    let adminDashboard = "{{ route('adminIndex') }}";


</script>

    <script src="{{ asset('assets/js/admin.js') }}">
    </script>



</body>
</html>



