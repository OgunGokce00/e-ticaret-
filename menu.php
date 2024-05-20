<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">


</head>
<?php
session_start();
?>
<!-- Menüyü oluşturalım -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="home.php">E_ticaret(DEMO)</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
                if (isset($_SESSION["shoppingCart"])) {
                    $shoppingCart = $_SESSION["shoppingCart"];
            
                    $total_count = $shoppingCart["summary"]["total_count"];
                    $totol_price = $shoppingCart["summary"]["total_price"];
                    $shopping_products=$shoppingCart["products"];
                } else 
                {
                    $totol_price = 0.0;
                    $total_count = 0;
                }

       ?>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Anasayfa</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="goods.php">Dizüstü Bilgisayar</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="help.php">İletişim</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="basket.php"> 
                         Sepetim
                        <span class="badge cart-count"><?php echo $total_count; ?></span>
                        <span class="glyphicon glyphicon-shopping-cart">&#x1F6D2;</span>

                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="about.php">Hakkımda</a>
                </li>
                <?php


                if (isset($_SESSION['user']) && $_SESSION['user'] == 'admin') {
                    echo ' <li class="nav-item">
                 <a class="nav-link active" href="logout.php">Çıkış Yap</a>
                 </li>';
                } else {
                    echo ' <li class="nav-item active">
                    <a class="nav-link" href="login.php">Giriş  Yap</a>
                    </li>';
                }

                if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') {
                    echo ' <li class="nav-item active">
                 <a class="nav-link" href="pages/admin_panel.php">Ayarlar</a>
                 </li>';
                } else 
                {
                }
                
              

                ?>
            </ul>
           

        </div>
    </div>
</nav>
<br><br>


<script>
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Form submitini engelle
        var arama_terimi = document.getElementById('searchInput').value.toLowerCase(); // Arama terimini al ve küçük harfe çevir

        if (arama_terimi.trim() !== '') { // Boş bir arama terimi değilse
            // AJAX ile PHP dosyasına post isteği gönder
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'arama.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('searchResults').innerHTML = xhr.responseText; // Cevabı al ve ekrana yazdır
                }
            };
            xhr.send('arama_terimi=' + encodeURIComponent(arama_terimi)); // Arama terimini kodla ve isteği gönder
        } else {
            // Boş arama terimi uyarısı göster
            document.getElementById('searchResults').innerHTML = '<div class="alert alert-warning" role="alert">Lütfen bir arama terimi girin.</div>';
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>