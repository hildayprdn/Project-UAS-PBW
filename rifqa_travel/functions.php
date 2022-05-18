<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "rifqa_travel");

// Mengambil data dan menampungnya ke dalam variabel rows
function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	};
	return $rows;
};

// Fungsi registrasi akun 
function registrasi($data) {
	global $conn;

	$username = mysqli_real_escape_string($conn, $data["username"]);
	$password_sebelum = mysqli_real_escape_string($conn, $data["password"]);
	$nama = mysqli_real_escape_string($conn, $data["nama"]);

	// cek username admin sudah ada atau belum

	$cekusernameadmin = "SELECT * FROM admin where username='$username'";
	$prosescek= mysqli_query($conn, $cekusernameadmin);

	if (mysqli_num_rows($prosescek)>0) { 
	    echo "<script>alert('Username Sudah Digunakan!');history.go(-1) </script>";
	    exit;
	}

	// cek username user sudah ada atau belum

	$cekusernameuser = "SELECT * FROM user where username='$username'";
	$prosescek= mysqli_query($conn, $cekusernameuser);

	if (mysqli_num_rows($prosescek)>0) { 
	    echo "<script>alert('Username Sudah Digunakan!');history.go(-1) </script>";
	    exit;
	}

	// enkripsi password
	$password = password_hash($password_sebelum, PASSWORD_DEFAULT);

	// Masukkan Data ke Database
	mysqli_query($conn, "INSERT INTO user VALUES(NULL, '$username', '$password', '$nama')");
	return mysqli_affected_rows($conn);
}

// Fungsi untuk menampung data pesanan

function pesanan($data) {
	global $conn;

	$username = mysqli_real_escape_string($conn, $data["username"]);
	$kode_maskapai = mysqli_real_escape_string($conn, $data["kode_maskapai"]);
	$nama = mysqli_real_escape_string($conn, $data["nama"]);
	$nohp = mysqli_real_escape_string($conn, $data["nohp"]);
	$dari = mysqli_real_escape_string($conn, $data["dari"]);
	$tujuan = $data["tujuan"];
	$jam_berangkat = mysqli_real_escape_string($conn, $data["jam_berangkat"]);
	$total_biaya = mysqli_real_escape_string($conn, $data["total_biaya"]);
	$status = mysqli_real_escape_string($conn, $data["status"]);

	// cek username user sudah ada atau belum

	$cekusernameuser = "SELECT * FROM bookings where username='$username'";
	$prosescek= mysqli_query($conn, $cekusernameuser);

	if (mysqli_num_rows($prosescek)>0) { 
	    echo "<script>alert('Anda Memiliki Pesanan Yang Sedang Aktif!');history.go(-1) </script>";
	    exit;
	}

	// Masukkan Data ke Database
	mysqli_query($conn, "INSERT INTO bookings VALUES(NULL, '$username',  '$kode_maskapai', '$nama', '$nohp', '$dari', '$tujuan', '$jam_berangkat', '$total_biaya', '$status')");
	return mysqli_affected_rows($conn);
}

// Fungsi untuk menghapus data pesanan

function hapuspesanan($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM bookings WHERE id = $id");

	return mysqli_affected_rows($conn);
}

// Fungsi untuk mencari data maskapai sesuai apa yang diinputkan oleh user di kolom pencarian

function cari($keyword) {
	$query = "SELECT * FROM maskapai
				WHERE
			  kode LIKE '%$keyword%' OR
			  nama_maskapai LIKE '%$keyword%' OR
			  harga LIKE '%$keyword%'
		    ";

	return query($query);
}