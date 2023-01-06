<?php
session_start();

if ($_SESSION["role"] != "Customer") {
    header("Location: ../lib/login.php");
}

require '../lib/functions.php';

$username = $_GET["username"];

$cart = query("SELECT produk.idProduk, produk.gambarProduk, produk.namaProduk, produk.hargaProduk, cart.idCart FROM produk INNER JOIN cart ON produk.idProduk = cart.idProduk WHERE cart.username = '$username'");
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
            <h1>Keranjang</h1>

            <div class="navbar">
                <p>
                    <a href="halamanUser.php">Home</a> > <a href="#" style="color: #2155cd;">Keranjang</a>
                </p>
            </div>

            <div class="list-product">
                <form action="" method="POST">
                    <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Manage</th>
                        </tr>

                        <?php $i = 1; ?>
                        <?php foreach ($cart as $row) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td style="padding: 0px;"><img src="../img/<?= $row["gambarProduk"]; ?>" width="50"></td>
                            <td><?= $row["namaProduk"]; ?></td>
                            <td>Rp <?= $row["hargaProduk"]; ?>,00</td>
                            <td>
                                <a href="hapusCart.php?idProduk=<?= $row["idProduk"]; ?>&username=<?= $_SESSION['username']; ?>"
                                    onclick="return confirm('Yakin ingin menghapus data?');"
                                    style="color: red;">Hapus</a>
                                | <a href="detailOrder.php?idCart=<?= $row["idCart"]; ?>"
                                    style="color: green;">Pesan</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </table>
                </form>
            </div>
    </div>
    </main>
</body>

</html>