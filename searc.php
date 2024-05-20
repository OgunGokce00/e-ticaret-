<div class="container mt-4">
    <form id="searchForm" method="post">
        <div class="input-group">
            <input type="search" class="form-control" placeholder="Arama yapın" aria-label="Search" name="arama_terimi">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <div id="searchResults" class="mt-4"></div>
</div>

<?php
try {
    $baglanti = new PDO('mysql:host=localhost;dbname=dbveri', 'root', '');
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
    exit();
}

if (isset($_POST['arama_terimi']) && !empty(trim($_POST['arama_terimi']))) {
    $arama_terimi = $_POST['arama_terimi'];
    $sql = "SELECT * FROM products WHERE p_ad LIKE :arama_terimi";

    $stmt = $baglanti->prepare($sql);
    $stmt->bindValue(':arama_terimi', '%' . $arama_terimi . '%', PDO::PARAM_STR);
    $stmt->execute();

    // Eğer sonuç varsa mesaj kutusunu oluştur
    if ($stmt->rowCount() > 0) {
        echo '<div class="container mt-1">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-6">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<h5 class="card-title">Ürün Adı: ' . $row['p_ad'] . '</h5>';
            // Diğer ürün bilgilerini mesaj kutusu içeriğine ekleyebilirsiniz
            // Ürün linkine gitmek için bir bağlantı ekle
            echo '<a href="review.php?id=' . $row['p_id'] . '">Ürüne Git</a>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="container mt-4">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-6">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        // Eğer sonuç yoksa kullanıcıya bir mesaj göster
        echo "Üzgünüz, aradığınız ürün  stokta yok.";
        echo '<meta http-equiv="refresh" content="5;">';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else 
{ 
}

// Bağlantıyı kapat
$baglanti = null;
?>
