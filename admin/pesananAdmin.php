<?php
session_start();

if ($_SESSION['role'] != "Admin") {
    header("Location: ../lib/login.php");
}

require '../lib/functions.php';

$status = $_GET['statusProduk'];

if ($status == "menunggukonfirmasi") {
    $pesanan = query("SELECT * FROM pesanan WHERE status='Menunggu Konfirmasi'");
} else if ($status == "pesanandiproses") {
    $pesanan = query("SELECT * FROM pesanan WHERE status='Pesanan di Proses'");
} else if ($status == "pesanandiantar") {
    $pesanan = query("SELECT * FROM pesanan WHERE status='Pesanan di Antar'");
} else if ($status == "selesai") {
    $pesanan = query("SELECT * FROM pesanan WHERE status='Selesai'");
}

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
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="container">
        <aside>
            <div class="user-info">
                <img src="../img/profile.png" class="profile-picture" width="100px">
                <p id="profile-nama"><?= $_SESSION['username']; ?></p>
                <p id="profile-role"><?= $_SESSION['role']; ?></p>
            </div>
            <hr style="width: 80%;">
            <div class="aside-menu">
                <div class="menu">
                    <i class="fa-solid fa-lg fa-home"></i>
                    <a href="index.php"><span style=" font-weight: lighter; margin: 0 5px;"> | </span> Home</a>
                </div>
                <div class="menu">
                    <i class="fa-solid fa-lg fa-cart-plus"></i>
                    <a href="tambah.php"><span style=" font-weight: lighter; margin: 0 5px;"> | </span> Tambah Menu</a>
                </div>
                <div class="menu">
                    <i class="fa-solid fa-lg fa-file-invoice-dollar"></i>
                    <a href="pesananAdmin.php"><span style=" font-weight: lighter; margin: 0 5px; margin-left: 11px;"> |
                        </span>
                        Pesanan</a>
                </div>
                <hr style="width: 100%; margin: 40px 0;">
                <div class="menu">
                    <i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i>
                    <a href="../lib/logout.php" style="color: rgb(200, 0, 0);">Log Out</a>
                </div>
            </div>
        </aside>
        <main>
            <h1>Daftar Pesananan</h1>
            <div class="navbar">
                <p>
                    <a href="index.php">Home</a> > <a href="#" style="color: #2155cd;">Daftar Pesanan</a>
                </p>
            </div>

            <div class="status-page">
                <a href="?statusProduk=menunggukonfirmasi" style="color: red;">Menunggu Konfirmasi</a>
                <a href="?statusProduk=pesanandiproses" style="color: darkgoldenrod;">Pesanan di Proses</a>
                <a href="?statusProduk=pesanandiantar" style="color: blue;">Pesanan di Antar</a>
                <a href="?statusProduk=selesai" style="color: green;">Selesai</a>
            </div>

            <form action="" method="POST">
                <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
                <section style="margin-top: 30px;" class="main-pesanan">
                    <?php $i = 1; ?>
                    <?php foreach ($pesanan as $row) : ?>
                    <div class="detail-pesanan">
                        <div class="detail-header">
                            <div class="id-pesanan">
                                #<?= $row["idPesanan"]; ?>
                            </div>
                            <p id="username"><?= $row["username"]; ?></p>
                        </div>
                        <div class="nama-pesanan">
                            <p id="nama-produk"><?= $row["namaProduk"]; ?></p>
                            <p id="harga-produk"><?= $row["hargaProduk"]; ?></p>
                            <p id="jumlah-produk">x<?= $row["jumlahProduk"]; ?></p>
                        </div>
                        <p id="alamat"><?= $row["alamatCustomer"]; ?></p>
                        <p id="telepon"><?= $row["teleponCustomer"]; ?></p>
                        <button type="submit" name="changeStatus" class="submit-button">
                            <a
                                href="status.php?idPesanan=<?= $row["idPesanan"]; ?>&status=<?= $row["status"]; ?>"><?= $row["status"]; ?></a>
                        </button>
                    </div>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </section>
            </form>
        </main>
    </div>

</body>

</html>