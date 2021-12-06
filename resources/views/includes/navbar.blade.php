<nav class="navbar navbar-expand-lg  nav_bar_main_bg">
    <div class="container-fluid px-xxl-5 px-xl-5 px-lg-5 mx-xxl-5 mx-xl-5">
      <img src="{{ asset('assets/images/user_nav_images/Logo.svg') }}" class="img-fluid for_nav_bar_icon">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
           <li class="nav-item px-xxl-5 px-xl-5 px-lg-4">
            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item px-xxl-5 px-xl-5 px-lg-4">
            <a class="nav-link" href="{{ route('allSalons') }}">Salons</a>
          </li>


          @if (Auth::user())
            <li class="nav-item px-xxl-5 px-xl-5 px-lg-4">
                <a class="nav-link" href="{{ route('userAppointments', Auth::user()->uuid ?? '') }}">Active Appointments</a>
            </li>

          @else

          @endif
          {{-- <li class="nav-item px-xxl-5 px-xl-5 px-lg-4">
            <a class="nav-link" href="#">Past Appointments</a>
          </li> --}}

          <li class="nav-item px-xxl-5 px-xl-5 px-lg-4">
            <a class="nav-link active" aria-current="page" href="{{ route('aboutUsUser') }}">About Us</a>
          </li>

          <li class="nav-item px-xxl-5 px-xl-5 px-lg-4">
            <a class="nav-link active" aria-current="page" href="{{ route('pricatedPolicy') }}">Privacy Policy</a>
          </li>

          <li class="nav-item px-xxl-5 px-xl-5 px-lg-4">
            <a class="nav-link active" aria-current="page" href="{{ route('termsCondition') }}">TOC</a>
          </li>

          <li class="nav-item px-xxl-5 px-xl-5 px-lg-4 for_sign_in_button_css d-flex">
          <i class="fa fa-bell-o bell_icon-s" aria-hidden="true"></i>
              <span>
                  @if (\Auth::user())
                    {{-- <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ \Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div> --}}


                    <div class="mt-2">
                    <a href="{{ route('logout') }}">
                        <button type="button" class="btn btn-outline-warning px-4">Logout</button>
                    </a>
                    </div>

                  @else
                  <!-- <a href="{{ route('weblogin') }}">
                    <button type="button" class="btn btn-outline-warning px-4">Sign In</button>
                  </a>
                  <br> -->
                    <div class="btn-group mt-2">
                        <button type="button" class="btn signin_button-s dropdown-toggle dropdown-toggle-split signin_dropdown-d" data-bs-toggle="dropdown" aria-expanded="false">
                            Sign In
                        </button>
                        <ul class="dropdown-menu bg-dark alignment-s text-start px-0">
                            <li><span class="dropdown-item spacing_none-s fg_yellow-s cursor_pointer-s" id="user_login-d">User</span></li>
                            <li><a class="dropdown-item spacing_none-s fg_yellow-s" href="{{ route('weblogin') }}">Saloon</a></li>
                        </ul>
                    </div>
                    <!-- <div class="dropdown ">
                        <a class="nav-link dropdown-toggle no_link-s align-self-center signin_dropdown-d" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('assets/images/home_page_component/signup_logo.svg')}}" width="40" class="rounded-circle mr-3" alt="user img">
                        </a>
                        <div class="dropdown-menu bg-dark alignment-s text-start px-0 mt-4">
                            <a class="dropdown-item fg_yellow-s spacing_none-s" href="{{ route('logout') }}">Log Out</a>
                        </div>
                    </div> -->

                  @endif
                  <!-- <button type="button" class="btn btn-warning">Warning</button> -->


              </span>




        </li>
        </ul>
        <!-- <form class="d-flex ml-auto">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
      </div>
    </div>
  </nav>


