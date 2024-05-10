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
                      Edit Data Dokter
                    </p>
                    <form class="forms-sample" action="/dokter/update" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $dokter->id }}">
                      <div class="form-group">
                        <label for="nama_dokter">Name Dokter</label>
                        <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" placeholder="Nama Dokter" value="{{ $dokter->nama_dokter }}" required>
                      </div>
                      <div class="form-group">
                        <label for="no_hp">No. HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. Hp" value="{{ $dokter->no_hp }}" required>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-4">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="jk" id="jk" value="Perempuan" {{ $dokter->jk=='Perempuan' ? 'checked' : '' }} required>
                              Perempuan
                            </label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="jk" id="jk" value="Laki-Laki" {{ $dokter->jk=='Laki-Laki' ? 'checked' : '' }} required>
                              Laki-Laki
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="harga_chat">Harga Chat</label>
                        <input type="number" class="form-control" id="harga_chat" name="harga_chat" placeholder="Harga Chat" value="{{ $dokter->harga_chat }}" required>
                      </div>
                      <div class="form-group">
                        <label for="harga_janji">Harga Janji</label>
                        <input type="number" class="form-control" id="harga_janji" name="harga_janji" placeholder="Harga Janji" value="{{ $dokter->harga_janji }}" required>
                      </div>
                      <div class="form-group">
                        <label>Spesialisasi</label>
                        <select class="js-example-basic-single w-100" name="spesialisasi_id" required>
                          <option value="">Pilih Spesialisasi</option>
                          @foreach ($spesialisasi as $s)
                            <option value="{{ $s->id }}" {{ $dokter->spesialisasi_id==$s->id ? 'selected' : '' }}>{{ $s->nama_spesialisasi }}</option>
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
                      <div class="form-group">
                        <label for="logo_app">Foto Dokter</label>
                        @if ($dokter->foto)
                          <img id="previewLogo" src="{{ asset($dokter->foto) }}" alt="Preview Logo" class="img-thumbnail" style="max-width: 200px;">
                        @endif
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

