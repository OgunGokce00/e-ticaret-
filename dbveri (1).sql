-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 May 2024, 13:21:02
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dbveri`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `addcontent`
--

CREATE TABLE `addcontent` (
  `id` int(11) NOT NULL,
  `ad` varchar(300) NOT NULL,
  `aciklama` varchar(500) NOT NULL,
  `fiyat` decimal(5,2) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_turkish_ci;

--
-- Tablo döküm verisi `addcontent`
--

INSERT INTO `addcontent` (`id`, `ad`, `aciklama`, `fiyat`, `img`) VALUES
(5, 'LENOVO V15 G4 Intel Core', 'Ürün Özellikleri\r\nİşlemci Tipi\r\nIntel Core i5\r\nRam (Sistem Belleği)\r\n16 GB\r\nSSD Kapasitesi\r\n512 GB\r\nİşletim Sistemi\r\nFree Dos\r\nEkran Kartı\r\nIntel Iris Graphics\r\nEkran Boyutu\r\n15,6 inç\r\nÇözünürlük\r\n1920 x 1080\r\nKullanım Amacı\r\nOfis - İş\r\nCihaz Ağırlığı\r\n2 kg ve Altı\r\nŞarjlı Kullanım Süresi\r\n4-6 Saat\r\nEkran Yenileme Hızı\r\n60 Hz\r\nEkran Kartı Tipi\r\nDahili\r\nEkran Kartı Hafızası\r\nPaylaşımlı\r\nİşlemci Modeli\r\n12500H\r\nİşlemci Nesli\r\n12. Nesil\r\nİşlemci Çekirdek Sayısı\r\n12+\r\nHard Disk Kapasitesi\r\nHDD Yok\r\n', 15.85, '../img/home/png.png'),
(6, 'MONSTER Tulpar T7 V20.6.2 Intel Core i7 13700H 32 GB RAM 1 TB SSD 8 GB RTX 4060 FreeDos 17,3&quot; FHD 144 Hz', 'Ürün Özellikleri\r\nİşlemci Tipi\r\nIntel Core i7\r\nRam (Sistem Belleği)\r\n32 GB\r\nSSD Kapasitesi\r\n1 TB\r\nİşletim Sistemi\r\nFree Dos\r\nÇözünürlük\r\n1920 x 1080\r\nEkran Yenileme Hızı\r\n144 Hz\r\nEkran Kartı\r\nNvidia GeForce RTX 4060\r\nEkran Boyutu\r\n17,3 inç\r\nKullanım Amacı\r\nOyun\r\nCihaz Ağırlığı\r\n2 - 4 kg\r\nŞarjlı Kullanım Süresi\r\n3 Saat ve Altı\r\nEkran Kartı Tipi\r\nHarici\r\nEkran Kartı Hafızası\r\n8 GB\r\nİşlemci Modeli\r\n13700H\r\nİşlemci Çekirdek Sayısı\r\n14\r\nİşlemci Nesli\r\n13. Nesil\r\nHard Disk Kapasitesi\r\nHDD Yok\r\nDokunma', 44.30, '../img/home/12png.png'),
(7, 'HP Victus 15-FA1035NT 7N9V4EA i5-13500H 16GB 512GB RTX4050 6GB 15.6 144Hz FHD Freedos Gaming Laptop', 'HP Victus 15-FA1035NT 7N9V4EA Intel Core i5-13500H 16GB 512GB SSD RTX4050 6GB 15.6 inç 144Hz Full HD Freedos Gaming Laptop En iyi oyunları oynayın ve en iyi oyuncuların gerisinde kalmayın. İntel işlemci seçenekleri ve grafik kartları. Üstün işlem bileşenleri İntel ile Güç Sende! İşlemci, modern bir grafik kartı ve yüksek bellek kapasitesi ile en iyi oyun performansını ortaya koy. HP Hızlı Şarj Dizüstü bilgisayarın pili azaldığında, kimse yeniden şarj etmek için saatlerce beklemek istemez. cihazı', 32.51, '../img/home/16.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `help`
--

CREATE TABLE `help` (
  `id` int(11) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mesaj` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_turkish_ci;

