  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('dist/img/gg_logo_new.jpg') }}" width="150" height="70">
                </a> -->
                <h1 class="logo-text pt-0">CLICKMETRIX</h1>
    <!-- Left navbar links -->
    <!-- <ul class="navbar-nav ml-4" style="padding-top: 36px;">
     
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Reports</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
        <li><a href="{{ route('home') }}" class="dropdown-item">Customer Service Report</a></li>
        </ul>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('datacollection') }}" class="nav-link">Data Collection</a>
      </li>
    </ul> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->