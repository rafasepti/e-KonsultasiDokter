<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Resmi Perusahaan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .letterhead {
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            border: 1px solid #ddd;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header .logo img {
            height: 100px;
            width: auto;
            display: block;
        }
        .company-details {
            text-align: center;
        }
        .divider {
            border-top: 2px solid #000;
            margin: 10px 0;
        }
        .body {
            margin-top: 20px;
        }
        .footer {
            margin-top: 40px;
        }

        @media print {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            .company-details {
                text-align: left;
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container letterhead">
        <div class="row align-items-center">
            <div class="logo col-sm-4 text-center">
                <img src="{{ asset($profile_rs->logo_app) }}" alt="Company Logo" style="max-height: 200px; width: auto;">
            </div>
            <div class="company-details col-sm-8">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-center">
                        <h4>{{ $profile_rs->nama_rs }}</h4>
                        <p>{{ $profile_rs->alamat }}</p>
                        <p>Email: <a href="mailto:{{ $profile_rs->email }}">{{ $profile_rs->email }}</a></p>
                        <p>Telepon: {{ $profile_rs->no_hp }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <div class="divider"></div>

        <div class="body">
            <h5 class="text-center mb-4">Laporan Janji Temu</h5>
            <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Pasien.</th>
                      <th>Tanggal</th>
                      <th>Jam</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        Carbon\Carbon::setLocale('id');
                    @endphp
                    @foreach ($janji as $item => $j)
                        <tr>
                            <td>{{ $item+1 }}</td>
                            <td>{{ $j->pasien->nama_pasien }}</td>
                            <td>{{  \Carbon\Carbon::parse($j->tgl)->translatedFormat('l, d M Y') }}</td>
                            <td>{{ $j->waktu }}</td>
                            <td>{{ $j->status }}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script>
    window.onload = function() {
        window.print();
    }
</script>
</html>
