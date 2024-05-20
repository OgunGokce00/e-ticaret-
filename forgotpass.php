<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include("menu.php");

    ?>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Şifrenizi Sıfırlayın</h5>
                        <form id="contactForm" method="post">
                            <div class="mb-3">
                                <label for="email">E-posta Adresiniz</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                                <label for="email"></label>
                                <label class="small mb-1" for="guvenlikSorusu">Güvenlik Sorusu</label>
                                <input class="form-control py-4" name="güven" id="guvenlikSorusu" type="text" placeholder="Güvenlik sorunuzu girin" required>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submitButton">Şifremi Sıfırla</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php

    include("conn/bag.php");
    $mesaj="";
     $bas= isset($_POST["submit"]);
    if ($_SERVER["REQUEST_METHOD"] === "POST"&&$bas) {
        if (isset($_POST['email']) && isset($_POST['güven'])) {
            $email = $_POST['email'];
            $güven = $_POST['güven'];

            // SQL injection koruması için hazır ifadeler kullanalım
            $sorgu = $bag->prepare("SELECT * FROM users WHERE u_email = ? AND  u_guven = ?");
            $sorgu->bind_param("ss", $email, $güven);
            $sorgu->execute();
            $sonuc = $sorgu->get_result();

            if ($sonuc->num_rows > 0) {
                // Kullanıcı bulundu, yeni şifre oluşturabiliriz
                $sifre = generate_random_password(); // Rastgele şifre oluştur

                // Veritabanında yeni şifreyi hash'leyerek güncelle
                $hashed_password = password_hash($sifre, PASSWORD_DEFAULT);
                $sorgu = $bag->prepare("UPDATE users SET u_sifre = ? WHERE u_email = ?");
                $sorgu->bind_param("ss", $hashed_password, $email);
                $sorgu->execute();
                    echo $mesaj = "Şifreniz başarıyla sıfırlandı. Yeni şifreniz: " . $sifre;
                
               
            } else {
               echo  $mesaj = "E-posta adresi veya güvenlik cevabı yanlış.";
            }
        }
    }

    function generate_random_password()
    {
        // Güvenli bir şekilde rastgele şifre oluştur
        $length = 10; // Şifre uzunluğu
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }
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