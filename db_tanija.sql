-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 08:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tanija`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `password_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email_admin`, `password_admin`) VALUES
(7, 'Tanija', 'tanija1@gmail.com', '$2y$10$cpsRepmRdtwhZqiNZPLN.ee5pnGvPuexfHRo8HyPmEUgUrgI8xYC.'),
(8, 'Admin', 'admin@gmail.com', '$2y$10$fziCRhQX7BwB3gVAGuyLLu0s5deQ16jHG.GBaGwv/1t5s97jXN81y');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `sumber` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `judul`, `tanggal`, `gambar`, `sumber`, `penulis`, `isi`) VALUES
(1, 'Pupuk Indonesia: Pembelian pupuk bersubsidi dengan KTP elektronik', '2024-06-13', 'antarafoto-stok-pupuk-subsidi-190822-da-3_ratio-16x9.jpg', 'Antara', 'Machrus', 'Makassar (ANTARA) - PT Pupuk Indonesia menyosialisasikan kebijakan alokasi pupuk bersubsidi di mana pembeliannya hanya dapat dilakukan dengan menggunakan KTP elektronik.\"Ini sesuai dengan Peraturan Menteri Pertanian (Permentan) Nomor 01 tahun 2024 dan Keputusan Menteri Pertanian (Kepmentan) Nomor 249 tahun 2024,\" ujar SVP Strategi Penjualan dan Pelayanan Pelanggan Pupuk Indonesia Deni Dwiguna Sulaeman saat sosialisasi yang dihadiri petani, pemilik kios, dan distributor di Makassar, Sulawesi Selatan, Rabu.Ia berharap sosialisasi tersebut benar-benar sampai ke petani penerima pupuk, di mana tahun ini ada penambahan alokasi yang hanya dapat ditebus dengan KTP elektronik di tingkat pengecer resmi.Ia menjelaskan, melalui inovasi dengan menghadirkan aplikasi digital yang dinamai Ipubers (Integrasi Pupuk Bersubsidi) yang berbasis KTP elektronik, diharapkan mempermudah distribusi pupuk bersubsidi Pada tahun 2023 aplikasi ini sudah dilaksanakan di enam provinsi dan tahun ini diterapkan secara nasionalPihaknya juga memastikan stok cukup untuk mendukung kebijakan pemerintah berkaitan penetapan alokasi. Posisi stok secara nasional sebanyak 2,1 juta ton dan ini merupakan stok tertinggi sepanjang sejarah Pupuk Indonesia.Deni menyebutkan ada penambahan alokasi pupuk bersubsidi dari 4,7 juta ton menjadi 9,55 juta ton. Data per 14 Mei 2024, realisasi penyerapan pupuk bersubsidi secara nasional sebesar 20,8 persen atau sebanyak 1,98 juta ton dari total alokasi 9,55 juta ton.\"Jadi, sosialisasi ini juga harapannya bisa mengoptimalkan serapan yang masih tersisa sampai akhir 2024. Mudah-mudahan bisa terserap optimal,\" katanya.Untuk stok pupuk di Sulsel tercatat 185.689 ton, terdiri atas 181.290 ton pupuk subsidi yakni Urea 135 ton dan NPK 46 ribu ton. Pupuk nonsubsidi 4.400 ton di seluruh Sulsel. Direktur Pupuk dan Pestisida Kementerian Pertanian Tommy Nugraha dalam sosialisasi itu melalui virtual mengemukakan, Permentan Nomor 249/KPTS/SR.320M/04/ tahun 2024 tentang Tata Cara Penetapan Alokasi dan HET Pupuk Bersubsidi Sektor Pertanian merupakan revisi Permentan Nomor 10 tahun 2022.Ia menjelaskan Permentan terbaru ini guna memastikan penyaluran pupuk bersubsidi akurat dan tepat sasaran. Selain itu terdapat penambahan jenis pupuk bersubsidi yakni pupuk organik, sebelumnya ada tiga masing-masing Urea, NPK dan NPK Formula Khusus.\"Mekanisme penyaluran pupuk bersubsidi dari kios pengecer ke petani dilakukan berdasarkan data Rencana Definitif Kebutuhan Kelompok Elektronik (e-RDKK) sesuai batas alokasi per kecamatan yang ditetapkan melalui surat keputusan (SK) bupati, wali kota,\" paparnya.Petani yang berhak mendapatkan pupuk bersubsidi, kata dia, wajib tergabung dalam kelompok tani serta terdaftar dalam e-RDKK dan SIMLUHTAN. Pendataan petani penerima melalui e-RDKK kemudian dapat dievaluasi empat bulan sekali di tahun berjalan. Ini dilakukan sebagai pembaharuan saat sistem e-RDKK dibuka.'),
(5, 'Strategi Pupuk Indonesia Tingkatkan Produktivitas Pertanian Nasional 2024', '2024-06-13', '6559729a2d489.jpg', 'Kompas', 'Danu', 'JAKARTA, KOMPAS.com - Direktur Utama PT Pupuk Indonesia Rahmad Pribadi mengatakan, memasuki 2024, industri pupuk nasional maupun global menghadapi peluang dan tantangan yang signifikan. Pergeseran musim tanam yang disebabkan fenomena El Nino mempengaruhi tren permintaan dan stabilitas harga pasar. Meski demikian, Pupuk Indonesia telah memastikan pemenuhan kebutuhan pupuk nasional dengan kinerja produksi terbaik. \"Sejumlah inovasi dan inisiatif Pupuk Indonesia selama 2023 dan 2024 pun turut digalakkan dalam mendukung pemerintah untuk memastikan percepatan tanam, salah satunya adalah Program Gebyar Diskon Pupuk yang diadakan di 30 kota yang tersebar di Indonesia,\" kata Rahmad dalam keterangan tertulis, Minggu (14/1/2024). Baca juga: Bangun Ketahanan Pangan, Anies: Pupuk dan Benih Berkualitas Harus Mudah Didapat dan Murah Rahmad mengatakan, tujuan dari program Gebyar Diskon Pupuk tersebut adalah untuk memberikan kemudahan akses pupuk nonsubsidi dengan harga terjangkau, terutama bagi kelompok tani yang belum termasuk sebagai penerima pupuk subsidi. \"Alhamdulillah, Pupuk Indonesia telah berhasil menutup 2023 dengan pencapaian kinerja produksi yang positif. Tentunya hal ini dapat tercapai atas dukungan seluruh insan, baik di holding maupun anak-anak perusahaan,\" ujarnya. Rahmad mengatakan, sepanjang 2024, pihakmya akan terus menjalankan mandat dari pemerintah yakni membantu petani dengan penyediaan pupuk, menjaga ketahanan pangan, dan melakukan transformasi bisnis yang lebih rendah karbon dan berkelanjutan. Selain itu, perusahaan akan terus menggalakkan berbagai program yang dapat memacu produktivitas pertanian Tanah Air, salah satunya melalui program Gebyar Diskon Pupuk. \"Lewat program ini, kami berharap petani bisa mendapatkan kemudahan bukan hanya dari ketersediaan pupuk, tetapi juga dari sisi keterjangkauan dan pemerataan akses,\" tuturnya. Rahmad mengatakan, pemerintah mengalokasikan anggaran sebesar Rp 26 triliun pada 2024 untuk pupuk subsidi sebesar 4,7 juta ton guna memenuhi kebutuhan pupuk pada musim tanam pertama. Selanjutnya, pemerintah berencana menambah kuota subsidi pupuk senilai Rp 14 triliun, tambahan alokasi ini bisa dimanfaatkan petani pada musim tanam kedua tahun 2024. Ia mengatakan, dampak positif dari subsidi ini akan terfokus pada peningkatan produktivitas pertanian yang diperkirakan mencapai sebesar 8 persen untuk tanaman padi. \"Hingga Desember 2023, Pupuk Indonesia memiliki kinerja produksi yang cukup baik, yaitu mencapai 18,71 juta ton, terdiri dari 7,69 juta ton Urea, 3,06 juta ton NPK, 814 ribu ton pupuk lainnya, dan non pupuk sebesar 7,13 juta ton (amonia, asam sulfat, asam fosfat, dan lainnya),\" kata dia. Di samping itu, Rahmad mengatakan, pupuk Indonesia juga memberikan kontribusi yang sangat positif dalam pemenuhan pupuk subsidi, yaitu menyalurkan 100 persen dari jumlah yang telah ditetapkan. Hal ini, kata dia, mencerminkan dedikasi perusahaan untuk mendukung petani dan memastikan ketersediaan pupuk yang memadai bagi pertanian nasional. \"Proyek-proyek pengembangan kapasitas produksi, seperti Proyek Pusri IIIB, PSN Kawasan Industri Fakfak, dan pengembangan pabrik pupuk NPK di Anak Perusahaan adalah salah satu langkah strategis Pupuk Indonesia agar dapat memenuhi kebutuhan pupuk nasional,\" kata dia. Selain itu, Pupuk Indonesia juga mendukung hilirisasi industri pertanian dan petrokimia hijau berkelanjutan sebagai bagian dari kontribusi terhadap keberlanjutan dan kemandirian sumber daya alam. Upaya ini mencakup peningkatan produk dan solusi pertanian yang berorientasi pada konsumen, melanjutkan hilirisasi dan inisiatif substitusi impor melalui pembangunan pabrik baru untuk Amonium Nitrat, Soda Ash, dan Metanol. Persiapan pengembangan industri amonia hijau dan rencana penyusunan Final Investment Decision (FID) untuk industri Clean Amonia menunjukkan langkah progresif perusahaan dalam mendukung pembangunan yang berkelanjutan.'),
(6, 'Teknologi Digital: Transformasi di Lahan Pertanian', '2024-06-13', 'middle-aged-asian-farmer-man.jpg', '-', 'Irgi', 'Teknologi digital telah mengubah cara petani berinteraksi dengan tanaman mereka dan mengelola operasi pertanian mereka. Berikut adalah beberapa aplikasi utama teknologi digital dalam pertanian:\r\n\r\na. Sensor Tanah dan Pemantauan Lingkungan\r\nSensor tanah yang dipasang di lahan pertanian dapat memberikan informasi real-time tentang kelembaban tanah, suhu, tingkat keasaman (pH), dan kandungan nutrisi. Data ini memungkinkan petani untuk mengambil keputusan yang lebih tepat, seperti kapan menyirami tanaman atau kapan memberikan pupuk tambahan.\r\n\r\nb. Internet of Things (IoT) dan Perangkat Tersambung\r\nPerangkat IoT seperti traktor, irigasi, dan alat pengumpul panen yang terhubung secara internet memungkinkan petani untuk mengontrol dan memantau operasi mereka dari jarak jauh. Misalnya, petani dapat mengatur irigasi tanaman mereka menggunakan smartphone mereka, atau memantau kesehatan tanaman melalui kamera yang terpasang di lahan.\r\n\r\nc. Analisis Data dan Kecerdasan Buatan (AI)\r\nTeknologi analisis data dan kecerdasan buatan memungkinkan petani untuk mengolah besarannya data yang dihasilkan oleh sensor dan perangkat IoT untuk mendapatkan wawasan yang lebih dalam tentang kondisi tanaman dan prediksi masa depan. Misalnya, AI dapat digunakan untuk memprediksi hasil panen, mengidentifikasi penyakit tanaman, atau memberikan rekomendasi pemupukan yang disesuaikan dengan kebutuhan tanaman.\r\n\r\nd. Sistem Informasi Geografis (SIG)\r\nSIG memungkinkan petani untuk memetakan lahan pertanian mereka dan menganalisis variasi spasial dalam parameter seperti kesuburan tanah, kemiringan lahan, dan paparan sinar matahari. Ini membantu petani dalam merencanakan tanaman secara lebih efisien dan mengoptimalkan penggunaan sumber daya.\r\n\r\nTeknologi digital telah membuka pintu untuk pertanian yang lebih efisien, produktif, dan berkelanjutan. Dengan terus mengembangkan dan mengadopsi inovasi-inovasi ini, kita dapat memastikan bahwa pertanian tetap menjadi pilar penting dalam menyediakan makanan bagi populasi dunia yang terus berkembang, sambil menjaga keseimbangan lingkungan dan sumber daya alam.'),
(7, 'Mengenal Apa Itu Irigasi dan Fungsinya', '2024-05-31', 'irigasi.jpg', 'Kawan Lama (https://www.kawanlama.com/blog/berita/apa-itu-irigasi)', 'Machrus', 'Apa Itu Irigasi?\r\nIrigasi adalah suatu metode atau teknik untuk mengalirkan air secara terkontrol ke lahan pertanian atau kebun, dengan tujuan memberikan kelembapan yang cukup kepada tanaman. Air yang disalurkan ini berasal dari sumber air seperti sungai, danau, sumur, atau sistem pengumpulan air lainnya. \r\n\r\nTujuan utama dari irigasi yaitu untuk menggantikan atau meningkatkan pasokan air alami, terutama dalam kondisi kekeringan atau musim kemarau. Dalam kata lain, irigasi memberikan kemudahan kepada petani untuk mengontrol perkembangan tumbuh-tumbuhan dan meningkatkan hasil panen melalui pemberian air secara teratur.\r\n\r\nFungsi dan Manfaat Irigasi\r\nDalam dunia pertanian dan pengelolaan sumber daya air, irigasi memegang peranan penting sebagai salah satu teknik yang memungkinkan pertumbuhan tanaman jadi lebih sehat dan hasil panen melimpah. Irigasi bukan hanya sekadar memberikan pasokan air tambahan kepada tanaman, melainkan juga membawa berbagai manfaat bagi pertanian, lingkungan, dan ketahanan pangan. Mari simak berbagai fungsi dan manfaat irigasi lainnya berikut ini. \r\n\r\n1. Peningkatan Hasil Panen\r\nPeningkatan hasil panen adalah salah satu manfaat utama dari sistem irigasi. Melalui pemberian pasokan air yang cukup dan teratur, tanaman dapat tumbuh dengan optimal, serta menghasilkan buah-buahan dan biji-bijian yang berkualitas unggul. Kelembapan yang dijaga dengan irigasi ini tidak hanya meningkatkan produktivitas pertanian, tetapi juga berperan dalam menjaga ketersediaan pangan yang memadai.\r\n\r\n2. Mengatasi Kekeringan\r\nMengatasi kekeringan merupakan salah satu peran penting dari sistem irigasi. Saat musim kemarau tiba dan pasokan air alami menipis, irigasi hadir sebagai solusi yang efektif dalam menjaga kelangsungan hidup tanaman dan mencegah terjadinya kegagalan panen. \r\n\r\nSaat Anda melakukan penyediaan air yang terencana dan terukur, irigasi memberikan perlindungan kepada tanaman dari dampak buruk kekeringan, memastikan pertumbuhan yang optimal, serta menghasilkan hasil panen yang memuaskan.\r\n\r\n3. Pengendalian Lingkungan Tumbuh-Tumbuhan\r\nSistem irigasi mampu mengatur pasokan air sesuai kebutuhan, menentukan jenis tanaman yang paling sesuai untuk ditanam, dan mengatur jadwal pemberian air yang tepat, sehingga irigasi memberi kesempatan bagi petani untuk terus berproduksi bahkan di wilayah dengan kondisi iklim yang sulit. \r\n\r\nDalam kata lain, sistem irigasi tidak hanya menciptakan lingkungan yang ideal bagi pertumbuhan tanaman, tetapi juga membuka peluang baru bagi pertanian berkelanjutan dalam menghadapi tantangan perubahan cuaca dan lingkungan.\r\n\r\n4. Pengembangan Lahan Pertanian\r\nIrigasi juga memiliki peran penting dalam mengembangkan lahan pertanian di daerah yang sebelumnya sulit untuk ditanami. Penyediaan pasokan air yang cukup dan teratur, membuat lahan-lahan yang tadinya kering atau tandus dapat diubah menjadi lahan subur yang mendukung pertumbuhan tanaman. \r\n\r\nMelalui irigasi, potensi pertanian di wilayah-wilayah yang memiliki keterbatasan air dapat dimaksimalkan, serta menghasilkan lahan produktif yang sebelumnya mungkin terabaikan. Sistem irigasi ini memberikan peluang untuk mengoptimalkan penggunaan lahan pertanian dan memenuhi kebutuhan pangan yang makin meningkat.');

-- --------------------------------------------------------

--
-- Table structure for table `detail_barang`
--

CREATE TABLE `detail_barang` (
  `id` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_barang`
