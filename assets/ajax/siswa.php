<?php

require_once '../../functions.php';

$keyword = $_GET["keyword"];

$siswa = query("SELECT * FROM xirpl1
            
WHERE

nama LIKE '%$keyword%' OR
nis LIKE '%$keyword%' OR
jurusan LIKE '%$keyword%'");

?>

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