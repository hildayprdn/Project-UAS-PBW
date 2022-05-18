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

$id = $_GET["id"];
$maskapai = query("SELECT * FROM maskapai WHERE id = $id")[0];

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
     $booking = mysqli_query($conn, "SELECT * FROM bookings WHERE username = '$username'");
}
$total_bookings = mysqli_num_rows($booking);



if (isset($_POST["pesan"])) {
  if (pesanan($_POST) > 0 ) {
    echo "<script>
        alert('Berhasil Memesan Tiket Pesawat!');
        window.location.replace('pesanan.php');
    </script>";
  } else {
    echo mysqli_error($conn);
  }
 }
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
            padding: 10px;
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
        #content {
            width: 55%;
        }
        aside {
            width: 45%;
        }
        .alert {
            margin: 10px 0;
            font-size: 0.9rem;
            background-color: #FCC663;
            padding: 10px;
            border-radius: 6px;
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
        td {
          padding-right: 30px;
          font-weight: bold;
        }
        #content {
          width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="katalog.php">Tiket Pesawat</a></li>
                <li><a href="pesanan.php">Pesanan Saya <span class="jumlah_bookings"><?= $total_bookings; ?></span></a></li>
                <li><a href="logout.php" class="btn" style="border-bottom: none;">Logout <i class="fas fa-power-off fa-1x"></i></a></li>
            </ul>
        </nav>
        <div class="jumbotron">
            <h3>Rifqa Travel <i class="fab fa-accusoft"></i></h3>
            <p>Stay Safe,
            <?php
                    if (isset($_SESSION['username'])) {
                     $username = $_SESSION['username'];

                     $query = mysqli_query($conn, "SELECT nama FROM user WHERE username = '$username'"); 
                     foreach ($query as $cf) {}

                     if($query->num_rows > 0) {
                      echo $cf['nama'];
                      }
                  }
                ?>
            </p>
        </div>
    </header>

    <main>

        <div id="content">
                <div class="card">
                    <h2>Detail Tiket</h2>
                    <table>
                      <tr>
                        <td><span style="color: green;cursor: pointer;"><?= $maskapai["kode"]; ?></span></td>
                        <td><?= $maskapai["nama_maskapai"]; ?></td>
                        <td><?= $maskapai["harga"]; ?></td>
                      </tr>
                    </table>
               </div>

               <div class="card">
                <form action="" method="post">
                 <input type="hidden" id="username" name="username" value="<?= $username; ?>" required>
                 <input type="hidden" id="total_biaya" name="total_biaya" value="<?= $maskapai["harga"]; ?>" required>
                 <input type="hidden" id="kode_maskapai" name="kode_maskapai" value="<?= $maskapai["kode"]; ?>" required>
                 <input type="hidden" id="status" name="status" value="Sedang Diproses" required>
                    <center><h4>Format Pemesanan</h4></center>
                   <center><span style="color: grey;" class="alert"><i class="fas fa-info-circle"></i> Pastikan semua data yang anda isi sudah benar, sebelum klik tombol pesan.</span></center>
                    <br>
                    <div class="jarak">
                         <label for="nama_penerima">Nama Lengkap</label>
                         <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="jarak">
                         <label for="nohp">Nomor Handphone</label>
                         <input type="number" id="nohp" name="nohp" placeholder="Masukkan Nomor Handphone" required>
                    </div>
                    <div class="jarak">
                         <label for="dari">Kota Keberangkatan</label>
                         <input type="text" id="dari" name="dari" placeholder="Masukkan Nama Kota Keberangkatan" required>
                    </div>
                    <div class="jarak">
                         <label for="tujuan">Kota Tujan</label>
                         <input type="text" id="tujuan" name="tujuan" placeholder="Masukkan Nama Kota Tujuan" required>
                    </div>
                    <div class="jarak">
                         <label for="jam_berangkat">Jadwal Keberangkatan Diinginkan</label>
                         <input type="datetime-local" id="jam_berangkat" name="jam_berangkat" placeholder="Masukkan Jam Keberangkatan Diinginkan" required>
                    </div>
                     <div class="jarak">
                         <label for="harga">Total Pembayaran</label>
                         <p style="font-weight: bold;color: green;"><?= $maskapai["harga"]; ?></p>
                    </div>
                    <input type="hidden" name="status" id="status" value="Menunggu Pembayaran">
                    <button type="submit" name="pesan" class="btn" style="width: 100%;background-color: green;">Pesan Sekarang</button>
                </form>
            </div>
        </div>
           
    </main>

    <footer>
        <p>&#169 Rifqa Travel <i class="fab fa-accusoft"></i> 2022</p>
    </footer>
</body>
</html>