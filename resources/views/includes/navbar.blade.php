<nav class="navbar navbar-expand-lg  nav_bar_main_bg">
    <div class="container-fluid">
      <img src="UserSide/user_side_navbar/user_side_navbar_assets/images/Logo.svg" class="img-fluid for_nav_bar_icon">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
           <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="UserSide/HomePageComponent/salons_page.php">Salons</a>
          </li>
  
          <li class="nav-item">
            <a class="nav-link" href="UserSide/HomePageComponent/my_appointments.php">Active Appointments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Past Appointments</a>
          </li>
      
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">About Us</a>
          </li>
  
  
          <li class="nav-item for_sign_in_button_css">
          <i class="fa fa-bell-o " aria-hidden="true">
              <span>
                  <a href="{{ route('login') }}">
                    <button type="button" class="btn btn-outline-warning px-4">Sign In</button>
                  </a>
                  <!-- <button type="button" class="btn btn-warning">Warning</button> -->
  
                  
              </span>
          </i> 
        
          
  
          </li>
        </ul> 
        <!-- <form class="d-flex ml-auto">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form> -->
      </div>
    </div>
  </nav>