--
-- Tablo döküm verisi `help`
--

INSERT INTO `help` (`id`, `ad`, `email`, `mesaj`) VALUES
(25, 'ali', 'aligokce41@gmail.com', 'cdcdcdvggtrgr'),
(26, 'muhammet', 'muhammet@gmail.com', 'sacsacascas');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_ad` varchar(255) DEFAULT NULL,
  `p_acikla` varchar(10000) DEFAULT NULL,
  `p_fiyat` decimal(10,2) DEFAULT NULL,
  `p_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_turkish_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`p_id`, `p_ad`, `p_acikla`, `p_fiyat`, `p_img`) VALUES
(1, 'Lenova', '  Sertifikalı Intel® Evo™, en fazla 13. Nesil Intel® Core™ vPro® CPU ile.Yalnızca 1,12 kg / 2,48 lb\'lik ultra hafif başlangıç ağırlığıÖnceki nesle göre iki kat daha fazla bellekle süper duyarlıÇift fan ve arka havalandırma ile optimize edilmiş.', 10.00, '../img/a1.png'),
(2, 'Monster', 'Monster Tulpar T7 V26.1.4 Intel Core I7 13700H 16 GB Ram 1 Tb SSD 8 GB Rtx 4060 Freedos 17,3', 15.00, '../img/product_1.jpeg'),
(3, 'Huawei Matebook', 'Huawei Matebook D14 2024 Intel Core i5 12450H 8GB 512GB SSD Windows 11 Home 14\" IPS Taşınabilir Bilgisayar', 5.00, 'a1.png'),
(4, ' Lenovo', 'IdeaPad Gaming 3 15IAH7 82S9016MTX Intel Core i5-12450H 16GB 1TB SSD RTX3050Ti 4GB 15.6 inç Full HD 120Hz FreeDos Gaming Laptop + (Logitech M190 Büyük Boy Kablosuz Mouse)', 25.00, 'a2.png'),
(13, 'Acer Nitro 5 ', '12.Nesil Core i5 12500H-RTX4050 6Gb-8Gb-512Gb Ssd-15.6inc-W11', 30.00, '../img/ace.png'),
(14, 'MacBook Air ', 'MRYR3TU/A M3 8Gb-256Gb Ssd-Liquid Retina-15.3inc-Starlight', 45.50, '../img/appel.png'),
(15, 'MacBook Pro MK183TU/A M1 Pro 16Gb-512Gb Ssd-Liquid Retina-16inc-Space Grey', 'MK183TU/A M1 Pro 16Gb-512Gb Ssd-Liquid Retina-16inc-Space Grey\r\n\r\n8 adet performans çekirdeğine ve 2 adet verimlilik çekirdeğine sahip 10 çekirdekli CPU, 16 çekirdekli GPU’ya sahip', 50.00, '../img/apple2.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_ad` varchar(50) NOT NULL,
  `u_soyad` varchar(50) NOT NULL,
  `u_guven` varchar(50) NOT NULL,
  `u_email` varchar(100) DEFAULT NULL,
  `u_cinsiyet` varchar(50) NOT NULL,
  `u_sehir` varchar(50) DEFAULT NULL,
  `u_adres` varchar(250) DEFAULT NULL,
  `u_sifre` varchar(100) NOT NULL,
  `user_type` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`u_id`, `u_ad`, `u_soyad`, `u_guven`, `u_email`, `u_cinsiyet`, `u_sehir`, `u_adres`, `u_sifre`, `user_type`) VALUES
(7, 'Ogun', 'Gökce', 'Taci', 'ogungokce59@mail.com', 'erkek', 'kirsehir', 'Kuşdili Mahalle / Merkez / Kırşehir 1362.  Sokak No:60/3', '123456', 'admin'),
(28, 'deneme', 'deneme', 'deneme', 'deneme1234@gmail.com', 'erkek', 'kirsehir', 'deneme1234@gmail.com', 'deneme123', 'user');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `addcontent`
--
ALTER TABLE `addcontent`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_email` (`u_email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `addcontent`
--
ALTER TABLE `addcontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `help`
--
ALTER TABLE `help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
