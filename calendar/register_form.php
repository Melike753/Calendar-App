<?php

@include 'config.php';

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

   $result = mysqli_query($conn, $select);  /* tablo yenileme ve veri silme komutları için kullanılır. */

   if(mysqli_num_rows($result) > 0){    /* En son sorgu ile gelen kayıt sayısını verir*/

      $error[] = 'Kullanıcı zaten var!';    /*Hata mesajı*/

   }else{

      if($sifre != $sifretekrar){    /* Şifre kontrolü */
         $error[] = 'Şifre eşleşmiyor!';
      }else{
         $insert = "INSERT INTO kullanici_form(adi, soyadi, kullanici_adi, tc, sifre, telefon, eposta, adres, kullanici_tipi) VALUES ('$adi',
         '$soyadi','$kullanici','$tcno','$sifre','$telno','$email','$adres','$kullanici_tipi')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }

   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>

    <!--custom css file link -->
    <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Kayıt Ol</h3>
      <?php
      if(isset($error)){

         foreach($error as $error){
            /* Hata mesajını ekrana yansıtır. */
            echo '<span class="error-msg">'.$error.'</span>';  

         };
      }; 
      ?>
      <input type="text" name="adi" required placeholder="Adı">
      <input type="text" name="soyadi" required placeholder="Soyadı">
      <input type="text" name="kullanici_adi" required placeholder="Kullanıcı Adı">
      <input type="text" name="tc" required placeholder="T.C">
      <input type="password" name="sifre" required placeholder="Şifre">
      <input type="password" name="sifretekrar" required placeholder="Şifreyi Tekrar Giriniz">
      <input type="tel" name="telefon" required placeholder="Telefon">
      <input type="email" name="eposta" required placeholder="E-posta">
      <input type="text" name="adres" required placeholder="Adres">
      <select name="kullanici_tipi">
         <option value="kullanici">kullanıcı</option>
         <option value="admin">yönetici</option>
      </select>
      <input type="submit" name="submit" value="Üye Ol" class="form-btn">
      <p>Zaten bir hesabınız var mı? <a href="login_form.php">Giriş Yap</a></p>
   </form>

</div>

</body>
</html>