<?php 
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('../login.php');
       </script>";
  exit;
}

require 'functions.php';

  $maskapai = mysqli_query($conn, "SELECT * FROM maskapai");
  $total_maskapai = mysqli_num_rows($maskapai);
  
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
        th, td {
            padding: 10px 40px;
            text-align: justify;
        }
    </style>
</head>

<body>
     <header>
        <nav>
            <ul>
                <li><a href="pesanan.php">Data Pesanan</a></li>
                <li><a href="../logout.php" class="btn" style="border-bottom: none;">Logout <i class="fas fa-power-off fa-1x"></i></a></li>
            </ul>
        </nav>
        <div class="jumbotron">
            <h3>Rifqa Travel <i class="fab fa-accusoft"></i></h3>
        </div>
    </header>

    <main>
         <article class="card">
                <center><h3 style="color:royalblue;">Katalog Maskapai</h3></center>
        </article>

        <div id="content">
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
                                <a href="edit-item.php?id=<?= $pesawat["id"]; ?>">Edit</a> | 
                                <a href="hapus-item.php?id=<?= $pesawat["id"]; ?>">Hapus</a>
                            </td>
                           </tr>
                       </table>
               </div>
            </div>
            <?php endforeach; ?>
        </div>

        <aside>
            <div class="card">
                <center><p>Total Maskapai : <b><span style="color: royalblue;"><?= $total_maskapai; ?></span></b></p></center>
            </div>

            <a href="tambah.php" style="text-decoration: none;"><div class="card">
                <center><p>Tambah maskapai</p></center>
            </div></a>

            <a href="pesanan.php" style="text-decoration: none;">
                <div class="card">
                    <center>Data Bookings</center>
                </div>
            </a>
        </aside>
           
    </main>

   <footer>
        <p>&#169 Rifqa Travel <i class="fab fa-accusoft"></i> 2022</p>
    </footer>

</body>
</html>