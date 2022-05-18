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

     $bookings = mysqli_query($conn, "SELECT * FROM bookings WHERE username = '$username'"); 

  }
$total_bookings = mysqli_num_rows($bookings);

// Pagination
$jumlahDataPerHalaman = 3; 
$jumlah_data = count(query("SELECT * FROM maskapai"));
$jumlah_halaman = ceil($jumlah_data / $jumlahDataPerHalaman);
$halaman_aktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awal_data = ( $jumlahDataPerHalaman * $halaman_aktif) - $jumlahDataPerHalaman;

$maskapai = mysqli_query($conn, "SELECT * FROM maskapai LIMIT $awal_data, $jumlahDataPerHalaman"); 

// jika tombol cari di tekan ( SEARCHING )
if (isset($_POST["cari"])) {
  $maskapai = cari($_POST["keyword"]);
} 

// $total_maskapai = mysqli_num_rows($maskapai);
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
        body {
          background-image: url("images/bg.jpeg");
          background-size: contain;
        }
        th, td {
            padding: 10px 40px;
            text-align: justify;
        }
        .card input {
          max-width: 60%;
        }

        .card button {
          padding: 5px 10px;
          margin: 0 10px;
          background-color: blue;
          border-radius: 4px;
          color: white;
          border: none;
          box-shadow: 3px 3px 3px gray; 
        }

        .card a {
            text-decoration: none;
            color: black;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="pesanan.php">Pesanan Saya <span class="jumlah_bookings"><?= $total_bookings; ?></span></a></li>
                <li><a href="logout.php" class="btn" style="border-bottom: none;">Logout <i class="fas fa-power-off fa-1x"></i></a></li>
            </ul>
        </nav>
        <div class="jumbotron">
            <h3>Rifqa Travel <i class="fab fa-accusoft"></i></h3>
            <p>Hai,
                <!-- Logika untuk menampilkan nama dari database -->
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
        <div class="card">
              <center>
                <form action="" method="post">
                <label for="keyword">Cari Penerbangan Anda disini... &nbsp;&nbsp;</label>
                <input type="text" name="keyword" size="40" autofocus placeholder="Ketik Maskapai / Rute / Kode Maskapai ... " autocomplete="off">
                <button type="submit" name="cari">Cari!</button>
                </form>
              </center>
        </div>
         <article class="card">
              <center><h3 style="color:royalblue;">Pilih Maskapai</h3></center>
        </article>

       <div id="content" style="width: 100%">
            <?php foreach ($maskapai as $pesawat) : ?>
            <div class="flex">
                <div class="card">
                       <table>
                           <tr>
                               <th>Kode Maskapai</th>
                               <th>Nama Pesawat</th>
                               <th>Harga Tiket</th>
                               <th>Aksi</th>
                           </tr>
                           <tr>
                               <td><span style="color: royalblue;cursor: pointer;"><?= $pesawat["kode"]; ?></span></td>
                               <td><?= $pesawat["nama_maskapai"]; ?></td>
                               <td><?= $pesawat["harga"]; ?></td>
                               <td>
                                <a href="produk.php?id=<?= $pesawat["id"]; ?>" class="btn btn-beli">Lihat  Detail</a>
                            </td>
                           </tr>
                       </table>
               </div>
            </div>
            <?php endforeach; ?>
        </div>

        

        <!-- Navigasi Halaman / Tombol Halaman -->
        <div class="card" style="font-size: 20px;">
            <center>
                <?php if ( $halaman_aktif > 1) : ?>
                    <a href="?halaman=<?= $halaman_aktif-1; ?>"><< &nbsp;</a>
                <?php endif; ?>   
                <?php for ($i = 1; $i <= $jumlah_halaman; $i++) : ?>
                    <?php if($i == $halaman_aktif) :  ?>
                        <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: blue"><?php echo $i; ?></a>
                    <?php else : ?>
                        <a href="?halaman=<?= $i; ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if ( $halaman_aktif < $jumlah_halaman) : ?>
                    <a href="?halaman=<?= $halaman_aktif + 1; ?>"> >> &nbsp;</a>
                <?php endif; ?>
            </center>  
        </div> 
           
    </main>

    <footer>
        <p>&#169 Rifqa Travel <i class="fab fa-accusoft"></i> 2022</p>
    </footer>
</body>
</html>