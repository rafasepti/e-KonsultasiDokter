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
                      Update Data Spesialisasi
                    </p>
                    <form class="forms-sample" action="/spesialisasi/update" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $spesialisasi->id }}">
                      <div class="form-group">
                        <label for="nama_spesialisasi">Name Spesialisasi</label>
                        <input type="text" class="form-control" id="nama_spesialisasi" name="nama_spesialisasi" placeholder="Nama Spesialisasi" value="{{ $spesialisasi->nama_spesialisasi }}" required>
                      </div>
                      <div class="form-group">
                        <label for="nama_spesialisasi">Gelar Spesialisasi</label>
                        <input type="text" class="form-control" id="gelar" name="gelar" placeholder="Gelar" value="{{ $spesialisasi->gelar }}" required>
                      </div>
                      <div class="form-group">
                        <label for="informasi_rs">Upload Logo Spesialisasi</label>
                        <input type="file" name="logo" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="logo_app">Logo Spesialisasi</label>
                        @if ($spesialisasi->logo)
                          <img id="previewLogo" src="{{ asset($spesialisasi->logo) }}" alt="Preview Logo" class="img-thumbnail" style="max-width: 200px;">
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

