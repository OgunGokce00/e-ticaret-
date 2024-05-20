<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>

    </style>

</head>

<!-- Menüyü oluşturalım -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item">
                <a class="nav-link" href="../home.php"> Markete Gözat </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kullanıcı Ayarları
                </a>
                <div class="dropdown-menu" aria-labelledby="productsDropdown">
                    <a class="dropdown-item" href="usershow.php">Görüntüle</a>
                    <a class="dropdown-item" href="useradd.php">Ekle</a>
                    <a class="dropdown-item" href="userup.php">Güncelle</a>
                    <a class="dropdown-item" href="userdel.php">Sil</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ürünler
                </a>
                <div class="dropdown-menu" aria-labelledby="productsDropdown">
                    <a class="dropdown-item" href="productshow.php">Görüntüle</a>
                    <a class="dropdown-item" href="productsadd.php">Ekle</a>
                    <a class="dropdown-item" href="productsup.php">Güncelle</a>
                    <a class="dropdown-item" href="productsdel.php">Sil</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="homepageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Anasayfa Ayarla
                </a>
                <div class="dropdown-menu" aria-labelledby="homepageDropdown">
                <a class="dropdown-item" href="pageshomshow.php">İçerikleri Gör</a>
                    <a class="dropdown-item" href="pageshomadd.php">İçerik Ekle</a>
                    <a class="dropdown-item" href="pageshomup.php">İçerik Güncelle</a>
                    <a class="dropdown-item" href="pageshomdel.php">İçerik Sil</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="userhelp.php">Geri Dönüşler </a>
            </li>
           
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="pageslogout.php">Çıkış yap </a>
            </li>
        </ul>
    </div>



</nav>
<br><br>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>