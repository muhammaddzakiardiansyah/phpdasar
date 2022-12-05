
<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// $conek = mysqli_connect("localhost", "root", "", "datasiswa");

$id = $_GET["id"];

$siswa = query("SELECT * FROM xirpl1 WHERE id = $id") [0];

if( isset($_POST["submit"]) ) {

   if( edit($_POST) > 0) {
    echo "
    <script>
        alert('data berhasil diedit!');
        document.location.href = 'index.php';
    </script>
    ";
   } else {
    echo "
    <script>
        alert('data gagal diedit!');
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
            <h2>Edit Data siswa</h2>
            <table>
                <form action="" method="post" enctype="multipart/form-data">
                <tbody>
                    <input type="hidden" name="id" value="<?= $siswa["id"]; ?>">
                    <input type="hidden" name="gambarLama" value="<?= $siswa["gambar"]; ?>">
                    <tr>
                        <td><label for="gambar">Gambar </label></td>
                        <td>:</td>
                        <td><img src="assets/img/<?= $siswa["gambar"]; ?>" alt=profil"></td>
                        <td><input type="file" name="gambar" id="gambar"></td>
                    </tr>
                    <tr>
                        <td><label for="nama">Nama </label></td>
                        <td>:</td>
                        <td><input type="username" name="nama" id="nama" required value="<?= $siswa["nama"]; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="nis">Nis </label></td>
                        <td>:</td>
                        <td><input type="text" name="nis" id="nis" required value="<?= $siswa["nis"]; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email </label></td>
                        <td>:</td>
                        <td><input type="email" name="email" id="email" value="<?= $siswa["email"]; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="Jurusan">Jurusan </label></td>
                        <td>:</td>
                        <td><input type="text" name="jurusan" id="jurusan" value="<?= $siswa["jurusan"]; ?>"></td>
                    </tr>
                    <div class="kirim">
                        <button type="submit" name="submit">Edit</button>
                    </div>
                </tbody>
                </form>
            </table>
        </div>
    </div>
    
</body>
</html>