<!DOCTYPE html>
<html lang="en">
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('pengguna/v_header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('pengguna/v_setting')
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
            <div class="col-md-3 grid-margin stretch-card">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <h4 class="card-title text-light text-center">Top aligned media</h4>
                    <div class="media">
                      <i class="ti-world icon-md text-info d-flex align-self-start mr-3"></i>
                      <div class="media-body">
                        <p class="card-text">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <h4 class="card-title">Center aligned media</h4>
                    <div class="media">
                      <i class="ti-world icon-md text-info d-flex align-self-center mr-3"></i>
                      <div class="media-body">
                        <p class="card-text">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <h4 class="card-title">Bottom aligned media</h4>
                    <div class="media">
                      <i class="ti-world icon-md text-info d-flex align-self-end mr-3"></i>
                      <div class="media-body">
                        <p class="card-text">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card card-light-blue">
                  <div class="card-body">
                    <h4 class="card-title">Bottom aligned media</h4>
                    <div class="media">
                      <i class="ti-world icon-md text-info d-flex align-self-end mr-3"></i>
                      <div class="media-body">
                        <p class="card-text">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</p>
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

