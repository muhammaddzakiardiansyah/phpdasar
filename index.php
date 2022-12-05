<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';
//  pagination
// ORDER BY id DESC
// LIMIT 0(index), 10(banyaknya table)
//  konfigurasi
$banyakTable = 5;
$jmlhData = count(query("SELECT * FROM xirpl1"));
$jmlhHalaman = ceil($jmlhData / $banyakTable);
$halActive = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($banyakTable * $halActive) - $banyakTable;

$siswa = query("SELECT * FROM xirpl1 ORDER BY id DESC LIMIT $awalData, $banyakTable");


// tombol cari ditekan

if (isset($_POST["cari"])) {
  $siswa = cari($_POST["keyword"]);
}


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data siswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <style>

     img {
        width: 100px;
        height: 100px;
        object-fit: contain;
     }

  </style>
</head>

<body>
  <div class="container-fluid">
    <h1 class="text-center p-5">Data siswa smk syafii akrom</h1>
    <?php if (!isset($_POST["keyword"])) : ?>
      <a href="logout.php" class="btn btn-danger">Logout</a>
    <?php endif; ?>
    <form class="d-flex justify-content-end" method="post">
      <input type="search" placeholder="Cari siswa" aria-label="Search" name="keyword" autofocus autocomplete="off">
      <button class="btn btn-outline-success" type="submit" name="cari">Cari!</button>
    </form>
    <?php if (!isset($_POST["keyword"])) : ?>
      <?php if ($halActive > 1) : ?>
        <a href="?halaman=<?= $halActive - 1; ?>">&laquo;</a>
      <?php endif; ?>
      <?php for ($i = 1; $i <= $jmlhHalaman; $i++) : ?>
        <?php if ($i == $halActive) : ?>
          <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
        <?php else : ?>
          <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
      <?php endfor; ?>
      <?php if ($halActive < $jmlhHalaman) : ?>
        <a href="?halaman=<?= $halActive + 1; ?>">&raquo;</a>
      <?php endif; ?>
    <?php endif; ?>
    <a href="tambah.php" class="btn btn-primary mb-2">Tambah data siswa</a>
    <table class="table table-hover table-striped-columns mt-3">
      <thead class="bg-primary">
        <th>No.</th>
        <th>Profil</th>
        <th>Aksi</th>
        <th>Nama</th>
        <th>Nis</th>
        <th>Email</th>
        <th>Jurusan</th>
      </thead>
      <?php $i = 1; ?>
      <?php foreach ($siswa as $row) : ?>
        <tbody>
          <td><?= $i; ?></td>
          <td><img src="assets/img/<?= $row["gambar"]; ?>" alt="profile"></td>
          <td>
            <a href="edit.php?id=<?= $row["id"]; ?>" class="btn btn-success">Edit</a> |
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick=" return confirm('Anda yakin akan menghapus data ini?');" class="btn btn-danger">Hapus</a>
          </td>
          <td><?= $row["nama"]; ?></td>
          <td><?= $row["nis"]; ?></td>
          <td><?= $row["email"]; ?></td>
          <td><?= $row["jurusan"]; ?></td>
        </tbody>
        <?php $i++; ?>
      <?php endforeach; ?>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>