<?php
session_start();

if ($_SESSION["role"] != "Customer") {
    header("Location: ../lib/login.php");
}

require '../lib/functions.php';

$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM produk WHERE statusProduk='Tersedia'"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$menu = query("SELECT * FROM produk  WHERE statusProduk='Tersedia' LIMIT $awalData, $jumlahDataPerHalaman");

if (isset($_POST["cari"])) {
    $menu = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">

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
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
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
            <section class="slider">
                <div class="box-left">
                    <h1>Enjoy Our<br>Delicious Seafood</h1>
                    <p>berbagai macam olahan seafood
                        dibuat oleh chef ternama dan ternama. Pilih menu seafood favoritmu</p>
                </div>
                <div class="box-right">
                    <div class="image-slide">
                        <div class="wrapper">
                            <img src="img-web/1.jpg">
                            <img src="img-web/2.jpg">
                            <img src="img-web/3.jpg">
                            <img src="img-web/4.jpg">
                        </div>
                    </div>
                </div>
            </section>
            <section class="search">
                <form action="" method="POST">
                    <input type="text" class="searchTerm" name="keyword" autofocus autocomplete="off" id="keyword"
                        placeholder="Masukkan nama menu...">
                    <button type="submit" class="searchButton" name="cari">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </section>
            <section class="pagination">
                <!-- navigasi -->
                <a href="?halaman=1"><i class="fa-solid fa-arrow-left"></i></a>

                <?php if ($halamanAktif > 1) : ?>
                <a href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                <?php else : ?>
                <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                <?php endif; ?>
                <?php endfor; ?>

                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                <a href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
                <?php endif; ?>

                <a href="?halaman=<?= $jumlahHalaman; ?>"><i class="fa-solid fa-arrow-right"></i></a>
            </section>
            <section class="content" style="margin-top: 20px;">
                <?php foreach ($menu as $row) : ?>
                <div class="menu">
                    <img src="../img/<?= $row["gambarProduk"]; ?>">
                    <p id="nama-menu"><?= $row["namaProduk"]; ?></p>
                    <p id="harga-menu">Rp <?= $row["hargaProduk"]; ?>,00</p>
                    <div class="addCartButton">
                        <button class="submit-button" type="submit" name="lihat-detail">
                            <a href="detailProduk.php?idProduk=<?= $row["idProduk"]; ?>">LIHAT PRODUK</a>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </section>
        </main>
    </div>
</body>

</html>