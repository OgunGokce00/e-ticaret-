<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Ürün Güncelleme Formu</title>
    <style>
        /* CSS for custom select */
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
    <?php
    include("pagesmanu.php");
    try {
        $baglanti = new PDO('mysql:host=localhost;dbname=dbveri', 'root', '');
        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Bağlantı hatası: " . $e->getMessage();
    }

    // Ürünleri sorgula ve sonuçları al
    $sonuclar = $baglanti->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <form method="post" style="text-align: center;">
            <h2>Ürün Seçin ve Güncelleyin</h2>
            <div class="custom-select-wrapper">
                <select name="sec" class="custom-select" style="text-align: center;">
                    <option></option>
                    <?php foreach ($sonuclar as $sonuc) : ?>
                        <option value="<?php echo $sonuc['p_id'] ?>"><?php echo $sonuc['p_ad'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Forma Ekle</button>
        </form>

        <?php
        if (isset($_POST['sec'])) {
            $p_id = $_POST['sec'];

            // Ürün bilgilerini almak için SQL sorgusu hazırla ve çalıştır
            if ($p_id) {
                // Ürün bilgilerini almak için SQL sorgusu hazırla ve çalıştır
                $stmt = $baglanti->prepare("SELECT * FROM products WHERE p_id = :p_id");
                $stmt->bindParam(':p_id', $p_id);
                $stmt->execute();
                $urun = $stmt->fetch(PDO::FETCH_ASSOC);

                // Ürün bilgilerini güncelleme formunu göster
        ?>
                <div style="text-align: center;">
                    <div class="custom-product-item">
                        <form method="post" id="myForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $urun['p_id']; ?>">
                                <label for="ad">Ürün Adı</label>
                                <input type="text" name="ad" placeholder="Ürün adını girin" value="<?php echo $urun['p_ad']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="acikla">Ürün Açıklaması</label>
                                <input type="text" name="acikla" placeholder="Ürün açıklaması girin" value="<?php echo $urun['p_acikla']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="fiyat">Ürün Fiyatı</label>
                                <input type="text" name="fiyat" placeholder="Ürün fiyatı girin" value="<?php echo $urun['p_fiyat']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="resim">Ürün Resim Yolu</label>
                                <img width="50px" src="../img/<?php echo $urun['p_img']; ?>" alt="<?php echo $urun['p_ad']; ?>">
                                <br><br>
                                <input type="file" id="resim" name="resim" accept="image/*" required>
                            </div>
                            <button type="submit" name="submit">Güncelle</button>
                        </form>
                    </div>
                </div>
        <?php
            } else {
                echo "Lütfen bir ürün seçin.";
            }
        }

        function dosyaYukle($dosyaAdi, $dosyaTmpYolu, $hedefKlasor)
        {
            $hedefDosya = $hedefKlasor . $dosyaAdi;

            // Resmi klasöre taşıma
            if (move_uploaded_file($dosyaTmpYolu, $hedefDosya)) {
                return $hedefDosya; // Dosya yükleme başarılıysa dosyanın yolunu döndür
            } else {
                return false; // Dosya yükleme başarısızsa false döndür
            }
        }

        if (isset($_POST['submit'])) {
            try {
                $baglanti = new PDO('mysql:host=localhost;dbname=dbveri', 'root', '');
                $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Form verilerini al
                $id = $_POST['id'];
                $ad = $_POST['ad'];
                $acikla = $_POST['acikla'];
                $fiyat = $_POST['fiyat'];

                $dosyaAdi = $_FILES['resim']['name'];
                $dosyaTmpYolu = $_FILES['resim']['tmp_name'];
                $hedefKlasor = '../img/';
                $dosyaYolu = dosyaYukle($dosyaAdi, $dosyaTmpYolu, $hedefKlasor);

                // SQL güncelleme sorgusu için hazırla ve çalıştır
                $stmt = $baglanti->prepare("UPDATE products SET p_ad = ?, p_acikla = ?, p_fiyat = ?, p_img = ? WHERE p_id = ?");
                $stmt->execute([$ad, $acikla, $fiyat, $dosyaYolu, $id]); // Değişken isimleri burada düzeltildi

                echo "Veri başarıyla güncellendi.";
            } catch (PDOException $e) {
                echo "Güncelleme hatası: " . $e->getMessage();
            }
        }
        ?>
    </div>
</body>

</html>