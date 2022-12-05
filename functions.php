<?php 

// panggil data siswa


$conek = mysqli_connect("localhost", "root", "", "muhammad-dzaki");

function query($query) {
    global $conek;
    $result = mysqli_query($conek, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }

    return $rows;

}


function tambah($data) {

    global $conek;
    // $gambar = htmlspecialchars($data["gambar"]);
    $nama = htmlspecialchars($data["nama"]);
    $nis = htmlspecialchars($data["nis"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars( $data["jurusan"]);

    // upload gambar

    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

    $query = "INSERT INTO xirpl1
    VALUES
    ('', '$gambar', '$nama', '$nis', '$email', '$jurusan')
    ";


    mysqli_query($conek, $query);

    return mysqli_affected_rows($conek);

}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tempatFile = $_FILES['gambar']['tmp_name'];

    // cek gambar sudah upload
    if( $error === 4 ) {
        echo "
               <script>
                  alert('Pilih gambar terlebih dahulu!');
               </script>
             ";
             return false;
    }
    //  cek gambar yg diupload
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "
               <script>
                  alert('Yang anda upload bukan gambar!');
               </script>
             ";
             return false;
    }
    // cek jika ukuranya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "
        <script>
           alert('Gambar yang anda masukan terlalu besar!');
        </script>
      ";
      return false;
    }
    // jika lolos pengecekan
    // generate nama baru
     $namaFileBaru = uniqid();
     $namaFileBaru .= '.';
     $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tempatFile, 'assets/img/' . $namaFileBaru);
    return $namaFileBaru;
}

function hapus($id) {

     global $conek;
     mysqli_query($conek, "DELETE FROM xirpl1 WHERE id = $id");
     return mysqli_affected_rows($conek);

}


function edit($data) {

    global $conek;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nis = htmlspecialchars($data["nis"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars( $data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES["gambar"]["error"] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE xirpl1 SET 
              gambar = '$gambar',
              nama = '$nama',
              nis = '$nis',
              email = '$email',
              jurusan = '$jurusan'

              WHERE id = $id
              ";


    mysqli_query($conek, $query);

    return mysqli_affected_rows($conek);

}



function cari($keyword) {
    $query = "SELECT * FROM xirpl1
            
             WHERE

             nama LIKE '%$keyword%' OR
             nis LIKE '%$keyword%' OR
             jurusan LIKE '%$keyword%' 
    
           ";

           return query($query);
}


 function registrasi($data) {
    global $conek;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conek, $data["password"]);
    $password2 = mysqli_real_escape_string($conek, $data["password2"]);

    // cek username sudah ada belum ?

    $result = mysqli_query($conek, "SELECT username FROM user WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo "
        <script>
           alert('Username sudah terdaftar!');
        </script>
      ";
      return false;
    }

    // cek konfirmasi password
    if( $password !== $password2 ) {
        echo "
        <script>
           alert('Konfirmasi password tidak valid!');
        </script>
      ";
      return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database 
     mysqli_query($conek, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conek);

 } 





?>