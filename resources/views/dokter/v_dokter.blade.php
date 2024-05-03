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
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Data Dokter</h3>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <a href="dokter/tambah" class="btn btn-primary btn-rounded btn-fw">Tambah Data</a>
                  </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Spesialisasi Dokter</h4>
                <div class="table-responsive">
                  <table class="table table-striped yajra-datatable">
                    <thead>
                      <tr>
                        <th>
                          No.
                        </th>
                        <th>
                          Nama Dokter
                        </th>
                        <th>
                          Jenis Kelamin
                        </th>
                        <th>
                          Spesialisasi
                        </th>
                        <th>
                          Aksi
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
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

<script type="text/javascript">
    $(function () {
      
      var table = $('.yajra-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ url('dokter/list') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'nama_dokter', name: 'nama_dokter'},
              {data: 'jk', name: 'jk'},
              {data: 'spesialisasi.nama_spesialisasi', name: 'spesialisasi.nama_spesialisasi'},
              {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
              },
          ]
      });
      
    });
  </script>

