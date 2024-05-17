<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .day-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 5px;
            cursor: pointer;
            text-align: center;
        }

        .day-button.selected {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .time-button {
            margin: 5px;
        }

        .time-button.selected {
            background-color: #007bff;
            color: white;
        }

        .day-button h6, .day-button span {
            margin: 0;
        }

        .date-picker {
            display: none;
        }

        .selected-date {
            display: none;
            margin-top: 10px;
        }

        .selected-date.visible {
            display: block;
        }

        .ui-datepicker {
            z-index: 9999 !important;
        }
    </style>
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
                                    <h3 class="font-weight-bold">Janji Temu Dokter</h3>
                                    <h6 class="font-weight-normal mb-0">Layanan telemedisin yang siap siaga untuk bantu
                                        kamu hidup lebih sehat</h6>
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
                    <form class="forms-sample" id="x-submit-form" action="{{ route('midtrans.proses-bayar-janji') }}"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
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
                                            <button type="button" style="float: right; padding-right: 0px;"
                                                class="btn btn-link" data-toggle="modal" data-target="#modalPasien">
                                                + Pasien Baru
                                            </button>
                                            <select class="js-example-basic-single w-100" name="pasien_id"
                                                id="pasien_id" required>
                                                <option value="" selected disabled>Pilih Pasien</option>
                                                @foreach ($pasien as $p)
                                                    <option value="{{ $p->id }}" data-jk="{{ $p->jk }}"
                                                        data-bb="{{ $p->bb }}" data-tb="{{ $p->tb }}"
                                                        data-tgl="{{ date('d/m/Y', strtotime($p->tgl_lahir)) }}
                                                    ">
                                                        ({{ $p->relasi }})
                                                        {{ $p->nama_pasien }}</option>
                                                @endforeach
                                            </select>
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
                                        <div class="form-group">
                                            <label for="alamat">Alamat Pasien</label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="4" placeholder="Alamat" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="penyakit_derita">Penyakit yang diderita</label>
                                            <input type="text" class="form-control" id="penyakit_derita" name="penyakit_derita" placeholder="Penyakit Yang diderita" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Keterangan" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Dokter</h4>
                                        <p class="card-description">
                                            Dokter yang akan ditemui
                                        </p>
                                        @if (session('status'))
                                            <div class="alert alert-success">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <div class="card card-tale">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    @if ($dokter->foto != null)
                                                        <img src="{{ asset($dokter->foto) }}" class="card-img"
                                                    alt="Foto Dokter" style="width: 170px">
                                                    @else
                                                        <img src="{{  asset('assets/images/foto_dokter/default.png') }}" class="card-img" alt="Foto Dokter" style="width: 170px">
                                                    @endif
                                                </div>
                                                <div class="col-md-8 text-right">
                                                    <div class="card-body d-flex flex-column justify-content-center"
                                                        style="height: 100%;">
                                                        <input type="hidden" name="dokter_id" id="dokter_id"
                                                            value="{{ $dokter->id }}">
                                                        <input type="hidden" name="total_bayar" id="total_bayar"
                                                            value="{{ $total_chat }}">
                                                        <h5 class="card-title text-light">{{ $dokter->nama_dokter }}
                                                        </h5>
                                                        <p class="card-text">Dokter
                                                            {{ $dokter->spesialisasi->nama_spesialisasi }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h4 class="mt-3 mb-3">Pilih tanggal dan waktu kunjungan</h4>
                                            @if($dokter->jadwalDokter->isEmpty())
                                                <p>Jadwal tidak tersedia.</p>
                                            @else
                                                <div class="d-flex flex-wrap">
                                                    @foreach($dokter->jadwalDokter->groupBy('hari') as $hari => $jadwals)
                                                        @php
                                                            $hariIndoToEng = [
                                                                'Senin' => 'Monday',
                                                                'Selasa' => 'Tuesday',
                                                                'Rabu' => 'Wednesday',
                                                                'Kamis' => 'Thursday',
                                                                'Jumat' => 'Friday',
                                                                'Sabtu' => 'Saturday',
                                                                'Minggu' => 'Sunday'
                                                            ];
                                                            $nextDate = \Carbon\Carbon::now()->next($hariIndoToEng[$hari])->format('d M');
                                                        @endphp
                                                        <div class="day-button" data-day="{{ $hari }}" data-date="{{ $nextDate }}"> 
                                                            <h6 class="mt-2">{{ $hari }}</h6>
                                                            <span>{{ $nextDate }}</span>
                                                        </div>
                                                    @endforeach
                                                    
                                                    <button class="btn btn-outline-primary" id="datePickerButton">
                                                        <img src="https://img.icons8.com/fluency/48/000000/calendar.png" alt="Calendar Icon" style="width: 30px;">
                                                        <p id="datePickerText">Pilih</p>
                                                    </button>
                                                    <input type="text" id="datepicker" class="date-picker">
                                                </div>
                                        
                                                <div class="mt-4">
                                                    @foreach($dokter->jadwalDokter->groupBy('hari') as $hari => $jadwals)
                                                        <div id="jadwal-{{ $hari }}" class="jadwal-group d-none">
                                                            @foreach($jadwals as $jadwal)
                                                                <button type="button" class="btn btn-outline-secondary time-button" data-time="{{ $jadwal->jam }}">{{ $jadwal->jam }}</button>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                    <div id="jadwal-date" class="jadwal-group-date d-none">
                                                    </div>
                                                </div>
                                            @endif
                                        <div class="row">
                                            <div class="col-md-6 mt-3">
                                                <h5>Biaya sesi 30 menit</h5>
                                                <h5 class="mt-3">Biaya Layanan</h5>
                                                <h5 class="mt-3">Total Pembayaran</h5>
                                            </div>
                                            <div class="col-md-6 mt-3 text-right">
                                                <p>Rp.{{ number_format($dokter->harga_chat, 0, ',', '.') }}</p>
                                                <p class="mt-2">Rp.2.000</p>
                                                <p class="mt-2">Rp.{{ number_format($total_chat, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="x_json" name="x_json">

                        <br>
                        <!-- untuk tombol simpan -->

                        <input class="col-sm-1 btn btn-success btn-sm" disabled value="Bayar" id="pay-button">

                        <!-- untuk tombol batal simpan -->
                        <a class="col-sm-1 btn btn-dark  btn-sm" href="" role="button">Batal</a>
                    </form>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('pengguna/v_footer')
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalPasien" tabindex="-1" role="dialog" aria-labelledby="modalPasien"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Masukan Data Pasien Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pasien.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_pasien">Nama</label>
                            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien"
                                placeholder="Nama" required>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="jk" id="jk"
                                            value="Perempuan" required>
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="jk" id="jk"
                                            value="Laki-Laki" required>
                                        Laki-Laki
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                placeholder="Tanggal Lahir" required>
                        </div>
                        <div class="form-group">
                            <label for="relasi">Relasi</label>
                            <select class="form-control" id="relasi" name="relasi">
                                <option>Saudara Laki-laki</option>
                                <option>Saudara Perempuan</option>
                                <option>Ayah</option>
                                <option>Ibu</option>
                                <option>Suami</option>
                                <option>Istri</option>
                                <option>Anak</option>
                                <option>Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bb">Berat Badan <small class="text-muted">(KG)</small></label>
                            <input type="number" class="form-control" id="bb" name="bb"
                                placeholder="Berat Badan" required>
                        </div>
                        <div class="form-group">
                            <label for="tb">Tinggi Badan <small class="text-muted">(CM)</small></label>
                            <input type="number" class="form-control" id="tb" name="tb"
                                placeholder="Tinggi Badan" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- container-scroller -->
</body>
<script src="https://app.sandbox.midtrans.com/snap/snap.js"></script>
<script>
    var timeSelected = false;
    // Handle time button click using event delegation
    $(document).on('click', '.time-button', function() {
        $('.time-button').removeClass('selected');
        $(this).addClass('selected');

        var selectedTime = $(this).data('time');
        console.log("Selected time: " + selectedTime);  // Handle the selected time as needed

        timeSelected = true;
        checkPaymentButtonStatus();
    });

    function checkPaymentButtonStatus() {
        if (timeSelected) {
            // Jika waktu telah dipilih, aktifkan tombol "Bayar"
            $('#pay-button').prop('disabled', false);
        } else {
            // Jika waktu tidak dipilih, nonaktifkan tombol "Bayar"
            $('#pay-button').prop('disabled', true);
        }
    }

    $(document).ready(function() {
        // Handle day button click
        $('.day-button').click(function() {
            $('.day-button').removeClass('selected');
            $(this).addClass('selected');

            var selectedDay = $(this).data('day');
            $('.jadwal-group').addClass('d-none');
            $('.jadwal-group-date').addClass('d-none');
            $('#jadwal-' + selectedDay).removeClass('d-none');

            var selectedDate = $(this).data('date');
            console.log("Selected date: " + selectedDate);
            console.log("Selected time: " + selectedDay);
            $('.time-button').removeClass('selected');
            timeSelected = false;
            checkPaymentButtonStatus();
        });
        
        $('#pasien_id').change(function() {
            var selectedOption = $(this).find(':selected');

            var jk = selectedOption.data('jk');
            var tgl_lahir = selectedOption.data('tgl');
            var tb = selectedOption.data('tb');
            var bb = selectedOption.data('bb');
            var alamat = selectedOption.data('alamat');

            if (jk == '') {
                // Mengubah tipe input dari text menjadi date
                $('#tgl_lahir1').attr('type', 'date');

                $('#jk1').prop('disabled', false);
                $('#tgl_lahir1').prop('disabled', false);
                $('#bb1').prop('disabled', false);
                $('#tb1').prop('disabled', false);

                document.getElementById('jk1').value = '';
                $('#tgl_lahir1').val('');
                $('#bb1').val('');
                $('#tb1').val('');
            } else {
                $('#tgl_lahir1').attr('type', 'text');

                document.getElementById('jk1').value = jk;
                $('#tgl_lahir1').val(tgl_lahir);
                $('#bb1').val(bb + ' KG');
                $('#tb1').val(tb + ' CM');

                $('#jk1').prop('disabled', true);
                $('#tgl_lahir1').prop('disabled', true);
                $('#bb1').prop('disabled', true);
                $('#tb1').prop('disabled', true);
            }

            if(alamat != ''){
                $('#alamat').val(alamat);
            }
        });

        const datePicker = $('#datepicker');
        const datePickerButton = $('#datePickerButton');
        const datePickerText = $('#datePickerText');

        // Ensure the datepicker input is visible during initialization
        datePicker.css('display', 'block').css('position', 'absolute').css('left', '-9999px');

        // Initialize datepicker with minDate
        const today = new Date();
        today.setDate(today.getDate() + 1);

        datePicker.datepicker({
            minDate: today,
            dateFormat: 'yy-mm-dd',
            onSelect: function(dateText) {
                const date = new Date(dateText);
                const options = { weekday: 'long', month: 'long', day: 'numeric' };
                const formattedDate = date.toLocaleDateString('id-ID', options);

                datePickerText.text(formattedDate);
                datePickerButton.parent().addClass('selected');

                // Ambil hari dari tanggal yang dipilih
                const selectedDay = date.toLocaleDateString('id-ID', { weekday: 'long' });
                const dokterId = $('#dokter_id').val();

                // Kirim permintaan ke server untuk mendapatkan jadwal dokter berdasarkan hari yang dipilih
                $.ajax({
                    url: '{{ route("janji-rs.jadwal") }}',
                    method: 'GET',
                    data: { 
                        day: selectedDay,
                        dokter_id: dokterId
                     },
                    success: function(response) {
                        // Perbarui tampilan jadwal dokter
                        updateJadwalDokter(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        });

        datePickerButton.click(function (e) {
            e.preventDefault();
            console.log("Button clicked");  // Tambahkan ini untuk debugging
            datePicker.datepicker('show');
        });

        function updateJadwalDokter(data) {
            // Hapus jadwal dokter yang sudah ada
            timeSelected = false;
            checkPaymentButtonStatus();
            $('#jadwal-date .time-button').remove();
            $('.jadwal-group').addClass('d-none');
            $('.day-button').removeClass('selected');
            $('.time-button').removeClass('selected');
            // Tampilkan jadwal dokter yang baru
            data.forEach(function(jadwal) {
                console.log(jadwal)
                var button = $('<button/>', {
                    type: 'button',
                    class: 'btn btn-outline-secondary time-button',
                    'data-time': jadwal.jam,
                    text: jadwal.jam
                });
                $('#jadwal-date').removeClass('d-none');
                $('#jadwal-date').append(button);
            });
        }
    });

    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        var form = document.getElementById('x-submit-form');   
        if (form.checkValidity() === false) {
            alert('Harap isi semua data yang diperlukan.');
        }else{
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            // window.snap.pay('TRANSACTION_TOKEN_HERE');
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    // alert("payment success!"); console.log(result);
                    isi_formulir(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    // alert("wating your payment!"); console.log(result);
                    isi_formulir(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    // alert("payment failed!"); console.log(result);
                    isi_formulir(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            });
        }
        // customer will be redirected after completing payment pop-up
    });

    //   fungsi untuk mengirim response call back
    function isi_formulir(result) {
        document.getElementById('x_json').value = JSON.stringify(result);
        //alert(document.getElementById('x_json').value);
        $('#x-submit-form').submit();
    }
</script>

</html>
