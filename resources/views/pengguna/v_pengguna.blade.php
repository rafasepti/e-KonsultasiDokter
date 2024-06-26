<!DOCTYPE html>
<html lang="en">
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('pengguna/v_header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <!-- partial -->
      <div class="main-panel" style="width:100%;">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Solusi Kesehatan Terlengkap</h3>
                  <h6 class="font-weight-normal mb-0">Chat dokter, kunjungi rumah sakit, semua bisa di sini!</h6>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white" disabled type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> Hari ini ({{ \Carbon\Carbon::now()->format('d/m/Y') }})
                    </button>
                  </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card card-tale">
                <div class="card-people mt-auto">
                  <img src="{{  asset('assets') }}/images/dashboard/dokter.png" alt="people" style="width: 300px;">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="mdi mdi-account-multiple-outline mr-2"></i></h2>
                      </div>
                      <div class="ml-2">
                        <h3 class="font-weight-normal mb-2">Selamat Datang,</h3>
                        @if (auth()->check())
                          <h3 class="font-weight-normal">{{ auth()->user()->name }}</h3>
                        @else
                          <h3 class="font-weight-normal">Guest</h3>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 transparent">
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card card-light-blue">
                    <div class="card-people mt-auto">
                      <div class="row">
                        <div class="col-12 col-sm-6 d-flex align-items-center">
                          <div class="weather-info">
                            <div class="d-flex">
                              <div>
                                <h2 class="mb-0 mt-2 font-weight-normal"><i class="mdi mdi-comment-text-outline mr-2"></i></h2>
                              </div>
                              <div class="ml-2 mt-2">
                                @if (auth()->check())
                                  @if (auth()->user()->hak_akses === "dokter")
                                    <a href="{{ route('pembayaran.view-status') }}" class="link-offset-2 link-underline-opacity-0 text-light">
                                      <h4 class="location font-weight-normal mb-1">Status chat</h4>
                                      <h6 class="location font-weight-normal">dengan pasien</h6>
                                    </a>
                                  @else
                                    <a href="{{ route('chat-rs') }}" class="link-offset-2 link-underline-opacity-0 text-light">
                                      <h4 class="location font-weight-normal mb-1">Chat dengan</h4>
                                      <h6 class="location font-weight-normal">Dokter</h6>
                                    </a>
                                  @endif
                                @else
                                  <a href="{{ route('chat-rs') }}" class="link-offset-2 link-underline-opacity-0 text-light">
                                    <h4 class="location font-weight-normal mb-1">Chat dengan</h4>
                                    <h6 class="location font-weight-normal">Dokter</h6>
                                  </a>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6 d-flex justify-content-center align-items-center">
                          @if (auth()->check())
                            @if (auth()->user()->hak_akses === "dokter")
                              <a href="{{ route('pembayaran.view-status') }}" class="link-offset-2 link-underline-opacity-0 text-light">
                                <img src="{{ asset('assets') }}/images/dashboard/chat.png" alt="people" style="width: 150px;" class="float-right mr-5">
                              </a>
                            @else
                              <a href="{{ route('chat-rs') }}" class="link-offset-2 link-underline-opacity-0 text-light">
                                <img src="{{ asset('assets') }}/images/dashboard/chat.png" alt="people" style="width: 150px;" class="float-right mr-5">
                              </a>
                            @endif
                          @else
                            <a href="{{ route('chat-rs') }}" class="link-offset-2 link-underline-opacity-0 text-light">
                              <img src="{{ asset('assets') }}/images/dashboard/chat.png" alt="people" style="width: 150px;" class="float-right mr-5">
                            </a>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card card-dark-blue">
                    <div class="card-people mt-auto">
                      <div class="row">
                        <div class="col-12 col-sm-6 d-flex align-items-center">
                          <div class="weather-info">
                            <div class="d-flex">
                              <div>
                                <h2 class="mb-0 mt-2 font-weight-normal"><i class="mdi mdi-content-paste mr-2"></i></h2>
                              </div>
                              <div class="ml-2 mt-2">
                                @if (auth()->check())
                                  @if (auth()->user()->hak_akses === "dokter")
                                    <a href="{{ route('status-janji') }}" class="link-offset-2 link-underline-opacity-0 text-light">
                                      <h4 class="location font-weight-normal mb-1">Janji dengan</h4>
                                      <h6 class="location font-weight-normal">Pasien</h6>
                                    </a>
                                  @else
                                    <a href="{{ route('janji-rs') }}" class="link-offset-2 link-underline-opacity-0 text-light">
                                      <h4 class="location font-weight-normal mb-1">Buat Janji</h4>
                                      <h6 class="location font-weight-normal">Rumah Sakit</h6>
                                    </a>
                                  @endif
                                @else
                                  <a href="{{ route('janji-rs') }}" class="link-offset-2 link-underline-opacity-0 text-light">
                                    <h4 class="location font-weight-normal mb-1">Buat Janji</h4>
                                    <h6 class="location font-weight-normal">Rumah Sakit</h6>
                                  </a>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-6 d-flex justify-content-center align-items-center">
                          <a href="{{ route('janji-rs') }}" class="link-offset-2 link-underline-opacity-0 text-light">
                            <img src="{{ asset('assets') }}/images/dashboard/periksa.png" alt="people" style="width: 200px;" class="float-right mr-4">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('pengguna/v_footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
</body>

</html>

