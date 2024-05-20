<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Üye Ol</title>
    <style>
        body {
            overflow-y: auto;

        }

        body {
            overflow-y: auto;
        }
        .row 
        {
            overflow-y: auto;
            max-height: 600px;
           

        }

        

   

   
   
    </style>

</head>

<body>
    <?php

    include("menu.php");
    ?>
    <div class="col-md-13 mx-auto">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="font-weight-light my-4">Kayıt Ol</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" id="myForm">
                            <div>
                                <label>Ad</label>
                                <input type="text" id="ad" name="ad" placeholder="Adınızı girin" required>
                            </div>
                            <div>
                                <label>Soyad</label>
                                <input type="text" id="soyad" name="soyad" placeholder="Soyadınızı girin" required>
                            </div>
                            <div>
                                <label>Güvenlik Sorusu</label>
                                <input type="text" id="guvenn" name="guven" placeholder="Güvenlik sorunuzu girin" required>
                                <small>Kurallar: Güvenlik sorusu, kolay hatırlanabilir ancak başkaları tarafından kolayca tahmin edilemez olmalıdır. Örneğin: İlk okul öğretmeninizin adı gibi.</small>
                            </div>
                            <div>
                                <label>E-posta</label>
                                <input type="email" id="email" name="email" placeholder="E-posta adresinizi girin" required>
                            </div>
                            <div>
                                <label>Cinsiyet</label>
                                <select id="cinsiyett" name="cinsiyet" required>
                                    <option value="secimyok">Cinsiyet Seçiniz</option>
                                    <option value="erkek">Erkek</option>
                                    <option value="kadin">Kadın</option>
                                    <option value="diger">Diğer</option>
                                </select>
                            </div>

                    </div>
                    <div>
                        <label>Şehir</label>
                        <select id="sehirr" name="sehir" required>
                            <option value="Sehir Seciniz">Şehir Seçiniz</option>
                            <option value="kirsehir">Kırşehir</option>
                            <option value="Adana">Adana</option>
                            <option value="Adıyaman">Adıyaman</option>
                            <option value="Afyonkarahisar">Afyonkarahisar</option>
                            <option value="Ağrı">Ağrı</option>
                            <option value="Amasya">Amasya</option>
                        </select>
                    </div>
                    <div>
                        <label>Adres</label>
                        <input type="text" id="adresi" name="adres" placeholder="Adresinizi girin" required>
                    </div>
                    <label>Şifre</label>
                    <div>
                        <input type="password" id="password" name="sifre" placeholder="Şifrenizi girin" required>
                        <button type="button" onclick="togglePasswordVisibility('password')"><i class="fa fa-eye"></i></button>
                    </div>
                    <label>Şifre Tekrar</label>
                    <div>
                        <input type="password" id="password2" name="sif2" placeholder="Şifrenizi tekrar girin" required>
                        <button type="button" onclick="togglePasswordVisibility('password2')"><i class="fa fa-eye"></i></button>
                        <button type="submit" name="submit">Kayıt Ol</button>
                    </div>

                    <div class="small" style="background-color: yellowgreen;text-align: center;">
                        <a id="av" href="login.php">Zaten bir hesabınız var mı? Giriş yapın!</a>
                    </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    include("conn/bag.php");
    $form_submitted = isset($_POST['submit']);

    if ($_SERVER["REQUEST_METHOD"] === "POST"  && $form_submitted) {

        echo '<meta http-equiv="refresh" content="5">';
        // Kullanıcı girişlerini alın
        $email = $_POST['email'];
        $ad = $_POST['ad'];
        $soyad = $_POST['soyad'];
        $guven = $_POST['guven'];
        $cinsiyet = $_POST['cinsiyet'];
        $sehir = $_POST['sehir'];
        $adres = $_POST['adres'];
        $pas = $_POST['sifre'];
        $pas2 = $_POST['sif2'];
        $typ_user = "user";

        // E-posta adresinin veritabanında zaten kullanılıp kullanılmadığını kontrol et
        $check_email_sql = "SELECT COUNT(*) AS count FROM users WHERE u_email = ?";
        $statement = $bag->prepare($check_email_sql);
        $statement->bind_param("s", $email);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            // Eğer e-posta adresi veritabanında zaten varsa, kullanıcıya hata mesajı göster
            echo '<div class="alert alert-danger mt-4" role="alert">
            Bu e-posta adresi zaten kullanılıyor. Lütfen farklı bir e-posta adresi deneyin.
        </div>';
            echo '<meta http-equiv="refresh" content="3;URL=\'register.php\'">';
           
        }

        // Şifrelerin eşleşip eşleşmediğini kontrol et
        if ($pas != $pas2) {
            echo "<script>alert('Üzgünüz, şifreler eşleşmiyor. Sayfa yenilendikten sonra  Lütfen tekrar deneyin.');</script>";
            
        }

       
   

        // Veritabanına kullanıcıyı ekle
        $insert_user_sql = "INSERT INTO users (u_ad, u_soyad, u_guven, u_email, u_cinsiyet, u_sehir, u_adres, u_sifre, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_statement = $bag->prepare($insert_user_sql);
        $insert_statement->bind_param("sssssssss", $ad, $soyad, $guven, $email, $cinsiyet, $sehir, $adres,$pas, $typ_user);
        $insert_statement->execute();

        if ($insert_statement->affected_rows > 0) {
            echo '<meta http-equiv="refresh" content="0;url=success.html">';
           
        } else {
            echo '<meta http-equiv="refresh" content="0;url=warning.html">';
           
        }
        $bag->close();
    }

    ?>

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



    <script>
        // Sayfa yüklendiğinde form alanlarını temizle
        document.addEventListener('DOMContentLoaded', function() {
            resetFormOnLoad();
        });

        window.addEventListener('popstate', function(event) {
            if (event.state && event.state.page) {
                resetFormOnLoad();
                location.reload();
            }
        });

        function resetFormOnLoad() {
            document.getElementById('myForm').reset();
        }

        function resetFormOnLoad() {
            document.getElementById('ad').value = '';
            document.getElementById('soyad').value = '';
            document.getElementById('guvenn').value = '';
            document.getElementById('email').value = '';
            document.getElementById('cinsiyett').value = 'secimyok';
            document.getElementById('sehirr').value = 'Sehir Seciniz';
            document.getElementById('adresi').value = '';
            document.getElementById('password').value = '';
            document.getElementById('password2').value = '';
        }

        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            if (input) {
                input.type = input.type === "password" ? "text" : "password";
            }
        }
    </script>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>