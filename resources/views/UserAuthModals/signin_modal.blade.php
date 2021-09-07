<!-- SignIn Option Modal Start -->

<div class="modal " id="signin_modal-d">
    <div class="modal-dialog">
      <div class="modal-content modal-lg for_modal_bg signin_h">

        <!-- Modal Header -->


          <div class="modal-body ">
              <div class="pull-right text-end">
                <img src="./assets/images/Group 152.svg " class="img-fluid for_modal_cancel_img_my_appointments  "  data-dismiss="modal" aria-label="Close" alt="...">
              </div>
              <div class="text-center login_main_option_div">
                <h3>Wellcome to <span>Glitter</span>ups</h3>
                <p>Log in using your password and email </p>
              </div>

            <form action="{{ route('weblogin') }}" class="frm_login-d" method="post">
                @csrf
              <div class="for_form_email_class ">
                  <p>Email</p>
                  <div class="input-group mb-3  for_email_pass_common border-bottom">
                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <span class="for_icon_email_span"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
                     <input type="email" name="email" class="input_class" placeholder="abcd@gmail.com"/>
                  </div>
              </div>

              <div class="for_form_email_class ">
                <p>Password</p>
                <div class="input-group mb-3  for_email_pass_common border-bottom">
                  <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                  <span class="for_icon_email_span"> <i class="fa fa-unlock-alt" aria-hidden="true"></i> </span>
                  <input type="password"  name="password" class="input_class" placeholder="create password"/>
                </div>
              </div>

              <div class="text-center for_forgot_pass_text">
                <h5>
                  <button type="button" id="option_forgot_modal-d">Forgot password?</button>
                </h5>
                  <br>
                  <br>
                <button type="submit" class="btn btn-warning">Log In</button>
                <input type="hidden" name="service" class="service-d" value="1">
              </div>

          </form>



            <div class="text-center ">
            <p class="dont_have_account">Don't have an</p>
              <p class="account_css">account? <span>
                {{-- <a href="" data-toggle="modal" data-target="#signupoptionModal">Sign Up</a> --}}
                <button id="option_signup_socail_modal-d">Sign Up</a>
              </span></p>
            </div>


         </div>
      </div>
    </div>
  </div>
<!-- SignIn Option Modal End-->




