<?php 
require 'functions.php';
$id = $_GET["id"];
if (hapuspesanan($id) > 0 ) {
	echo "
		<script>
			alert('Pesanan Anda berhasil dihapus!');
			document.location.href = 'index.php';
		</script>
	";
    } else {
	echo "
		<script>
			alert('Pesanan Anda gagal dihapus!');
			document.location.href = 'index.php';
		</script>
	";
	}
 ?>