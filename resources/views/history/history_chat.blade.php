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
                                    <h3 class="font-weight-bold">Chat Saya</h3>
                                </div>
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0 mb-3">
                                    <a href="{{ route('historyChat') }}" class="btn btn-primary mt-auto {{ is_null($status) ? 'active' : '' }}">Semua</a>
                                    <a href="{{ route('historyChat', ['status' => 'not_accepted']) }}" class="btn btn-primary mt-auto {{ $status == 'not_accepted' ? 'active' : '' }}">Belum Diterima</a>
                                    <a href="{{ route('historyChat', ['status' => 'accepted']) }}" class="btn btn-primary mt-auto {{ $status == 'accepted' ? 'active' : '' }}">Diterima</a>
                                    <a href="{{ route('historyChat', ['status' => 'ended']) }}" class="btn btn-primary mt-auto {{ $status == 'ended' ? 'active' : '' }}">Selesai</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                      Carbon\Carbon::setLocale('id');
                    @endphp
                    @foreach ($chat as $c)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="d-flex flex-column h-100">
                                        <img src="{{ $c->dokter->foto }}" alt="{{ $c->dokter->nama_dokter }}" class="rounded-circle" style="width: 60%;">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="d-flex flex-column h-100">
                                        <h5 class="card-title">{{ $c->dokter->nama_dokter }}</h5>
                                        <p class="card-text">Pasien {{ $c->pasien->nama_pasien }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            @if ($c->status_chat == "not_accepted")
                                <button class="btn btn-danger mt-auto" disabled>Belum DIterima</button>
                            @endif
                            @if ($c->status_chat == "accepted")
                                <button class="btn btn-info mt-auto" disabled>Diterima</button>
                            @endif
                            @if ($c->status_chat == "ended")
                                <button class="btn btn-success mt-auto" disabled>Selesai</button>
                            @endif
                            <div class="ml-auto">
                                @if ($c->status_chat == "accepted" || $c->status_chat == "ended")
                                    <a href="/ChatDokter/{{ $c->dokter->id }}" class="btn btn-success mt-auto">Chat</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
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

