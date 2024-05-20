<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/urun.css">
    <style>
        .product-img {
            max-width: 100%;
            max-height: 150px;
            /* veya istediğiniz bir değer */
            width: auto;
            height: auto;
        }

        .col-md-3 {
            margin: 0 2px;
        }

        .custom-product-info {
            height: 250px;
            /* Açıklama alanının yüksekliği */
            overflow-y: auto;
            /* Dikey taşma durumunda scroll çubuğunu göster */
        }
    </style>
</head>

<body>
    <!-- Menü include edildi -->
    <?php include("menu.php");
    include("searc.php");

    try {
        $baglanti = new PDO('mysql:host=localhost;dbname=dbveri', 'root', '');
        $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Bağlantı hatası: " . $e->getMessage();
    }

    // Ürünleri sorgula ve sonuçları al
    $urunler = array();
    $sonuclar = $baglanti->query("SELECT * FROM addcontent")->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container mt-4">
        <h1 class="text-center"> Mağazamda çok yakında   </h1>
        <div class="row">
            <?php foreach ($sonuclar as $sonuc) : ?>
                <div class="col-md-4">
                    <div class="custom-product-item">
                        <img src="img/<?php echo $sonuc['img']; ?>" class="product-img" style="display: block; margin: 0 auto;" alt="<?php echo $sonuc['ad']; ?>">

                        <div class="custom-product-info">
                            <h5 class="product-title"><?php echo $sonuc['ad']; ?></h5>
                            <p class="product-price"><?php echo $sonuc['fiyat'] ?>TL</p>
                            <div class="product-body">
                                <div class="modal-body">
                                    <p><?php echo $sonuc['aciklama']; ?></p>
                                </div>

                            </div>
                            <a class="btn btn-primary btn-block" href="reviewhome.php?id=<?php echo $sonuc['id']; ?>">İncele</a>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>
    </div>
    <br><br>
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

    </footer>
    <!-- Güncellenmiş Bootstrap ve jQuery sürümleri eklendi -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.min.js"></script>
</body>

</html>