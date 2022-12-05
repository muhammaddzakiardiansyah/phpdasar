<?php 

   require 'functions.php';

  if( isset($_POST["register"]) ) {
     
     if( registrasi($_POST) > 0 ) {
        echo "
        <script>
           alert('User baru berhasil ditambahkan!');
           document.location.href = 'login.php';
        </script>
      ";
     } else {
        echo  mysqli_error($conek);
     }

  }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi user</title>
</head>
<body>
    <h1 align="center">Halaman Registrasi</h1>
    <table cellpadding="10" cellspacing="0" align="center">
        <form action="" method="post">
            <tbody>
                <tr>
                    <td><label for="username">Username</label></td>
                    <td>:</td>
                    <td><input type="username" name="username" id="username" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td>:</td>
                    <td><input type="password" name="password" id="password" required></td>
                </tr>
                <tr>
                    <td><label for="password2">Password2</label></td>
                    <td>:</td>
                    <td><input type="password" name="password2" id="password2" required></td>
                </tr>
                <tr>
                    <td colspan="3" align="center"><button type="submit" name="register">Register</button></td>
                </tr>
            </tbody>
        </form>
    </table>
</body>
</html>