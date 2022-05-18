<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "rifqa_travel");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	};
	return $rows;
};

function tambah($data) {
	global $conn;

	// htmlspecialchars berfungsi untuk tidak menjalankan script
	$kode = htmlspecialchars($data["kode"]);
	$nama_maskapai = htmlspecialchars($data["nama_maskapai"]);
	$harga = htmlspecialchars($data["harga"]);

		// tambahkan ke database
		// NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
		// sedangkan jika masih di localhost, bisa memakai ''
	mysqli_query($conn, "INSERT INTO maskapai VALUES(NULL, '$kode', '$nama_maskapai', '$harga')");
	return mysqli_affected_rows($conn);
}


function hapusitem($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM maskapai WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function hapuspesanan($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM bookings WHERE id = $id");

	return mysqli_affected_rows($conn);
}

function ubah($data) {
	global $conn;
     
    $id = $data["id"];
    $kode = $data["kode"];
    $nama_maskapai = $data["nama_maskapai"];
    $harga = $data["harga"];

	$query = "UPDATE maskapai SET 
				kode = '$kode',
				nama_maskapai = '$nama_maskapai',
				harga = '$harga'
			  WHERE id = $id
			";
			
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahdata($data) {
    global $conn;
     
    $id = $data["id"];
    $status =  $data["status"];

    $query = "UPDATE bookings SET 
                status = '$status'
              WHERE id = $id
            ";
            
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}