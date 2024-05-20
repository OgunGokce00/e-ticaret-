<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Giriş Paneli</title>
</head>
<?php
include("menu.php");
?>

<body>


    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="font-weight-light my-4">Giriş Yap</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST">

                            <input type="email"  class="form-control"name="email" placeholder="E-posta adresiniz"required>
                            <input type="password"  class="form-control" id="password" name="sifre" placeholder="Şifreniz"required>
                            <button type="button"  class="btn btn-light"onclick="togglePasswordVisibility('password')"><i class="fa fa-eye"></i></button>
                            <button type="submit" class="btn btn-primary btn-block" >Giriş Yap</button>


                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small"><a href="forgotpass.php">Şifremi Unuttum</a></div>
                        <div class="small"><a href="register.php">Hesap oluşturun</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="fixed-bottom footer-bg p-2"> <!-- Footer yüksekliği p-2 olarak değiştirildi -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-content text-center">
                        <p>Ahi Evran Üniversitesi Teknik Bilimler Meslek Yüksekokulu Bilgisayar Teknolojisi 2. Sınıf Öğrencisi <i>Ogün Gökce</i></p>

                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php
    include("conn/bag.php");
    $user = false;
    if (isset($_POST['email']) && isset($_POST['sifre'])) {
        $email = $_POST['email']; // Formdan gelen email'i al
        $sifre = $_POST['sifre']; // Formdan gelen şifreyi al

        // Veritabanından email'e göre kullanıcı bilgilerini sorgulama
        $sorgula = "SELECT u_id, u_sifre, user_type FROM users WHERE u_email='$email'";
        $result = $bag->query($sorgula);
        $is_admin = true;


        if ($result->num_rows > 0) {
            // Email bulundu, şifreyi kontrol etme
            $row = $result->fetch_assoc();
            $stored_password = $row['u_sifre'];
            $user_type = $row['user_type'];

            // Girilen şifre ile veritabanındaki şifreyi karşılaştırma
            if (isset($sifre, $stored_password)) {
                // Kullanıcı yönetici mi kontrol et
                $_SESSION['user'] = true;
                $user = true;
                if ($user_type == 'admin') {
                    // Yönetici ise, yönetici oturumu başlat

                    $_SESSION['user_id'] = $row['u_id'];
                    $_SESSION['user_type'] = 'admin';
                    $is_admin = true;
                    echo '<meta http-equiv="refresh" content="0;url=pages/admin_panel.php">';
                    exit();
                } else {
                    // Yönetici değilse, kullanıcı oturumu başlat
                    $_SESSION['user_id'] = $row['u_id'];
                    $_SESSION['user_type'] = 'user';
                    $is_admin = false;
                    echo '<meta http-equiv="refresh" content="0;url=home.php">';
                    exit();
                }
            } else {
                // Hatalı şifre
                echo '<div class="alert alert-danger mt-4" role="alert">
                       Hatalı şifre!
                   </div>';
                exit();
            }
        } else {
            // Email bulunamadı
            echo '<div class="alert alert-danger mt-4" role="alert">
                   Bu email adresiyle ilişkili bir hesap bulunamadı!
               </div>';
            exit();
        }
    } else {
        // Form gönderilmedi, hata mesajı göster
        echo '<div class="alert alert-danger mt-4" role="alert">
               Lütfen e-posta adresinizi ve şifrenizi girin.
           </div>';
    }
    $bag->close();
    
    ?>
    <script>
        // Sayfa yüklendiğinde form alanlarını temizle
        document.addEventListener('DOMContentLoaded', function() {
            resetFormOnLoad();
        });

        window.addEventListener('popstate', function(event) {
            if (event.state && event.state.page) {
                resetFormOnLoad();
                document.getElementById('myForm').reset();
            }
        });

        function resetFormOnLoad() {
            document.getElementById('myForm').reset();
        }


        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            if (input) {
                input.type = input.type === "password" ? "text" : "password";
            }
        }
    </script>

</body>

</html>