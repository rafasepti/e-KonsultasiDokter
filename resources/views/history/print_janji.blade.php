<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Surat dengan Header dan Footer</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }
            .content {
                padding: 20px;
            }
            .header, .footer {
                background-color: #f8f9fa;
                padding: 10px 20px;
            }
            .header {
                border-bottom: 2px solid #dee2e6;
            }
            .footer {
                border-top: 2px solid #dee2e6;
                position: fixed;
                width: 100%;
                bottom: 0;
            }
            .footer p {
                margin: 0;
            }

            p {
                font-size: 20px; /* Adjust font size for <p> tags */
            }
        </style>
    </head>
    <body>
        <!-- Header -->
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>Confirmation Letter</h1>
                        <p>Email: {{ $profile_rs->email }} | Telepon: {{ $profile_rs->no_hp }}</p>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Main Content -->
        <div class="content container">
            <div class="row">
                <div class="col-12 text-justify">
                    <br>
                    <h4 class="text-primary">Yth, Bapak/Ibu {{ $janji->pasien->nama_pasien }}</h4>
                    <p>Berikut Surat Konfirmasi untuk jadwal konsultasi di rumah sakit {{ $profile_rs->nama_rs }}, Berdasarkan permintaan pasien tersebut di bawah ini:</p>
                    <table>
                        <tr>
                            <td><p>Nama Pasien</p></td>
                            <td><p>:</p></td>
                            <td><p> {{ $janji->pasien->nama_pasien }}</p></td>
                        </tr>
                        <tr>
                            <td><p>Jenis Kelamin</p></td>
                            <td><p>:</p></td>
                            <td><p> {{ $janji->pasien->jk }}</p></td>
                        </tr>
                        <tr>
                            <td><p>Nama Pasien</p></td>
                            <td><p>:</p></td>
                            <td><p> {{ $janji->pasien->nama_pasien }}</p></td>
                        </tr>
                        <tr>
                            <td><p>Alamat</p></td>
                            <td><p>:</p></td>
                            <td><p> {{ $janji->pasien->alamat }}</p></td>
                        </tr>
                    </table>
                    <br>
                    <p>Telah mendapatkan jadwal konsultasi di rumah sakit {{ $profile_rs->nama_rs }} dengan keterangan sebagai berikut:</p>
                    <table>
                        <tr>
                            <td><p>Konsultarn/p></td>
                            <td><p>:</p></td>
                            <td><p> {{ $janji->dokter->nama_dokter }}</p></td>
                        </tr>
                        <tr>
                            <td><p>Spesialisasi</p></td>
                            <td><p>:</p></td>
                            <td><p> {{ $janji->dokter->spesialisasi->nama_spesialisasi }}</p></td>
                        </tr>
                        <tr>
                            <td><p>Hari/Tanggal</p></td>
                            <td><p>:</p></td>
                            <td><p> {{ $tanggalBaru }}</p></td>
                        </tr>
                        <tr>
                            <td><p>Jam Konsultasi</p></td>
                            <td><p>:</p></td>
                            <td><p> {{ $janji->waktu }}</p></td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <h4>Hormat kami,</h4>
                    <br><br>
                    <br>
                    <h4>{{ $profile_rs->nama_rs }}</h4>
                </div>
            </div>
        </div>
    
        <!-- Footer -->
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>&copy; {{ now()->year }} {{ $profile_rs->nama_rs }}. Semua Hak Dilindungi.</p>
                    </div>
                </div>
            </div>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
<script>
    window.onload = function() {
        window.print();
    }
</script>
    

</body>
</html>