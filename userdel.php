<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
         .container form {
    max-width: 400px;
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
    <?php include("pagesmanu.php"); ?>


    <?php
    try {
        $baglanti = new PDO('mysql:host=localhost;dbname=dbveri', 'root', '');
        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Örnek sorgu, kullanıcıların listesini alır
        $kullanicilar_sorgu = $baglanti->query("SELECT * FROM users");
        $sonuclar = $kullanicilar_sorgu->fetchAll(PDO::FETCH_ASSOC);

        if (isset($_POST['sec'])) {
            $selected_user_id = $_POST['sec'];

            // Kullanıcıyı seçilen ID'ye göre silme işlemi
            $silme_sorgu = $baglanti->prepare("DELETE FROM users WHERE u_id = :user_id");
            $silme_sorgu->bindParam(':user_id', $selected_user_id);
            $silme_sorgu->execute();

            // Silme işleminin başarılı olup olmadığını kontrol etme
            $silinen_satirlar = $silme_sorgu->rowCount();
            if ($silinen_satirlar > 0) {
             
                echo '<div class="alert alert-success mt-4" role="alert">
                Kullanıcı başarıyla silindi.
             </div>';
            } else {
                echo '<div class="alert alert-danger mt-4" role="alert">
                Kullanıcı silinemedi , Boş veri silinemez
              </div>';
                
            }
        }
    } catch (PDOException $e) {
        echo "Bağlantı hatası: " . $e->getMessage();
    }
    ?>
    <div class="container">
        <form method="post" style="text-align: center;">
            <h2>Kullanıcı seçiniz</h2>
            <div class="custom-select-wrapper">
                <select name="sec" class="custom-select" style="text-align: center; ">
                    <option>Seçim Yap</option>
                    <?php foreach ($sonuclar as $sonuc) : ?>
                        <option value="<?php echo $sonuc['u_id'] ?>"><?php echo $sonuc['u_ad'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br><br><br>
            <button type="submit">Kullanıcı Sil</button>
        </form>
    </div>
</body>

</html>