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
            @csrf
            <div class="for_common_email_pass sm_name_css pt-4">
                <p>Name</p>
                  <div class="input-group mb-3 w-75 ">
                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <input type="text" name="name"  class="inp w-100 border-bottom" placeholder="David Miller" />
                    @error('name')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
            </div>

            <div class="for_common_email_pass ">
                <p>Email</p>
                  <div class="input-group mb-3 w-75 ">
                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <input type="email" class="inp w-100 border-bottom" name="email" placeholder="abcd@gmail.com" required/>
                  </div>
            </div>

             {{-- <div class="for_common_email_pass ">
                <p>Role</p>
                  <div class="input-group mb-3 w-75 border-bottom">
                    <select class="inp" name="type" aria-label="Default select example">
                        <option  value="salon" selected>Salon</option>
                        <option value="user">User</option>
                    </select>
                  </div>
            </div> --}}



            <div class="d-flex w-75">
                <div class="for_common_email_pass col input-group">

                    <label for="phone_code_label">Phone Code</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend d-flex align-self-end">
                            <span class="input-group-text rounded-0 border-0 bg-white  border-bottom" id="phone_code">+</span>
                        </div>
                        <input type="tel" class="form-control rounded-0   border-bottom inp form-control-lg" name="phone_code" maxlength="3" id="phone_code_label" aria-describedby="phone_code">
                    </div>
                </div>
              {{-- <div class="for_common_email_pass col input-group">
                <label>Phone Code</label>

                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="phone_code">+</span>
                    </div>
                    <input type="tel" class="form-control form-control-lg inp border-bottom" maxlength="3" name="phone_code" placeholder="+ 00" aria-describedby="phone_code" required/>

              </div> --}}
              <div class="for_common_email_pass col form-group">
                <label>Phone</label>
                  {{-- <div class="input-group mb-3 w-75 "> --}}
                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <input type="tel" class="form-control form-control-lg inp rounded-0` border-bottom" name="phone_number" maxlength="12" placeholder=" 000 00 00 000"  required/>
                  {{-- </div> --}}
              </div>
            </div>


            <div class="for_common_email_pass ">
                <p>Password</p>
                  <div class="input-group mb-3 w-75 ">
                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <input type="password" class="inp pswd_password-d w-100 border-bottom" name="password" placeholder="************" required/>
                  </div>
            </div>

            <div class="for_common_email_pass ">
                <p>Confirm Password</p>
                  <div class="input-group mb-3 w-75 ">
                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                    <input type="password" class="inp w-100 border-bottom" name="password_confirmation" placeholder="************" required/>
                  </div>
            </div>



            <div class="pt-5 text-center button_signin_css">
                <input type="hidden" name="type" value="salon">
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
