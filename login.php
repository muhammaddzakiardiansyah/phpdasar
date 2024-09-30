<?php 
session_start();
require 'functions.php';
// cek cookie
 if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    // ambil username berdasarkan id
    $result = mysqli_query($conek, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    // cek cookie dan username
    if( $key === hash('sha256', $row['username']) ) {
        $_SESSION['login'] = true;
    }

 }
// cek session
 if( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
 }

// cek tombol submit
if( isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conek, "SELECT * FROM user WHERE username = '$username'");

    // cek username 
    if( mysqli_num_rows($result) === 1 ) {
        
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"])) {
            // cek session
            $_SESSION["login"] = true;
            // cek remember me
            if( isset($_POST["checkbox"]) ) {
                // buat cookie
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']), time()+60);
            }

            header("Location: index.php");
            exit;
        }

    }

    $error = true;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="bg-gray-100 min-h-screen flex items-center justify-center">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img style="background-image: url('https://picsum.photos/1920/1080');" alt=""
            class="w-full h-full object-cover filter blur-sm">
    </div>

    <!-- Login Form -->
    <div class="relative z-10 bg-white p-8 rounded-md shadow-lg">
        <h1 class="text-xl font-bold mb-4">Halaman Login</h1>
        <?php if ( isset($error) ) : ?>
            <script>
                Swal.fire({
                    title: 'Kesalahan!',
                    text: 'Username / Password Salah',
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi'
                });
            </script>
            <?php endif; ?>
        <form action="#" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="email">Username</label>
                <input
                    class="appearance-none border rounded-md py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
                    name="username" id="" type="text" placeholder="Username">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="password">Password</label>
                <input
                    class="appearance-none border rounded-md py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
                    name="password" id="password" type="password" placeholder="Password">
            </div>
            <div class="mb-4">
                <label class="text-gray-700 font-bold mb-2" for="checkbox">Remember me?</label>
                <input type="checkbox" name="checkbox" id="checkbox">
            </div>
            <div class="flex items-center justify-between gap-8">
                <button
                    class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    name="login" type="submit">
                    Sign In
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-cyan-500 hover:text-cyan-800"
                    href="registrasi.php">
                    Don't Have Account?
                </a>
            </div>
        </form>
    </div>
</div>    
</body>
</html>

