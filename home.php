<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Management SMAN 1 Sungai Limau</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-image: url('assets/images/gambar.png'); /* Ganti dengan URL gambar latar belakang */
            background-size: cover;
            background-position: center;
            color: white;
        }

        .container {
            position: relative;
            z-index: 2;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .row {
            margin-top: 50px;
        }

        h2, p {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            color: black; /* Menambahkan warna hitam pada teks */
        }

        .btn-outline-success {
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .card:hover {
            transform: translateY(-10px);
            transition: transform 0.3s ease;
        }

        .card-body p {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .card-title {
            font-weight: bold;
            font-size: 1.25rem;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container text-center mt-5">
        <h2 class="fw-bold" style="color: white;">SISTEM INFORMASI TATA USAHA DI SMAN 1 SUNGAI LIMAU</h2>
        <p style="color: white;">Sistem ini dirancang untuk mendukung pengelolaan administrasi sekolah secara digital.
        Tersedia akses login khusus untuk Tata Usaha, Guru, Pegawai, dan Kepala Sekolah guna memudahkan tugas harian dan pelaporan secara efisien.</p>

        <!-- Row Card -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <!-- Kartu 1 -->
            <div class="col">
                <div class="card shadow-lg">
                    <div class="card-body text-start">
                        <h5 class="card-title">Tata Usaha Sekolah</h5>
                        <p>Login untuk mengelola administrasi sekolah.</p>
                        <a href="admin/login/index.php" class="btn btn-outline-success">Masuk</a>
                    </div>
                </div>
            </div>

            <!-- Kartu 2 -->
            <div class="col">
                <div class="card shadow-lg">
                    <div class="card-body text-start">
                        <h5 class="card-title">Guru dan Pegawai</h5>
                        <p>Login untuk ambil absensi guru atau Pegawai.</p>
                        <a href="guru_pegawai/login/index.php" class="btn btn-outline-success">Masuk</a>
                    </div>
                </div>
            </div>

      

            <!-- Kartu 4 -->
            <div class="col mx-auto">
                <div class="card shadow-lg">
                    <div class="card-body text-start">
                        <h5 class="card-title">Kepala Sekolah</h5>
                        <p>Login untuk melihat surat-menyurat dan laporan.</p>
                        <a href="kepala-sekolah/login/index.php" class="btn btn-outline-success">Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
