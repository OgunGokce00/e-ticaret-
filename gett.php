<?php
// Veritabanına bağlanma işlemi

if (isset($_GET['p_id'])) {
    $productId = $_GET['p_id'];

    // Veritabanından ürün açıklamasını al
    $query = "SELECT description FROM products WHERE p_id = $productId";
    // Sorguyu çalıştır ve sonucu al
    // $db değişkeni veritabanı bağlantınızı temsil eder
    $result = mysqli_query($db, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo $row['p_acikla'];
    } else {
        echo "Ürün açıklaması bulunamadı.";
    }
} else {
    echo "Ürün kimliği belirtilmedi.";
}
?>