--

INSERT INTO `detail_barang` (`id`, `id_pemesanan`, `id_produk`, `nama_barang`, `jumlah`, `harga`) VALUES
(44, 83, 51, 'Pupuk urea', 1, 400000.00),
(45, 84, 54, 'Bibit Jagung Manis 25 Seeds', 1, 7000.00),
(46, 84, 55, 'Sabit', 1, 57200.00),
(48, 85, 52, 'Cangkul', 2, 130000.00),
(49, 85, 57, 'Pupuk Kakao', 1, 69825.00),
(50, 85, 55, 'Sabit', 1, 57200.00),
(51, 86, 51, 'Pupuk urea', 1, 400000.00),
(52, 86, 60, 'Insektisida', 2, 77900.00),
(53, 86, 54, 'Bibit Jagung Manis 25 Seeds', 3, 7000.00),
(54, 86, 62, 'Garpu Tanah', 1, 95000.00),
(55, 87, 51, 'Pupuk urea', 1, 400000.00),
(56, 87, 54, 'Bibit Jagung Manis 25 Seeds', 1, 7000.00),
(57, 87, 55, 'Sabit', 1, 57200.00),
(58, 88, 51, 'Pupuk urea', 1, 400000.00),
(59, 88, 57, 'Pupuk Kakao', 1, 69825.00),
(60, 88, 52, 'Cangkul', 1, 130000.00),
(61, 88, 62, 'Garpu Tanah', 1, 95000.00),
(62, 89, 57, 'Pupuk Kakao', 1, 69825.00),
(63, 89, 62, 'Garpu Tanah', 1, 95000.00),
(64, 89, 52, 'Cangkul', 1, 130000.00),
(65, 89, 56, 'SAMITE 135 EC 100 ML AKARISIDA', 1, 40000.00),
(66, 90, 60, 'Insektisida', 1, 77900.00),
(67, 90, 56, 'SAMITE 135 EC 100 ML AKARISIDA', 1, 40000.00),
(68, 90, 52, 'Cangkul', 1, 130000.00),
(69, 91, 56, 'SAMITE 135 EC 100 ML AKARISIDA', 1, 40000.00),
(70, 91, 60, 'Insektisida', 1, 77900.00),
(71, 91, 54, 'Bibit Jagung Manis 25 Seeds', 1, 7000.00),
(72, 92, 56, 'SAMITE 135 EC 100 ML AKARISIDA', 1, 40000.00),
(73, 92, 55, 'Sabit', 1, 57200.00),
(74, 92, 54, 'Bibit Jagung Manis 25 Seeds', 1, 7000.00),
(75, 93, 58, 'Pupuk Nitrea', 1, 55000.00),
(76, 94, 51, 'Pupuk urea', 1, 400000.00),
(77, 95, 59, 'Benih Tomat 50 Seeds', 1, 6000.00);

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(100) DEFAULT NULL,
  `tarif` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Lamongan', 14000.00),
