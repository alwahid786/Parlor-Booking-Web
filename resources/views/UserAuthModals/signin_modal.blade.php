<!-- SignIn Option Modal Start -->

<div class="modal static_modal-d" id="signin_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content for_modal_bg ">

        <!-- Modal Header -->


          <div class="modal-body ">
              <div class="pull-right text-end">
                <img src="{{asset('assets/images/home_page_component/Group 152.svg')}}" class="img-fluid for_modal_cancel_img_my_appointments close"  data-dismiss="modal" aria-label="Close" alt="...">
              </div>
              <div class="text-center login_main_option_div">
                <h3>Wellcome to <span>Glitter</span>ups</h3>
                <p>Log in using your password and email </p>
              </div>

            <form action="{{ route('weblogin') }}" class="frm_login-d" method="post">
                @csrf
                <div class="for_form_email_class for_email_pass_common">
                  <h6 class="ms_-28px-s text-white">Email</h6>
                  <div class="input-group">
                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <span class="for_icon_email_span">
                        <img src="{{asset('assets/images/saloon_dashboard_images/email.svg')}}" width="20" class="img-fluid" alt="email">
                    </span>
                     <input type="email" name="email" class="input_class mt-1 border-bottom text-white" placeholder="abcd@gmail.com"/>
                  </div>
                    <!-- <p>Email</p>
                    <div class="input-group mb-3 for_email_pass_common">
                        <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="for_icon_email_span">
                            <img src="{{asset('assets/images/saloon_dashboard_images/email.svg')}}" width="20" class="img-fluid" alt="email">
                        </span>
                        <input type="email" name="email" class="input_class mt-1 border-bottom" placeholder="abcd@gmail.com"/>
                    </div> -->
                </div>

                <div class="for_form_email_class for_email_pass_common">
                    <h6 class="ms_-28px-s text-white">Password</h6>
                        <div class="input-group">
                        <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                        <span class="for_icon_email_span">
                            <img src="{{asset('assets/images/saloon_dashboard_images/password.svg')}}" width="20" class="img-fluid" alt="password">
                        </span>
                        <input type="password"  name="password" class="input_class mt-1 border-bottom text-white" placeholder="create password"/>
                        </div>
                </div>

              <div class="text-center for_forgot_pass_text">
                <h5 id="option_forgot_modal-d"><u>Forgot password?</u></h5>
                  <br>
                  <br>
                <button type="submit" class="btn btn-warning text-white">Log In</button>
                <input type="hidden" name="service" class="service-d" value="1">
                <input type="hidden" name="type" class="" value="user">
              </div>

          </form>



            <div class="text-center ">
            <p class="dont_have_account">Don't have an</p>
              <p class="account_css">account? <span class="text-warning py-1 px-1 cursor_pointer-s" id="option_signup_socail_modal-d"><u>Sign Up</u></span></p>
                {{-- <a href="" data-toggle="modal" data-target="#signupoptionModal">Sign Up</a> --}}

            </div>


         </div>
      </div>
    </div>
  </div>
  <script>
    $("#option_signup_socail_modal-d").click(function () {
        switchModal('signin_modal-d', 'signup_socail_modal-d');
    });
  </Script>
<!-- SignIn Option Modal End-->




