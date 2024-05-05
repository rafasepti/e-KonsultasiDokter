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
                      Edit Data Pengguna
                    </p>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  @endif
                    <form class="forms-sample" action="/akun/update" method="post">
                      <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                      @csrf
                      @if ($user->hak_akses == "dokter")
                      <div class="form-group">
                        <label>Hak Akses</label>
                        <input type="text" class="form-control" id="hak_akses" name="hak_akses" placeholder="Hak Akses" value="{{ $user->hak_akses }}" readonly required>
                      </div>
                      <div class="form-group" id="dokterField">
                        <label>Dokter</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Dokter" value="{{ $dokter->nama_dokter }}" readonly required>
                      </div>
                      @else
                      <div class="form-group" id="petugasField">
                        <div class="form-group">
                          <label>Hak Akses</label>
                          <select class="form-control" name="hak_akses" id="hak_akses" required>
                            <option value="">Pilih Hak Akses</option>
                            <option value="admin" {{ $user->hak_akses == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="petugas" {{ $user->hak_akses == 'petugas' ? 'selected' : '' }}>Petugas</option>
                          </select>
                        </div>
                        <label>Petugas</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Petugas" value="{{ $petugas->nama_petugas }}" readonly required>
                      </div>
                      @endif
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}" required>
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
