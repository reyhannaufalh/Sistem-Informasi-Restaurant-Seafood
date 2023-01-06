<?php
session_start();

if ($_SESSION['role'] != "Admin") {
	header("Location: ../lib/login.php");
}

require '../lib/functions.php';

$idPesanan = $_GET["idPesanan"];
$status = $_GET["status"];

global $conn;

if ($status == 'Menunggu Konfirmasi') {
	$query = "UPDATE pesanan SET
				status = 'Pesanan di Proses'
			  WHERE idPesanan = $idPesanan
			";
	$pesan = 'pesanandiproses';
} else if ($status == 'Pesanan di Proses') {
	$query = "UPDATE pesanan SET
				status = 'Pesanan di antar'
			  WHERE idPesanan = $idPesanan
			";
	$pesan = 'pesanandiantar';
} else if ($status == 'Pesanan di antar') {
	$query = "UPDATE pesanan SET
				status = 'Selesai'
			  WHERE idPesanan = $idPesanan
			";
	$pesan = 'selesai';
}

mysqli_query($conn, $query);

echo "
		<script>
			document.location.href = 'pesananAdmin.php?statusProduk=$pesan';
		</script>
    ";