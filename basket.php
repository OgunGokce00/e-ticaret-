<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .FromCartBtnrmv {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .sepet {
            background-color: greenyellow;
            color: black;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .container-small {
            max-height: 500px;
            overflow-y: auto;
        }
        .custom-product-info {
            max-height: 300px;
            /* Açıklama alanının yüksekliği */
            overflow-y: auto;
            /* Dikey taşma durumunda scroll çubuğunu göster */
        }
    </style>
</head>

<body>

    <?php
    include("menu.php");
    include("searc.php");
    if (isset($_SESSION["shoppingCart"])) {
        $shopping_products = $_SESSION["shoppingCart"]["products"];
        $total_price = 0.0;
        $total_count = 0;
        foreach ($shopping_products as $product) {
            $total_price += $product->p_fiyat * $product->count;
            $total_count += $product->count;
        }
    } else {
        $total_price = 0.0;
        $total_count = 0;
    }
    ?>

    <div class="container mt-5"  class="custom-product-info">
        <?php if ($total_count > 0) { ?>
            <h2 class="text-center">Sepetinizde <strong><?php echo $total_count; ?></strong> adet ürün bulunmaktadır.</h2>
        <?php } else { ?>
            <div class="alert alert-info">
                <h6 class="text-center">Sepetinizde henüz bir ürün bulunmamaktadır. <a href="goods.php">Ürün sepetine göz atın</a></h6>
            </div>
        <?php } ?>

        <div class="container product-table">
            <table class="table table-dark table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">Resmi</th>
                        <th scope="col">Ürün Adı</th>
                        <th scope="col">Fiyat</th>
                        <th scope="col">Adet</th>
                        <th scope="col">Sil</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($shopping_products) && is_array($shopping_products)) { ?>
                        <?php foreach ($shopping_products as $product) { ?>
                            <tr>
                                <td>
                                    <img width="50px" src="img/<?php echo $product->p_img; ?>" alt="<?php echo $product->p_ad; ?>">
                                </td>
                                <td><?php echo $product->p_ad; ?></td>
                                <td><strong><?php echo $product->p_fiyat; ?> TL</strong></td>
                                <td>
                                    <a href="cart_db.php?p=incCount&product_id=<?php echo $product->p_id; ?>" class="btn btn-xs btn-success">
                                        <span class="glyphicon glyphicon-plus">&#43;</span>
                                    </a>
                                    <input type="text" value="<?php echo $product->count; ?>" class="item-count-input">
                                    <a href="cart_db.php?p=decCount&product_id=<?php echo $product->p_id; ?>" class="btn btn-xs btn-danger">
                                        <span class="glyphicon glyphicon-minus">&#8722;</span>
                                    </a>
                                </td>
                                <td>
                                    <button product-id="<?php echo $product->p_id; ?>" class="FromCartBtnrmv">
                                        Sepetten Çıkar
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="5">Sepetinizde ürün bulunmamaktadır.</td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-right">
                            Toplam Ürün: <span class="color-danger"><?php echo $total_count; ?> adet</span>
                        </th>
                        <th colspan="2" class="text-center">
                            Toplam Tutar: <span class="color-danger"><?php echo $total_price; ?> TL</span>
                        </th>
                        <th class="text-right">
                            <a href="payment.php" name="sepet" class="sepet">Sepeti Onayla</a>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <footer class="fixed-bottom footer-bg p-2">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".FromCartBtnrmv").click(function () {
                var url = "cart_db.php";
                var data = {
                    p: "removeFromCart",
                    product_id: $(this).attr("product-id")
                };
                $.post(url, data, function (response) {
                    window.location.reload();
                });
            });

            var productRows = $(".product-table tbody tr").length;
            if (productRows > 9) {
                $(".product-table").addClass("container-small");
            }
        });
    </script>
</body>

</html>