(2, 'Tuban', 14000.00),
(3, 'Gresik', 14000.00),
(4, 'Surabaya', 14000.00),
(5, 'Sidoarjo', 15000.00),
(6, 'Bangkalan', 15000.00),
(7, 'Ponorogo', 20000.00),
(8, 'Malang', 17000.00),
(9, 'Pasuruan', 18000.00),
(10, 'Mojokerto', 16000.00),
(11, 'Probolinggo', 20000.00),
(12, 'Kediri', 17000.00),
(13, 'Blitar', 19000.00),
(14, 'Trenggalek', 18000.00),
(15, 'Tulungagung', 20000.00),
(16, 'Pamekasan', 22000.00),
(17, 'Sampang', 23000.00),
(18, 'Bandung', 25000.00),
(19, 'Bogor', 28000.00),
(20, 'Depok', 27000.00),
(21, 'Bekasi', 26000.00),
(22, 'Cirebon', 30000.00),
(23, 'Sukabumi', 29000.00),
(24, 'Tasikmalaya', 27000.00),
(25, 'Karawang', 28000.00),
(26, 'Purwakarta', 29000.00),
(27, 'Subang', 30000.00),
(28, 'Semarang', 22000.00),
(29, 'Solo', 25000.00),
(30, 'Magelang', 24000.00),
(31, 'Tegal', 26000.00),
(32, 'Pekalongan', 27000.00),
(33, 'Salatiga', 23000.00),
(34, 'Purwokerto', 28000.00),
(35, 'Brebes', 29000.00),
(36, 'Demak', 25000.00),
(37, 'Kudus', 26000.00),
(38, 'Banjarmasin', 35000.00),
(39, 'Balikpapan', 38000.00),
(40, 'Samarinda', 36000.00),
(41, 'Pontianak', 39000.00),
(42, 'Palangkaraya', 37000.00),
(43, 'Tarakan', 38000.00),
(44, 'Bontang', 37000.00),
(45, 'Singkawang', 40000.00),
(46, 'Tanjung Selor', 39000.00),
(47, 'Sampit', 40000.00),
(48, 'Makassar', 30000.00),
(49, 'Manado', 33000.00),
(50, 'Palu', 31000.00),
(51, 'Kendari', 34000.00),
(52, 'Gorontalo', 32000.00),
(53, 'Mamuju', 33000.00),
(54, 'Palopo', 32000.00),
(55, 'Bau-Bau', 35000.00),
(56, 'Bantaeng', 34000.00),
(57, 'Bitung', 35000.00),
(58, 'Medan', 28000.00),
(59, 'Palembang', 31000.00),
(60, 'Pekanbaru', 29000.00),
(61, 'Bandar Lampung', 32000.00),
(62, 'Bengkulu', 30000.00),
(63, 'Padang', 32000.00),
(64, 'Jambi', 31000.00),
(65, 'Binjai', 33000.00),
(66, 'Batam', 34000.00),
(67, 'Tanjung Pinang', 35000.00),
(68, 'Jakarta Barat', 27000.00),
(69, 'Jakarta Timur', 26000.00),
(70, 'Jakarta Pusat', 28000.00),
(71, 'Jakarta Utara', 25000.00),
(72, 'Jakarta Selatan', 29000.00),
(73, 'Yogyakarta', 23000.00),
(74, 'Bantul', 24000.00),
(75, 'Sleman', 22000.00),
(76, 'Gunungkidul', 25000.00),
(77, 'Kulon Progo', 26000.00),
(78, 'Denpasar', 30000.00),
(79, 'Badung', 32000.00),
(80, 'Gianyar', 31000.00),
(81, 'Tabanan', 34000.00),
(82, 'Klungkung', 33000.00);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` decimal(10,2) NOT NULL,
  `foto_produk` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) NOT NULL,
  `deskripsi_produk` text DEFAULT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `foto_produk`, `kategori`, `deskripsi_produk`, `stock`) VALUES
(51, 'Pupuk urea', 400000.00, 'pupuk urea.png', 'pupuk', 'Pupuk urea dengan kandungan nitrogen 46% sangat bagus untuk tanaman padi, sayuran hidroponik, bunga dan tanaman hias lainnya.\r\nKemasan 50 kg\r\nHarga hemat dengan barang yang berkualitas\r\n\r\nSpesifikasi:\r\n· Kadar Biuret max 1%\r\n· Kadar Nitrogen min 46%\r\n· Bentuk butiran prill uncoated\r\n· 100% larut dlm air\r\n\r\nPerbedaan Urea Non & Subsidi:\r\n- Warna putih utk urea non subsidi\r\n- Warna pink utk urea bersubsidi\r\n\r\nBerikut bbrp manfaat pupuk Urea pd tanaman:\r\n- Membuat Daun tampak lbh segar, hijau & rimbun\r\n- Meningkatkan jmlh anakan tanaman\r\n- Mempercepat pertumbuhan tunas & tinggi tanaman\r\n- Mempercepat proses fotosintesis\r\n- Memacu pertumbuhan tanaman\r\n- Mempercepat pertumbuhan akar\r\n- Meningkatkan unsur Nitrogen dlm tanah\r\n- Meningkatkan hasil panen\r\n- Tanaman menjadi lebih kokoh & tahan terhadap serangan hama & penyakit\r\n- Bisa diaplikasikan pd semua jenis tanaman\r\n- Mdh larut hingga mdh diserap tanaman', 5),
(52, 'Cangkul', 130000.00, 'Frame 30.png', 'alat pertanian', 'Kategori: Cangkul\r\nMerek/Penerbit: Distributor\r\nKondisi: Baru\r\nGaransi: Non Garansi\r\n\r\nDimensi Produk:\r\nPanjang: 40 cm\r\nLebar: 15 cm\r\nTinggi: 20 cm\r\nBerat: 700 gram\r\n\r\nDeskripsi Produk:\r\nCangkul ini adalah alat yang sangat berguna untuk kegiatan berkebun atau pertanian. Dengan kondisi baru dan kualitas yang terjamin dari distributor terpercaya, cangkul ini dirancang untuk memberikan kenyamanan dan efisiensi dalam penggunaan sehari-hari. Terbuat dari bahan yang kuat dan tahan lama, cangkul ini memiliki dimensi yang ideal untuk berbagai jenis pekerjaan tanah.\r\n\r\nPengiriman dilakukan oleh kurir internal toko dengan jaminan pengiriman dalam waktu 3 hari, memastikan produk tiba dengan cepat dan dalam kondisi baik. Produk ini dikenakan PPN, menambah kepercayaan bahwa produk ini resmi dan legal. Meskipun tidak dilengkapi dengan garansi, cangkul ini dijamin kualitasnya sehingga dapat diandalkan untuk penggunaan jangka panjang.', 6),
(54, 'Bibit Jagung Manis 25 Seeds', 7000.00, 'jagung-manis.jpg', 'bibit tanaman', 'Isi per kemasan kurang lebih (25 butir)  \r\n\r\nJagung manis hibrida, tanaman seragam, tinggi sedang, tongkol seragam, warna bulir kuning tua, rasa manis dan lembut, bobot tongkol 270 – 300 gram, untuk konsumsi segar,  dipanen pada umur 63 HSS, dengan hasil segar    13 – 15 ton per hektar.\r\n\r\nRekomendasi Dataran:  Rendah – Menengah\r\nUmur Panen: 70 – 85 HST\r\nPotensi Hasil: 14 – 18 ton/ha\r\nDaya Tumbuh: 80 %\r\nKemurnian: 99 %\r\n\r\n*)Ketahanan penyakit, umur panen, bobot dan potensi hasil tergantung pada lingkungan dan perlakuan budidayanya.', 3),
(55, 'Sabit', 57200.00, 'Sabit.png', 'alat pertanian', 'Sabit, arit, atau celurit adalah alat pertanian berupa pisau melengkung menyerupai bulan sabit. Meskipun bentuknya sama, secara bahasa \"arit\" dan \"sabit\" cenderung merujuk pada alat pertanian, sedangkan celurit pada senjata tajam.\r\n\r\nPemangkas Sabit kapak Ganda Pemangkas Rumput Multifungsi 6722/Sabit Kapak Ganda Baja Sabit Ranting Pohon Sabit Rumput Arit Padi Alat Pembelah Bambu\r\nSabit Arit Rumput Baja Asli Sabit Kapak Ganda Alat Pemotong Ranting Pohon Alat Panen Padi Potong Rumput', 6),
(56, 'SAMITE 135 EC 100 ML AKARISIDA', 40000.00, 'Akarisida.jpg', 'pestisida', '*** PRODUK ORIGINAL ASLI, BUKAN PALSU ***\r\n*** HATI-HATI PRODUK SEJENIS DENGAN HARGA MURAH ***\r\n\r\nSAMITE 135 EC 100 ML\r\nKandungan           : Piridaben 135 g/l\r\nBentuk                  : Pekatan yang dapat diemulsikan, warna kuning\r\nCara Kerja            : Racun Kontak\r\nDiproduksi oleh    : PT Tanindo Intertraco\r\n\r\nSamite merupakan akarisida kontak berbentuk pekatan yang dapat diemulsikan berwarna kuning untuk mengendalikan hama tungau pada tanaman cabai, cabai merah, jeruk manis dan teh.\r\n\r\nDosis dan Aplikasi :\r\nCabai: hama tungau Hemitarsonemus latus (Penyemprotan volume tinggi: 1 ml/l)\r\nJeruk: hama tungau Tetranychus sp. (Penyemprotan volume tinggi: 0,5 ml/l)', 6),
(57, 'Pupuk Kakao', 69825.00, 'Npk Kakao.png', 'pupuk', 'Pupuk Organik Cair (POC) Buah Kakao adalah solusi terbaik untuk meningkatkan pertumbuhan dan hasil panen tanaman kakao secara alami. Dengan kombinasi bahan organik berkualitas tinggi, mikroba bermanfaat, dan nutrisi alami, POC Buah Kakao memberikan dukungan yang optimal sepanjang siklus hidupnya. \r\n\r\nPupuk Organik Cair Buah Kakao adalah formulasi khusus yang mengandung bahan organik alami, mikroba pengurai, dan nutrisi esensial yang dibutuhkan oleh tanaman kakao. Diproduksi melalui proses fermentasi yang cermat, produk ini memberikan nutrisi langsung ke tanaman, merangsang pertumbuhan vegetatif, dan meningkatkan produksi buah kakao.', 7),
(58, 'Pupuk Nitrea', 55000.00, 'Nitrea.png', 'pupuk', 'Spesifikasi:\r\n\r\n- Kadar Biuret maksimal: 1%\r\n- Kadar Nitrogen minimal: 46%\r\n- Bentuk: Butiran prill uncoated\r\n- Kelarutan: 100% larut dalam air\r\n- Kandungan: Nitrogen 46%\r\n- Isi: 5 kg\r\n\r\nManfaat:\r\n-Membuat tanaman lebih hijau dan segar.\r\n-Mempercepat proses pertumbuhan tanaman.\r\n-Menambahkan nutrisi protein yang penting untuk pertumbuhan tanaman.\r\n\r\nPeruntukan:\r\n-Tanaman pangan.\r\n-Hortikultura.\r\n-Tanaman keras.\r\n-Perkebunan.\r\n\r\nCatatan:\r\nPupuk ini dirancang khusus dengan kandungan nitrogen tinggi (46%) untuk memberikan nutrisi penting bagi tanaman pangan, hortikultura, tanaman keras, dan perkebunan. Dengan bentuk butiran prill uncoated yang 100% larut dalam air, pupuk ini dapat diserap dengan efisien oleh tanaman, membantu dalam pertumbuhan vegetatif dan pembentukan protein yang vital bagi kesehatan tanaman. Ideal untuk meningkatkan hasil panen dan kualitas tanaman secara keseluruhan.', 9),
(59, 'Benih Tomat 50 Seeds', 6000.00, 'Bibit Tomat.jpg', 'bibit tanaman', 'Tomat jenis ini cocok dibudidayakan di daerah dataran rendah hingga dataran tinggi. Tergolong tanaman tomat yang tahan terhadap serangan penyakit layu bakteri.\r\nBenih ini akan menghasilkan buah tomat berbentuk bulat, agak lembek dan seragam. Dikenal sebagai tomat sayur terutama untuk sambal. Warna buah merah ketika sudah matang. Tanaman Vigor, tipe tumbuh determinate. Buah sudah bisa dipanen saat tanaman berusia 60-70 hari setelah tanam (HST) dengan potensi hasil bisa mencapai 2-3 kg/tanaman.', 9),
(60, 'Insektisida', 77900.00, 'Insektisida.jpg', 'pestisida', '•100% ORIGINAL.\r\n•HATI HATI PRODUK PALSU YANG MENAWARKAN HARGA LEBIH MURAH!\r\n•Gunakan VOUCHER ONGKIR yang disediakan Shopee.\r\n●PENGIRIMAN SELURUH INDONESIA●\r\n\r\nBahan Aktif : Profenofos 540 g/l + Sipermetrin 60 g/l\r\nVIPER 600 EC adalah Insektisida racun kontak dan lambung berbentuk larutan berwarna kuning kecoklatan dapat diemulsikan dengan air untuk mengendalikan hama ulat grayak Spodoptera exigua pada tanaman bawang merah.\r\n\r\nKeunggulan VIPER 600 EC\r\n-Mudah diaplikasikan/penyem:perotan dapat dicampur dengan lain seperti kebiasaan petani\r\n-Bekerja sebagai racun kontak- lambung dan sistemik\r\n-Spektrum Luas\r\n-Efektif mengendalikan hama ulat grayak pada bawang merah\r\n-Efektif pada dosis rendah\r\n-Ekonomis bagi petani', 6),
(61, 'Traktor Quick Kubota RD 65 ', 25000000.00, 'imapala.png', 'alat pertanian', 'Merk/Model	QUICK / Impala\r\nKecepatan	1 Kecepatan Maju\r\nSistem Transmisi	Kombinasi (Gear-Chain)\r\nGear Case	Casting Dual Part System\r\nSistem Penggerak (Kopling Utama)	V-Belt & Tension Pulley *\r\nSistem Kemudi (Kopling Belok)	Dog Clutch\r\nIsi Minyak Pelumas	4.6 Liter (Oli SAE 90-140)\r\nDimensi Traktor dengan Roda Besi Ø 720mm / Roda Karet	Panjang (mm)	2230 / 2230\r\nLebar (mm)	1055 / 720\r\nTinggi (mm)	1153 / 1125\r\nBerat dengan mesin penggerak diesel Kubota RD 65 DI-1s (kg)	204.8 / 188.6 **\r\nBerat dengan mesin penggerak (kg)	ditambah dengan berat mesin penggerak yang digunakan\r\nKapasitas Kerja (menggunakan diesel 6.5 HP dan bajak singkal tunggal)	Lahan Sawah (jam/Ha)	± 11.48 ***\r\nLahan Kering (jam/Ha)	± 11.54 ***', 5),
(62, 'Garpu Tanah', 95000.00, 'garpu-tanah.jpg', 'alat pertanian', 'Garpu Tanah Injak,merupakan salah satu alat bercocok tanam yang digunakan untuk menggemburkan tanah dan juga untuk meratakan pupuk di kebun, terutama pupuk kandang dan berguna juga untuk pemakaian dilingkungan rumah sebagai alat yang bisa dipakai kerja bakti dilingkungan tempar tinggal yang berguna mengeruk sampah sampah dan lainya,Garpu injak ini berbahan besi beton yang tebal dan lancip,memikiki gagang besi yang tebal dan kuat cocok dijadikan peralatan siap siaga dikebun ataupun rumah,alat garpu injak ini memiliki ukuran :\r\n\r\nPanjang keseluruhan 88 cm\r\nPanjanga mata garpu 26 cm\r\nLebar mata garpu 20 cm\r\nKetebalan mata garpu 1,5 cm\r\nGagang pegangan berdiameter 3,5 cm', 7),
(63, 'Bibit Kacang Tanah 20 Seeds', 20000.00, 'Bibit Kacang Tanah.jpg', 'bibit tanaman', 'Sebagai kacang tanah, mereka kaya akan asam amino esensial, protein, lemak tak jenuh tunggal dan vitamin E, tetapi tidak seperti kebanyakan kacang tanah yang diproduksi secara massal, kacang liar bebas dari aflatoksin (racun alami yang dihasilkan oleh jamur yang mencemari banyak biji-bijian dan tanaman yang dibudidayakan secara massal). ).\r\n\r\nDi Indonesia, kacang tanah liar ini pertama kali ditemukan di Jawa, tetapi kurangnya lahan subur yang masih asli di pulau ini (yang paling padat penduduknya di Indonesia) mendorong kami untuk membangun pertanian kacang belang di Indonesia timur. Karena kondisi tanah yang cocok, petani di kepulauan Nusa Tenggara Timur telah membudidayakan kacang tanah secara komersial sejak tahun 2006. Pada tahun 2013, PMA memperkenalkan kacang belang kepada para petani ini dan juga melatih mereka dalam metode pertanian organik.\r\n\r\nProdusen: Ninufarm\r\nNama Variates: Giant Striped Peanut\r\nNama Latin: Arachis Hypogea\r\nDaya Kecambah: 80% (minimal)\r\nIsi Benih Perkemasan: 20 butir\r\nExp: April 2027\r\nUkuran Kemasan : 9,7 cm x 6 cm x 0,1 cm\r\nKet: Kemasan Original Pabrik\r\n\r\n*) Ketahanan penyakit, umur panen, bobot dan potensi hasil tergantung pada lingkungan dan perlakuan budidayanya', 10);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `review_text` text NOT NULL,
  `review_rating` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `id_produk`, `id_pemesanan`, `nama_user`, `review_text`, `review_rating`, `created_at`) VALUES
(39, 51, 83, 'tanija', 'Produknya berkualitas dengan harga yang terjangkau.', 5, '2024-06-13 12:30:43'),
(40, 51, 86, 'Asep', 'Saya sangat puas dengan pembelian pupuk urea ini dari e-commerce. Pengiriman cepat dan produk tiba dalam kondisi baik. Kualitas pupuk urea sangat bagus, butirannya halus dan mudah larut dalam air. Setelah digunakan, tanaman saya terlihat lebih subur dan hijau.', 5, '2024-06-13 13:49:00'),
(41, 60, 86, 'Asep', 'Pengiriman sangat cepat dan produk tiba dalam kondisi sempurna. Insektisida ini sangat efektif mengendalikan hama di kebun saya. Setelah pemakaian pertama, saya sudah melihat penurunan signifikan dalam populasi serangga pengganggu. Cara penggunaannya juga mudah dan petunjuknya jelas. Tidak ada efek samping negatif yang terlihat pada tanaman. Harga produk ini juga sangat terjangkau dibandingkan dengan insektisida lainnya di pasaran.', 5, '2024-06-13 13:49:39'),
(42, 54, 86, 'Asep', 'Saya sangat puas dengan pembelian bibit jagung manis ini dari e-commerce. Pengiriman cepat dan bibit tiba dalam kondisi baik, dengan kemasan yang rapi dan terlindungi. Dari 25 bibit yang saya tanam, hampir semuanya berkecambah dengan baik dan tumbuh subur. Tanaman jagung manis ini terlihat sangat sehat dan kuat, dan saya sudah bisa melihat pertumbuhan yang cepat dalam beberapa minggu pertama.', 5, '2024-06-13 13:51:00'),
(43, 62, 86, 'Asep', 'Saya sangat puas dengan pembelian garpu tanah ini dari e-commerce. Pengirimannya cepat dan produk tiba dalam kondisi baik, tanpa ada cacat atau kerusakan. Garpu tanah ini sangat kokoh dan terbuat dari bahan berkualitas tinggi yang tahan lama. Pegangannya ergonomis dan nyaman digunakan, sehingga mengurangi kelelahan saat bekerja di kebun. Gigi-giginya tajam dan kuat, sangat efektif untuk menggemburkan tanah dan mengangkat akar tanaman. ', 5, '2024-06-13 13:51:48'),
(44, 54, 84, 'tanija', 'Saya sangat senang dengan pembelian bibit jagung manis 25 seeds ini dari e-commerce. Proses pengirimannya cepat dan kemasannya sangat rapi, sehingga bibit tiba dalam kondisi yang sangat baik. Dari 25 bibit yang saya tanam, hampir semua berhasil tumbuh dengan baik. Bibit ini menghasilkan tanaman yang subur dan sehat, serta jagung manis yang rasanya luar biasa. Instruksi penanaman yang disertakan sangat jelas dan membantu, bahkan bagi pemula seperti saya. Harga yang ditawarkan sangat sebanding dengan kualitas bibit yang diterima.', 5, '2024-06-13 13:53:15'),
(45, 55, 84, 'tanija', 'Saya sangat puas dengan pembelian sabit ini dari e-commerce. Pengirimannya cepat dan produk tiba dalam kondisi sempurna, tanpa ada cacat atau kerusakan. Sabit ini terbuat dari bahan berkualitas tinggi yang sangat tajam dan kuat, memudahkan saya untuk memotong rumput dan tanaman di kebun. Desain pegangan yang ergonomis membuatnya nyaman digunakan dalam jangka waktu lama tanpa membuat tangan lelah. Harganya juga sangat terjangkau untuk kualitas yang ditawarkan.', 5, '2024-06-13 13:54:02'),
(46, 52, 85, 'tanija', 'Saya sangat puas dengan pembelian cangkul ini dari e-commerce. Pengirimannya cepat dan produk tiba dalam kondisi prima, tanpa cacat atau kerusakan. Cangkul ini terbuat dari bahan yang sangat kokoh dan tahan lama, sehingga sangat efektif untuk menggali dan mengolah tanah di kebun saya. Pegangannya dirancang dengan ergonomis, sehingga nyaman digunakan dan tidak membuat tangan cepat lelah. Mata cangkul yang tajam memudahkan pekerjaan berkebun, baik untuk menggali tanah keras maupun menggemburkan tanah.', 5, '2024-06-13 13:54:44'),
(47, 57, 85, 'tanija', 'Saya sangat puas dengan pembelian pupuk kakao ini dari e-commerce. Pengirimannya cepat dan pupuk tiba dalam kondisi baik. Pupuk ini terbukti sangat efektif untuk meningkatkan pertumbuhan dan produksi buah kakao di kebun saya. Setelah beberapa kali penggunaan, saya melihat peningkatan yang signifikan dalam kualitas dan jumlah buah yang dihasilkan. Cara penggunaannya juga mudah, dengan petunjuk yang jelas. Harga pupuk ini juga cukup terjangkau untuk kualitas yang ditawarkan. Saya sangat merekomendasikan produk ini kepada para petani kakao yang ingin meningkatkan hasil tanaman mereka!', 5, '2024-06-13 13:55:22'),
(48, 55, 85, 'tanija', 'Pembelian sabit ini dari e-commerce sungguh memuaskan. Pengirimannya sangat cepat dan sabit tiba dalam kondisi prima. Bahan dari sabit ini terasa sangat kuat dan kokoh, sangat cocok untuk memotong rumput yang tinggi di sekitar halaman saya. Pegangan sabit juga sangat nyaman digenggam, tidak membuat tangan cepat lelah meskipun digunakan dalam waktu yang lama. Mata sabit yang tajam memudahkan pekerjaan memotong rumput secara efisien dan bersih. Harganya juga cukup terjangkau, sangat sepadan dengan kualitas sabit yang saya terima. Saya sangat merekomendasikan sabit ini bagi siapa saja yang membutuhkan alat untuk merapikan halaman dengan baik dan efektif!', 5, '2024-06-13 13:55:52'),
(49, 51, 87, 'Burhan Udin', 'engirimannya cepat dan pupuk tiba dalam kondisi sempurna. Pupuk urea ini terbukti sangat efektif dalam meningkatkan pertumbuhan tanaman di kebun saya. Saya melihat hasil yang positif dalam waktu singkat setelah mengaplikasikannya. Butiran pupuknya halus dan mudah larut dalam air, sehingga mudah untuk diaplikasikan. Tanaman saya terlihat lebih hijau dan subur setelah menggunakan pupuk ini. Harganya juga cukup terjangkau mengingat manfaat yang diberikan. Saya sangat merekomendasikan pupuk urea baru ini bagi para petani dan penghobi tanaman!', 5, '2024-06-13 14:05:28'),
(50, 54, 87, 'Burhan Udin', 'Bibit jagung manis 25 seeds ini sungguh memuaskan! Pengiriman cepat dan bibit tiba dalam kondisi prima. Saya sangat senang melihat hampir semua bibit tumbuh dengan baik dan sehat setelah saya tanam. Tanaman jagung manisnya mulai tumbuh dengan kuat dan berdaun hijau subur. Instruksi penanaman yang disertakan juga sangat membantu, bahkan untuk pemula seperti saya. Harganya juga cukup terjangkau untuk kualitas bibit yang bagus. Sangat direkomendasikan untuk penghobi tanaman dan petani kecil seperti saya!', 5, '2024-06-13 14:07:24'),
(51, 55, 87, 'Burhan Udin', 'Sabit ini sangat kokoh dan tajam. Sangat efektif untuk membersihkan rumput di halaman rumah saya. Desain pegangannya juga nyaman digunakan. Harganya terjangkau dan kualitasnya memuaskan.', 5, '2024-06-13 14:08:18'),
(52, 51, 88, 'Diky Ramadhan', 'Pupuk urea baru ini benar-benar membuat perbedaan dalam kebun saya. Saya melihat peningkatan yang signifikan dalam pertumbuhan dan kualitas tanaman setelah menggunakannya. Konsistensi butiran pupuknya sangat baik, memastikan aplikasi yang merata dan efektif. Tanaman saya terlihat lebih sehat dan produktif dari sebelumnya. Selain itu, pupuk ini juga mudah larut dalam air, membuat penggunaannya sangat praktis. Dengan harga yang terjangkau, saya sangat merekomendasikan produk ini untuk meningkatkan hasil tanaman Anda!', 5, '2024-06-13 14:21:06'),
(53, 57, 88, 'Diky Ramadhan', 'Pupuk kakao ini sangat efektif untuk tanaman kakao saya. Setelah beberapa kali penggunaan, tanaman kakao terlihat lebih sehat dan produktif. Mudah larut dalam air dan tidak meninggalkan residu berlebih di tanah. Sangat direkomendasikan untuk petani kakao yang ingin meningkatkan hasil panen mereka.', 5, '2024-06-13 14:21:28'),
(54, 52, 88, 'Diky Ramadhan', 'Cangkul ini sangat kuat dan tangguh. Bahan pembuatannya terasa kokoh dan tahan lama. Desain pegangan yang ergonomis membuatnya nyaman digunakan dalam pekerjaan menggali atau mengolah tanah. Sangat efektif untuk pekerjaan berkebun atau konstruksi kecil di rumah. Harganya juga terjangkau untuk kualitas yang ditawarkan. Saya sangat merekomendasikan cangkul ini bagi siapa saja yang membutuhkan alat yang handal dan awet.', 5, '2024-06-13 14:22:14'),
(55, 62, 88, 'Diky Ramadhan', 'Garpu tanah ini sangat praktis dan efisien untuk menggemburkan tanah di kebun saya. Terbuat dari bahan yang kokoh dan tahan lama, serta memiliki pegangan yang nyaman untuk digunakan dalam waktu yang lama. Gigi-giginya tajam dan kuat, memudahkan saya dalam pekerjaan mengurus tanaman.', 5, '2024-06-13 14:22:37'),
(56, 57, 89, 'Muad Rojim', 'Pupuk kakao ini sangat efektif untuk tanaman kakao saya. Setelah menggunakan pupuk ini, tanaman kakao saya terlihat lebih subur dan menghasilkan buah yang lebih banyak. Pupuk ini mudah larut dalam air dan memberikan nutrisi yang tepat untuk tanaman.', 5, '2024-06-13 14:34:59'),
(57, 62, 89, 'Muad Rojim', 'Garpu tanah ini sangat membantu dalam pekerjaan saya di kebun. Terbuat dari bahan yang kuat dan kokoh, garpu ini tidak mudah bengkok atau rusak meskipun digunakan untuk menggali tanah yang keras. Pegangannya nyaman dan tidak licin saat digunakan, sehingga membuat saya lebih efisien dalam pekerjaan pengolahan tanah. ', 5, '2024-06-13 14:38:23'),
(58, 60, 90, 'Suwarno Bakri', 'Insektisida ini sungguh efektif untuk mengendalikan hama di kebun saya. Setelah penggunaan beberapa kali, saya melihat penurunan signifikan dalam populasi serangga yang mengganggu tanaman. Formula insektisida ini tidak hanya efektif, tetapi juga aman untuk tanaman saya.', 5, '2024-06-13 14:45:43'),
(59, 56, 90, 'Suwarno Bakri', 'SAMITE 135 EC 100 mL adalah akarisida yang sangat efektif untuk mengendalikan hama akar pada tanaman saya. Saya menggunakannya untuk tanaman hias di halaman belakang, dan hasilnya luar biasa. Hama akar yang mengganggu segera berkurang setelah aplikasi pertama.', 5, '2024-06-13 14:46:49'),
(60, 52, 90, 'Suwarno Bakri', 'Pembelian cangkul ini sungguh memuaskan. Cangkulnya tahan lama dan tidak mudah rusak meskipun digunakan secara intensif. Desain pegangannya ergonomis, membuatnya nyaman digunakan dan tidak membuat tangan cepat lelah. Mata cangkulnya juga tajam dan efisien untuk menggali atau merapikan tanah.', 5, '2024-06-13 14:47:46'),
(61, 56, 91, 'Faisal Ahmad', 'Ini adalah produk yang umumnya digunakan dengan cara mencampurkan dengan air, lalu disemprotkan ke tanaman untuk mengurangi atau menghilangkan populasi hama yang tidak diinginkan. Metode aplikasinya yang mudah membuatnya sangat praktis digunakan dalam perlindungan tanaman dari serangga atau hama lainnya di kebun atau lahan pertanian.', 5, '2024-06-13 15:01:11'),
(62, 60, 91, 'Faisal Ahmad', 'Ini adalah jenis insektisida yang umumnya digunakan dengan cara mencampurkan dengan air, kemudian disemprotkan langsung ke tanaman untuk mengendalikan populasi serangga yang tidak diinginkan. Aplikasi yang mudah dan efektif membuatnya menjadi pilihan yang populer dalam melindungi tanaman dari serangan hama di kebun atau pertanian.', 5, '2024-06-13 15:01:34'),
(63, 54, 91, 'Faisal Ahmad', 'Bibit jagung manis 25 seeds ini sangat baik. Saya senang dengan kualitasnya yang bagus dan tingkat keberhasilan berkecambahnya yang tinggi. Hampir semua bibit tumbuh dengan baik setelah saya tanam, dan sekarang tanaman jagung manisnya sudah mulai subur. Harganya juga terjangkau untuk kualitas bibit yang diberikan. Sangat direkomendasikan untuk mereka yang ingin menanam jagung manis di kebun rumah!', 5, '2024-06-13 15:02:08'),
(64, 56, 92, 'Nuri Hidayatuloh', 'Saya menggunakan produk ini untuk tanaman hias di halaman belakang, dan hasilnya luar biasa. Hama akar yang mengganggu berkurang signifikan setelah penggunaan pertama. Formula konsentratnya mudah larut dalam air, membuat aplikasinya praktis dan efisien. Meskipun kuat dalam melawan hama, produk ini aman bagi tanaman saya. Saya sangat merekomendasikan SAMITE 135 EC 100 mL kepada penghobi tanaman yang ingin melindungi tanaman mereka dengan efektif.', 5, '2024-06-13 15:06:33'),
(65, 55, 92, 'Nuri Hidayatuloh', 'Sabit ini sangat kuat dan dapat diandalkan. Saya menggunakan sabit ini untuk membersihkan rumput liar di halaman belakang, dan saya sangat terkesan dengan kekuatan serta ketajaman mata sabitnya. Pegangannya nyaman digenggam dan tidak membuat tangan cepat lelah.', 5, '2024-06-13 15:07:15'),
(66, 54, 92, 'Nuri Hidayatuloh', 'Hampir semua bibit tumbuh dengan baik setelah saya tanam, dan sekarang tanaman jagung manisnya sudah mulai subur. Petunjuk penanamannya juga cukup jelas dan membantu. Harganya juga terjangkau untuk kualitas bibit yang diberikan. Saya sangat merekomendasikan produk ini kepada siapa saja yang ingin menanam jagung manis di halaman rumah.', 5, '2024-06-13 15:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pemesanan`
--

