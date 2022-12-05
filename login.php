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
    <title>Login</title>
</head>
<body>
    <h1 align="center">Halaman Login</h1>
    <?php if( isset($error) ) : ?>
        <p style="font-style: italic; color: red; text-align: center;">Username / Password salah!</p>
    <?php endif; ?>
    <table cellpadding="10" cellspacing="0" align="center">
        <form action="" method="post">
            <tbody>
                <tr>
                    <td><label for="username">Username</label></td>
                    <td>:</td>
                    <td><input type="username" name="username" id="username"></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td>:</td>
                    <td><input type="password" name="password" id="password"></td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><input type="checkbox" name="checkbox" id="checkbox"><label for="checkbox">Remember me?</label></td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><button type="submit" name="login">Login</button></td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><a href="registrasi.php">Daftarkan akun</a></td>
                </tr>
            </tbody>
        </form>
    </table>
</body>
</html>