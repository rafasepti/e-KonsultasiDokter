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
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Data Spesialisasi</h4>
                    <p class="card-description">
                      Masukan Data Spesialisasi
                    </p>
                    <form class="forms-sample" action="/spesialisasi/store" method="post">
                        @csrf
                      <div class="form-group">
                        <label for="nama_spesialisasi">Name Spesialisasi</label>
                        <input type="text" class="form-control" id="nama_spesialisasi" name="nama_spesialisasi" placeholder="Nama Spesialisasi" required>
                      </div>
                      <div class="form-group">
                        <label for="nama_spesialisasi">Gelar Spesialisasi</label>
                        <input type="text" class="form-control" id="gelar" name="gelar" placeholder="Gelar" required>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
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

