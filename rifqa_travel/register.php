<?php 
require 'functions.php';

if (isset($_POST["register"])) {
  if (registrasi($_POST) > 0 ) {
    $success = true;
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
        #content {
            width: 100%;
            padding: 0 350px;
        }
        @media screen and (max-width: 1000px) {
            #content {
                padding: 0 10px;
            }
        }
        .alert {
            margin: 10px 0;
            font-size: 0.9rem;
            background-color: #FCC663;
            padding: 10px;
            border: 1px solid darkorange;
        }
        body {
          background-image: url("images/bg.jpeg");
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
            <?php if (isset($success)) : ?>
            <center>
                <p style="color: green;" class="sukses">Registrasi Berhasil <i class="fas fa-check-circle"></i></p>
            </center>
            <?php endif; ?>
            <h2 class="judul">Registrasi Akun</h2>
            <article class="card">
                <form action="" method="post">
                    <div class="jarak">
                         <label for="username">Username</label>
                         <input type="text" id="username" name="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="jarak">
                        <label for="password">Password</label>
                        <div class="alert"><a>Minimal 8 Digit</a></div>
                        <input type="password" id="password" name="password" placeholder="Masukkan Password" min="8" minlength="8" required>
                    </div>
                    <div class="jarak">
                         <label for="nama">Nama Lengkap</label>
                         <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <button type="submit" name="register" class="btn" style="width: 100%;">Registrasi</button>
                </form>
            </article>

            <center>Sudah mempunyai akun? <a href="login.php">Login Disini</a></center>
        </div>
    </main>
    

    <footer>
        <p>&#169 Rifqa Travel <i class="fab fa-accusoft"></i> 2022</p>
    </footer>
</body>
</html>