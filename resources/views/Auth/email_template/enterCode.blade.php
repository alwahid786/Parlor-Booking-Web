@extends('Auth.layouts.auth')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        / Firefox /
        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>
@section('auth-content')


    <!--Sign In Page Start !-->
    <div class="for-overflow">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
              <div class="for_signin_img_css">
                <img src="{{ asset('assets/images/dashboard_images/12312.svg') }}" class="img-fluid">
              </div>
            </div>

            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 main_div_col_six_sm_res">
                <div class="container pt-5">
                  <div class="for_h1_color">
                    <h1>Enter <span> Code</span> </h1>
                  </div>

                  <div class="for_personal_information">
                      <p>Enter your code...</p>

                  </div>

                  <form action="{{ route('enterCode') }}" id="frm_validate_code-d" method="post">
                    <div class="row mt-5 for_row_enter_code">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 for_enter_code_responsive_main_div code_border-s code_border-d ">
                            <div class="for_common_email_pass pt-4 ">
                                <div class="input-group mb-3 w-75 ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <input type="number" class="inp dot dot_one v_code-d v_code-s"  name='number_box_1'  id='number_box_1' min='0' max="9" maxlength="1" placeholder="0"/>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 code_border-s code_border-d">
                            <div class="for_common_email_pass pt-4">

                                <div class="input-group mb-3 w-75 ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <input  type="number"  class="inp dot dot_two v_code-d v_code-s" name='number_box_2' id='number_box_2' min='0' max="9" maxlength="1"  placeholder="1"/>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 code_border-s code_border-d">
                            <div class="for_common_email_pass pt-4">
                                <div class="input-group mb-3 w-75 ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <input type="number" class="inp dot dot_three v_code-d v_code-s"   name='number_box_3' id='number_box_3' min='0' max="9" maxlength="1"  placeholder="2"/>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 code_border-s code_border-d">
                            <div class="for_common_email_pass pt-4">
                                <div class="input-group mb-3 w-75 ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <input type="number" class="inp dot dot_four v_code-d v_code-s last-d" name='number_box_4' id='number_box_4' min='0' max="9" maxlength="1"   placeholder="3"/>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                    <div class=" text-center button_signin_css ">
                        <input type="hidden" name="email" class="email-d" value="{{ $email ?? '' }}">
                          <input type='hidden' name='activation_code' id='hdn_activation_code-d' />
                          <input type="hidden" name="type" class="type-d" value="{{ $type ?? '' }}">
                        <button type="submit" class="btn  btn-lg  w-50 w-sm-25"><span>Okay</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Sign In Page End !-->

@endsection

@section('footer-scripts')
    <script src="{{ asset('assets/js/auth.js') }}"></script>
@endsection




