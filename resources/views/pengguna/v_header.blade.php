<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Konsultasi Dokter</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{  asset('assets') }}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{  asset('assets') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{  asset('assets') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{  asset('assets') }}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{  asset('assets') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="{{  asset('assets') }}/js/select.dataTables.min.css">
    <link rel="stylesheet" href="{{  asset('assets') }}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{  asset('assets') }}/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{  asset('assets') }}/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{  asset('assets') }}/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{  asset('assets') }}/images/favicon.png" />
    @vite('resources/js/app.js')
</head>

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo ml-5 mr-5" tyle="font-size: 18px" href="/">E-Konsultasi Dokter</a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="padding-left: 0px;">
      <ul class="navbar-nav mr-lg-2">
        <li class="nav-item d-none d-lg-block" style="
          margin-left: 0px; margin-right: 0px;">
          <a href="{{ route('index') }}" class="dropdown-item">
            Home
          </a>
        </li>
        <li class="nav-item d-none d-lg-block" style="
          margin-left: 0px; margin-right: 0px;">
          <a href="{{ route('profile-rs.pengguna') }}" class="dropdown-item">
            Profile
          </a>
        </li>
        <li class="nav-item d-none d-lg-block" style="
          margin-left: 0px; margin-right: 0px;">
          <a href="{{ route('contact-rs.pengguna') }}" class="dropdown-item">
            Contact
          </a>
        </li>
        @if (auth()->check() && auth()->user()->hak_akses == 'pasien')
        <li class="nav-item dropdown d-none d-lg-block" style="margin-left: 15px; margin-right: 0px;">
          <a class="nav-link dropdown-toggle" href="#" id="historyDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            History
          </a>
          <div class="dropdown-menu" aria-labelledby="historyDropdown">
            <a class="dropdown-item" href="{{ route('historyChat') }}">Chat Saya</a>
            <a class="dropdown-item" href="{{ route('historyJanji') }}">Janji Saya</a>
          </div>
        </li>
        @endif
      </ul>
      <ul class="navbar-nav navbar-nav-right">
        @if (auth()->check())
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{  asset('assets') }}/images/logo/profile.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              {{-- <a href="{{ route('profile') }}" class="dropdown-item">
                <i class="ti-user text-primary"></i>
                Profile
              </a> --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="ti-power-off text-primary"></i> Logout</button>
                </form>
            </div>
          </li>
        @else
          <li class="nav-item nav-profile ">
            <a href="{{ route('login') }}" class="dropdown-item">
              Login
            </a>
          </li>
        @endif
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
      </button>
    </div>
  </nav>