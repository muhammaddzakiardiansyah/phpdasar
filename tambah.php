<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// $conek = mysqli_connect("localhost", "root", "", "datasiswa");

if( isset($_POST["submit"]) ) {

   if( tambah($_POST) > 0) {
    echo "
    <script>
        alert('data berhasil ditambahkan!');
        document.location.href = 'index.php';
    </script>
    ";
   } else {
    echo "
    <script>
        alert('data gagal ditambahkan!');
    </script>
    ";
   }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Tambah Data siswa</h2>
            <table>
                <form action="" method="post" enctype="multipart/form-data">
                <tbody>
                    <tr>
                        <td><label for="gambar">Gambar </label></td>
                        <td>:</td>
                        <td><input type="file" name="gambar" id="gambar" required></td>
                    </tr>
                    <tr>
                        <td><label for="nama">Nama </label></td>
                        <td>:</td>
                        <td><input type="username" name="nama" id="nama" required></td>
                    </tr>
                    <tr>
                        <td><label for="nis">Nis </label></td>
                        <td>:</td>
                        <td><input type="text" name="nis" id="nis" required></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email </label></td>
                        <td>:</td>
                        <td><input type="email" name="email" id="email"></td>
                    </tr>
                    <tr>
                        <td><label for="Jurusan">Jurusan </label></td>
                        <td>:</td>
                        <td><input type="text" name="jurusan" id="jurusan"></td>
                    </tr>
                    <div class="kirim">
                        <button type="reset">Bersihkan</button>
                        <button type="submit" name="submit">Tambah</button>
                    </div>
                </tbody>
                </form>
            </table>
        </div>
    </div>
    
</body>
</html>