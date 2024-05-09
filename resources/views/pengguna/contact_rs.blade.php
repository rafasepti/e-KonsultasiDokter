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
            <div class="">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h1 class="mb-4">Contact Us</h1>
                              <p class="card-description mb-5 text-justify">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste quaerat autem corrupti asperiores accusantium et fuga! Facere excepturi, quo eos, nobis doloremque dolor labore expedita illum iusto, aut repellat fuga!
                              </p>
                              <ul class="list-unstyled pl-md-5 mb-5">
                                <li class="d-flex text-black mb-2">
                                    <div class="d-flex">
                                        <i class="mdi mdi-hospital-marker icon-sm mr-2" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"></i>
                                        <p class="font-weight-bold">{{ $profile->alamat }}</p>
                                    </div>
                                </li>
                                <li class="d-flex text-black mb-2">
                                    <div class="d-flex">
                                        <i class="mdi mdi-phone icon-sm mr-2" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"></i>
                                        <p class="font-weight-bold">{{ $profile->no_hp }}</p>
                                    </div>
                                </li>
                                <li class="d-flex text-black"><span class="mr-3">
                                    <div class="d-flex">
                                        <i class="mdi mdi-email-outline icon-sm mr-2" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"></i>
                                        <p class="font-weight-bold">{{ $profile->email }}</p>
                                    </div>
                                </li>
                             </ul>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Send us A Message</h4>
                              <form class="forms-sample" method="POST" action="contact/send">
                                @csrf
                                <div class="form-group row">
                                  <label for="nama" class="col-sm-3 col-form-label">Name</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Name" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                                  <div class="col-sm-9">
                                    <input type="email" class="form-control" id="exampleInputEmail2" name="email" placeholder="Email" required>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label for="message" class="col-sm-3 col-form-label">Message</label>
                                  <div class="col-sm-9">
                                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Send</button>
                              </form>
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
