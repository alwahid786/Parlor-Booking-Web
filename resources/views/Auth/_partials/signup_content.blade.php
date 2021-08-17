<div class="row">
    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
      <div class="for_signin_img_css">
        <img src="{{ asset('assets/images/dashboard_images/12312.svg') }}" class="img-fluid">
      </div>
    </div>

    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 for_create_new_account_sm_res_main_div">
       <div class="container pt-2">
          <div class="for_h1_color">
            <h1>WELLCOME TO</h1>
            <h1>GLITTER<span>UPS</span> </h1>
          </div>

          <div class="for_personal_information">
              <p>Create your Account by filling the form</p>
              <div class="for-below">
              <p>below:</p>
              </div>
             
          </div>

          <form action="{{ route('signup') }}" id="frm_signup-d" method="post">
            <div class="for_common_email_pass sm_name_css pt-4">
                <p>Name</p>
                  <div class="input-group mb-3 w-75 border-bottom">
                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <input type="text" name="name"  class="inp" placeholder="David Miller" />
                    @error('name')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
            </div>

            <div class="for_common_email_pass ">
                <p>Email</p>
                  <div class="input-group mb-3 w-75 border-bottom">
                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <input type="email" class="inp" name="email" placeholder="abcd@gmail.com" required/>
                  </div>
            </div>

            <div class="for_common_email_pass ">
                <p>Phone</p>
                  <div class="input-group mb-3 w-75 border-bottom">
                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <input type="tel" class="inp" name="phone_no" placeholder="+ 000 000 000" required/>
                  </div>
            </div>

            <div class="for_common_email_pass ">
                <p>Password</p>
                  <div class="input-group mb-3 w-75 border-bottom">
                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <input type="password" class="inp pswd_password-d" name="password" placeholder="********" required/>
                  </div>
            </div>

            <div class="for_common_email_pass ">
                <p>Confirm Password</p>
                  <div class="input-group mb-3 w-75 border-bottom">
                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <input type="password" class="inp" name="password_confirmation" placeholder="********" required/>
                  </div>
            </div>

         

            <div class="pt-5 text-center button_signin_css">
              <button type="submit" class="btn  btn-lg  px-5 "><span>Create</span></button>
            </div>

          </form>

          <div class="text-center for_OR_css">
              <p>OR</p>
          </div>


          <div class="text-center for_fb_google">
              <p class="dot">
              <i class="fa fa-facebook" aria-hidden="true"></i>
              
              </p>
              <span class="dot"> <i class="fa fa-google" aria-hidden="true"></i></span>

          </div>


       </div>
    </div>
  </div>