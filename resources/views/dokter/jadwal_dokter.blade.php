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
                    <h4 class="card-title">Data Jadwal Dokter</h4>
                    <p class="card-description">
                      Masukan Data Jadwal Dokter
                    </p>
                    <form class="forms-sample" action="/dokter/jadwalStore" method="post">
                        @csrf
                        <input type="hidden" name="dokter_id" value="{{ $dokter->id }}">
                      <div class="form-group">
                        <label for="nama_dokter">Name Dokter</label>
                        <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" placeholder="Nama Dokter" value="{{ $dokter->nama_dokter }}" disabled required>
                      </div>
                      <h6>Pilih Jadwal</h6>
                      <div class="container">
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input hari-checkbox" name="hari[]" value="{{ strtolower($hari) }}">
                                        <label class="form-check-label">{{ $hari }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group jam-select" id="jam-{{ strtolower($hari) }}">
                                    <label>Jam {{ $hari }}</label>
                                    <select class="js-example-basic-multiple w-100" multiple="multiple" name="jam[{{ strtolower($hari) }}]" disabled>
                                        @foreach(['08.00', '10.00', '13.00', '15.00', '17.00', '19.00'] as $jam)
                                        <option>{{ $jam }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
  $(document).ready(function(){
      $('.hari-checkbox').change(function(){
          var hari = $(this).val();
          if ($(this).is(':checked')) {
              $('#jam-' + hari).find('select').prop('disabled', false);
          } else {
              $('#jam-' + hari).find('select').prop('disabled', true);
          }
      });
  });
</script>

