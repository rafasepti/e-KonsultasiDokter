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
                  <h3 class="font-weight-bold">Janji Temu Dokter {{ $spesialisasi->nama_spesialisasi }}</h3>
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
            @foreach ($dokter as $d)
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card card-light-blue border">
                  <div class="row no-gutters">
                      <div class="col-md-4">
                          @if ($d->foto)
                              <img src="{{ asset($d->foto) }}" class="card-img" alt="{{ $d->nama_dokter }}" style=" width: 100%;
                              height: 15vw;
                              object-fit: cover;">
                          @else 
                              <img src="{{  asset('assets/images/foto_dokter/default.png') }}" class="card-img" alt="{{ $d->nama_dokter }}" style=" width: 100%;
                              height: 15vw;
                              object-fit: cover;">
                          @endif
                      </div>
                      <div class="col-md-8">
                          <div class="card-body">
                              <h5 class="card-title text-light">{{ $d->nama_dokter }}</h5>
                              <h6 class="card-subtitle text-light">Dokter {{ $d->spesialisasi->nama_spesialisasi }}</h6>
                              <p class="card-text text-light">Rp.{{ number_format($d->harga_janji, 0, ',', '.') }}</p>
                              <div class="text-right">
                                <a href="{{ route('janji-rs.order', ['id' => $d->id]) }}" class="btn btn-primary">Buat Janji</a>
                              </div>
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

