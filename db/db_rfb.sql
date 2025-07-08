-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2025 at 03:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rfb`
--

-- --------------------------------------------------------

--
-- Table structure for table `beritas`
--

CREATE TABLE `beritas` (
  `id` bigint UNSIGNED NOT NULL,
  `image` text NOT NULL,
  `kategori` enum('Info & Kegiatan','Pengumuman') NOT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `judul` varchar(100) NOT NULL,
  `slug` text NOT NULL,
  `isi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `beritas`
--

INSERT INTO `beritas` (`id`, `image`, `kategori`, `status`, `judul`, `slug`, `isi`, `created_at`, `updated_at`) VALUES
(1, '2025-07-07-21-17-38-pt-rifan-financindo-berjangka-catat-pertumbuhan-positif-dan-perkuat-komitmen-edukasi-keuangan.jpg', 'Info & Kegiatan', 'published', 'PT Rifan Financindo Berjangka Catat Pertumbuhan Positif dan Perkuat Komitmen Edukasi Keuangan', 'pt-rifan-financindo-berjangka-catat-pertumbuhan-positif-dan-perkuat-komitmen-edukasi-keuangan', '<p data-start=\"369\" data-end=\"758\"><strong data-start=\"392\" data-end=\"425\">PT Rifan Financindo Berjangka</strong> kembali mencatatkan kinerja positif di semester pertama tahun 2025, menunjukkan ketahanan dan adaptasi perusahaan di tengah dinamika pasar global. Peningkatan volume transaksi dan bertambahnya jumlah nasabah menjadi indikator keberhasilan strategi perusahaan dalam memperluas jangkauan layanan serta meningkatkan kualitas pelayanan.</p>\r\n<p data-start=\"760\" data-end=\"1311\">Direktur Utama PT Rifan Financindo Berjangka, Bapak [Nama Direktur], menyampaikan bahwa capaian ini merupakan hasil dari komitmen kuat perusahaan untuk terus berinovasi dan memberikan edukasi keuangan kepada masyarakat. &ldquo;Kami percaya bahwa literasi keuangan adalah kunci untuk menciptakan investor yang cerdas dan mandiri. Oleh karena itu, selain memperkuat layanan digital dan memperluas produk, kami juga aktif menggelar berbagai seminar, pelatihan, dan edukasi online guna meningkatkan pemahaman masyarakat terhadap perdagangan berjangka,&rdquo; ujarnya.</p>\r\n<p data-start=\"1313\" data-end=\"1645\">Sepanjang semester pertama, PT Rifan Financindo Berjangka telah menyelenggarakan lebih dari 50 kegiatan edukasi di berbagai kota besar di Indonesia, dengan total peserta mencapai lebih dari 5.000 orang. Topik yang dibahas mencakup dasar-dasar investasi, manajemen risiko, hingga strategi perdagangan yang aman dan bertanggung jawab.</p>\r\n<p data-start=\"1647\" data-end=\"1908\">Tak hanya fokus pada peningkatan bisnis, perusahaan juga berkomitmen untuk terus mendukung program Tanggung Jawab Sosial (CSR) yang berfokus pada pendidikan dan lingkungan, sejalan dengan visi perusahaan untuk memberikan kontribusi positif bagi masyarakat luas.</p>\r\n<p data-start=\"1910\" data-end=\"2146\">Dengan pencapaian yang terus meningkat, PT Rifan Financindo Berjangka optimis dapat mempertahankan momentum pertumbuhan hingga akhir tahun 2025, sekaligus memperkokoh posisinya sebagai salah satu pialang berjangka terdepan di Indonesia.</p>', '2025-07-07 14:17:38', '2025-07-07 14:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jfxes`
--

CREATE TABLE `jfxes` (
  `id` bigint UNSIGNED NOT NULL,
  `image` text,
  `name` varchar(50) NOT NULL,
  `slug` text NOT NULL,
  `deskripsi` text NOT NULL,
  `specs` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jfxes`
--

INSERT INTO `jfxes` (`id`, `image`, `name`, `slug`, `deskripsi`, `specs`, `created_at`, `updated_at`) VALUES
(1, 'jfx/07072025-mengenal-minyak-sawit-merah-dan-manfaatnya-bagi-tubuh-tingkatkan-kesehatan-otak.jpg', 'Kontrak Berjangka Olein (OLE)', 'kontrak-berjangka-olein-ole', 'Kontrak Berjangka Olein (OLE) adalah produk perdagangan berjangka berbasis komoditas minyak kelapa sawit olahan (RBD Olein) yang diperdagangkan di Bursa Berjangka Jakarta (JFX). Produk ini memberikan kesempatan kepada investor untuk memperoleh keuntungan dari pergerakan harga komoditas sekaligus berfungsi sebagai sarana lindung nilai (hedging) terhadap volatilitas harga pasar. Dengan tingkat likuiditas yang baik dan transparansi harga, Kontrak Berjangka Olein menjadi salah satu pilihan investasi menarik di sektor komoditas, khususnya bagi para pelaku pasar yang ingin memanfaatkan potensi pasar minyak sawit yang terus berkembang.', '<p><strong>Spesifikasi Kontrak Berjangka Olein</strong></p>\r\n<div align=\"center\">\r\n<p>&nbsp;</p>\r\n<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p><strong>Kode Kontrak</strong></p>\r\n</td>\r\n<td>\r\n<p>OLE</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Dasar Kontrak</strong></p>\r\n</td>\r\n<td>\r\n<p>Olein dengan kualitas Standar Pasar</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Satuan Kontrak</strong></p>\r\n</td>\r\n<td>\r\n<p>20 ton (20.000 Kg)</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Bulan Kontrak</strong></p>\r\n</td>\r\n<td>\r\n<p>6 (enam) bulan berturut-turut, sehingga setiap hari perdagangan terdapat enam Bulan Kontrak</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Hari &amp; Jam Perdagangan</strong></p>\r\n</td>\r\n<td>\r\n<p>Setiap hari perdagangan</p>\r\n<p>Pukul 09.30 &ndash; 17.30 wib</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Pasca Penutupan</strong></p>\r\n</td>\r\n<td>\r\n<p>Sesi Pasca Penutupan dilaksanakan setiap hari perdagangan, yaitu mulai pukul 17.45 WIB sampai dengan 18.00 WIB.</p>\r\n<p>Amanat beli dan jual yang dimasukkan ke dalam JAFeTS adalah pada Harga Penyelesaian hari itu.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Tukar Fisik dengan Berjangka</strong></p>\r\n</td>\r\n<td>\r\n<p>Pihak-pihak yang melakukan transaksi jual/beli Olein, PPO lainnya dan CPO diluar bursa dapat mendaftarkannya ke Bursa untuk ditukar dengan transaksi berjangka bagi kedua belah pihak.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Hari Perdagangan Terakhir</strong></p>\r\n</td>\r\n<td>\r\n<p>Perdagangan untuk suatu Bulan Kontrak berakhir pada akhir sesi Pasca Penutupan tanggal 15 bulan yang bersangkutan, jika tanggal 15 bukan merupakan hari perdagangan, maka perdagangan berakhir pada hari perdagangan sesudahnya.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Harga</strong></p>\r\n</td>\r\n<td>\r\n<p>Rupiah per kilogram (termasuk PPN)</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Perubahan Harga Minimum</strong></p>\r\n</td>\r\n<td>\r\n<p>Rp 5,- /kg (termasuk PPN)</p>\r\n<p>Rp. 100.000,- per lot (termasuk PPN)</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Batas Perubahan Harga</strong></p>\r\n</td>\r\n<td>\r\n<p>Rp.150,- per kilogram diatas atau dibawah Harga Penyelesaian hari perdagangan sebelumnya. Batas perubahan harga ini tidak berlaku untuk Bulan Berjalan dan Bulan Terdekat, kalau Bulan Berjalan sudah tidak diperdagangkan lagi.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Penyelesaian Akhir</strong></p>\r\n</td>\r\n<td>\r\n<p>Penyerahan DO Terdaftar dengan kualitas Standar Pasar</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Waktu Pemberitahuan Penyerahan</strong></p>\r\n</td>\r\n<td>\r\n<p>5 (lima) hari perdagangan terakhir. Kalau tanggal 15 itu bukan hari perdagangan maka hari perdagangan sesudahnya menjadi hari Pemberitahuan Penyerahan terakhir.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Waktu Pemberitahuan Alokasi</strong></p>\r\n</td>\r\n<td>\r\n<p>Sebelum sesi pertama hari perdagangan pertama setelah hari pemberitahuan penyerahan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Waktu Serah</strong></p>\r\n</td>\r\n<td>\r\n<p>Sebelum sesi pertama hari perdagangan kedua setelah dilakukan pemberitahuan penyerahan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Mutu</strong></p>\r\n</td>\r\n<td>\r\n<p>Standard PASAR</p>\r\n<p>Free Fatty Acids (FFA) &lt; 0,15% AOCS Method Ca 5a-40</p>\r\n<p>Moisture &amp; Impurities &lt; 0,1% AOCS Method Ca 2b-38</p>\r\n<p>AOCS Method Ca 3a-46</p>\r\n<p>Iodine Value (WIJS) &gt; 56 AOCS Method Cd 1d-92</p>\r\n<p>Warna Merah (Lovibond 5,25 inci) &lt; 4 Red AOCS Method Cc 13b-45</p>\r\n<p>Slip Melt Point &lt; 24o C AOCS Method Cc 1-25</p>\r\n<p>Cloud Point 10,75o</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Tempat Penyerahan</strong></p>\r\n</td>\r\n<td>\r\n<p>Pilihan DO berada pada Penjual dengan batas maksimum 5 (lima) lot per penerbit DO Tangki Terdaftar per hari penyerahan</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Satuan Penyerahan</strong></p>\r\n</td>\r\n<td>\r\n<p>20 ton dengan toleransi + 2%</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Posisi Wajib Lapor</strong></p>\r\n</td>\r\n<td>\r\n<p>150 lot</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>Batas Posisi</strong></p>\r\n</td>\r\n<td>\r\n<p>500 lot</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>', '2025-07-07 15:01:38', '2025-07-07 15:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_wakil_pialang`
--

CREATE TABLE `kategori_wakil_pialang` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '0001_01_01_000000_create_users_table', 1),
(11, '0001_01_01_000001_create_cache_table', 1),
(12, '0001_01_01_000002_create_jobs_table', 1),
(13, '2025_04_25_060913_create_kategori_wakil_pialangs_table', 1),
(14, '2025_04_25_062529_create_wakil_pialangs_table', 1),
(15, '2025_04_27_052036_create_jfxes_table', 1),
(16, '2025_04_27_114838_create_spas_table', 1),
(17, '2025_04_28_053826_create_beritas_table', 1),
(18, '2025_04_29_154000_create_profiles_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `spas`
--

CREATE TABLE `spas` (
  `id` bigint UNSIGNED NOT NULL,
  `image` text,
  `name` varchar(50) NOT NULL,
  `slug` text NOT NULL,
  `deskripsi` text NOT NULL,
  `specs` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `spas`
--

INSERT INTO `spas` (`id`, `image`, `name`, `slug`, `deskripsi`, `specs`, `created_at`, `updated_at`) VALUES
(1, 'spa/07072025_223049-686be829f04df-images (1).jpeg', 'AU1010_BBJ & AU10F_BBJ', 'au1010-bbj-au10f-bbj', 'Kontrak derivatif yang diperdagangkan di Bursa Berjangka Jakarta (JFX), berfokus pada pergerakan nilai tukar Dolar Australia (AUD) terhadap Dolar AS (USD). Keduanya dirancang untuk memberikan fleksibilitas bagi trader dalam memilih mata uang transaksi, yaitu IDR Tetap dan USD Mengambang.', '<h3 style=\"text-align: center;\"><strong>FOREX TRADE TABLE</strong></h3>\r\n<h4 style=\"text-align: center;\"><strong>AU10F_BBJ &nbsp;&amp; &nbsp;AU1010_BBJ</strong></h4>\r\n<table class=\"table-auto w-full border border-gray-300\" style=\"border-collapse: collapse; width: 100%; height: 431.064px; border-width: 1px; margin-left: auto; margin-right: auto;\" border=\"1\"><colgroup><col style=\"width: 33.3333%;\"><col style=\"width: 33.3333%;\"><col style=\"width: 33.3333%;\"></colgroup>\r\n<tbody>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 58.7814px; text-align: center; background-color: rgb(53, 152, 219); vertical-align: middle;\" rowspan=\"3\"><strong>SPESIFICATIONS</strong></td>\r\n<td style=\"height: 19.5938px; text-align: center; background-color: rgb(53, 152, 219); vertical-align: middle;\" colspan=\"2\"><strong>REMARKS</strong></td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; text-align: center; background-color: rgb(53, 152, 219); vertical-align: middle;\" colspan=\"2\"><strong>AUSTRALIAN DOLLAR</strong></td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"text-align: center; height: 19.5938px; background-color: rgb(53, 152, 219); vertical-align: middle;\" colspan=\"2\"><strong>AUD/USD</strong></td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\"><strong>Trade Code</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"center\" valign=\"BOTTOM\">AU10F_BBJ</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"center\" valign=\"BOTTOM\">&nbsp;AU1010_BBJ</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\"><strong>Rate</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\"><strong>Floating ( USD )</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\"><strong>( USD 1 = IDR 10.000 )</strong></td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\"><strong>Contract Size</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">AUD 100,000</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">AUD 100,000</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\"><strong>Trading Days</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">Senin - Jumat</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">Senin - Jumat</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\"><strong>Trading Hours</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"BOTTOM\">&nbsp;</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\">&nbsp;</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\"><strong>- Summer (Daylight Saving Time)</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">07:00-03:00 WIB</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">07:00-03:00 WIB</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\"><strong>- Winter</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">07:00-04:00 WIB</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">07:00-04:00 WIB</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\">&nbsp;</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">&nbsp;</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">&nbsp;</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\"><strong>Initial Margin for Daytrade</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">USD 1,000 / Lot</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">IDR 10.000.000 / Lot</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\"><strong>Initial Margin for Overnight</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">USD 2,000 / Lot</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">IDR 20.000.000 / Lot</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"vertical-align: middle; background-color: rgb(53, 152, 219); height: 19.5938px;\"><strong>&nbsp;</strong></td>\r\n<td style=\"vertical-align: middle; background-color: rgb(53, 152, 219); height: 19.5938px;\">&nbsp;</td>\r\n<td style=\"vertical-align: middle; background-color: rgb(53, 152, 219); height: 19.5938px;\">&nbsp;</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\"><strong>Facility Fee</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">USD15/Lot/Side</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">IDR 150.000/Lot/Side</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\"><strong>Rollover Fee For Buy/Sell</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">USD5/Lot/Night</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">IDR 50.000/Lot/Night</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\"><strong>Value Added Tax (VAT)*</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">11% of Commission Fee</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">11% of Commission Fee</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"vertical-align: middle; background-color: rgb(53, 152, 219); height: 19.5938px;\"><strong>&nbsp;</strong></td>\r\n<td style=\"vertical-align: middle; background-color: rgb(53, 152, 219); height: 19.5938px;\">&nbsp;</td>\r\n<td style=\"vertical-align: middle; background-color: rgb(53, 152, 219); height: 19.5938px;\">&nbsp;</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\"><strong>Maintenance Margin</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">70% of Initial Margin</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">70% of Initial Margin</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\"><strong>Auto Liquidation</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">30% of Initial Margin</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">30% of Initial Margin</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\">&nbsp;</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">&nbsp;</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">&nbsp;</td>\r\n</tr>\r\n<tr style=\"height: 19.5938px;\">\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\"><strong>Price Source</strong></td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">Telequote</td>\r\n<td style=\"height: 19.5938px; vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">Telequote</td>\r\n</tr>\r\n<tr>\r\n<td style=\"vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\"><strong>Price Guidance</strong></td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">Last Trade</td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">Last Trade</td>\r\n</tr>\r\n<tr>\r\n<td style=\"background-color: rgb(53, 152, 219); vertical-align: middle;\"><strong>&nbsp;</strong></td>\r\n<td style=\"background-color: rgb(53, 152, 219); vertical-align: middle;\">&nbsp;</td>\r\n<td style=\"background-color: rgb(53, 152, 219); vertical-align: middle;\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\"><strong>Minimum Price Spread Quote</strong></td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">4 pips/side</td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">4 pips/side</td>\r\n</tr>\r\n<tr>\r\n<td style=\"vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\"><strong>Hectic Price Spread Quote</strong></td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">Based on Market</td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">Based on Market</td>\r\n</tr>\r\n<tr>\r\n<td style=\"vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\"><strong>Minimum Price Movement</strong></td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">0.0001 pip (Tick value : USD 10)</td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">0.0001 pip (Tick value : USD 10)</td>\r\n</tr>\r\n<tr>\r\n<td style=\"vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\"><strong>Range for limit and stop order</strong></td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">20-2000 Points/pips</td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">20-2000 Points/pips</td>\r\n</tr>\r\n<tr>\r\n<td style=\"vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\" bgcolor=\"#f3f3f3\"><strong>Hectic Range Price For Limit &amp; Stop Order</strong></td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">Base On Market</td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\" bgcolor=\"#f3f3f3\">Base On Market</td>\r\n</tr>\r\n<tr>\r\n<td style=\"vertical-align: middle;\" align=\"LEFT\" valign=\"BOTTOM\"><strong>Delivery By</strong></td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">Cash Settlement</td>\r\n<td style=\"vertical-align: middle;\" align=\"CENTER\" valign=\"MIDDLE\">Cash Settlement</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style=\"text-align: justify;\">* Changes in VAT fees to 11% (Effective as of April 01<sup>st</sup>, 2022)</p>', '2025-07-07 15:12:58', '2025-07-08 03:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Faturrahman', 'Putra', 'faturrahman86.fr@gmail.com', NULL, '$2y$12$janu1iHakxjif.LH/EGQX.VYvNdEJfRDpCDhdo55IqPLGIHggzUci', NULL, NULL, '2025-07-07 14:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `wakil_pialangs`
--

CREATE TABLE `wakil_pialangs` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_izin` text NOT NULL,
  `status` enum('aktif','non-aktif') NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beritas`
--
ALTER TABLE `beritas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jfxes`
--
ALTER TABLE `jfxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_wakil_pialang`
--
ALTER TABLE `kategori_wakil_pialang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_wakil_pialang_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `spas`
--
ALTER TABLE `spas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wakil_pialangs`
--
ALTER TABLE `wakil_pialangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wakil_pialangs_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beritas`
--
ALTER TABLE `beritas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jfxes`
--
ALTER TABLE `jfxes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_wakil_pialang`
--
ALTER TABLE `kategori_wakil_pialang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spas`
--
ALTER TABLE `spas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wakil_pialangs`
--
ALTER TABLE `wakil_pialangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wakil_pialangs`
--
ALTER TABLE `wakil_pialangs`
  ADD CONSTRAINT `wakil_pialangs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `kategori_wakil_pialang` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
