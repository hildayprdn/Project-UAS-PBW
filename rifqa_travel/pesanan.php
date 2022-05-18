<?php 
session_start();

if (isset($_SESSION["admin"])) {
  echo "<script>
         window.location.replace('admin');
       </script>";
  exit;
}
if (!isset($_SESSION['user'])) {
   echo "<script>
         window.location.replace('login.php');
       </script>";
  exit;
}
require 'functions.php';

    if (isset($_SESSION['username'])) {
     $username = $_SESSION['username'];

      $pesanan = mysqli_query($conn, "SELECT bookings.id AS id_booking, bookings.username, bookings.kode_maskapai, bookings.nama, bookings.nohp, bookings.dari, bookings.tujuan, bookings.jam_berangkat, bookings.total_biaya, bookings.status, maskapai.nama_maskapai FROM bookings LEFT JOIN maskapai ON bookings.kode_maskapai = maskapai.kode WHERE username = '$username'"); 
  }

$total_pesanan = mysqli_num_rows($pesanan);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Icon dari Fontawesome -->
    <script src="https://kit.fontawesome.com/348c676099.js" crossorigin="anonymous"></script>
    <title>Rifqa Travel</title>
    <style>
        .btn {
            text-decoration: none;
            padding: 5px 10px;
            background-color: red;
        }
        .flex {
            display: flex;
            flex-direction: column;
        }
        .btn-beli {
            text-decoration: none;
            padding: 5px 10px;
            background-color: green;
        }
        .harga {
            padding: 5px;
            border-radius: 5px;
            color: green;
            background-color: #90DE90;
        }
        body {
          background-image: url("images/bg.jpeg");
          background-size: contain;
        }
        .alert {
            margin: 10px 0;
            font-size: 0.9rem;
            background-color: red;
            padding: 10px;
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="katalog.php">Tiket Pesawat</a></li>
                <li><a href="logout.php" class="btn" style="border-bottom: none;">Logout <i class="fas fa-power-off fa-1x"></i></a></li>
            </ul>
        </nav>
        <div class="jumbotron">
            <h3>Rifqa Travel <i class="fab fa-accusoft"></i></h3>
            <p>Happy Shopping,
            <?php
                    if (isset($_SESSION['username'])) {
                     $username = $_SESSION['username'];

                     $query = mysqli_query($conn, "SELECT nama FROM user WHERE username = '$username'"); 
                     foreach ($query as $cf) {}

                     if($query->num_rows > 0) {
                      echo $cf['nama'];
                      }
                  }
                ?> :)
            </p>
        </div>
    </header>

    <main>
         <article class="card">
                <center><h3 style="color:royalblue;">Pesanan Saya</h3></center>
        </article>

        <div id="content">
            <?php foreach ($pesanan as $cf) : ?>
            <div class="flex">
                <div class="card">
                      <center><h3 style="color: royalblue;"><?= $cf["nama_maskapai"]; ?></h3></center>
                  
                       <center><p class="alert" style="color: white;background-color: darkorange;"><i class="fas fa-info-circle"></i> Cek secara berkala status pembayaran anda. Segera lakukan pembayaran jika belum, agar status pemesanan anda disetujui oleh admin!</p></center>
                     
                      <br>
                      <p>Nama Lengkap : <b><?= $cf["nama"]; ?></b></p>
                      <p>Nomor Handphone : <b><?= $cf["nohp"]; ?></b></p>
                      <p>Dari : <b><?= $cf["dari"]; ?></b></p>
                      <p>Ke : <b><?= $cf["tujuan"]; ?></b></p>
                      <p>Jadwal Penerbangan : <span class="harga" style="background-color: white;"><?= $cf["jam_berangkat"]; ?></span></p>
                      <p>Harga : <b style="color: royalblue;"><?= $cf["total_biaya"]; ?></b></p>
                      <p>Status Pembayaran : <b style="color: royalblue;"><?= $cf["status"]; ?></b></p><br>
                      <p><a href="hapus-pesanan.php?id=<?= $cf["id_booking"]; ?>" class="btn">Hapus Pesanan Saya</a></p>
               </div>
            </div>
            <?php endforeach; ?>
        </div>

        <aside>
            <div class="card">
              <?php  if ($total_pesanan > 0) : ?>
                <center><p>Anda Memiliki Pesanan Aktif</p></center>
                <?php else: ?>
                  <center><p>Anda Belum Memiliki Pesanan Aktif</p></center>
              <?php endif; ?>
            </div>
        </aside>
           
    </main>

    <footer>
        <p>&#169 Rifqa Travel <i class="fab fa-accusoft"></i> 2022</p>
    </footer>
</body>
</html>