-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220616.7a6bd9eb57
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2022 pada 02.59
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_pemweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `idCart` int(11) NOT NULL,
  `idProduk` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `namaProduk` varchar(200) NOT NULL,
  `hargaProduk` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`idCart`, `idProduk`, `username`, `namaProduk`, `hargaProduk`, `createdAt`) VALUES
(2, 3, 'tyoaditya', 'Jjamppong a Korean Seafood Noodle Soup', 40000, '2022-07-04 18:03:36'),
(3, 4, 'nela', 'Zarzuela de Mariscos', 60000, '2022-07-04 18:10:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `idPesanan` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `status` enum('Menunggu Konfirmasi','Pesanan di Proses','Pesanan di antar','Selesai') NOT NULL,
  `namaProduk` varchar(200) NOT NULL,
  `hargaProduk` int(11) NOT NULL,
  `jumlahProduk` int(11) NOT NULL,
  `alamatCustomer` varchar(300) NOT NULL,
  `teleponCustomer` int(11) NOT NULL,
  `tglPemesanan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`idPesanan`, `username`, `status`, `namaProduk`, `hargaProduk`, `jumlahProduk`, `alamatCustomer`, `teleponCustomer`, `tglPemesanan`) VALUES
(1, 'reyhan', 'Pesanan di antar', 'Sous Vide Octopus', 75000, 2, 'Jalan Sindoro Raya', 2147483647, '2022-07-04 18:03:12'),
(2, 'tyoaditya', 'Selesai', 'Jjamppong a Korean Seafood Noodle Soup', 40000, 3, 'Jalan Agung', 2147483647, '2022-07-04 18:04:05'),
(3, 'nela', 'Pesanan di antar', 'Zarzuela de Mariscos', 60000, 10, 'Jalan Abdi Jaya', 2147483647, '2022-07-04 18:11:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `idProduk` int(11) NOT NULL,
  `namaProduk` varchar(200) NOT NULL,
  `hargaProduk` int(11) NOT NULL,
  `statusProduk` enum('Tersedia','Habis') NOT NULL,
  `kategoriProduk` enum('Makanan','Minuman') NOT NULL,
  `gambarProduk` varchar(150) NOT NULL,
  `deskripsiProduk` varchar(300) NOT NULL,
  `tglUpload` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`idProduk`, `namaProduk`, `hargaProduk`, `statusProduk`, `kategoriProduk`, `gambarProduk`, `deskripsiProduk`, `tglUpload`) VALUES
(1, 'Kung Pao Shrimp', 40000, 'Habis', 'Makanan', '62c2bb6db45c9.jpg', 'Kung Pao shrimp is a sweet and spicy combination of fresh, crisp, sautéed veggies with shrimp. The sauce for this recipe combines a bit of broth with bold flavors from soy sauce, hoisin and sesame oil. A sprinkle of chili flakes add some heat (add a little or a lot). One of the most popular entrees ', '2022-07-04 05:05:33'),
(2, 'Nova Scotia Seafood Chowder', 50000, 'Tersedia', 'Makanan', '62c2bb94af6d4.png', 'Seafood chowder plays a big part in my Maritime heritage. Rich, creamy, and hearty, my parents have argued this is not a traditional recipe for Nova Scotia seafood chowder (because I use 35% heavy cream instead of canned milk). Either way it’s delicious and everyone who makes it or tries it loves it', '2022-07-04 05:06:12'),
(3, 'Jjamppong a Korean Seafood Noodle Soup', 40000, 'Tersedia', 'Makanan', '62c2bc13deecc.jpg', 'Jjamppong (or Jjampong, 짬뽕) is one of the most popular dishes you can order from a Korean-Chinese restaurant. Jjamppong consists of fresh noodles, various vegetables and various seafoods and it is served in a red hot soup base. Generally the soup can be quite spicy but it can be toned down if you’re', '2022-07-04 05:08:19'),
(4, 'Zarzuela de Mariscos', 60000, 'Tersedia', 'Makanan', '62c2bc3812b88.png', 'Zarzuela de Mariscos hails from the Catalonia region in Spain. The Catalan seafood stew is aptly named after Zarzuela, a genre of Spanish musical theatre that blends many contrasting styles of music and dance. Mariscos simply means shellfish in Spanish. Therefore, the stew is a blend of shellfish an', '2022-07-04 05:08:56'),
(5, 'Shrimp Lettuce Wraps ', 45000, 'Tersedia', 'Makanan', '62c2bc76941b1.jpg', 'It’s what we call these juicy, plump, sauce-slicked shrimp! They’re coated in an insanely yummy sweet-savory-spicy sauce that hits all the spots, and because it has cornstarch, honey and brown sugar in it, it really does stick to the shrimp—it coats them in the best way. ', '2022-07-04 05:09:58'),
(6, 'Cajun Seafood Boil', 80000, 'Tersedia', 'Makanan', '62c2bc9aaf756.jpg', 'The secret to a seafood boil packed with perfectly cooked shrimp, king crab legs, and clams? Taking it one step at a time. First, simmer a flavor-packed mixture of lemons, Cajun seasoning, onions, garlic, and chiles with small new potatoes to give them a head start. Then add your clams and gently sp', '2022-07-04 05:10:34'),
(7, 'Sous Vide Octopus', 75000, 'Tersedia', 'Makanan', '62c2bcd129729.jpg', 'Sous vide, which means “under vacuum” in French, refers to the process of vacuum-sealing food in a bag, then cooking it to a very precise temperature in a water bath. This technique is amazing because it makes it virtually impossible to overcook your food. Making it perfect for cooking delicate cuts', '2022-07-04 05:11:29'),
(9, 'Mango Lemonade', 20000, 'Tersedia', 'Minuman', '62c389812b0a7.jpg', 'This easy and simple refreshing mango lemonade or limeade is made with ripe mangoes, lemon or lime juice, sugar/honey, water, and ice. You can use either lemons or limes depending on your preference, or a mix of both. Also, to stretch this mango lemonade into a large amount, you can add additional w', '2022-07-04 19:44:49'),
(10, 'Iced Pineapple Sweet Tea', 20000, 'Tersedia', 'Minuman', '62c389ab9771c.jpg', 'A refreshing drink, my Pineapple Iced Tea is easy to prepare, and an ideal drink for a warm day or when you’re after a tasty non-alcoholic beverage. This Pineapple Iced Tea is incredibly quick and easy to make. Throughout the summer I like to keep a pitcher of this crisp and cool drink in my refrige', '2022-07-04 19:45:31'),
(11, 'Strawberry Hibiscus Iced Tea ', 15000, 'Tersedia', 'Minuman', '62c389d14a415.jpg', 'Stay cool and refreshed all summer long with this Strawberry Hibiscus Iced Tea! This refreshing berry tea is mixed with strawberry purée to add lots of extra fresh berry flavor. Serve with lots of ice and a sprig of mint for garnish and settle in for a sweet summer treat. Hibiscus tea is quite simpl', '2022-07-04 19:46:09'),
(12, 'Lemon mojito', 10000, 'Tersedia', 'Minuman', '62c389eb83cc7.jpg', 'The combination of lemon, mint, and sparkling water is so delicious. It is literally the perfect drink year-round. I can definitely see myself sitting on my deck on a warm Spring or Summer evening enjoying this cocktail. You could easily substitute vodka and add berries for a simple twist.  You coul', '2022-07-04 19:46:35'),
(13, 'Strawberry Mango Sangria', 25000, 'Tersedia', 'Minuman', '62c38a0d49a92.jpg', 'As summer approaches and the weather warms up, nothing is more refreshing than a cold glass of sangria! Check out this delicious cocktail recipe for Strawberry Mango Sangria! It’s the perfect patio drink for warm summer nights and this particular recipe is a healthier spin on one of everybody’s favo', '2022-07-04 19:47:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `namaLengkap` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`idUser`, `namaLengkap`, `username`, `password`, `role`) VALUES
(1, 'Reyhan Naufal Hakim', 'admin', '$2y$10$ggHB8YQV/2YwSf4FXD09SOaRHFaxv1lAmnnRMYuii52SaNG1gjCYi', 'Admin'),
(3, 'tyo aditya', 'tyoaditya', '$2y$10$9OAFNyZwOss9WfEqxkjOwO05.pwFKtTqoyafsflYT95WTvg7uu0f2', 'Customer'),
(5, 'reyhan naufal', 'reyhan', '$2y$10$uLT0BM84e1VDX7tVafsCX.nmOb/mP7Jri/PGnqio2PzJq/0eqjqN2', 'Customer'),
(6, 'nailul munjidah', 'nela', '$2y$10$kw52y9vBPzfnkZ4IBpcGgOqUp7YeC8yuE2pbmOSWO5N9pOsRWz1pK', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idCart`),
  ADD KEY `idProduk` (`idProduk`),
  ADD KEY `idUser` (`username`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`idPesanan`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idProduk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `idCart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `idPesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `idProduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`idProduk`) REFERENCES `produk` (`idProduk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



