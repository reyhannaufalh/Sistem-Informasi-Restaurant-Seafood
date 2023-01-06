<?php
require '../lib/functions.php';

$idProduk = $_GET["idProduk"];

if (hapusProduk($idProduk) > 0) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'index.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href = 'index.php';
		</script>
	";
}