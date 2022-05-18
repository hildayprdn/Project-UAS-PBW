<?php 
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('../login.php');
       </script>";
  exit;
}

require 'functions.php';

 $pesanan = mysqli_query($conn, "SELECT bookings.id AS id_booking, bookings.username, bookings.kode_maskapai, bookings.nama, bookings.nohp, bookings.dari, bookings.tujuan, bookings.jam_berangkat, bookings.total_biaya, bookings.status, maskapai.nama_maskapai FROM bookings LEFT JOIN maskapai ON bookings.kode_maskapai = maskapai.kode"); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/348c676099.js" crossorigin="anonymous"></script>
    <title>Rifqa Travel</title>
    <style>
        .btn {
            text-decoration: none;
            padding: 3px 10px;
            background-color: darkred;
        } 
        body {
          background-image: url("../images/bg.jpeg");
          background-size: contain;
        }
    </style>
</head>

<body>
     <header>
        <nav>
            <ul>
                <li><a href="index.php">Data produk</a></li>
                <li><a href="../logout.php" class="btn" style="border-bottom: none;">Logout</a></li>
            </ul>
        </nav>
        <div class="jumbotron">
            <h3>Rifqa Travel <i class="fab fa-accusoft"></i></h3>
        </div>
    </header>

    <main>
         <article class="card">
                <center><h3 style="color:royalblue;">Data Pesanan</h3></center>
        </article>

         <div id="content">
            <?php foreach ($pesanan as $cf) : ?>
            <div class="flex">
                <div class="card">
                      <center><h3 style="color: royalblue;"><?= $cf["nama_maskapai"]; ?></h3></center>
                      <p>Nama Lengkap : <b><?= $cf["nama"]; ?></b></p>
                      <p>Nomor Handphone : <b><?= $cf["nohp"]; ?></b></p>
                      <p>Dari : <b><?= $cf["dari"]; ?></b></p>
                      <p>Ke : <b><?= $cf["tujuan"]; ?></b></p>
                      <p>Jadwal Penerbangan : <span class="harga" style="background-color: white;"><?= $cf["jam_berangkat"]; ?></span></p>
                      <p>Harga : <b style="color: royalblue;"><?= $cf["total_biaya"]; ?></b></p>
                      <p>Status : <b style="color: royalblue;"><?= $cf["status"]; ?></b></p>
                      <p><a href="edit-pesanan.php?id=<?= $cf["id_booking"]; ?>" class="btn" style="background-color: orange;">Ubah Status</a></p>
                      <p><a href="hapus-pesanan.php?id=<?= $cf["id_booking"]; ?>" class="btn">Hapus</a></p>
               </div>
            </div>
            <?php endforeach; ?>
        </div>

        <aside>
            <a href="index.php" style="text-decoration: none;"><div class="card">
                <center><p>Kembali ke Beranda</p></center>
            </div></a>
        </aside>
           
    </main>

    <footer>
        <p>&#169 Rifqa Travel <i class="fab fa-accusoft"></i> 2022</p>
    </footer>
</body>
</html>