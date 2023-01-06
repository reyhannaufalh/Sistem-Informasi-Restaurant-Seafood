<?php
session_start();

if ($_SESSION["role"] != "Customer") {
	header("Location: ../lib/login.php");
}

require '../lib/functions.php';

$idProduk = $_GET["idProduk"];
$username = $_GET["username"];

if (hapusCart($idProduk) > 0) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'keranjang.php?username=$username';
		</script>
		";
} else {
	echo "
		<script>
		alert('Data gagal dihapus!');
		document.location.href = 'keranjang.php?username=$username';
		</script>
	";
}