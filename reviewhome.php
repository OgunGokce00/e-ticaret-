<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün İnceleme Sayfası</title>
  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <link rel="stylesheet" href="style/style.css">
   
    <style>
        /* Özel CSS stilleri buraya */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top:5px;
        }

        .product-img {
            width: 100%;
            height: auto;
        }

        .product-details {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php
    include("menu.php");
    
    try {
        $baglanti = new PDO('mysql:host=localhost;dbname=dbveri', 'root', '');
        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Bağlantı hatası: " . $e->getMessage();
    }

    // URL'den alınan ürün ID'si
    $id = $_GET['id'];

    // Veritabanından ürün bilgilerini sorgula
    $query = "SELECT aciklama, img,ad ,fiyat FROM addcontent WHERE id = :id";
    $statement = $baglanti->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $sonuc = $statement->fetch(PDO::FETCH_ASSOC);

    // Ürün açıklaması ve resmi
    $acikla = $sonuc['aciklama'];
    $img = $sonuc['img'];
    $ad =$sonuc['ad'];
    $fiyat=$sonuc['fiyat'];
    
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto"> <!-- Tam ortalamak için mx-auto kullanıyoruz -->
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center"><?php echo $ad; ?></h2>
                        <img src="img/<?php echo $img; ?>" alt="Ürün Resmi" class="product-img">
                        <div class="product-details">
                            <p><?php echo $acikla; ?></p>
                            <p><?php echo $fiyat; ?>TL</p>
                            <!-- Diğer ürün detayları buraya eklenebilir -->
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="fixed-bottom footer-bg"> <!-- Footer stilini uygula -->
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
    <php  $baglanti=null  ?>
</body>

</html>