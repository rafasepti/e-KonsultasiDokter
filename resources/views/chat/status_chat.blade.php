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

