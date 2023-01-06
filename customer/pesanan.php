<?php
session_start();

if ($_SESSION["role"] != "Customer") {
    header("Location: ../lib/login.php");
}

require '../lib/functions.php';
$username = $_GET["username"];

$pesanan = query("SELECT * FROM pesanan WHERE username = '$username'");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omah Seafood | Restoran Seafood</title>
    <link href="../img/favicon.png" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/cust.css">
</head>

<body>
    <div class="container">
        <aside>
            <div class="customer">
                <a href="customer.php"><i class="fa-solid fa-lg fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="user-info">
                <img src="../img/profile.png" class="profile-picture" width="100px">
                <p id="profile-nama"><?= $_SESSION['username'] ?></p>
                <p id="profile-role"><?= $_SESSION['role'] ?></p>
            </div>
            <hr style="width: 80%;">
            <div class="aside-menu">
                <div class="menu">
                    <i class="fa-solid fa-lg fa-house"></i>
                    <a href="halamanUser.php"><span style=" font-weight: lighter; margin: 0 5px;"> | </span> Home</a>
                </div>
                <div class="menu">
                    <i class="fa-solid fa-lg fa-cart-plus"></i>
                    <a href="keranjang.php?username=<?= $_SESSION['username']; ?>"><span
                            style=" font-weight: lighter; margin: 0 5px;"> | </span> Keranjang</a>
                </div>
                <div class="menu">
                    <i class="fa-solid fa-lg fa-clock-rotate-left"></i>
                    <a href="pesanan.php?username=<?= $_SESSION['username']; ?>"><span
                            style=" font-weight: lighter; margin: 0 5px;"> | </span> Riwayat
                        Pesanan</a>
                </div>
                <hr style="width: 100%; margin: 40px 0;">
                <div class="menu">
                    <i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i>
                    <a href="../lib/logout.php">Log Out</a>
                </div>
            </div>
        </aside>

        <main>
            <h1>Riwayat Pesanan</h1>
            <div class="navbar">
                <p>
                    <a href="halamanUser.php">Home</a> > <a href="#" style="color: #2155cd;">Keranjang</a>
                </p>
            </div>
            <section style="margin-top: 40px;" class="main-pesanan">
                <?php $i = 1; ?>
                <?php foreach ($pesanan as $row) : ?>
                <div class="detail-pesanan">
                    <div class="id-pesanan">
                        <p>#<?= $row["idPesanan"]; ?></p>
                    </div>
                    <div class="nama-pesanan">
                        <p id="nama-produk"><?= $row["namaProduk"]; ?></p>
                        <p id="harga-produk"><?= $row["hargaProduk"]; ?></p>
                        <p id="jumlah-produk">x<?= $row["jumlahProduk"]; ?></p>
                    </div>
                    <p id="status-produk"><?= $row["status"]; ?></p>
                </div>
                <?php $i++; ?>
                <?php endforeach; ?>
            </section>
        </main>
    </div>

</body>

</html>