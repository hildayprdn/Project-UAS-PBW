<?php 

session_start();

if (!isset($_SESSION['admin'])) {
   echo "<script>
         window.location.replace('../login.php');
       </script>";
  exit;
}
require 'functions.php';


if (isset($_POST["register"])) {
  
  if (tambah($_POST) > 0 ) {
     echo "<script>
        alert('Maskapai Berhasil Ditambahkan!');
        window.location.href='index.php';
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
            <h2 class="judul">Tambah Produk</h2>
            <article class="card">
                <form action="" method="post">
                     <div class="jarak">
                         <label for="kode">Kode Maskapai</label>
                         <input type="text" id="kode" name="kode" placeholder="Masukkan Kode Maskapai" required>
                    </div>
                    <div class="jarak">
                         <label for="nama_maskapai">Nama Maskapai</label>
                         <input type="text" id="nama_maskapai" name="nama_maskapai" placeholder="Masukkan Nama Maskapai" required>
                    </div>
                    <div class="jarak">
                         <label for="harga">Harga</label>
                         <input type="text" id="harga" name="harga" placeholder="Masukkan Harga" required>
                    </div>
                    <button type="submit" name="register" class="btn" style="width: 100%;padding:10px;background-color: royalblue;">Tambah</button>
                </form>
            </article>
        </div>
    </main>


    <footer>
        <p>&#169 Rifqa Travel <i class="fab fa-accusoft"></i> 2021</p>
    </footer>

    <script type="text/javascript">
        
        var harga = document.getElementById('harga');
        harga.addEventListener('keyup', function(e){
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatharga() untuk mengubah angka yang di ketik menjadi format angka
            harga.value = formatharga(this.value, 'Rp. ');
        });
 
        /* Fungsi formatharga */
        function formatharga(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split           = number_string.split(','),
            sisa            = split[0].length % 3,
            harga          = split[0].substr(0, sisa),
            ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
 
            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                harga += separator + ribuan.join('.');
            }
 
            harga = split[1] != undefined ? harga + ',' + split[1] : harga;
            return prefix == undefined ? harga : (harga ? 'Rp. ' + harga : '');
        }
    </script>
</body>
</html>