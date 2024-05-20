 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="style/style.css">
     <style>

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
        $sonuclar = $baglanti->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
        ?>
      <div class="container">
    <div class="container-fluid mt-0">
        <div class="row" style="background-color: aliceblue;">
            <div class="col">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Kullanıcı adı</th>
                                <th scope="col">Kullanıcı soyadı</th>
                                <th scope="col">Kullanıcı email</th>
                                <th scope="col">Kullanıcı Adres</th>
                                <th scope="col">Kullanıcı cinsiyet</th>
                                <th scope="col">Kullanıcı Türü</th>
                                <th scope="col">Kullanıcı Şehir</th>
                                <th scope="col">Kullanıcı Şifre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sonuclar as $sonuc) : ?>
                                <tr>
                                    <td><?php echo $sonuc['u_ad'] ?></td>
                                    <td><?php echo $sonuc['u_soyad'] ?></td>
                                    <td><?php echo $sonuc['u_email'] ?></td>
                                    <td><?php echo $sonuc['u_adres'] ?></td>
                                    <td><?php echo $sonuc['u_cinsiyet'] ?></td>
                                    <td><?php echo $sonuc['user_type'] ?></td>
                                    <td><?php echo $sonuc['u_sehir'] ?></td>
                                    <td><?php echo $sonuc['u_sifre'] ?></td>
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