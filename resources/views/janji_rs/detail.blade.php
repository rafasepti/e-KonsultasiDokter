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
                              <h3 class="font-weight-bold">Detail Janji Temu Pasien</h3>
                            </div>
                            <div class="col-12 col-xl-4">
                             <div class="justify-content-end d-flex">
                              <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <a href="{{ route('status-janji.print-janji', ['id' => $janji->id]) }}" class="btn btn-primary btn-rounded btn-fw">Print</a>
                              </div>
                             </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Informasi pasien</h4>
                                <form class="forms-sample">
                                    <div class="form-group row">
                                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Username" value="{{ $janji->pasien->nama_pasien }}" disabled>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                      <div class="col-sm-9">
                                        <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email" value="{{ \Carbon\Carbon::parse($janji->pasien->tgl_lahir)->format('d/m/Y') }}" disabled>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="Mobile number" value="{{  $janji->pasien->jk }}" disabled>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Alamat Email</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputPassword2" placeholder="Password" value="{{ $janji->user->email }}" disabled>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Alamat Rumah</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputConfirmPassword2" placeholder="Password" value="{{ $janji->pasien->alamat }}" disabled>
                                      </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Detail Janji Temu</h4>
                                <form class="forms-sample">
                                    <div class="form-group row">
                                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tanggal dan Waktu</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Username" value="{{ $tanggalBaru }} Pukul {{ $janji->waktu }}" disabled>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Tujuan/Keluhan</label>
                                      <div class="col-sm-9">
                                        <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email" value="{{ $janji->penyakit }}" disabled>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Keterangan</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputMobile" placeholder="Mobile number" value="{{ $janji->ket }}" disabled>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Nama Dokter</label>
                                      <div class="col-sm-9">
                                        <input type="text" class="form-control" id="exampleInputPassword2" placeholder="Password" value="{{ $janji->dokter->nama_dokter }}" disabled>
                                      </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                              <h4 class="card-title">Detail Rekam Medis Pasien</h4>
                              <form class="forms-sample">
                                  <div class="form-group row">
                                    <label for="riwayat_medis" class="col-sm-3 col-form-label">Riwayat Medis</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="riwayat_medis" id="riwayat_medis"
                                            placeholder="Riwayat Medis" class="form-control" value="{{ $janji->riwayat_medis }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gelaja_keluhan" class="col-sm-3 col-form-label">Gejala dan
                                        Keluhan</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="gelaja_keluhan" id="gelaja_keluhan"
                                            placeholder="Gejala dan Keluhan" class="form-control" value="{{ $janji->gelaja_keluhan }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diagnosa" class="col-sm-3 col-form-label">Diagnosa</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="diagnosa" id="diagnosa" placeholder="Diagnosa"
                                            class="form-control" value="{{ $janji->diagnosa }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rencana_pengobatan" class="col-sm-3 col-form-label">Rencana
                                        Pengobatan</label>
                                    <div class="col-sm-9">
                                        <textarea name="rencana_pengobatan" id="rencana_pengobatan" cols="30" rows="10"
                                            placeholder="Rencana Pengobatan" class="form-control" disabled>{{ $janji->rencana_pengobatan }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tindak_lanjut" class="col-sm-3 col-form-label">Tindak Lanjut</label>
                                    <div class="col-sm-9">
                                        <textarea name="tindak_lanjut" id="tindak_lanjut" cols="30" rows="10" placeholder="Tindak Lanjut"
                                            class="form-control" disabled>{{ $janji->tindak_lanjut }}</textarea>
                                    </div>
                                </div>
                              </form>
                          </div>
                      </div>
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

