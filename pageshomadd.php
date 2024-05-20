<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Ekle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Custom CSS for registration form */

        /* Custom CSS for product add form */
       

        .container .form-group {
            margin-bottom: 15px;
        }

        .container label {
            font-weight: bold;
        }

        .container input[type="text"],
        .container textarea {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .container button[type="submit"] {
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

        .container button:focus {
            outline: none;
        }

        .card {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
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
                <h3 class="font-weight-light my-15">Ürün ekle</h3>
            </div>
            <div class="card-body">
                <form method="post" id="myForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="ad">Ürün adı</label>
                        <input type="text" id="ad" name="ad" placeholder="Ürün adı girin" required>
                    </div>

                    <div class="form-group">
                        <label for="acikla">Ürün açıklaması</label>
                        <textarea id="acikla" name="acikla" placeholder="Ürün açıklaması girin" style="height: 150px;" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="fiyat">Ürün fiyatı</label>
                        <input type="text" id="fiyat" name="fiyat" placeholder="Ürün fiyatı girin" required>
                    </div>

                    <div class="form-group">
                        <label for="resim">Ürün Resmi</label>
                        <input type="file" id="resim" name="resim" accept="image/*" required>
                    </div>

                    <button type="submit" name="submit">Ürün Ekle</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    include("../conn/bag.php"); // Veritabanı bağlantısını içe aktar

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
        // Güvenlik önlemleri: Kullanıcı girişlerini temizleme ve doğrulama
        $urunAdi = htmlspecialchars($_POST['ad']);
        $urunAciklama = htmlspecialchars($_POST['acikla']);
        $urunFiyat = floatval($_POST['fiyat']); // Fiyatı float türüne dönüştür

        // Dosya yükleme işlemi
        $dosyaAdi = $_FILES['resim']['name'];
        $dosyaTmpYolu = $_FILES['resim']['tmp_name'];
        $hedefKlasor = '../img/home/'; // Resimlerin kaydedileceği klasör

        $dosyaYolu = dosyaYukle($dosyaAdi, $dosyaTmpYolu, $hedefKlasor);

        if ($dosyaYolu) {
            try {
                // Veritabanına kayıt ekleme işlemi

                $eklemeSorgusu = $bag->prepare("INSERT INTO addcontent (ad,aciklama,fiyat,img) VALUES (?, ?, ?, ?)");
                $eklemeSorgusu->bind_param("ssds", $urunAdi, $urunAciklama, $urunFiyat, $dosyaYolu);
                $eklemeSorgusu->execute();

                echo '<div class="alert alert-success mt-4" role="alert">
                Kayıt Başarı ile eklendi.
              </div>';
              die();
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger mt-4" role="alert">
                Veritabanı hatası: ' . $e->getMessage() . '
              </div>';
            }
        } else {
            echo '<div class="alert alert-danger mt-4" role="alert">
            Dosya yüklenirken bir hata oluştu.
          </div>';
        }
        $bag->close();
    }
    ?>
</body>

</html>