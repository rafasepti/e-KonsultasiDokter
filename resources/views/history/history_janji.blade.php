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
                                    <h3 class="font-weight-bold">History janji temu dokter</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
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
                                                    Nama Dokter
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
            ajax: "{{ route('historyJanji.list-janji') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'pasien.nama_pasien',
                    name: 'pasien.nama_pasien'
                },
                {
                    data: 'dokter.nama_dokter',
                    name: 'dokter.nama_dokter'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, full, meta) {
                        if (data == "dikonfirmasi") {
                            return `<label class="badge badge-info">Dikonfirmasi</label>`
                        }

                        if (data == "selesai") {
                            return `<label class="badge badge-success">Selesai</label>`
                        }

                        if (data == "dibatalkan") {
                            return `<label class="badge badge-danger">Dibatalkan</label>`
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
        channel.bind('new-order-janji', function(data) {
            // Perbarui tabel atau tampilan dengan data pesanan baru
            console.log('New Order: ', data);
            // Contoh perbarui DOM
            $('.yajra-datatable').DataTable().ajax.reload();
        });
    });
</script>

