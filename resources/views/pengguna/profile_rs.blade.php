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
      <div class="">
        <div class="content-wrapper">
          <!-- About 1 - Bootstrap Brain Component -->
            <section class="py-3 py-md-5">
                <div class="container">
                <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-6 col-xl-5">
                    <img class="img-fluid rounded" loading="lazy" src="{{ asset($profile->logo_app) }}" alt="About 1">
                    </div>
                    <div class="col-12 col-lg-6 col-xl-7">
                    <div class="row justify-content-xl-center">
                        <div class="col-12 col-xl-11">
                        <h2 class="mb-3">{{ $profile->nama_rs }}</h2>
                        <p class="mb-5 text-justify">
                            {{ $profile->informasi_rs }}
                        </p>
                        <div class="row gy-4 gy-md-0 gx-xxl-5X">
                            <div class="col-12 col-md-6">
                            <div class="d-flex">
                                <div class="me-4 text-primary mr-4">
                                    <i class="mdi mdi-hospital-marker icon-lg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"></i>
                                </div>
                                <div>
                                <h2 class="h4 mb-3">Alamat</h2>
                                <p class="text-secondary mb-0">{{ $profile->alamat }}</p>
                                </div>
                            </div>
                            </div>
                            <div class="col-12 col-md-6">
                            <div class="d-flex">
                                <div class="me-4 text-primary mr-4">
                                    <i class="mdi mdi-phone icon-lg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"></i>
                                </div>
                                <div>
                                <h2 class="h4 mb-3">No. Telpon</h2>
                                <p class="text-secondary mb-0">{{ $profile->no_hp }}</p>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </section>
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
