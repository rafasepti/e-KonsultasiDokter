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
                      Edit Data Petugas
                    </p>
                    <form class="forms-sample" action="/petugas/update" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $petugas->id }}">
                      <div class="form-group">
                        <label for="nama_petugas">Name Petugas</label>
                        <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" placeholder="Nama Petugas" value="{{ $petugas->nama_petugas }}" required>
                      </div>
                      <div class="form-group">
                        <label for="no_hp">No. HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. Hp" value="{{ $petugas->no_hp }}" required>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-4">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="jk" id="jk" value="Perempuan" {{ $petugas->jk=='Perempuan' ? 'checked' : '' }} required>
                              Perempuan
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="jk" id="jk" value="Laki-Laki" {{ $petugas->jk=='Laki-Laki' ? 'checked' : '' }} required>
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

