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
                    <form class="forms-sample" action="/dokter/store" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $dokter->id }}">
                      <div class="form-group">
                        <label for="nama_dokter">Name Dokter</label>
                        <input type="text" class="form-control" id="nama_dokter" name="nama_dokter" placeholder="Nama Dokter" value="{{ $dokter->nama_dokter }}" disabled required>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="hari">
                                Senin
                              </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="hari">
                                Selasa
                              </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="hari">
                                Rabu
                              </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="hari">
                                Kamis
                              </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="hari">
                                Jum'at
                              </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="hari">
                                Sabtu
                              </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="hari">
                                Minggu
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Jam Senin</label>
                            <select class="js-example-basic-multiple w-100" multiple="multiple" name="jam[]">
                              <option>08.00</option>
                              <option>10.00</option>
                              <option>13.00</option>
                              <option>15.00</option>
                              <option>17.00</option>
                              <option>19.00</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Jam Selasa</label>
                            <select class="js-example-basic-multiple w-100" multiple="multiple" name="jam[]">
                              <option>08.00</option>
                              <option>10.00</option>
                              <option>13.00</option>
                              <option>15.00</option>
                              <option>17.00</option>
                              <option>19.00</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Jam Rabu</label>
                            <select class="js-example-basic-multiple w-100" multiple="multiple" name="jam[]">
                              <option>08.00</option>
                              <option>10.00</option>
                              <option>13.00</option>
                              <option>15.00</option>
                              <option>17.00</option>
                              <option>19.00</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Jam Kamis</label>
                            <select class="js-example-basic-multiple w-100" multiple="multiple" name="jam[]">
                              <option>08.00</option>
                              <option>10.00</option>
                              <option>13.00</option>
                              <option>15.00</option>
                              <option>17.00</option>
                              <option>19.00</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Jam Jum'at</label>
                            <select class="js-example-basic-multiple w-100" multiple="multiple" name="jam[]">
                              <option>08.00</option>
                              <option>10.00</option>
                              <option>13.00</option>
                              <option>15.00</option>
                              <option>17.00</option>
                              <option>19.00</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Jam Sabtu</label>
                            <select class="js-example-basic-multiple w-100" multiple="multiple" name="jam[]">
                              <option>08.00</option>
                              <option>10.00</option>
                              <option>13.00</option>
                              <option>15.00</option>
                              <option>17.00</option>
                              <option>19.00</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Jam Minggi</label>
                            <select class="js-example-basic-multiple w-100" multiple="multiple" name="jam[]">
                              <option>08.00</option>
                              <option>10.00</option>
                              <option>13.00</option>
                              <option>15.00</option>
                              <option>17.00</option>
                              <option>19.00</option>
                            </select>
                          </div>
                        </div>
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

