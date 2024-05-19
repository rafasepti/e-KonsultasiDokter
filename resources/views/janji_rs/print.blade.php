<!DOCTYPE html>
<html>
<head>
    <title>Print Janji Temu Pasien</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .table th, .table td {
            border: 1px solid #ddd !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1>Detail Janji Temu Pasien</h1>
        </div>
        
        <!-- Informasi Pasien -->
        <div class="mb-4">
            <h2 class="h4">Informasi Pasien</h2>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $janji->pasien->nama_pasien }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($janji->pasien->tgl_lahir)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $janji->pasien->jk }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Email</th>
                        <td>{{ $janji->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Rumah</th>
                        <td>{{ $janji->pasien->alamat }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Detail Janji Temu -->
        <div class="mb-4">
            <h2 class="h4">Detail Janji Temu</h2>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Tanggal dan Waktu</th>
                        <td>{{ $tanggalBaru }} Pukul {{ $janji->waktu }}</td>
                    </tr>
                    <tr>
                        <th>Tujuan/Keluhan</th>
                        <td>{{ $janji->penyakit }}</td>
                    </tr>
                    <tr>
                      <th>Keterangan</th>
                      <td>{{ $janji->ket }}</td>
                  </tr>
                    <tr>
                        <th>Nama Dokter</th>
                        <td>{{ $janji->dokter->nama_dokter }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    window.onload = function() {
        window.print();
    }
</script>
</html>
