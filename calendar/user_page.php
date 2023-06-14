<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){

   header('location:login_form.php');
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Page</title>

   <!--custom css file link -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
<div class = "container">

   <div class="content">
      <h3>Merhaba, <span>kullanıcı</span></h3>
      <h1>Hoş Geldin <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>Bu bir kullanıcı sayfasıdır.</p>
      <a href="Calendar.App/index.html" class = "btn">Takvim Sayfasına Giriş</a>
      <a href="logout.php" class = "btn">Çıkış Yap</a>
   </div>

</div>

   
</body>
</html>