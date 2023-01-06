<?php
session_start();

if ($_SESSION["role"] != "Customer") {
    header("Location: ../lib/login.php");
}

require '../lib/functions.php';
$idCart = $_GET["idCart"];

if (isset($_POST["submit"])) {
    pesan($_POST);

    echo "
			<script>
				document.location.href = 'halamanUser.php';
			</script>
		";
}

$cart = query("SELECT * FROM cart WHERE idCart = $idCart")[0];
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
            <h1>Detail Order</h1>
            <div class="navbar">
                <p>
                    <a href="halamanUser.php">Home</a> > <a href="#" style="color: #2155cd;">Detail Order</a>
                </p>
            </div>
            <form action="" method="POST">
                <h2 style="margin-top: 50px;">Informasi Customer</h2>
                <div class="input-detail-user">
                    <div class="alamat">
                        <textarea name="alamatCustomer" id="alamatCustomer" cols="30" rows="10"
                            placeholder="Masukkan alamat Anda"></textarea>
                    </div>
                    <div class="telepon">
                        <input type="number" placeholder="No Telepon" name="teleponCustomer" id="teleponCustomer">
                    </div>
                </div>
                <div class="list-product" style="margin-top: 20px;">
                    <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
                    <table>
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                        </tr>
                        <tr>
                            <input type="hidden" name="idCart" value="<?= $idCart; ?>">
                            <input type="hidden" name="namaProduk" value="<?= $cart['namaProduk'] ?>">
                            <input type="hidden" name="hargaProduk" value="<?= $cart['hargaProduk'] ?>">
                            <td><?= $cart["namaProduk"]; ?></td>
                            <td>Rp <?= $cart["hargaProduk"]; ?>,00</td>
                            <td><input type="number" name="jumlahProduk"></td>
                        </tr>
                    </table>
                    <div class="button-menu" style="text-align: right; width: 100%; margin-top: 20px;">
                        <button type="submit" class="submit-button" name="submit">
                            Checkout
                        </button>
                    </div>
                </div>
            </form>
    </div>
    </main>
</body>

</html>