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
                        <div class="input-group has-validation">
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                          <button class="input-group-text" type="button" id="show-password"><i class="mdi mdi-eye"></i></button>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Hak Akses</label>
                        <select class="form-control" name="hak_akses" id="hak_akses" required>
                          <option value="">Pilih Hak Akses</option>
                          <option value="admin">Admin</option>
                          <option value="petugas">Petugas</option>
                          <option value="dokter">Dokter</option>
                        </select>
                      </div>
                      <div class="form-group" id="dokterField" style="display: none;">
                        <label>Dokter</label>
                        <select class="form-control" name="user_id" id="kode_dokter">
                          <option value="">Pilih Dokter</option>
                          @foreach ($dokter as $d)
                            <option value="{{ $d->kode_dokter }}">{{ $d->nama_dokter }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group" id="petugasField" style="display: none;">
                        <label>Petugas</label>
                        <select class="form-control" name="user_id" id="kode_petugas">
                          <option value="">Pilih Petugas</option>
                          @foreach ($petugas as $p)
                            <option value="{{ $p->kode_petugas }}">{{ $p->nama_petugas }}</option>
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

<script>
  document.getElementById('show-password').addEventListener('click', function() {
      var passwordInput = document.getElementById('password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        this.innerHTML = '<i class="mdi mdi-eye-off"></i>';
      } else {
        passwordInput.type = 'password';
        this.innerHTML = '<i class="mdi mdi-eye"></i>';
      }
    });

  document.getElementById('hak_akses').addEventListener('change', function() {
      var hakAkses = this.value;
      if (hakAkses === 'dokter') {
          document.getElementById('dokterField').style.display = 'block';
          document.getElementById('petugasField').style.display = 'none';
      } else if (hakAkses === 'petugas' || hakAkses === 'admin') {
          document.getElementById('dokterField').style.display = 'none';
          document.getElementById('petugasField').style.display = 'block';
      } else {
          document.getElementById('dokterField').style.display = 'none';
          document.getElementById('petugasField').style.display = 'none';
      }
  });
</script>

