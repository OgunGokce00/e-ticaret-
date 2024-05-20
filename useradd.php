<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Custom CSS for registration form */
        /* Custom CSS for registration form */
        .card {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            grid-gap: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            display: block;
            margin: 0 auto;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <?php include("pagesmanu.php"); ?>
    <div class="container">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="font-weight-light my-15">Kullanıcı ekle</h3>
            </div>
            <div class="card-body">
                <form method="post" id="myForm">
                    <div class="form-group">
                        <label for="ad">Ad</label>
                        <input type="text" id="ad" name="ad" placeholder="Adınızı girin" required>
                    </div>
                    <!-- Other form fields -->
                    <div class="form-group">
                        <label for="soyad">Soyad</label>
                        <input type="text" id="soyad" name="soyad" placeholder="Soyadınızı girin" required>
                    </div>
                    <!-- Other form fields -->
                    <div class="form-group">
                        <label for="email">E-posta</label>
                        <input type="email" id="email" name="email" placeholder="E-posta adresinizi girin" required>
                    </div>
                    <!-- Other form fields -->
                    <div class="form-group">
                        <label for="cinsiyet">Cinsiyet</label>
                        <select id="cinsiyet" name="cinsiyet" required>
                            <option value="secimyok">Cinsiyet Seçiniz</option>
                            <option value="erkek">Erkek</option>
                            <option value="kadin">Kadın</option>
                            <option value="diger">Diğer</option>
                        </select>
                    </div>
                    <!-- Other form fields -->
                    <div class="form-group">
                        <label for="sehir">Şehir</label>
                        <select id="sehir" name="sehir" required>
                            <option value="Sehir Seciniz">Şehir Seçiniz</option>
                            <option value="kirsehir">Kırşehir</option>
                            <option value="Adana">Adana</option>
                            <option value="Adıyaman">Adıyaman</option>
                            <option value="Afyonkarahisar">Afyonkarahisar</option>
                            <option value="Ağrı">Ağrı</option>
                            <option value="Amasya">Amasya</option>
                        </select>
                    </div>
                    <!-- Other form fields -->
                    <div class="form-group">
                        <label for="adres">Adres</label>
                        <input type="text" id="adres" name="adres" placeholder="Adresinizi girin" required>
                    </div>
                    <!-- Other form fields -->
                    <div class="form-group">
                        <label for="password">Şifre</label>
                        <div>
                            <input type="text" id="text" name="sifre" placeholder="Şifrenizi girin" required>
                        </div>
                    </div>
                    <!-- Other form fields -->
                    <div class="form-group">
                        <label for="guvenlikSorusu">Güvenlik Sorusu</label>
                        <input type="text" id="guvenlikSorusu" name="guven" placeholder="Güvenlik sorunuzu girin" required>
                        <small>Kurallar: Güvenlik sorusu, kolay hatırlanabilir ancak başkaları tarafından kolayca tahmin edilemez olmalıdır. Örneğin: İlk okul öğretmeninizin adı gibi.</small>
                    </div>
                    <!-- Other form fields -->
                    <div class="form-group">
                        <label for="user_type">Kullanıcı Türü</label>
                        <select id="sehir" name="user" required>
                            <option value="user">User(normal kullanıcı)</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <!-- Other form fields -->
                    <button type="submit" name="submit">Kayıt Ekle</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    include("../conn/bag.php");
    $form_submitted = isset($_POST['submit']);
    if ($_SERVER["REQUEST_METHOD"] === "POST"  && $form_submitted) {
        $ad = $_POST['ad'];
        $soyad = $_POST['soyad'];
        $email = $_POST['email'];
        $cinsiyet = $_POST['cinsiyet'];
        $sehir = $_POST['sehir'];
        $adres = $_POST['adres'];
        $sifre = $_POST['sifre'];
        $guven = $_POST['guven'];
        $user = $_POST['user'];

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
        } else {
            $hashed_password = password_hash($sifre, PASSWORD_DEFAULT);

            // Veritabanına kullanıcıyı ekle
            $insert_user_sql = "INSERT INTO users (u_ad, u_soyad, u_guven, u_email, u_cinsiyet, u_sehir, u_adres, u_sifre, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insert_statement = $bag->prepare($insert_user_sql);
            $insert_statement->bind_param("sssssssss", $ad, $soyad, $guven, $email, $cinsiyet, $sehir, $adres, $hashed_password, $user);
            $insert_statement->execute();

            if ($insert_statement->affected_rows > 0) {
                echo '<div class="alert alert-success mt-4" role="alert">
                Kullanıcı Başarı ile eklendi.
             </div>';
                die();
            } else {
                echo '<div class="alert alert-danger mt-4" role="alert">
                Kullanıcı eklerken sorun yaşandı
         </div>';
                die();
            }
        }
        $bag->close();
    }


    ?>
</body>

</html>