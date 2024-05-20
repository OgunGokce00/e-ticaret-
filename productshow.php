<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
    <style>
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
.product-img {
            max-width: 100%;
            max-height: 150px;
            /* veya istediğiniz bir değer */
            width: auto;
            height: auto;
        }
    </style>
</head>

<body>
    <?php
       include("pagesmanu.php");
       try {
           $baglanti = new PDO('mysql:host=localhost;dbname=dbveri', 'root', '');
           $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch (PDOException $e) {
           echo "Bağlantı hatası: " . $e->getMessage();
       }

       // Ürünleri sorgula ve sonuçları al
       $user = array();
       $sonuclar = $baglanti->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
       ?>
     <div class="container">
   <div class="container-fluid mt-0">
       <div class="row" style="background-color: aliceblue;">
           <div class="col">
               <div class="table-responsive">
                   <table class="table text-center">
                       <thead>
                           <tr>
                               <th scope="col">Ürün adı</th>
                               <th scope="col">Ürün açıklaması</th>
                               <th scope="col">ürün fiyat</th>
                               <th scope="col">ürün resim</th>
                              
                           </tr>
                       </thead>
                       <tbody>
                        <img src="" alt="">
                           <?php foreach ($sonuclar as $sonuc) : ?>
                               <tr>
                               <td><img width="50px" src="../img/<?php echo $sonuc['p_img']  ?>" alt="<?php echo $sonuc['p_ad'] ?>"></td>
                                   <td><?php echo $sonuc['p_ad'] ?></td>
                                   <td><?php echo $sonuc['p_acikla'] ?></td>
                                   <td><?php echo $sonuc['p_fiyat'] ?></td>
                                   
                               </tr>
                           <?php endforeach; ?>
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </div>
</div>

</body>

</html>