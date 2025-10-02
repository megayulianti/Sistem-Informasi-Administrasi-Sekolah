<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <title>CyberTech Academy</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="#" type="assets/image/x-icon" />
    <link rel="apple-touch-icon" href="#" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <!-- Pogo Slider CSS -->
    <link rel="stylesheet" href="assets/css/pogo-slider.min.css" />
    <!-- Site CSS -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="assets/css/responsive.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/custom.css" />

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <!-- Start header -->
    <header class="top-header">
        <nav class="navbar header-nav navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">
    <img src="assets/images/cy.png" alt="CyberTech Academy logo" class="img-fluid" style="max-height: 40px; width: auto;"> CyberTech Academy
</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="./">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kegiatan">Kegiatan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="berita">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kontak">Kontak</a>
                        </li>
                    </ul>

                    <!-- Tombol Login -->
                    <div class="login-box ml-3">
                        <a href="admin/login/" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- End header -->

    <!-- Custom CSS for responsiveness -->
    <style>
        /* Ensure navbar items stack vertically on smaller screens */
        @media (max-width: 991px) {
            .navbar-nav {
                text-align: center;
            }
            .login-box {
                margin-top: 15px;
            }
        }

        /* Ensure navbar brand image resizes properly */
        @media (max-width: 576px) {
            .navbar-brand img {
                max-height: 30px;
            }
        }

        /* Adjust login button margin for smaller screens */
        @media (max-width: 767px) {
            .login-box {
                margin-left: 0;
                margin-top: 10px;
            }
        }
    </style>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/pogo-slider.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
