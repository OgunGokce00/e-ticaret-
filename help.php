<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>İletişim Destek Sayfası</title>
  <link rel="stylesheet" href="style/style.cssF">

</head>

<body>

  <?php

  include('menu.php');

  ?>


  <div class="container mt-2">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <h2 class="text-center mb-4">Bize Ulaşın</h2>
        <form id="contactForm" method="post">
          <div class="form-group">
            <label for="name">Adınız Soyadınız</label>
            <input type="text" class="form-control" name="ad" id="name" placeholder="Adınız Soyadınız" required>
          </div>
          <div class="form-group">
            <label for="email">E-posta Adresiniz</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="E-posta Adresiniz" required>
          </div>
          <div class="form-group">
            <label for="message">Mesajınız</label>
            <textarea class="form-control" name="mesaj" id="message" rows="5" placeholder="Mesajınız" required></textarea>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Gönder</button>
        </form>
      </div>
    </div>
  </div>
  <?php
  include("conn/bag.php");


  // Form gönderildiğinde ve işaretçi doğru olduğunda işlemi gerçekleştir
  if (isset($_POST['submit']) && isset($_POST['ad']) && $_POST['email'] && $_POST['mesaj']) {

    // Post verilerini alıyoruz ve güvenli hale getiriyoruz
    $ad = mysqli_real_escape_string($bag, $_POST['ad']);
    $email = mysqli_real_escape_string($bag, $_POST['email']);
    $mesaj = mysqli_real_escape_string($bag, $_POST['mesaj']);

    // Sorguyu hazırlıyoruz
    $ekle = "INSERT INTO help (ad, email, mesaj) VALUES ('$ad', '$email', '$mesaj')";

    // Sorguyu çalıştırıyoruz
    if (mysqli_query($bag, $ekle)) {
      echo '<div class="alert alert-success mt-4" role="alert">
                  Mesajınız başarıyla gönderildi
            </div>';
            echo '<meta http-equiv="refresh" content="3;URL=\'help.php\'">';
      // Başarılı olduğunda JavaScript kullanarak formun yeniden gönderilmesini engelle

    } else {
      echo '<div class="alert alert-danger mt-4" role="alert">
                  Mesaj Gönderilemedi
            </div>';
    }
   
  }

  $bag->close();


  ?>
  <footer class="fixed-bottom footer-bg p-2">
    <!-- Footer yüksekliği p-2 olarak değiştirildi -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="footer-content text-center">
            <p>Ahi Evran Üniversitesi Teknik Bilimler Meslek Yüksekokulu Bilgisayar Teknolojisi 2. Sınıf
              Öğrencisi <i>Ogün Gökce</i></p>

          </div>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>