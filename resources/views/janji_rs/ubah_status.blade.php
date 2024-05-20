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
                    <form class="forms-sample" method="post" action="{{ route('status-janji.update-status') }}">
                        @csrf
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Ubah Status</h4>
                                    <div class="form-group row">
                                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Ubah
                                            Status</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $id }}">
                                            <select name="status" id="status" class="form-control">
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option value="dikonfirmasi" {{ $janji->status == "dikonfirmasi" ? 'selected' : '' }}>Dikonfirmasi</option>
                                                <option value="selesai" {{ $janji->status == "selesai" ? 'selected' : '' }}>Selesai</option>
                                                <option value="dibatalkan" {{ $janji->status == "dibatalkan" ? 'dibatalkan' : '' }}>Dibatalkan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Rekam Medis Pasien</h4>
                                    <div class="form-group row">
                                        <label for="riwayat_medis" class="col-sm-3 col-form-label">Riwayat Medis</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="riwayat_medis" id="riwayat_medis"
                                                placeholder="Riwayat Medis" class="form-control" value="{{ $janji->riwayat_medis }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gelaja_keluhan" class="col-sm-3 col-form-label">Gejala dan
                                            Keluhan</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="gelaja_keluhan" id="gelaja_keluhan"
                                                placeholder="Gejala dan Keluhan" class="form-control" value="{{ $janji->gelaja_keluhan }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="diagnosa" class="col-sm-3 col-form-label">Diagnosa</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="diagnosa" id="diagnosa" placeholder="Diagnosa"
                                                class="form-control" value="{{ $janji->diagnosa }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rencana_pengobatan" class="col-sm-3 col-form-label">Rencana
                                            Pengobatan</label>
                                        <div class="col-sm-9">
                                            <textarea name="rencana_pengobatan" id="rencana_pengobatan" cols="30" rows="10"
                                                placeholder="Rencana Pengobatan" class="form-control">{{ $janji->rencana_pengobatan }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tindak_lanjut" class="col-sm-3 col-form-label">Tindak Lanjut</label>
                                        <div class="col-sm-9">
                                            <textarea name="tindak_lanjut" id="tindak_lanjut" cols="30" rows="10" placeholder="Tindak Lanjut"
                                                class="form-control">{{ $janji->tindak_lanjut }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
