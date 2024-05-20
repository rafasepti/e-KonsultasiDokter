<!DOCTYPE html>
<html lang="en">
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('admin/v_header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('admin/v_setting')
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      @include('admin/v_sidebar')
      <!-- partial -->
      <div class="main-panel">
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
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="{{  asset('assets') }}/images/dashboard/dokter.png" alt="people" style="width: 300px;">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="mdi mdi-account-multiple-outline mr-2"></i></h2>
                      </div>
                      <div class="ml-2">
                        <h3 class="font-weight-normal mb-2">Selamat Datang,</h3>
                          <h3 class="font-weight-normal">{{ auth()->user()->name }}</h3>
                          <h6 class="font-weight-normal">{{ auth()->user()->hak_akses }}</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <h4 class="mt-3 mb-4">Jumlah Pasien</h4>
                      <p class="fs-30 mb-2">{{ $pasien }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <h4 class="mt-3 mb-4">Jumlah Dokter</h4>
                      <p class="fs-30 mb-2">{{ $dokter }}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <h4 class="mt-3 mb-4">Total Pendapatan Bulan ini</h4>
                      <p class="fs-30 mb-2">Rp. {{ number_format($totalThisMonth, 0, ',', '.')  }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <h4 class="mt-3 mb-4">Total Pendapatan Tahun ini</h4>
                      <p class="fs-30 mb-2">Rp. {{ number_format($totalThisYear, 0, ',', '.')  }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin/v_footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
</body>

</html>

