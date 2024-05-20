<?php
try {
    $baglanti = new PDO('mysql:host=localhost;dbname=dbveri', 'root', '');
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
session_start();
function addToCart($product_item)
{
    //session 
    if (isset($_SESSION["shoppingCart"])) {
        $shoppingCart = $_SESSION["shoppingCart"];
        $products = $shoppingCart["products"];
    } else {

        $products = array();
        //sessionda tutacağım verileri içeren değişken 

    }

    //adet kontrol 
    if (array_key_exists($product_item->p_id, $products)) {
        $products[$product_item->p_id]->count++;
    } else {
        $products[$product_item->p_id] = $product_item;
    }
    //sepetin hesaplanması 
    // fiyat hesaplama ve  adet hesaplama  işlemleri 

    $totol_price = 0.0;
    $total_count = 0;
    foreach ($products as $product) {
        $product->total_price = $product->count * $product->p_fiyat;
        $totol_price += $product->total_price;
        $total_count += $product->count;
    }


    $summary["total_price"] = $totol_price;
    $summary["total_count"] = $total_count;


    $_SESSION["shoppingCart"]["products"] = $products;
    $_SESSION["shoppingCart"]["summary"] = $summary;



    return $total_count;
}
function removeFromCart($product_id)
{
    if (isset($_SESSION["shoppingCart"])) {

        $shoppingCart = $_SESSION["shoppingCart"];
        $products = $shoppingCart['products'];

        // Ürünü listeden çıkar
        if (array_key_exists($product_id, $products)) {
            unset($products[$product_id]);
        }

        // Tekrardan sepeti hesapla
        $total_price = 0.0;
        $total_count = 0;

        foreach ($products as $product_id => $product) {
            // Her bir ürünün toplam fiyatını hesapla
            $product->total_price = $product->count * $product->p_fiyat;
            // Toplam tutarı güncelle
            $total_price += $product->total_price;
            $total_count += $product->count;
        }

        // Toplam fiyatı ve adeti güncelle
        $summary["total_price"] = $total_price;
        $summary["total_count"] = $total_count;

        // Yeni sepet bilgilerini session'a kaydet
        $_SESSION["shoppingCart"]["products"] = $products;
        $_SESSION["shoppingCart"]["summary"] = $summary;

        return true;
    }
}

function incCount($product_id)
{
    if (isset($_SESSION["shoppingCart"])) {
        $shoppingCart = $_SESSION["shoppingCart"];
        $products = $shoppingCart["products"];
    } 

    //adet kontrol 
    if (array_key_exists($product_id, $products)) {
        $products[$product_id]->count++;
    }
   
    $totol_price = 0.0;
    $total_count = 0;
    foreach ($products as $product) {
        $product->total_price = $product->count * $product->p_fiyat;
        $totol_price += $product->total_price;
        $total_count += $product->count;
    }


    $summary["total_price"] = $totol_price;
    $summary["total_count"] = $total_count;


    $_SESSION["shoppingCart"]["products"] = $products;
    $_SESSION["shoppingCart"]["summary"] = $summary;



    return true;
}
function decCount($product_id)
{  
    if (isset($_SESSION["shoppingCart"])) {
        $shoppingCart = $_SESSION["shoppingCart"];
        $products = $shoppingCart["products"];
    } 

    //adet kontrol 
    if (array_key_exists($product_id, $products)) {
        if($products[$product_id]->count > 1){
            $products[$product_id]->count--;
            }else {
                unset($products[$product_id]);
            }
    }
   
    $totol_price = 0.0;
    $total_count = 0;
    foreach ($products as $product) {
        $product->total_price = $product->count * $product->p_fiyat;
        $totol_price += $product->total_price;
        $total_count += $product->count;
    }


    $summary["total_price"] = $totol_price;
    $summary["total_count"] = $total_count;


    $_SESSION["shoppingCart"]["products"] = $products;
    $_SESSION["shoppingCart"]["summary"] = $summary;



    return true;
}
if (isset($_POST["p"])) {
    $islem = $_POST["p"];
    if ($islem == "addToCart") {
        $id = $_POST["product_id"];
        $product = $baglanti->query("SELECT * FROM products WHERE p_id = {$id}", PDO::FETCH_OBJ)->fetch();
        $product->count = 1;

        echo  addToCart($product);
    } elseif ($islem == "removeFromCart") {
        $id = $_POST["product_id"]; //js kullanılan değişkenden değer alındı
        removeFromCart($id);
    }
}
if (isset($_GET["p"])) {
    $islem = $_GET['p'];

    if ($islem == "incCount") {
        $id = $_GET["product_id"];

        if (incCount($id)) {
           
            header("location: basket.php");
        }
    } else if ($islem == "decCount") {

        $id = $_GET["product_id"];

        if (decCount($id)) {
            header("location:basket.php");
        }
    }
}
