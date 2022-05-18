<?php 
require 'functions.php';
$id = $_GET["id"];
if (hapusitem($id) > 0 ) {
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
 ?>