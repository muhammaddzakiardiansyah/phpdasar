<?php 

    require 'functions.php';

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Registrasi User</title>
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
        <h1 class="text-xl font-bold mb-4">Halaman Registrasi</h1>
        <?php
        if( isset($_POST["register"]) ) {
     
            if( registrasi($_POST) > 0 ) {
    
            ?>
                <script>
                    Swal.fire({
                        title: 'Registrasi Berhasil!',
                        text: 'User baru ditambahkan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'login.php';
                        }
                    });
                </script>
            <?php
        } else {
            echo  mysqli_error($conek);
        }
    
      }
        ?>
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
                <label class="block text-gray-700 font-bold mb-2" for="password">Confirm Password</label>
                <input
                    class="appearance-none border rounded-md py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
                    name="password2" id="password2" type="password" placeholder="Confirm Password">
            </div>
            <div class="flex items-center justify-between gap-8">
                <button
                    class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    name="register" type="submit">
                    Sign Up
                </button>
            </div>
        </form>
    </div>
</div>    
</body>
</html>