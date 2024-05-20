<!DOCTYPE html>
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
            width: auto;
            height: auto;
        }

        #messageDetail {
            max-height: 400px;
            overflow-y: auto;
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
    $sonuclar = $baglanti->query("SELECT * FROM help")->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sec'])) {
        $id = $_POST['sec'];

        // Seçilen ürünü silme işlemi
        $silme_sorgu = $baglanti->prepare("DELETE FROM help WHERE id = :id");
        $silme_sorgu->bindParam(':id', $id);
        $silme_sorgu->execute();

        // Silme işleminin başarılı olup olmadığını kontrol etme
        $silinen_satirlar = $silme_sorgu->rowCount();
        if ($silinen_satirlar > 0) {
            echo '<div class="alert alert-danger mt-4" role="alert" style="background-color: green;">
            Başarı ile silindi!
        </div>';
        echo '<meta http-equiv="refresh" content="2;URL=\'userhelp.php\'">';
  
        } else {
           
        }
    }
    ?>

    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel" style="text-align: center;">Mesaj Detayları</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="messageDetail">
                    <!-- Mesaj detayları buraya gelecek -->
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-0">
        <div class="row" style="background-color: aliceblue;">
            <div class="col">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Kullanıcı</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mesaj</th>
                                <th scope="col">Sil</th>
                                <th scope="col">Detaylar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sonuclar as $sonuc) : ?>
                                <tr>
                                    <td><?php echo $sonuc['ad'] ?></td>
                                    <td><?php echo $sonuc['email'] ?></td>
                                    <td><?php echo substr($sonuc['mesaj'], 0, 20) . '...' ?></td>
                                    <td>
                                        <form method="post">
                                            <button type="submit" name="sec"  style="background-color: red;"   class="btn btn-primary btn-sm" value="<?php echo $sonuc['id']; ?>" class="FromCartBtnrmv">Sil</button>
                                        </form>
                                    </td>
                                    <td><button class="btn btn-primary btn-sm viewMessage" data-message="<?php echo $sonuc['mesaj'] ?>">Detayları Gör</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.viewMessage').click(function() {
                var message = $(this).data('message');
                $('#messageDetail').text(message);
                $('#messageModal').modal('show');
            });
        });
    </script>
</body>

</html>
