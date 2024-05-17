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
                                    <h3 class="font-weight-bold">Profile</h3>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                            <button class="btn btn-sm btn-light bg-white" disabled type="button"
                                                id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="true">
                                                <i class="mdi mdi-calendar"></i> Hari ini
                                                ({{ \Carbon\Carbon::now()->format('d/m/Y') }})
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="forms-sample" id="x-submit-form" action="{{ route('midtrans.proses-bayar') }}"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Pasien</h4>
                                        <p class="card-description">
                                            Masukan pasien yang perlu penanganan
                                        </p>
                                        @if (session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="pasien_id">Nama Pasien</label>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="jk1">Jenis Kelamin</label>
                                                    <select name="jk1" id="jk1" class="form-control" disabled>
                                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                        <option value="Laki-Laki">Laki-Laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="bb1">Berat Badan (KG)</label>
                                                    <input type="text" class="form-control" id="bb1"
                                                        name="bb1" placeholder="Berat Badan" disabled required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tgl_lahir1">Tanggal Lahir</label>
                                                    <input type="text" class="form-control" id="tgl_lahir1"
                                                        name="tgl_lahir1" placeholder="Tanggal Lahir" disabled required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tb1">Tinggi Badan (CM)</label>
                                                    <input type="text" class="form-control" id="tb1"
                                                        name="tb1" placeholder="Tinggi Badan" disabled required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Dokter</h4>
                                        <p class="card-description">
                                            Dokter yang akan dichat
                                        </p>
                                        @if (session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <div class="card card-tale">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                        <img src="{{  asset('assets/images/foto_dokter/default.png') }}" class="card-img" alt="Foto Dokter" style="width: 170px">
                                                    
                                                </div>
                                                <div class="col-md-8 text-right">
                                                    <div class="card-body d-flex flex-column justify-content-center"
                                                        style="height: 100%;">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                                <h5>Biaya sesi 30 menit</h5>
                                                <h5 class="mt-3">Biaya Layanan</h5>
                                                <h5 class="mt-3">Total Pembayaran</h5>
                                            </div>
                                            <div class="col-md-6 mt-3 text-right">
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </form>
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
