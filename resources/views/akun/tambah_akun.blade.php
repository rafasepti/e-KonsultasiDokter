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
                    <h4 class="card-title">Data Pengguna</h4>
                    <p class="card-description">
                      Masukan Data Pengguna
                    </p>
                    <form class="forms-sample" action="/akun/store" method="post">
                        @csrf
                      <div class="form-group">
                        <label for="name">Name Pengguna</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Pengguna" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                        <label>Hak Akses</label>
                        <select class="js-example-basic-single w-100" name="hak_akses" required>
                          <option value="">Pilih Hak Akses</option>
                          <option value="admin">Admin</option>
                          <option value="petugas">Petugas</option>
                          <option value="dokter">Dokter</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Dokter</label>
                        <select class="js-example-basic-single w-100" name="spesialisasi_id" >
                          <option value="">Pilih Spesialisasi</option>
                          @foreach ($spesialisasi as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_spesialisasi }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Petugas</label>
                        <select class="js-example-basic-single w-100" name="spesialisasi_id">
                          <option value="">Pilih Spesialisasi</option>
                          @foreach ($spesialisasi as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_spesialisasi }}</option>
                          @endforeach
                        </select>
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

