<?php
require 'lib/functions.php';

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
				alert('Sign Up Berhasil');
                document.location.href = 'lib/login.php';
			  </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Omah Seafood</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../img/favicon.png" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="customer/lib/animate/animate.min.css" rel="stylesheet">
    <link href="customer/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="customer/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="customer/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="customer/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="p-0" style="min-width: 100%; min-height: 100vh; margin: 0;">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <div class="container-xxl py-1 bg-dark hero-header ">
                <div class="container my-5 py-2">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <div class="col-md-10 bg-dark d-flex align-items-center">
                                <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Sign Up
                                    </h5>
                                    <h1 class="text-white mb-4">Explore Our Menu</h1>
                                    <form action="" method="POST">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" placeholder="Nama Lengkap"
                                                        name="namaLengkap" id="namaLengkap">
                                                    <label for="namaLengkap">Nama Lengkap</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" placeholder="Username"
                                                        name="username" id="username">
                                                    <label for="username">Username</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <input type="password" class="form-control" placeholder="Password"
                                                        name="password" id="password">
                                                    <label for="password">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating">
                                                    <input type="password" class="form-control" placeholder="Password"
                                                        name="password2" id="password2">
                                                    <label for="password2">Confirm Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <p style="color: white;">Sudah punya akun?</p>
                                                <a href="lib/login.php">Masuk disini</a>
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary w-100 py-3" type="submit"
                                                    name="register">Sign Up</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            <img class="img-fluid"
                                src="customer/img-web/douglas-lopez-4B0cLMtJxWw-unsplash-modified.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="customer/lib/wow/wow.min.js"></script>
    <script src="customer/lib/easing/easing.min.js"></script>
    <script src="customer/lib/waypoints/waypoints.min.js"></script>
    <script src="customer/lib/counterup/counterup.min.js"></script>
    <script src="customer/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="customer/lib/tempusdominus/js/moment.min.js"></script>
    <script src="customer/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="customer/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="customer/js/main.js"></script>
</body>

</html>