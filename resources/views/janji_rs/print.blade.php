<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Rekam Medis Pasien</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .container {
      max-width: 800px;
      margin: auto;
    }
    .form-group {
      margin-bottom: 20px;
      display: flex;
      align-items: center;
    }
    .form-group label {
      flex: 0 0 150px; /* Lebar tetap 150px */
      font-weight: bold;
    }
    .form-group input,
    .form-group select,
    .form-group textarea {
      flex: 1; /* Menempati sisa ruang yang tersedia */
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2>Rekam Medis Pasien</h2>
    <div class="form-group">
      <label for="namaPasien">Nama Pasien:</label>
      <input type="text" id="namaPasien" placeholder="Masukkan Nama Pasien">
    </div>
    <div class="form-group">
      <label for="tanggalLahir">Tanggal Lahir:</label>
      <input type="date" id="tanggalLahir">
    </div>
    <div class="form-group">
      <label for="alamat">Alamat:</label>
      <textarea id="alamat" rows="3" placeholder="Masukkan Alamat Pasien"></textarea>
    </div>
    <!-- Tambahkan field lainnya di sini -->
  </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
<script>
    window.onload = function() {
        window.print();
    }
</script>
