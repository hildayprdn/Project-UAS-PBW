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
$promo = date("d F Y", strtotime("+3 days", time()));
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
        /*Membuat Tulisan Berkedip*/
        blink {
          -webkit-animation: 2s linear infinite condemned_blink_effect;
          animation: 1s linear infinite condemned_blink_effect;
        }
        @keyframes condemned_blink_effect {
          0% {
            visibility: hidden;
          }
          50% {
            visibility: hidden;
          }
          100% {
            visibility: visible;
          }
        }
        .btn {
            text-decoration: none;
            padding: 5px 10px;
            background-color: red;
        }
        body {
          background-image: url("images/bg.jpeg");
          background-size: contain;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="katalog.php">Tiket Pesawat</a></li>
                <li><a href="pesanan.php">Pesanan Saya <span class="jumlah_bookings"><?= $total_bookings; ?></span></a></li>
                <li><a href="logout.php" class="btn" style="border-bottom: none;">Logout <i class="fas fa-power-off fa-1x"></i></a></li>
            </ul>
        </nav>
        <div class="jumbotron">
            <h3>Rifqa Travel <i class="fab fa-accusoft"></i></h3>
            <p>Selamat Datang,
            <?php
                    if (isset($_SESSION['username'])) {
                     $username = $_SESSION['username'];

                     $query = mysqli_query($conn, "SELECT nama FROM user WHERE username = '$username'"); 
                     foreach ($query as $cf) {}

                     if($query->num_rows > 0) {
                      echo $cf['nama'];
                      echo "!";
                      }
                  }
                ?>
            </p>
        </div>
    </header>

    <main>
         <article class="card">
                <marquee><blink><h3 style="color:royalblue;">Garuda Indonesia Promo Hingga <?= $promo; ?> !!!</h3></blink></marquee>
            </article>
        <div id="content">
           

            <article class="card">
                <h4 class="judul">Nikmati Berbagai Metode Pembayaran : </h4>
                <center>
                    <img src="images/bni.PNG" alt="bni" width="25%">
                    <p><span></p>
                    <hr width="25%">
                    <br>
                </center>
                <center>
                    <img src="images/mandiri.PNG" alt="mandiri" width="25%">
                    <p><span></p>
                    <hr width="25%">
                    <br>
                </center>
                <center>
                    <img src="images/btn.PNG" alt="btn" width="25%">
                    <p><span></p>
                    <hr width="25%">
                    <br>
                </center>
                <center>
                    <img src="images/bri.PNG" alt="bri" width="25%">
                    <p><span></p>
                </center>
            </article>
        </div>

        <aside>
            <a href="katalog.php" style="text-decoration: none;">
                <article class="card">
                    <p class="judul"><b>Pesan Tiket Pesawat</b> <i class="fas fa-angle-left"></i></p>
                </article>
            </a>

            <article class="card">
                <h3 class="judul">Kebijakan Privasi</h3>
                <center><i class="fas fa-gem judul"></i></center>
                <p>Adanya Kebijakan Privasi ini adalah komitmen nyata dari layanan kami untuk menghargai dan melindungi setiap informasi pribadi pengguna situs ini. Kebijakan ini menjadi acuan yang mengatur dan melindungi penggunaan data dan informasi penting para pengguna situs layanan travel ini, yang telah dikumpulkan pada saat mendaftar, mengakses dan menggunakan layanan disini, seperti alamat e-mail, nomor telepon, foto, gambar, dan lain-lain.</p>
            </article>
        </aside>
    </main>

    <footer>
        <p>&#169 Rifqa Travel <i class="fab fa-accusoft"></i> 2022</p>
    </footer>
</body>
</html>