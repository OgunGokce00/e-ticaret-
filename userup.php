<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Ürün Güncelleme Formu</title>
    <style>
              .container form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.container form h2 {
    text-align: center;
    margin-bottom: 20px;
}

.container form .custom-select-wrapper {
    text-align: center;
    margin-bottom: 20px;
}

.container form .custom-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
    max-width: 300px;
    margin: 0 auto;
}

.container form button[type="submit"] {
    display: block;
    width: 100%;
    max-width: 300px;
    margin: 0 auto;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.container form button[type="submit"]:hover {
    background-color: #0056b3;
}


        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .custom-select-wrapper {
            text-align: center;
            margin-bottom: 20px;
        }

        .custom-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    include("pagesmanu.php");
    try {
        $baglanti = new PDO('mysql:host=localhost;dbname=dbveri', 'root', '');
        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Bağlantı hatası: " . $e->getMessage();
    }

    // Ürünleri sorgula ve sonuçları al
    $sonuclar = $baglanti->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <form method="post" style="text-align: center;">
            <h2>Kullanıcı seçiniz ve tıklayarak güncelleyin</h2>
            <div class="custom-select-wrapper">
                <select name="sec" class="custom-select" style="text-align: center; ">
                    <option>Seçim Yap</option>
                    <?php foreach ($sonuclar as $sonuc) : ?>
                        <option value="<?php echo $sonuc['u_id'] ?>"><?php echo $sonuc['u_ad'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Forma Ekle</button>
        </form>

        <?php

        if (isset($_POST['sec'])) {
            $selected_user_id = $_POST['sec'];
            if ($selected_user_id) {
                // Prepare and execute SQL statement to fetch user information
                $stmt = $baglanti->prepare("SELECT * FROM users WHERE u_id = :user_id");
                $stmt->bindParam(':user_id', $selected_user_id);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // Eğer kullanıcı bulunamazsa uyarı ver
                if (!$user) {
                    echo "lütfen bir seçim yapın";
                } else {
                    // Display the form to update user information
        ?>

                    <form method="post" id="myForm">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $user['u_id']; ?>">
                            <label for="ad">Ad</label>
                            <input type="text" name="ad" placeholder="Adınızı girin" value="<?php echo $user['u_ad']; ?>" required>
                        </div>
                        <!-- Other form fields -->
                        <div class="form-group">
                            <label for="soyad">Soyad</label>
                            <input type="text" name="soyad" placeholder="Soyadınızı girin" value="<?php echo $user['u_soyad']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Mail Adresi</label>
                            <input type="email" name="email" placeholder="Mail adresi :" value="<?php echo $user['u_email']; ?>" required>
                        </div>
                        <label for="adres">Adres</label>
                        <div class="form-group">

                            <textarea style="width: 500px;    height: 100px;" name="adres" placeholder="Mail adresi :" required><?php echo $user['u_adres']; ?></textarea>
                        </div>

                        <!-- Add other form fields for user information -->

                        <button type="submit" name="submit"> Güncelle </button>
                    </form>


        <?php
                }
            } else {
                echo "Lütfen bir kullanıcı seçin.";
            }
        }
        ?>
        <?php
        if (isset($_POST['submit'])) {
            try {
                $baglanti = new PDO('mysql:host=localhost;dbname=dbveri', 'root', '');
                $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Retrieve form data
                $id = $_POST['id'];
                $ad = $_POST['ad'];
                $soyad = $_POST['soyad'];
                $email = $_POST['email'];
                $adres = $_POST['adres'];

                // Prepare and execute the SQL update query
                $stmt = $baglanti->prepare("UPDATE users SET u_ad = ?, u_soyad = ?, u_email = ?, u_adres = ? WHERE u_id = ?");
                $stmt->execute([$ad, $soyad, $email, $adres, $id]);

                echo "Veri başarıyla güncellendi.";
            } catch (PDOException $e) {
                echo "Güncelleme hatası: " . $e->getMessage();
            }
        }
        ?>
    </div>
</body>

</html>