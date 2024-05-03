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
                    <h4 class="card-title">Data Petugas</h4>
                    <p class="card-description">
                      Masukan Data Petugas
                    </p>
                    <form class="forms-sample" action="/petugas/store" method="post">
                        @csrf
                      <div class="form-group">
                        <label for="nama_petugas">Name Petugas</label>
                        <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" placeholder="Nama Petugas" required>
                      </div>
                      <div class="form-group">
                        <label for="no_hp">No. HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. Hp" required>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-4">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="jk" id="jk" value="Perempuan" required>
                              Perempuan
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="jk" id="jk" value="Laki-Laki" required>
                              Laki-Laki
                            </label>
                          </div>
                        </div>
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

