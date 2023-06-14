<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $adi = mysqli_escape_string($conn, $_POST['adi']);
   $soyadi = mysqli_escape_string($conn, $_POST['soyadi']);
   $kullanici = mysqli_escape_string($conn, $_POST['kullanici_adi']);
   $tcno = mysqli_escape_string($conn, $_POST['tc']);
   $sifre = md5($_POST['sifre']);
   $sifretekrar = md5($_POST['sifretekrar']);
   $telno = mysqli_escape_string($conn, $_POST['telefon']);
   $email = mysqli_escape_string($conn, $_POST['eposta']);
   $adres = mysqli_escape_string($conn, $_POST['adres']);
   $kullanici_tipi = $_POST['kullanici_tipi'];

   $select = " SELECT * FROM  kullanici_form WHERE eposta = '$email' && sifre = '$sifre' ";

   /* tablo yenileme ve veri silme komutları için kullanılır. */

   $result = mysqli_query($conn, $select);  

   /* En son sorgu ile gelen kayıt sayısını verir*/
   if(mysqli_num_rows($result) > 0){   

      $row = mysqli_fetch_array($result);

      if($row['kullanici_tipi'] == 'admin'){

         /* session, oturum bilgilerini saklamak için kullanılan yapılardır */
         $_SESSION['admin_name'] = $row['adi'];  
         header('location:admin_page.php');

      }elseif($row['kullanici_tipi'] == 'kullanici'){

         $_SESSION['user_name'] = $row['adi'];
         header('location:user_page.php');
         
      }

   }else{

      $error[] = 'Yanlış e-posta adresi veya şifre!';

   }

};

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>

    <!--custom css file link -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Giriş Yap</h3>
      <?php
      if(isset($error)){

         foreach($error as $error){

            /* Hata mesajını ekrana yansıtır. */
            echo '<span class="error-msg">'.$error.'</span>';  
            
         };
      }; 
      ?>
      <input type="password" name="sifre" required placeholder="Şifre">
      <input type="email" name="eposta" required placeholder="E-posta">
      <input type="submit" name="submit" value="Giriş Yap" class="form-btn">
      <p>Hesabınız yok mu? <a href="register_form.php">Üye Ol</a></p>
   </form>

</div>

</body>
</html>