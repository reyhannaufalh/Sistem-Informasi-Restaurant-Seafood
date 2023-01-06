<?php
$conn = mysqli_connect("localhost", "root", "", "uas_pemweb");
$timestamp = date("Y-m-d H:i:s");

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambahMenu($data)
{
	global $conn;
	global $timestamp;

	$namaProduk = htmlspecialchars($data["namaProduk"]);
	$hargaProduk = htmlspecialchars($data["hargaProduk"]);
	$statusProduk = htmlspecialchars($data["statusProduk"]);
	$kategoriProduk = htmlspecialchars($data["kategoriProduk"]);
	$deskripsiProduk = htmlspecialchars($data["deskripsiProduk"]);

	$gambarProduk = upload();

	if (!$gambarProduk) {
		return false;
	}

	$query = "INSERT INTO produk
			VALUES
			('', '$namaProduk', '$hargaProduk', '$statusProduk', '$kategoriProduk', '$gambarProduk', '$deskripsiProduk', '$timestamp');";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload()
{

	$namaFile = $_FILES['gambarProduk']['name'];
	$ukuranFile = $_FILES['gambarProduk']['size'];
	$error = $_FILES['gambarProduk']['error'];
	$tmpName = $_FILES['gambarProduk']['tmp_name'];

	if ($error === 4) {
		echo "<script>
				alert('Pilih gambar terlebih dahulu!');
			  </script>";
		return false;
	}

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('Yang anda upload bukan gambar!');
			  </script>";
		return false;
	}

	if ($ukuranFile > 1000000) {
		echo "<script>
				alert('Ukuran gambar terlalu besar!');
			  </script>";
		return false;
	}

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

	return $namaFileBaru;
}

function hapusProduk($idProduk)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM produk WHERE idProduk = $idProduk");
	return mysqli_affected_rows($conn);
}

function hapusCart($idProduk)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM cart WHERE idProduk = $idProduk");
	return mysqli_affected_rows($conn);
}


function ubah($data)
{
	global $conn;

	$idProduk = $data["idProduk"];
	$namaProduk = htmlspecialchars($data["namaProduk"]);
	$hargaProduk = htmlspecialchars($data["hargaProduk"]);
	$statusProduk = htmlspecialchars($data["statusProduk"]);
	$kategoriProduk = htmlspecialchars($data["kategoriProduk"]);
	$deskripsiProduk = htmlspecialchars($data["deskripsiProduk"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	if ($_FILES['gambarProduk']['error'] === 4) {
		$gambarProduk = $gambarLama;
	} else {
		$gambarProduk = upload();
	}

	$query = "UPDATE produk SET
				namaProduk = '$namaProduk',
				hargaProduk = '$hargaProduk',
				statusProduk = '$statusProduk',
				kategoriProduk = '$kategoriProduk',
				gambarProduk = '$gambarProduk',
				deskripsiProduk = '$deskripsiProduk'
			  WHERE idProduk = $idProduk
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function registrasi($data)
{
	global $conn;

	$namaLengkap = stripslashes($data["namaLengkap"]);
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('Username sudah terdaftar!')
		      </script>";
		return false;
	}


	if ($password !== $password2) {
		echo "<script>
				alert('Konfirmasi password tidak sesuai!');
		      </script>";
		return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	mysqli_query($conn, "INSERT INTO user VALUES('', '$namaLengkap', '$username', '$password', 'Customer')");

	return mysqli_affected_rows($conn);
}

function addToCart($data)
{
	global $conn;
	global $timestamp;

	$idProduk = $data["idProduk"];
	$namaProduk = $data["namaProduk"];
	$hargaProduk = $data["hargaProduk"];
	$username = $data["username"];

	$query = "INSERT INTO cart
			VALUES
			('', '$idProduk', '$username', '$namaProduk', '$hargaProduk', '$timestamp');";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function pesan($data)
{
	global $conn;
	global $timestamp;

	$username = htmlspecialchars($data["username"]);
	$status = 'Menunggu Konfirmasi';
	$namaProduk = $data["namaProduk"];
	$hargaProduk = $data["hargaProduk"];
	$jumlahProduk = $data["jumlahProduk"];
	$alamatCustomer = $data["alamatCustomer"];
	$teleponCustomer = $data["teleponCustomer"];

	$query = "INSERT INTO pesanan
			VALUES
			('', '$username', '$status','$namaProduk', '$hargaProduk', '$jumlahProduk', '$alamatCustomer', '$teleponCustomer', '$timestamp');";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function cari($keyword)
{
	$query = "SELECT * FROM produk
				WHERE
			  namaProduk LIKE '%$keyword%' AND statusProduk='Tersedia'
			";
	return query($query);
}