CREATE TABLE `riwayat_pemesanan` (
  `id` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `detail_barang` text NOT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `nomor_handphone` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `ongkir` int(11) NOT NULL,
  `total_pembayaran` decimal(10,2) NOT NULL,
  `status_pembayaran` varchar(20) NOT NULL,
  `tanggal_pemesanan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_pemesanan`
--

INSERT INTO `riwayat_pemesanan` (`id`, `nama_user`, `detail_barang`, `nama_penerima`, `nomor_handphone`, `alamat`, `ongkir`, `total_pembayaran`, `status_pembayaran`, `tanggal_pemesanan`) VALUES
(83, 'tanija', 'Pupuk urea (1)', 'Suparno', '0812345678', 'BABAT KABUPATEN LAMONGAN', 14000, 414000.00, 'success', '2024-06-13 12:29:43'),
(84, 'tanija', 'Bibit Jagung Manis 25 Seeds (1), Sabit (1)', 'Machrus', '0812345678', 'BABAT KABUPATEN LAMONGAN', 14000, 78200.00, 'success', '2024-06-13 12:45:02'),
(85, 'tanija', 'Cangkul (2), Pupuk Kakao (1), Sabit (1)', 'Dicky', '081342353345', 'Jalan Mawar No. 15, Kelurahan Banyumanik, Kecamatan Banyumanik, Kota Semarang, Jawa Tengah 50269', 22000, 409025.00, 'success', '2024-06-13 13:43:49'),
(86, 'Asep', 'Pupuk urea (1), Insektisida (2), Bibit Jagung Manis 25 Seeds (3), Garpu Tanah (1)', 'Asep', '085322390778', 'Jalan Anggrek No. 27, Kelurahan Ciumbuleuit, Kecamatan Cidadap, Kota Bandung, Jawa Barat 40141', 32000, 703800.00, 'success', '2024-06-13 13:47:56'),
(87, 'Burhan Udin', 'Pupuk urea (1), Bibit Jagung Manis 25 Seeds (1), Sabit (1)', 'Burhan Udin', '087746567459', 'Jalan Flamboyan No. 10, Kelurahan Cibeureum, Kecamatan Tawang, Kota Tasikmalaya, Jawa Barat 46115', 27000, 491200.00, 'success', '2024-06-13 14:04:42'),
(88, 'Diky Ramadhan', 'Pupuk urea (1), Pupuk Kakao (1), Cangkul (1), Garpu Tanah (1)', 'Diki Ramadhan', '085779427337', 'Jalan Merdeka No. 8, Kelurahan Malunda, Kecamatan Mamuju, Kabupaten Mamuju, Sulawesi Barat 91512', 33000, 727825.00, 'success', '2024-06-13 14:17:18'),
(89, 'Muad Rojim', 'Pupuk Kakao (1), Garpu Tanah (1), Cangkul (1), SAMITE 135 EC 100 ML AKARISIDA (1)', 'Muad Rojim', '088377929371', 'Jalan Raya Ubud No. 25, Banjar Tegal, Desa Ubud, Kecamatan Gianyar, Kabupaten Gianyar, Bali 80571', 31000, 365825.00, 'success', '2024-06-13 14:34:26'),
(90, 'Suwarno Bakri', 'Insektisida (1), SAMITE 135 EC 100 ML AKARISIDA (1), Cangkul (1)', 'Suwarno Bakri', '085238596875', 'Jalan Raya Pantai Timur No. 12, Kelurahan Tanjung, Kecamatan Bangkalan, Kabupaten Bangkalan, Jawa Timur 69111', 15000, 262900.00, 'success', '2024-06-13 14:45:07'),
(91, 'Faisal Ahmad', 'SAMITE 135 EC 100 ML AKARISIDA (1), Insektisida (1), Bibit Jagung Manis 25 Seeds (1)', 'Faisal Ahmad', '081473269025', 'Jalan Pahlawan No. 17, Kelurahan Sukorejo, Kecamatan Lamongan, Kabupaten Lamongan, Jawa Timur 62211', 14000, 138900.00, 'success', '2024-06-13 14:59:56'),
(92, 'Nuri Hidayatuloh', 'SAMITE 135 EC 100 ML AKARISIDA (1), Sabit (1), Bibit Jagung Manis 25 Seeds (1)', 'Nuri Hidaytuloh', '087457297352', 'Jalan Diponegoro No. 30, Kelurahan Kepatihan, Kecamatan Ponorogo, Kabupaten Ponorogo, Jawa Timur 63411', 20000, 124200.00, 'success', '2024-06-13 15:05:10'),
(93, 'tanija', 'Pupuk Nitrea (1)', 'Machrus', '0812345678', 'BABAT KABUPATEN LAMONGAN', 14000, 69000.00, 'success', '2024-06-14 01:36:37'),
(94, 'tanija', 'Pupuk urea (1)', 'Machrus', '0812345678', 'BABAT KABUPATEN LAMONGAN', 14000, 414000.00, 'success', '2024-06-14 13:55:07'),
(95, 'tanija', 'Benih Tomat 50 Seeds (1)', 'Machrus', '0812345678', 'BABAT KABUPATEN LAMONGAN', 14000, 20000.00, 'success', '2024-06-15 14:01:58');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email_user`, `password_user`, `nama_user`) VALUES
(7, 'tanija1@gmail.com', '5a496f097f7dc19358cc5ee506a83518', 'tanija'),
(8, 'mac1@gmail.com', 'f26dcd6e0c0b71fce13e1c1030e54660', 'Machrus'),
(13, 'mach123@gmail.com', '1bb733b9a65d790c49ff5bf93b76fdff', 'machrus'),
(17, 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'Admin'),
(18, 'asep12@gmail.com', 'f3465a353436bbab3617815f64083c84', 'Asep'),
(19, 'burhanud92@gmail.com', 'c1a5c76d5d692a72c570ac3dcf1eaf5a', 'Burhan Udin'),
(20, 'dikirahman17@gmail.com', 'dffaa4c60a250f19dc4a79b1d05c8d53', 'Diky Ramadhan'),
(21, 'muadrojim22@gmail.com', 'df1cdf56049e4175bad0c8312e5bdcb8', 'Muad Rojim'),
(22, 'suwarno45@gmail.com', '83e75ae49c1e5b4caa91bd5511b19c88', 'Suwarno Bakri'),
(23, 'faisalahmad13@gmail.com', 'b67aaaf5e991b8aa6cdc7959a3c326a5', 'Faisal Ahmad'),
(24, 'faisalahmad12@gmail.com', 'b67aaaf5e991b8aa6cdc7959a3c326a5', 'Faisal Ahmad'),
(25, 'nurihidayat30@gmail.com', '264bdcf50ee157e5a7d27f94168a2df7', 'Nuri Hidayatuloh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indexes for table `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `riwayat_pemesanan`
--
ALTER TABLE `riwayat_pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detail_barang`
--
ALTER TABLE `detail_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `riwayat_pemesanan`
--
ALTER TABLE `riwayat_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_barang`
--
ALTER TABLE `detail_barang`
  ADD CONSTRAINT `detail_barang_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `riwayat_pemesanan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
