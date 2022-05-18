<?php
session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('../login.php');
       </script>";
  exit;
}
 
require 'functions.php';


$id = $_GET["id"];
$maskapai = query("SELECT * FROM maskapai WHERE id = $id")[0];

if (isset($_POST["submit"])) {

  if (ubah($_POST) > 0 ) {
    echo "
      <script>
        alert('Data Berhasil Diubah!');
        window.location.href='index.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Data Gagal Diubah!');
        
      </script>
    ";
  }
} 
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
        #content {
            width: 100%;
        }
        body {
          background-image: url("../images/bg.jpeg");
          background-size: contain;
        }
    </style>
</head>

<body>
    <header>
        <div class="jumbotron">
            <h3>Rifqa Travel <i class="fab fa-accusoft"></i></h3>
        </div>
    </header>

   <main>
        <div id="content">
            <h2 class="judul">Edit maskapai</h2>
            <article class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $maskapai["id"]; ?>">
                     <div class="jarak">
                         <label for="kode">Kode Maskapai</label>
                         <input type="text" id="kode" name="kode" value="<?= $maskapai["kode"]; ?>" required></input>
                    </div>
                     <div class="jarak">
                         <label for="nama_maskapai">nama_maskapai maskapai</label>
                         <input type="text" id="nama_maskapai" name="nama_maskapai" placeholder="Masukkan Nama Maskapai" value="<?= $maskapai["nama_maskapai"]; ?>" required>
                    </div>
                    <div class="jarak">
                         <label for="harga">Harga Maskapai</label>
                         <input type="text" id="harga" name="harga" value="<?= $maskapai["harga"]; ?>" required></input>
                    </div>
                    <button type="submit" name="submit" class="btn" style="width: 100%;padding:10px;background-color: royalblue;">Ubah Maskapai</button>
                </form>
            </article>
        </div>
    </main>
    

   <footer>
        <p>&#169 Rifqa Travel <i class="fab fa-accusoft"></i> 2022</p>  
    </footer>

</body>
</html>