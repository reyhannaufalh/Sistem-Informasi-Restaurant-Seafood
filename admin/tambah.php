<?php
session_start();

if ($_SESSION['role'] != "Admin") {
    header("Location: ../lib/login.php");
}

require '../lib/functions.php';

if (isset($_POST["submit"])) {

    tambahMenu($_POST);
    echo "
			<script>
				alert('Data berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
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

            <div class="form-input">

                <input type="hidden" name="idProduk" value="<? $idProduk ?>">

                <h1>Tambah Menu</h1>

                <div class="navbar">
                    <p>
                        <a href="index.php">Home</a> > <a href="#" style="color: #2155cd;">Tambah data</a>
                    </p>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="main-tambah">
                        <div class="form-input-data">
                            <table class="tambah-data">
                                <tr>
                                    <td>Nama Produk</td>
                                    <td><input type="text" name="namaProduk" id="namaProduk"></td>
                                </tr>
                                <tr>
                                    <td>Harga Produk</td>
                                    <td><input type="number" name="hargaProduk" id="hargaProduk"></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <select name="statusProduk" id="statusProduk">
                                            <option value="Tersedia">Tersedia</option>
                                            <option value="Habis">Habis</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>
                                        <input style="width: fit-content;" type="radio" id="kategoriProduk"
                                            name="kategoriProduk" value="Makanan" checked>
                                        <label for="kategoriProduk">Makanan</label><input style="width: fit-content;"
                                            type="radio" id="kategoriProduk" name="kategoriProduk" value="Minuman">
                                        <label for="kategoriProduk">Minuman</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">Deskripsi</td>
                                    <td><textarea name="deskripsiProduk" id="deskripsiProduk" cols="30"
                                            rows="10"></textarea>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <script class="jsbin"
                                            src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                                        <div class="file-upload">
                                            <button class="file-upload-btn" type="button"
                                                onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                                            <div class="image-upload-wrap">
                                                <input class="file-upload-input" name="gambarProduk" type='file'
                                                    onchange="readURL(this);" accept="image/*" />
                                                <div class="drag-text">
                                                    <h3>Drag and drop a file or select add Image</h3>
                                                </div>
                                            </div>
                                            <div class="file-upload-content">
                                                <img class="file-upload-image" src="#" alt="your image" />
                                                <div class="image-title-wrap">
                                                    <button type="button" onclick="removeUpload()"
                                                        class="remove-image">Remove <span class="image-title">Uploaded
                                                            Image</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" name="submit" class="submit-button"
                                            style="width: 350px; background-color: green; color: white;">Tambah
                                            Data!</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="reset" name="reset" class="submit-button"
                                            style="width: 350px; background-color: red; color: white;">Reset
                                            Data!</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </form>
        </main>
    </div>
    </div>
    <script class="jsbin" src="../js/script.js"></script>
</body>

</html>