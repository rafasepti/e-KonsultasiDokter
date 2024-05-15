<!DOCTYPE html>
<html lang="en">
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('pengguna/v_header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('pengguna/v_setting')
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <!-- partial -->
      <div class="main-panel" style="width:100%;">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Buat Janji Temu RS</h3>
                  <h6 class="font-weight-normal mb-0">Layanan telemedisin yang siap siaga untuk bantu kamu hidup lebih sehat</h6>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white" disabled type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> Hari ini ({{ \Carbon\Carbon::now()->format('d/m/Y') }})
                    </button>
                  </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            @foreach ($spesialisasi as $s)
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card card-light-blue">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h4 class="card-title text-light text-center"><a href="{{ route('janji-rs.spesialisasi', ['id' => $s->id]) }}" class="text-light">{{ $s->nama_spesialisasi }}</a></h4>
                        <div class="media">
                            <div class="media-body">
                                <a href="{{ route('janji-rs.spesialisasi', ['id' => $s->id]) }}"><img src="{{ $s->logo }}" alt="" style="width: 100px;"></a>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('pengguna/v_footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
</body>

</html>

