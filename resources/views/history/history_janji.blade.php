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
                                    <h3 class="font-weight-bold">Janji Saya</h3>
                                </div>
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0 mb-3">
                                    <a href="{{ route('historyJanji') }}" class="btn btn-primary mt-auto {{ is_null($status) ? 'active' : '' }}">Semua</a>
                                    <a href="{{ route('historyJanji', ['status' => 'dikonfirmasi']) }}" class="btn btn-primary mt-auto {{ $status == 'dikonfirmasi' ? 'active' : '' }}">Dikonfirmasi</a>
                                    <a href="{{ route('historyJanji', ['status' => 'dibatalkan']) }}" class="btn btn-primary mt-auto {{ $status == 'dibatalkan' ? 'active' : '' }}">Dibatalkan</a>
                                    <a href="{{ route('historyJanji', ['status' => 'selesai']) }}" class="btn btn-primary mt-auto {{ $status == 'selesai' ? 'active' : '' }}">Selesai</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                      Carbon\Carbon::setLocale('id');
                    @endphp
                    @foreach ($janji as $j)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="d-flex flex-column h-100">
                                        @if ($j->dokter->foto != null)
                                        <img src="{{ $j->dokter->foto }}" alt="{{ $j->dokter->nama_dokter }}" class="rounded-circle" style="width: 60%;">
                                        @else
                                            <img src="{{  asset('assets/images/foto_dokter/default.png') }}" class="card-img" alt="Foto Dokter" style="width: 170px">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="d-flex flex-column h-100">
                                        <h5 class="card-title">{{ $j->dokter->nama_dokter }}</h5>
                                        <p class="card-text">Pasien {{ $j->pasien->nama_pasien }}</p>
                                        <p class="card-text">{{ \Carbon\Carbon::parse($j->tgl)->translatedFormat('l, d M Y') }}</p>
                                        <p class="card-text">Jam {{ $j->waktu }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            @if ($j->status == "dikonfirmasi")
                                <button class="btn btn-info mt-auto" disabled>Dikonfirmasi</button>
                            @endif
                            @if ($j->status == "selesai")
                                <button class="btn btn-success mt-auto" disabled>Selesai</button>
                            @endif
                            @if ($j->status == "dibatalkan")
                                <button class="btn btn-danger mt-auto" disabled>Dibatalkan</button>
                            @endif
                            <div class="ml-auto">
                                @if ($j->status == "dikonfirmasi")
                                    <a href="{{ route('historyJanji.surat', ['id' => $j->id]) }}" class="btn btn-primary mt-auto">Surat Konfirmasi</a>
                                    <a href="#" class="btn btn-danger mt-auto" data-id="{{ $j->id }}" onclick="event.preventDefault(); confirmCancel(this);">Batalkan</a>
                                @else
                                    <a href="{{ route('status-janji.show', ['id' => $j->id]) }}" class="btn btn-info">
                                        Detail
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <form id="cancelForm" method="POST" style="display: none;">
                    @csrf
                </form>
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
<script>
    function confirmCancel(element) {
        if (confirm('Apakah Anda yakin ingin membatalkan janji ini?')) {
            // Mendapatkan ID dari atribut data-id
            var id = element.getAttribute('data-id');
            // Mengatur aksi formulir
            var form = document.getElementById('cancelForm');
            form.action = '/history-janji/batal/' + id;
            // Mengirimkan formulir
            form.submit();
        }
    }
</script>
</html>

