<?php
session_start();

if ($_SESSION['role'] != "Admin") {
    header("Location: ../lib/login.php");
}

require '../lib/functions.php';

$jumlahDataPerHalaman = 3;
$jumlahData = count(query("SELECT * FROM produk"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$menu = query("SELECT * FROM produk LIMIT $awalData, $jumlahDataPerHalaman");

if (isset($_POST["cari"])) {
    $menu = cari($_POST["keyword"]);
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
                    <a href="pesananAdmin.php?statusProduk=menunggukonfirmasi"><span
                            style=" font-weight: lighter; margin: 0 5px; margin-left: 11px;"> |
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
            <h1>Manajemen Produk</h1>

            <section class="search">
                <form action="" method="POST">
                    <input type="text" class="searchTerm" name="keyword" autofocus autocomplete="off" id="keyword"
                        placeholder="Masukkan nama menu...">
                    <button type="submit" name="cari" class="searchButton">
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

            <div class="list-product">
                <table>

                    <tr>
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>

                    <?php $i = 1; ?>
                    <?php foreach ($menu as $row) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><img src="../img/<?= $row["gambarProduk"]; ?>" width="50"></td>
                        <td><a href="detail.php?idProduk=<?= $row["idProduk"]; ?>"
                                class="nama-product"><?= $row["namaProduk"]; ?></a></td>
                        <td>Rp <?= $row["hargaProduk"]; ?>,00</td>
                        <td><?= $row["statusProduk"]; ?></td>
                        <td>
                            <a href="ubah.php?idProduk=<?= $row["idProduk"]; ?>"
                                style="color: rgb(197, 197, 14);">Ubah</a>
                            |
                            <a href="hapus.php?idProduk=<?= $row["idProduk"]; ?>"
                                onclick="return confirm('Yakin ingin menghapus data?');" style="color: red;">Hapus</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>

                </table>
            </div>
        </main>
    </div>
    <script src="../js/jquery.js"></script>
    <script class="jsbin" src="../js/search.js"></script>
</body>

</html>