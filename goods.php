<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticaret Sitesi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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
    $sonuclar = $baglanti->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container mt-4">
        <div class="row">
            <?php foreach ($sonuclar as $sonuc) : ?>
                <div class="col-md-4">
                    <div class="custom-product-item">
                        <img src="img/<?php echo $sonuc['p_img']; ?>" class="product-img" style="display: block; margin: 0 auto;" alt="<?php echo $sonuc['p_ad']; ?>">

                        <div class="custom-product-info">
                            <h5 class="product-title"><?php echo $sonuc['p_ad']; ?></h5>
                            <p class="product-price"><?php echo $sonuc['p_fiyat'] ?>TL</p>
                            <div class="product-body">
                                <div class="modal-body">
                                    <p><?php echo $sonuc['p_acikla']; ?></p>
                                </div>

                            </div>
                            <button class=" btn btn-primary btn-block addToCartBtn" product-id="<?php echo $sonuc['p_id'] ?>" role="button">
                                Sepete Ekle
                            </button>




                            <a class="btn btn-primary btn-block" href="review.php?id=<?php echo $sonuc['p_id']; ?>">İncele</a>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".addToCartBtn").click(function() {
                // butona  ayit classa gittik  ve 


                var url = "cart_db.php";
                var data = {
                    p: "addToCart",
                    product_id: $(this).attr("product-id") //etirübitü değişkene atadık
                }
                $.post(url, data, function(response) {
                    $(".cart-count").text(response);
                });
            });
        });
    </script>

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