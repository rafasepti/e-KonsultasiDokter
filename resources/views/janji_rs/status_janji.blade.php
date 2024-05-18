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
                                    <h3 class="font-weight-bold">Status Janji</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Janji Pasien</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped yajra-datatable">
                                        <thead>
                                            <tr>
                                                <th>
                                                    No.
                                                </th>
                                                <th>
                                                    Nama Pasien
                                                </th>
                                                <th>
                                                    Tanggal
                                                </th>
                                                <th>
                                                    Jam
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                <th>
                                                    Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
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
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script type="text/javascript">
    var table;
    $(function() {
        table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('status-janji/list') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'pasien.nama_pasien',
                    name: 'pasien.nama_pasien'
                },
                {
                    data: 'tgl',
                    name: 'tgl',
                    render: function(data) {
                        var date = new Date(data);
                        return date.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                    }
                },
                {
                    data: 'waktu',
                    name: 'waktu'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, full, meta) {
                        if (data == "dibatalkan") {
                            return `<label class="badge badge-danger">Dibatalkan</label>`
                        }

                        if (data == "dikonfirmasi") {
                            return `<label class="badge badge-info">Dikonfirmasi</label>`
                        }

                        if (data == "selesai") {
                            return `<label class="badge badge-success">Selesai</label>`
                        }
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });

    });

    $(document).ready(function() {
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });

        var channel = pusher.subscribe('orders-channel');
        channel.bind('new-order', function(data) {
            // Perbarui tabel atau tampilan dengan data pesanan baru
            console.log('New Order: ', data);
            // Contoh perbarui DOM
            $('.yajra-datatable').DataTable().ajax.reload();
        });
    });

    // function checkForNewData() {
    //     $.ajax({
    //         url: "{{ route('check-for-new-data') }}",
    //         type: "GET",
    //         success: function(response) {
    //             if (response.hasNewData) {
    //                 // Refresh DataTable jika ada data baru
    //                 table.ajax.reload(null, false); // Set to false to maintain current paging position
    //             }
    //         }
    //     });
    // }

    // // Panggil fungsi checkForNewData setiap 5 detik
    // setInterval(checkForNewData, 5000);
</script>

