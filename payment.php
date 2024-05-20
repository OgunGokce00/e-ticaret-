<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme Sayfası</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style/style.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            /* Genel font ailesi tanımı */
        }

        .container {
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Table styling */
        .table-container {
            margin-top: 20px;
        }

        .table-container table {
            width: 100%;
        }

        .table-container th,
        .table-container td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        .table-container th {
            background-color: #007bff;
            color: #fff;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }

        .alert-info a {
            color: #0c5460;
            font-weight: bold;
            text-decoration: underline;
        }

        .alert-info a:hover {
            color: #073b4c;
        }

        /* Resmi yuvarlak yapma */
        .table-container img {
            border-radius: 50%;
        }

        /* Sepet butonu stilleri */
        .FromCartBtnrmv,
        .sepet {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .FromCartBtnrmv:hover,
        .sepet:hover {
            background-color: #c82333;
        }

        .alert-warning {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<?php
session_start();
?>

<body>
    <div class="container-fluid">
        <h2 class="text-center mt-5">Ödeme Formu</h2>
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label for="address">Adres</label>
                        <textarea class="form-control" id="address" rows="3" placeholder="Adres" required></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="cardNumber">Kart Numarası</label>
                        <input type="text" class="form-control" id="cardNumber" placeholder="Kart Numarası" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="expirationDate">Son Kullanma Tarihi</label>
                            <input type="text" class="form-control" id="expirationDate" placeholder="MM/YY" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cvv">CVV</label>
                            <input type="text" class="form-control" id="cvv" placeholder="CVV" required>
                        </div>
                    </div>
                    <button id="paymentButton" type="submit" class="btn btn-primary">Ödemeyi Tamamla</button>
                     <br><br>
                    <div id="inactiveAlert" class="alert alert-warning" role="alert" style="display: none;">
                        Bu sayfa şu anda aktif değil.
                    </div>

                    <script>
                        document.getElementById("paymentButton").addEventListener("click", function() {
                            document.getElementById("inactiveAlert").style.display = "block";
                        });
                    </script>
                </form>
            </div>
            <div class="col-md-6">
                <div class="table-container">
                    <div class="container mt-5">

                        <div class="container">
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


                        </div>

                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>