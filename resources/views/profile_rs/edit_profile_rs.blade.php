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
                    <h4 class="card-title">Data Rumah Sakit</h4>
                    <p class="card-description">
                      Masukan Data Rumah Sakit
                    </p>
                    <form class="forms-sample" action="/profile-rs/update" method="post">
                        @csrf
                      <div class="form-group">
                        <label for="nama_rs">Name Rumah Sakit</label>
                        <input type="text" class="form-control" id="nama_rs" name="nama_rs" placeholder="Nama" value="{{ $profile->nama_rs }}" required>
                      </div>
                      <div class="form-group">
                        <label for="no_hp">No. HP</label>
                        <input type="input" class="form-control" id="no_hp" name="no_hp" placeholder="No. Hp" value="{{ $profile->no_hp }}" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email Rumah Sakit</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $profile->email }}" required>
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat Rumah Sakit</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="4" placeholder="Alamat">{{ $profile->alamat }}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="informasi_rs">Informasi Rumah Sakit</label>
                        <textarea class="form-control" id="informasi_rs" name="informasi_rs" rows="10" style="height:100%;" placeholder="Informasi">{{ $profile->informasi_rs }}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="informasi_rs">Upload Logo Rumah Sakit</label>
                        <input type="file" name="img[]" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
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

