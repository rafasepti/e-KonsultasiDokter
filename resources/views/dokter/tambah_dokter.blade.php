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
                    <h4 class="card-title">Data Dokter</h4>
                    <p class="card-description">
                      Masukan Data Dokter
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
                    <form class="forms-sample" action="/dokter/store" method="post" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                        <label for="nama_dokter">Name Dokter</label>
                        <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" placeholder="Nama Dokter" required>
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
                      <div class="form-group">
                        <label for="harga_chat">Harga Chat</label>
                        <input type="number" class="form-control" id="harga_chat" name="harga_chat" placeholder="Harga Chat" required>
                      </div>
                      <div class="form-group">
                        <label for="harga_janji">Harga Janji</label>
                        <input type="number" class="form-control" id="harga_janji" name="harga_janji" placeholder="Harga Janji" required>
                      </div>
                      <div class="form-group">
                        <label>Spesialisasi</label>
                        <select class="js-example-basic-single w-100" name="spesialisasi_id" required>
                          <option value="">Pilih Spesialisasi</option>
                          @foreach ($spesialisasi as $s)
                            <option value="{{ $s->id }}">{{ $s->nama_spesialisasi }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="informasi_rs">Upload Foto Dokter</label>
                        <input type="file" name="foto" class="file-upload-default">
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

