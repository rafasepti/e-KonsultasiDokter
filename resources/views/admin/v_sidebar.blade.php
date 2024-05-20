<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item {{ Request::is('/admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('index.admin') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      @auth
        @if (auth()->user()->hak_akses == "admin")
        <li class="nav-item">
          <a class="nav-link {{ Request::is('profile-rs*') ? 'active' : '' }}" href="{{ route('profile-rs') }}">
            <i class="mdi mdi-hospital-building menu-icon"></i>
            <span class="menu-title">Profile Rumah Sakit</span>
          </a>
        </li>
          <li class="nav-item {{ Request::is('dokter*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dokter') }}">
              <i class="mdi mdi-account-box menu-icon"></i>
              <span class="menu-title">Dokter</span>
            </a>
          </li>
          <li class="nav-item {{ Request::is('spesialisasi*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('spesialisasi') }}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Spesialisasi</span>
            </a>
          </li>
          <li class="nav-item {{ Request::is('petugas*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('petugas') }}">
              <i class="mdi mdi-account-outline menu-icon"></i>
              <span class="menu-title">Petugas</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('akun*') ? 'active' : '' }}" href="{{ route('akun') }}">
              <i class="mdi mdi-account-multiple-outline menu-icon"></i>
              <span class="menu-title">Akun</span>
            </a>
          </li>
        @endif
        @if (auth()->user()->hak_akses == "petugas")
        <li class="nav-item">
          <a class="nav-link {{ Request::is('status-janji*') ? 'active' : '' }}" href="{{ route('status-janji') }}">
            <i class="mdi mdi-account-multiple-outline menu-icon"></i>
            <span class="menu-title">Rekam Medis Pasien</span>
          </a>
        </li>
        @endif
      @endauth
    </ul>
  </nav>