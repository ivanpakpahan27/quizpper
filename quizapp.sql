-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for quizapp
CREATE DATABASE IF NOT EXISTS `quizapp` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `quizapp`;

-- Dumping structure for table quizapp.tbl_enroll
CREATE TABLE IF NOT EXISTS `tbl_enroll` (
  `enroll_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`enroll_id`),
  KEY `FK_tbl_enroll_tbl_student` (`student_id`),
  KEY `FK_tbl_enroll_tbl_subject` (`subject_id`),
  CONSTRAINT `FK_tbl_enroll_tbl_student` FOREIGN KEY (`student_id`) REFERENCES `tbl_student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_enroll_tbl_subject` FOREIGN KEY (`subject_id`) REFERENCES `tbl_subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table quizapp.tbl_enroll: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_enroll` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_enroll` ENABLE KEYS */;

-- Dumping structure for table quizapp.tbl_process
CREATE TABLE IF NOT EXISTS `tbl_process` (
  `process_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enroll_id` int(10) unsigned NOT NULL,
  `question` longtext NOT NULL,
  `first_answer` varchar(255) NOT NULL DEFAULT '',
  `second_answer` varchar(255) NOT NULL DEFAULT '',
  `third_answer` varchar(255) NOT NULL DEFAULT '',
  `fourth_answer` varchar(255) NOT NULL DEFAULT '',
  `fifth_answer` varchar(255) NOT NULL DEFAULT '',
  `correct_answer` int(11) DEFAULT NULL,
  `student_answer` varchar(255) NOT NULL DEFAULT '',
  `reason` longtext DEFAULT NULL,
  `marks` decimal(10,0) DEFAULT NULL,
  `question_image` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`process_id`),
  KEY `FK_tbl_process_tbl_enroll` (`enroll_id`),
  CONSTRAINT `FK_tbl_process_tbl_enroll` FOREIGN KEY (`enroll_id`) REFERENCES `tbl_enroll` (`enroll_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table quizapp.tbl_process: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_process` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_process` ENABLE KEYS */;

-- Dumping structure for table quizapp.tbl_question
CREATE TABLE IF NOT EXISTS `tbl_question` (
  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject_id` int(10) unsigned NOT NULL,
  `question` longtext NOT NULL,
  `first_answer` varchar(255) NOT NULL,
  `second_answer` varchar(255) NOT NULL,
  `third_answer` varchar(255) NOT NULL,
  `fourth_answer` varchar(255) NOT NULL,
  `fifth_answer` varchar(255) NOT NULL,
  `answer` int(11) NOT NULL,
  `reason` longtext NOT NULL,
  `marks` decimal(10,0) NOT NULL,
  `category` varchar(100) NOT NULL,
  `is_active` varchar(10) NOT NULL,
  `added_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `image_name` varchar(255) NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `FK_tbl_question_tbl_subject` (`subject_id`),
  CONSTRAINT `FK_tbl_question_tbl_subject` FOREIGN KEY (`subject_id`) REFERENCES `tbl_subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;

-- Dumping data for table quizapp.tbl_question: ~45 rows (approximately)
/*!40000 ALTER TABLE `tbl_question` DISABLE KEYS */;
INSERT INTO `tbl_question` (`question_id`, `subject_id`, `question`, `first_answer`, `second_answer`, `third_answer`, `fourth_answer`, `fifth_answer`, `answer`, `reason`, `marks`, `category`, `is_active`, `added_date`, `updated_date`, `image_name`) VALUES
	(127, 2, 'Udara di Bogor terasa dingin. (2) Kali ini dinginnya melebihi hari-hari sebelumnya. (3) Dinginnya suhu udara di Bogor mencapai 24ºC. (4) Data tingkat suhu udara ini, terdapat di papan informasi pengukur suhu di jalan-jalan besar di kota Bogor.\r\nDua kalimat pendapat pada teks tersebut ditandai dengan nomor ', '(1) dan (2) ', '(2) dan (3)', '(1) dan (3) ', '(2) dan (4)', '(3) dan (4)', 1, 'Kalimat pendapat merupakan kalimat berisi pendapat dan bersifat subjektif yang memiliki lebih dari satu kemungkinan kebenaran sesuai data pada teks.\r\nKata kunci: … ”terasa” (kalimat 1) dan ”melebihi ... sebelumnya” (kalimat .2)', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(128, 2, '(1) Pemkot Depok telah menertibkan 700 Pedagang Kaki Lima (PKL) yang menggelar dagangannya di pinggir jalan. (2) Hal ini dinilai sebagai penyebab kemacetan. (3) Di samping itu, keberadaan PKL juga dianggap menimbulkan kesan semrawut. (4) Penertiban yang berlangsung tanggal 26 Desember itu disambut dengan senang oleh para pengguna jalan.\r\n\r\nDua kalimat pendapat pada teks tersebut ditandai dengan nomor ....', '(1) dan (2)', '(1) dan (4)', '. (2) dan (3)', '(3) dan (4)', '(2) dan (4)', 3, 'Pendapat=opini adalah pikiran atau anggapan seseorang terhadap sesuatu. Orang yang satu dengan yang lain dapat berbeda pendapat bergantung pada pandangan, pendirian, atau penilaiannya.\r\nPada paragraf tersebut terdapat opini atau pendapat, yaitu kalimat (2) Hal ini dinilai sebagai penyebab kemacetan. (3) Di samping itu, keberadaan PKL juga dianggap menimbulkan kesan semrawut.', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(129, 2, ' Sulit meminta maaf dan sulit memberi maaf sesungguhnya merupakan sifat manusia pada umumnya. Namun, peluang untuk meminta maaf dan memberi maaf pastilah selalu ada. Jika setiap orang bersedia memberi maaf alangkah tenteram dan nikmatnya kehidupan di muka bumi ini. Lebih dari itu, apabila setiap orang sadar bahwa memberi maaf itu bahkan lebih mulia nilainya daripada meminta maaf.\r\nPendapat yang tepat sesuai paragraf di atas adalah . . . .', 'Memberi maaf dan meminta maaf merupakan sikap yang baik.', 'Meminta maaf lebih mulia daripada memberi.', 'Sulit bagi kita meminta maaf lebih dahulu.', 'Kita jangan meminta maaf jika tidak bersalah.', ' Meminta maaf lalu diam', 1, 'karena pada kalimat ”Jika setiap orang bersedia memberi maaf alangkah tenteram dan nikmatnya kehidupan di muka bumi ini .” menunjukkan bahwa Memberi maaf dan meminta maaf merupakan sikap yang baik.', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(130, 2, '(1) Selama Mei 2010 ini Aremania mengumpulkan dana sumbangan. (2) Dana itu digunakan untuk membeli bahan-bahan kebutuhan hidup, seperti beras, gula, teh, kopi, mie instan, dan lain-lain. (3) Setelah itu, bahan-bahan tersebut mereka bagi-bagikan ke berbagai panti asuhan. (4) Hal itu membuktikan, Aremania adalah suporter yang memiliki kepedulian sosial.\r\nGagasan utama paragraf diatas adalah . . .', '(1)', '(3)', '(2)', '(4)', '(1) dan (4)', 4, 'Gagasan utamanya adalah Aremania adalah suporter yang memiliki kepedulian sosial (4) karena kalimat ini diperjelas oleh kalimat-kalimat yang lain. Kalimat 1, 2, dan 3 adalah gagasan penjelas karena isinya memperjelas gagasan kalimat 4.', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(131, 2, 'Musim kompetisi 2006/2007 belum juga berakhir, tetapi Inter Milan sudah mendapatkan pemain baru. Adalah Ederson Honorato yang berhasil didatangkan juara Liga Italia musim lalu itu. Sebelumnya, penyerang asal Brasil itu memperkuat Nice. Ederson yang berusia 21 tahun itu bergabung dengan Nice dua musim lalu. Saat itu, Inter Milan sebenarnya sudah berniat membawanya ke Stadion San Siro, namun Nice lebih menjadi pilihan Ederson. Kalimat utama paragraf tersebut adalah ...', 'Musim kompetisi 2006/2007 belum juga berakhir, tetapi Inter Milan sudah mendapatkan pemain baru.', ' Ederson Honorato sebelumnya memperkuat Nice, berhasil didatangkan juara Liga lalu.', 'Ederson Honorato yang berusia 21 tahun itu bergabung dengan Nice dua musim lalu.', 'Inter Milan sebenarnya sudah berniat membawanya ke Stadion San Siro namun Nice lebih menjadi pilihan Ederson.', 'Inter Milan sebenarnya sudah berniat merekrut Ederson Honorato, tetapi baru tahun ini tercapai.', 1, 'Karena kalimat kedua dan seterusnya merupakan kalimat penjelas.', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(132, 2, 'Sebuah Negara perlu diatur dengan sistem pemerintahan yang dianggap bisa mengatasi dan mengayomi masyarakat.Salah satu sistem pemerintahan tersebut adalah demokrasi.Bagi Negara yang masyarakatnya berpendidikan cukup, sistem demokrasi bisa memajukan Negara.Namun, bagi Negara yang masih perlu pendidikan, demokrasi adalah suatu bencana.\r\nSimpulan paragraf tersebut adalah . . . .', 'Sistem pemerintahan bisa mengayomi masyarakat', ' Sistem pemerintahan adalah demokrasi', 'Sistem demokrasi memiliki kelemahan dan kelebihan', 'Sistem demokrasi bisa memajukan negara', ' Sistem pemerintahan lemah', 3, 'karena dalam kutipan di atas sistem demokrasi ditentukan oleh suatu negara itu.\r\nKarena disimpulkan dari fakta kalimat 2, 3, dan 4', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(133, 2, 'Kalimat majemuk bertingkat dengan anak kalimat pengganti subjek adalah….', 'Ayah seorang yang berjuang pada masa perang kemerdekaan.', 'Ibu mengunjungi keluarga yang membesarkannya.', 'Nenek tinggal di ibukota Negara Republik Indonesia.', 'Yang berpakaian seragam SMP itu,adik saya.', ' Ikan  dipancing oleh bapak', 4, 'Karena pada jawaban D “Yang berpakaian seragam SMP itu” pengganti dari adik.', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(134, 2, 'Kalimat yang menyatakan menyerupai adalah……', 'Rama senang bermain mobil-mobilan', 'Pukullah dia kuat-kuat', 'Rumah-rumah itu akan dijual', 'Ani membeli buah-buahan dipasar', 'Yadi berlari-lari di lapangan', 1, 'karena menyerupai mengendarai mobil.', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(135, 2, 'Kalimat yang menggunakan kata berimbuhan peN-an yang semakna dengan imbuhanpeN-an pada kata pembangunan adalah....', 'Berkas perkara pencemaran nama baik itu sudah dilimpahkan kepada pengadilan', 'Penggilingan padi satu-satunya di desa kami itu sudah lama tidak berfungsi', 'Supaya jernih, penyaringan minyak kelapa sawit itu harus dilakukan beberapa kali', 'Pada musim penghujan ini, pemukiman penduduk sudah tergenang air sedalam 50cm', 'Pemutusan hubungan kerja banyak terjadi di berbagai perusahaan akibat krisis moneter', 3, 'Imbuhan peN-an pada kata pembangunan pada kalimat tersaji bermakna proses (membangun)', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(136, 2, 'Kata bercetak miring dalam kalimat-kalimat berikut yang seharusnya diberi imbuhan ke-an adalah…', 'Karena hujan, semalam Doni demam.', 'Kami akan segera lanjut perjalanan.', 'Sahabat antara Ima dan Ria sudah retak.', ' Malam ini langit mandi cahaya bintang.', 'Ibu mengunjungi keluarga yang membesarkannya.', 1, 'Karena kata tersebut lebih logis dimasukki imbuhan ke-an.', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(137, 2, 'Imbuhan ter- yang menyatakan makna “dikenai tindakan secara tak sengaja” terdapat pada kalimat…', 'Anak dari Kotabaru itu pandai dan tidak mudah tertipu.', 'Tulisan budi tidak terbaca olehku.', 'Dalam kecelakaan itu, maman terlempar beberapa meter.', 'Semua orang tertampung di tenda pengungsian di lapangan.', 'Karena hujan, semalam Doni demam.', 3, 'karena dalam kalimat tersebut maman tidak sengaja terlempar karena kecelakaan.\r\n40. Imbuhan ter- ', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(138, 2, ' Imbuhan ter- yang bermakna “dalam keadaan di-“ terdapat pada kalimat…', 'Beberapa novel tertata rapi di rak buku.', 'Siswa terpandai di kelasku berasal dari Banjar.', 'Gula itu terlarut dalam air.', 'Anak itu tertidur di kursi ruang tamu.', 'Sahabat antara Ima dan Ria sudah retak.', 1, 'Karena dalam keadaan tata “Beberapa novel tertata rapi di rak buku”', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(139, 2, 'Kalimat yang mengandung makna konotasi positif adalah….', 'Penjahat itu telah mampus ditembakoleh polisi.', 'Bini Mang Udin telah melahirkan.', 'Istrinya yang belia telah mengandung.', 'Ibu Tinah sedang bunting tujuh bulan.', 'Karena hujan, semalam Doni demam.', 3, 'Konotasi positif merupakan kata yang berkonotasi baik.Kata istri dan mengandung~ berkonotasi baik.', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(140, 2, 'Kalimat yang menggunakan kata berkonotasi negatif adalah….', ' Sebagai seorang istri harus pandai menyenangkan suami.', 'Biaya pemakaman para korban bencana alam ditanggung pemerintah setempat.', 'Para wanita tuna susila bekerja akibat tuntutan kebutuhan ekonomi.', 'Selama meringkuk di penjara, Roy berubah menjadi pendiam.', 'Tulisan budi tidak terbaca olehku.', 4, 'Kata berkonotasi negatif adalah kata yang bermakna kasar atau tidak sopan.Kata “istri” dan “suami” konotasi positif.Kata”pemakaman” Konotasi positif.Kata”wanita tuna susila” konotasi positif.Kata “penjara” ~ bangunan tempat mengurung orang hukuman (bui)konotasi negatif.', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(141, 2, 'Minggu lalu Budi telah melaksanakan Ulangan semester Bahasa Indonesia, dan ternyata hasilnyapun Budi mendapatkan nilai merah.\r\nMakna kata yang bercetak miring adalah....', 'Bagus', 'Jelek', 'Sangat Baik', 'Cukup', 'Sesuai Standard', 2, 'Merah berarti saja dibawah standar kelulusan nilai.', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(142, 2, 'Kata-katamu sungguh pedas untuk didengar.\r\nKalimat diatas termasuk dalam perubahan makna kata?', 'Sinestesia\r\n', 'Generalisasi', 'Asosiasi', 'Spesialisasi', ' Peyorasi', 1, 'karena terdapat perubahan arti akibat pertukaran tanggapan antara dua indera\r\n    yang berlain yaitu Kata-katamu sungguh pedas untuk didengar.', 0, 'Indonesia', 'yes', '0000-00-00', '0000-00-00', ''),
	(143, 3, 'Hasil dari 4 log 8 + 4 log 32 adalah....', '5', '12', '4', '2', '15', 3, 'Ingat sifat algoritma: c log A + c log B= c log (A.B)\r\n\r\nMaka:\r\n\r\n4 log 8 + 4 log 32\r\n\r\n= 4 log (8.32)\r\n\r\n= 4 log 256\r\n\r\n= 4.', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(144, 3, 'Jika sin 23=m, maka cos 113= . . . .', '113', '-113', 'm', '-m', '90', 4, 'cos 113° = cos (90° + 23°)\r\n\r\ncos 113° = cos 90° . cos 23° - sin 90° . sin 23°\r\n\r\ncos 113° = 0 . cos 23° - 1 . sin 23°\r\n\r\ncos 113° = - sin 23°\r\n\r\ncos 113° = - m', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(145, 3, ' Pada sebuah segitiga ABC, diketahui sudut A =30∘,  sudut B =45∘, dan panjang sisi a =10 cm. Maka panjang sisi b......', '10', '10√2', '2', '2√10', '1', 2, 'Gunakan perbandingan berikut:\r\n\r\na/sin A = b/sinB\r\n\r\n10/ sin30 = b/sin 45\r\n\r\n10 / 1/2 = b / √2/2\r\n\r\nb = 10√2', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(146, 3, 'Dalam interval 0o ≤ x ≤ 360o. Nilai terkecil dari y = 5 cos (x + 60o) + 16 terjadi saat x = …', '120˚', '90˚', '80˚', '60˚', 'x', 1, 'y = 5 cos (x + 60˚) + 16 , 0˚ ≤ x ≤ 2π\r\n\r\nNilai minimum yang didapatkan:\r\n\r\ncos (x + 60˚) = -1\r\n\r\ncos (x + 60˚) = cos 180˚\r\n\r\nx + 60˚ = 180˚\r\n\r\nx = 180˚ - 60˚ = 120˚', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(147, 3, 'Persamaan kuadrat 2x^2 - 3x- 4= 0 mempunyai akar-akar X1 dan x2. Tentukan nilai X1 dan X2!', '2', '3', '-3', '1', '-2', 5, 'Diketahui: a = 2, b = -3, c = -4\r\n\r\nMaka:\r\n\r\nX1 = -b/\r\n\r\nX1 = - (-3)/2\r\n\r\nX1 = 3/2\r\n\r\ndan\r\n\r\nX2 = c/a\r\n\r\nX2 = -4/2\r\n\r\nX2 = -2', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(148, 3, 'Keliling kebun berbentuk persegi panjang adalah 72 m. Jika selisih panjang dan lebar 4 m, maka luas kebun tersebut adalah ....', '120 m²', '240 m²', '150 m²', '90 m²', '320 m²', 3, 'Diketahui K = 72 m dan P = 4 + L, maka:\r\n\r\nK = 2 (p+l)\r\n\r\n72 = 2 (4 + l + l)\r\n\r\n72 = 2(4 + 2l)\r\n\r\n72 = 8 + 4l\r\n\r\n64 = 4l\r\n\r\nl = 64/4\r\n\r\nl = 16 m\r\n\r\nmaka p = 4 + l = 4 + 16 = 20 m\r\n\r\nLuas = p × l\r\n\r\n= 20 × 16\r\n\r\n= 320 m²', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(149, 3, 'Himpunan Penyelesaian dari x2 – 2x – 8 = 0 adalah...', '(2,4)', '(-2,-4)', '(2,-4)', '(2)', '(-2,4)', 5, 'x² - 2x - 8 = 0\r\n\r\n(x + 2) ( x - 4)\r\n\r\n→ x + 2 = 0\r\n\r\nx = -2\r\n\r\n→ x - 4 = 0\r\n\r\nx = 4\r\n\r\nJadi, himpunan penyelesaiannya adalah (-2,4)', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(150, 3, 'Pada saat jam istirahat sekolah, Andi dan Deo bersama-sama pergi ke kantin sekolah. Andi membeli 3 buah roti dan 2 buah donat dengan harga seluruhnya Rp3.500,00.\r\nSementara itu, Deo membeli 4 buah roti dan 2 buah donat dengan harga seluruhnya Rp4.000,00, maka harga masing-masing roti dan donat adalah ....', 'Harga roti adalah Rp500,00 dan harga donat adalah Rp1.000,00', 'Harga roti adalah Rp1500,00 dan harga donat adalah Rp1.000,00', 'Harga roti adalah Rp500,00 dan harga donat adalah Rp1.500,00', 'Harga roti adalah Rp5000,00 dan harga donat adalah Rp1.000,00', 'Harga roti adalah Rp500,00 dan harga donat adalah Rp2.000,00', 1, 'Pemisalan: roti = x, donat = y, maka model matematika pernyataannya:\r\n\r\n3x + 2y = 3.500...... (i)\r\n\r\n4x + 2y = 4.000.......(ii)\r\n\r\nJadi, penyelesaian dari persamaan tersebut adalah:\r\n\r\n3x + 2y = 3.500\r\n\r\n4x + 2y = 4.000\r\n\r\n-----------------\r\n\r\n-x = -500\r\n\r\nx = 500\r\n\r\nUntuk mencari nilai y:\r\n\r\n3x + 2y = 3.500\r\n\r\n3(500) + 2y = 3.500\r\n\r\n1.500 + 2y = 3.500\r\n\r\n2y = 3.500-1.500\r\n\r\ny = 1.000\r\n\r\nMaka, harga roti adalah Rp500,00 dan harga donat adalah Rp1.000,00.', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(151, 3, 'Harga 2 koper dan 5 tas adalah Rp600.000,00, sedangkan harga 3 koper dan 2 tas adalah Rp570.000,00. harga sebuah koper dan 2 tas adalah.....', '280.000', '270.000', '160.000', '50.000', '170.000', 2, 'Pemisalan: koper = x, tas = y, maka model matematika dari kedua pernyataan tersebut adalah:\r\n2x + 5y = 600.000...... (i)\r\n\r\n3x + 2y = 570.000......(ii)\r\n\r\nMetode eliminasi:\r\n\r\n2x + 5y = 600.000.... (x3) = 6x + 15y = 1.800.000\r\n\r\n3x + 2y = 570.000....(x2) = 6x + 4y = 1.140.000\r\n\r\nMaka:\r\n\r\n11 y = 660.000\r\n\r\ny = 60.000\r\n\r\nMetode substitusi:\r\n\r\n2x + 5y = 600.000\r\n\r\n2x + 5(60.000) = 600.000\r\n\r\n2x = 600.000 - 300.000\r\n\r\nx = 150.000\r\n\r\nJadi, nilai dari x + 2y = 270.000.', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(152, 3, 'Diketahui terdapat suatu fungsi kuadrat a(x) = x2 – 3x + 6 dan b(x) = 5x – 8. Jika c(x) = a(x) + b(x), maka c(x) = ….', 'c(x) = x4 - 2x – 2', 'c(x) = x4 + 2x – 2', 'c(x) = x2 + 2x + 2', 'c(x) = x2 + 2x – 2', 'c(x) = x2 - 2x – 2', 4, 'c(x) = a(x) + b(x)\r\n\r\nc(x) = x2 – 3x + 6 +5x – 8\r\n\r\nc(x) = x2 + 2x – 2', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(153, 3, 'Tentukan persamaan garis yang bergradien -1 dan melalui titik (-2, 3).', 'y - 3 = -1{x - (-2)} atau y - 3 = -1{x + 2}\r\n\r\natau y - 3 = -1x -2 atau y = -x + 1', 'y - 3 = -1{x - (-2)} atau y - 3 = -1{x + 2}\r\n\r\natau y - 3 = -1x -2 atau y = -x + 2.', 'y - 3 = -1{x - (-2)} atau y - 3 = -1{x + 2}\r\n\r\natau y - 3 = -1x -1 atau y = -x + 1.', 'y - 3 = -1{x - (-2)} atau y - 3 = -2{x - 2}\r\n\r\natau y - 3 = -1x -2 atau y = -x + 1', 'y - 3 = -1{x - (-2)} atau y - 3 = -2{x + 2}\r\n\r\natau y - 3 = -1x -2 atau y = -x + 1', 1, 'Persamaan garis yang bergradien m dan melalui titik (x1, y1) adalah\r\n\r\ny - y1 = m(x - x1).\r\n\r\nJadi persamaan garis bergradien -1 dan melalui titik (-2, 3) adalah:\r\n\r\ny - 3 = -1{x - (-2)} atau y - 3 = -1{x + 2}\r\n\r\natau y - 3 = -1x -2 atau y = -x + 1.', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(154, 3, 'Diketahui f : A → B dan dinyatakan oleh rumus f (x) = 2x – 1. Jika daerah asal A ditetapkan A : {x | 0 € x € 4. x € R}. Tentukan f (0), f (1), f (2), f (3) dan f (4).', 'f (0) = 2.0 – 1 = -1\r\n\r\nf (1) = 2.1 – 1 = 1\r\n\r\nf (2) = 2.2 – 1 = 3\r\n\r\nf (3) = 2.3 – 1 = 5\r\n\r\nf (4) = 2.1 – 1 = 7', 'f (0) = 2.0 – 1 = 1\r\n\r\nf (1) = 2.1 – 1 = 1\r\n\r\nf (2) = 2.2 – 1 = 3\r\n\r\nf (3) = 2.3 – 1 = 5\r\n\r\nf (4) = 2.1 – 1 = 7', 'f (0) = 2.0 – 1 = -2\r\n\r\nf (1) = 2.1 – 1 = 1\r\n\r\nf (2) = 2.2 – 1 = 3\r\n\r\nf (3) = 2.3 – 1 = 5\r\n\r\nf (4) = 2.1 – 1 = 7', 'f (0) = 2.0 – 1 = -1\r\n\r\nf (1) = 2.1 – 1 = 1\r\n\r\nf (2) = 2.2 – 1 = 3\r\n\r\nf (3) = 2.3 – 1 = 2\r\n\r\nf (4) = 2.1 – 1 = 7', 'f (0) = 2.0 – 1 = -1\r\n\r\nf (1) = 2.1 – 1 = -1\r\n\r\nf (2) = 2.2 – 1 = 2\r\n\r\nf (3) = 2.3 – 1 = 5\r\n\r\nf (4) = 2.1 – 1 = 7', 1, 'Diketahui f (x) = 2x – 1, maka :\r\n\r\nf (0) = 2.0 – 1 = -1\r\n\r\nf (1) = 2.1 – 1 = 1\r\n\r\nf (2) = 2.2 – 1 = 3\r\n\r\nf (3) = 2.3 – 1 = 5\r\n\r\nf (4) = 2.1 – 1 = 7', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(155, 3, 'Sebuah perusahaan otomotif mengeluarkan produk mobil terbaru dan akan diuji kelayakan jalannya dengan cara dikendarai selama 10 jam. Pada 4 jam pertama mobil tersebut telah menempuh jarak 242 km dan setelah 6 jam mobil tersebut telah menempuh 362 km.', 'y = 60x + 1', 'y = 30x + 2', 'y = 60x + 2', 'y = 30x - 2', 'y = 60x - 2', 3, 'Untuk menyelesaikan soal di atas kita misalkan x sebagai waktu jalannya mobil (jam) dan y menyatakan jarak tempuh mobil (km) lalu persamaan garis lurus yang bentuk umumnya y=mx+c\r\n\r\nMaka, persamaan dari garis tersebut adalah y = 60x + 2.', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(156, 3, 'Jika suatu bak berbentuk prisma tegak ABCD.EFGH. Alas ABCD berbentuk persegi panjang dengan panjang 10cm dan lebar 6 cm, tinggi prisma 9 cm. Bak itu berisi air 32 nya. Maka volume air dalam bak adalah.....', '30 cm3', '360 cm3', '160 cm3', '120 cm3', '240 cm3', 2, 'Volume air bak = 2/3 x Lalas x tinggi\r\n\r\nVolume air bak = 2/3 x 10 x 6 x 9\r\n\r\nVolume air bak = 360 cm3', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(157, 3, 'Diketahui bujur sangkar ABCD dengan panjang AB=5cm. Panjang diagonal AC adalah.....', ' 5', ' 5√20', ' 5√2', ' √2', ' 50√2', 3, 'Untuk mencari AC dapat menggunakan √AB2 +CD2, maka:\r\n\r\nAC= √AB^2+CD^2\r\n\r\nAC = √5^2+ 5^2\r\n\r\nAC = √ 50\r\n\r\nAC = 5√2.', 0, 'Matematika', 'yes', '0000-00-00', '0000-00-00', ''),
	(158, 4, 'Dalam suatu ekspedisi telah ditemukan tumbuhan dengan ciri‐ciri sebagai berikut: tidak berkayu, berdaun menyirip, tidak berbunga, batang roset, daun muda menggulung. Jika Anda diminta untuk menduga, tumbuhan kelompok apakah yang Anda temukan tersebut?', 'Angiospermae', 'Monocotyledonae', 'Pteridophyta', ' Bryophyta', 'Gymnospermae', 3, 'Daun muda menggulung merupakan ciri-ciri yang mudah ditemui pada tumbuhan paku. Jadi, ciri-ciri di atas merupakan ciri khas Pteridophyta.', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(159, 4, 'Lapisan sel mati yang terdiri atas beberapa lapisan jaringan epidermis pada akar udara tanaman anggrek dan berfungsi sebagai jaringan penyimpanan air adalah…', 'kutikula', 'trikom', 'spina', 'velamen', 'sel litosit', 4, 'Kutikula adalah lapisan bukan sel yang berada di atas lapisan epidermis, dapat berupa permukaan yang halus, kasar, bergelombang, atau beralur.\r\nTrikomata (rambut‐rambut) membantu proses penyerapan air dan mencegah terjadinya penguapan yang berlebihan.\r\nSpina (duri) merupakan metamorfosis bagian-bagian pokok tumbuhan (daun, batang, dan akar).\r\nVelamen merupakan lapisan sel mati di bagian dalam jaringan epidermis pada akar gantung (akar udara) tumbuhan anggrek. Fungsi velamen sebagai alat penyimpan air.\r\nSel litosit adalah sel yang dindingnya mengalami penebalan secara sentripetal.', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(160, 4, 'Glikolisis adalah rangkaian reaksi pengubahan molekul glukosa menjadi asam piruvat dengan menghasilkan NADH dan ATP. Pernyataan yang termasuk sifat‐sifat glikolisis adalah…\r\n\r\n1) Glikolisis dapat berlangsung secara aerob maupun anaerob.\r\n\r\n2) Dalam glikolisis terdapat kegiatan enzimatis.\r\n\r\n3) ADP dan ATP berperan dalam pemindahan fosfat dari molekul satu ke molekul lain.\r\n\r\n4) Pelepasan air menghasilkan 2 molekul fosfoenol piruvat yang masing‐masing memiliki ikatan fosfat berenergi tinggi.', 'Jika (1), (2), dan (3) yang benar', 'Jika (1) dan (3) yang benar', 'ika (2) dan (4) yang benar', 'ika hanya (4) yang benar', 'Jika semuanya benar', 3, 'Pernyataan salah, karena pemecahan glukosa atau glikolisis terjadi secara anaerob dengan bantuan enzim.\r\nPernyataan benar, dalam glikolisis terdapat kegiatan enzimatis dan Adenosine Trifosfat (ATP), serta Adenosine Difosfat (ADP).\r\nPernyataan benar, ADP dan ATP berperan dalam pemindahan fosfat dari molekul satu ke molekul lainnya.\r\nPernyataan benar, dengan pertolongan enzim enolase dan ion Mg++, maka asam‐2‐fosfogliserat melepaskan H2O dan menjadi asam‐2‐fosfoenolpiruvat.\r\nJadi, pernyataan 2,3 dan 4 yang benar.', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(161, 4, 'Proto-onkogen dapat berubah menjadi onkogen yang menyebabkan kanker.\r\n\r\nSEBAB\r\n\r\nDalam keadaan normal, proto-onkogen membantu meregulasi pembelahan sel.\r\n\r\nPilihlah:', 'Jika pernyataan benar, alasan benar, dan keduanya menunjukkan hubungan sebab akibat', 'Jika pernyataan benar, alasan benar, tetapi keduanya tidak menunjukkan hubungan sebab akiba', 'Jika pernyataan benar dan alasan salah', 'Jika pernyataan salah dan alasan benar', 'Jika pernyataan dan alasan keduanya salah', 2, 'Pernyataan benar. Kanker merupakan gangguan yang terjadi pada sel-sel normal yang membelah tak terkendali. Dari segi genetik, satu di antara penyebab kanker yaitu adanya mutasi proto-onkogen menjadi onkogen sehingga sel membelah terus-menerus.\r\nAlasan benar. Proto-onkogen dalam keadaan normal berfungsi dalam pembelahan sel.\r\nKeduanya tidak berhubungan. Penyebab mutasi proto-onkogen menjadi onkogen yang bisa menyebabkan kanker terjadi karena sinar UV, senyawa karsinogenik, atau bahkan umur.', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(162, 4, 'Pada klasifikasi Paramecium yang dilakukan secara molekular, para ahli menggunakan parameter genetik yang dimilikinya. Informasi genetik dalam Paramecium terkandung dalam…', 'mikronukleus', 'makronukleus', 'mitokondria', 'plastida', 'mikronukleus dan makronukle', 5, 'Paramecium termasuk kingdom protista yang menyerupai hewan (protozoa) dan telah memiliki selubung inti sel (eukariotik). Protista ini memiliki dua inti sel yaitu mikronukleus dan makronukleus. Keduanya berfungsi untuk menyimpan materi genetik.', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(163, 4, 'Pernyataan yang benar untuk menunjukkan bahwa Hydra merupakan hasil evolusi tumbuhan pada masa lalu adalah .......', 'mempunyai struktur tubuh yang sama dengan tumbuhan', 'berkembang biak secara vegetatif dengan tunas', 'hidup sebagai polip pada dasar perairan', 'lapisan terluar dari sel tubuhnya dari zat selulosa', 'hanya dapat hidup di air tawar saja', 3, '- Hidup sebagai polip (livi khusus)\r\n- Berkembangbiak dengan vegetatif dan generatif atau seksual dan aseksual yang disebuthermafrodit.\r\n- Memiliki daya regenerasi yang tinggi artinya bilatubuh/bagian tubuh indra ada yang terpotong, maka akan segera terbentuk bagian yang hilang.', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(164, 4, 'Penggunaan bahan bakar fosil yang berlebihan selain membuat persediaan sumber energi semakin menipis juga dapat menimbulkan pencemaran udara seperti global warming yang dapat menimbulkan dampak, seperti:\r\n\r\nNaiknya permukaan air laut yang dapat menyebabkan tenggelamnya beberapa daratan yang letaknya rendah.\r\nBeberapa spesies invasif berkembang pesat yang berdampak pada lingkungan sekitarnya.\r\nKetidakstabilan iklim yang salah satunya berdampak pada penurunan hasil produk pertanian\r\nPemutihan karang yang menyebabkan kerusakan dan kematian terumbu karang', '1,3 benar', '1,2,3 benar', '2,4 benar', 'hanya 4 yang benar', 'semuanya benar', 5, 'Es meleleh di seluruh dunia, terutama di kutub bumi, mencakup gletser di pegunungan, lapisan es yang menyelimuti Antartika barat dan Greenland, serta es lautan Arktik.\r\nBanyak spesies yang telah terdampak kenaikan suhu. Misalnya peneliti bernama Bill Fraser telah melacak penurunan populasi penguin Adelie di Antartika yang jumlahnya menyusut dari 32 ribu pasang menjadi 11 ribu dalam 30 tahun.\r\nPermukaan air laut meningkat lebih cepat selama abad terakhir\r\nBeberapa spesies kupu-kupu, rubah, dan tanaman alpin telah berpindah lebih jauh ke utara atau ke daerah yang lebih tinggi dan dingin.\r\nPresipitasi (hujan dan salju) telah meningkat secara rata-rata di seluruh dunia\r\nBeberapa spesies invasif berkembang pesat. Contohnya populasi kumbang kulit cemara meledak di Alaska berkat 20 tahun musim panas yang hangat. Serangga ini telah menyerang lebih dari 4 juta hektar pohon cemara.\r\nPemutihan karang akibat meningkatkan suhu air laut yang berdampak pada kerusakan dan kematian terumbu karang.', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(165, 4, 'Pengangkutan pada tumbuhan dapat dilakukan secara vasikuler dan ekstravasikuler. Adapun pengangkutan ekstravasikuler dapat dilakukan secara simplas dan apoplas. Pernyataan yang tepat mengenai pengangkutan tersebut adalah…', 'Pengangkutan simplas tergolong pengangkutan aktif', 'Pengangkutan simplas tergolong pengangkutan yang melibatkan selaput impermeabel', 'Simplas dan apoplas tergolong pengangkutan pasif', 'Simplas dan apoplas tergolong pengangkutan aktif', 'Pengangkutan simplas melibatkan ruang antar sel sedangkan apoplas melibatkan plasmodesma', 3, 'Simplas dan apoplas tergolong pengangkutan pasif atau tidak menggunakan energi. Adapun perbedaannya adalah pengangkutan simplas melibatkan plasmodesma, sedangkan apoplas melibatkan ruang antar sel.', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(166, 4, 'Pernyataan yang tidak berkaitan dengan lisosom…', 'Dibentuk oleh badan golgi dan retikulum endoplasma', 'Dapat berperan dalam peremajaan sel', 'Mengandung enzim hidrolisis', 'Dibedakan menjadi lisosom primer dan lisosom sekunder', 'Berfungsi untuk autolisis, autofage, dan auto repair', 5, 'Lisosom dibentuk oleh badan golgi dan retukulum endoplasma\r\nLisosom berperan dalam peremajaan sel karena menghancurkan komponen atau partikel yang tidak berguna, organel yang telah tua atau rusak\r\nLisosom mengandung enzim hidrolisis yang berperan untuk pencernaan intrasel\r\nLisosom dibedakan menjadi dua, yaitu lisosom primer (belum terlibat dalam kegiatan sel atau lisosom yang baru terbentuk) dan lisosom sekunder (lisosom yang sudah terlibat pencernaan sel).\r\nLisosom berfungsi untuk autolisis atau penghancuran diri sendiri, autofag, mencerna partikel atau komponen yang tidak berguna, dan apoptosis atau kematian sel.', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(167, 4, 'Pertumbuhan sekunder hasil aktivitas kambium intravasikuler dapat menyebabkan batang merekah. Untuk memperkuat batang tersebut, akan dibentuk jaringan..', 'Felogen', 'Felem', 'Feloderma', 'Periderm', 'Sklerenkim', 4, 'Pertumbuhan sekunder adalah hasil aktivitas kambium intravasikular yang bisa menyebabkan batang merekah. Untuk membuat batang menjadi kuat, dibentuk jaringan periderm yang meliputi felem (gabus), felogen (kambium gabus), dan feloderma.', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(168, 4, 'Linnaria marocanna berbatang tinggi (Tt) berbunga merah (Aabb) disilangkan dengan Linnaria marocanna tinggi (Tt) berbunga ungu (AaBb). Berapa persen keturunan yang berbatang rendah dan berbunga putih?', '3,13%', '6,25%', '12,5%', '25%', '37,5%', 2, 'P batang tinggi (Tt) x batang tinggi (Tt)\r\nDidapatkan TT (tinggi), Tt (tinggi), Tt (tinggi), tt (rendah)\r\nBatang rendah: ¼\r\n\r\nP: merah Aabb x ungu AaBb\r\nDidapatkan hasil: AABb (ungu), Aabb (merah), AABb (ungu), Aabb (merah), AaBb (ungu), Aabb (merah), Aabb (merah), aaBb (putih), aabb (putih)\r\nputih 2/8 = ¼\r\nKemungkinan fenotip berbatang rendah berbunga putih = ¼ . ¼ = 1/16 x 100% = 6,25%', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(169, 4, 'Produk pangan yang merupakan hasil fermentasi bakteri Lactobacillus adalah…\r\n\r\nKefir\r\nTerasi\r\nTempoyak\r\nAngciu', 'jika 1,2,3 benar', 'jika 1 dan 3 benar', 'Jika 2 dan 4 benar', 'Jika hanya 4 yang benar', 'Jika semua pilihan jawaban benar', 1, 'Angciu adalah arak merah yang biasanya dimanfaatkan untuk mengolah seafood pada hidangan kuliner China. Angciu didapatkan dari fermentasi ketan putih dan ragi.', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(170, 4, 'Suatu perkebunan membutuhkan tanaman yang memiliki kemampuan atau daya tahan terhadap serangan hama dan penyakit. Teknik bioteknologi yang dapat dilakukan untuk memenuhi kebutuhan tersebut adalah dengan membuat:', 'Kloning transfer inti', 'Tanaman transgenik', 'Kultur jaringan', 'Kloning embrio', 'Hibridoma', 2, 'tanaman transgenik memiliki sifat tolerans terhadap zat kimia tertentu, tahan terhadap hama dan penyakit tertentu, dan mempunyai sifat-sifat khusus yang dapat menguntungkan petani.', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', ''),
	(171, 4, 'Tumpahan minyak di lautan akibat kebocoran kapal tanker dapat menyebabkan permukaan laut tertutup minyak. Kondisi ini dapat menghalangi fotosintesis plankton, selanjutnya menyebabkan rantai makanan terputus. Apakah memungkinkan terjadinya evolusi dalam ekosistem dalam jangka waktu lama?', 'Ya, perubahan lingkungan mempengaruhi perubahan cara adaptasi individu', 'Ya, perubahan lingkungan dapat mempercepat kejadian mutasi.', 'Ya, fotosintesis plankton tergeser menjadi kemosintesis.', 'Tidak, perubahan lingkungan tidak mempengaruhi cara adaptasi individu', 'Tidak, perubahan lingkungan tidak menyebabkan mutasi', 1, 'eadaan tumpahan minyak di lautan akan mempengaruhi pola kehidupan organisme laut sehingga membuatnya harus beradaptasi, mutasi, atau bahkan terjadi rekombinasi pada gen organisme laut.\r\n\r\nDalam jangka waktu yang lama, hal itu akan mengubah komposisi genetik organisme di daerah tumpahan minyak tersebut sehingga terjadi suatu evolusi. Dengan demikian, perubahan lingkungan mempengaruhi perubahan cara adaptasi individu organisme di dalamnya', 0, 'Biologi', 'yes', '0000-00-00', '0000-00-00', '');
/*!40000 ALTER TABLE `tbl_question` ENABLE KEYS */;

-- Dumping structure for table quizapp.tbl_result
CREATE TABLE IF NOT EXISTS `tbl_result` (
  `result_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `student_answer` int(11) unsigned NOT NULL,
  `right_answer` int(11) unsigned NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`result_id`),
  KEY `FK_tbl_result_tbl_question` (`question_id`),
  KEY `FK_tbl_result_tbl_student` (`student_id`),
  CONSTRAINT `FK_tbl_result_tbl_question` FOREIGN KEY (`question_id`) REFERENCES `tbl_question` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tbl_result_tbl_student` FOREIGN KEY (`student_id`) REFERENCES `tbl_student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

-- Dumping data for table quizapp.tbl_result: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_result` ENABLE KEYS */;

-- Dumping structure for table quizapp.tbl_result_summary
CREATE TABLE IF NOT EXISTS `tbl_result_summary` (
  `summary_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(10) unsigned NOT NULL,
  `marks` decimal(10,2) NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`summary_id`),
  KEY `FK_tbl_result_summary_tbl_student` (`student_id`),
  CONSTRAINT `FK_tbl_result_summary_tbl_student` FOREIGN KEY (`student_id`) REFERENCES `tbl_student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Dumping data for table quizapp.tbl_result_summary: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_result_summary` DISABLE KEYS */;
INSERT INTO `tbl_result_summary` (`summary_id`, `student_id`, `marks`, `added_date`) VALUES
	(35, 1, 5.00, '2022-10-17'),
	(36, 1, 1.00, '2022-10-17'),
	(37, 1, 1.00, '2022-10-17');
/*!40000 ALTER TABLE `tbl_result_summary` ENABLE KEYS */;

-- Dumping structure for table quizapp.tbl_student
CREATE TABLE IF NOT EXISTS `tbl_student` (
  `student_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject_id` int(10) DEFAULT 0,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `is_active` varchar(10) NOT NULL,
  `role` enum('student','teacher') NOT NULL,
  `added_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `image_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `username` (`username`),
  KEY `FK_tbl_student_tbl_subject` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- Dumping data for table quizapp.tbl_student: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_student` DISABLE KEYS */;
INSERT INTO `tbl_student` (`student_id`, `subject_id`, `first_name`, `last_name`, `email`, `username`, `password`, `contact`, `gender`, `is_active`, `role`, `added_date`, `updated_date`, `image_name`) VALUES
	(1, 1, 'Student', 'Thapa', 'student@gmail.com', 'student', 'student', '98367253', 'male', 'no', 'student', '2017-06-27', '2022-10-13', NULL),
	(20, 2, 'zdfg', 'Pakpahan', 'ivanpakpahanchrst@gmail.com', 'dfbdfb', 'rtr', 'uoi;', 'male', 'yes', 'student', '2022-10-17', '0000-00-00', NULL);
/*!40000 ALTER TABLE `tbl_student` ENABLE KEYS */;

-- Dumping structure for table quizapp.tbl_subject
CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `subject_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` int(10) unsigned NOT NULL,
  `enroll_token` varchar(10) NOT NULL DEFAULT '',
  `subject_name` varchar(150) NOT NULL,
  `time_duration` int(11) NOT NULL,
  `total_question` int(11) DEFAULT NULL,
  `mark_right` int(11) DEFAULT NULL,
  `mark_false` int(11) DEFAULT NULL,
  `qns_per_set` int(11) NOT NULL,
  `total_english` int(10) unsigned NOT NULL,
  `total_math` int(10) unsigned NOT NULL,
  `is_active` varchar(10) NOT NULL,
  `added_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`subject_id`) USING BTREE,
  KEY `FK_tbl_subject_tbl_teacher` (`teacher_id`),
  CONSTRAINT `FK_tbl_subject_tbl_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `tbl_teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table quizapp.tbl_subject: ~7 rows (approximately)
/*!40000 ALTER TABLE `tbl_subject` DISABLE KEYS */;
INSERT INTO `tbl_subject` (`subject_id`, `teacher_id`, `enroll_token`, `subject_name`, `time_duration`, `total_question`, `mark_right`, `mark_false`, `qns_per_set`, `total_english`, `total_math`, `is_active`, `added_date`, `updated_date`, `start_time`, `end_time`, `file`) VALUES
	(2, 1, 'S2', 'Quiz2', 180, 10, 2, 1, 5, 1, 4, 'yes', '2017-04-04', '2022-10-17', '2022-11-02 01:02:28', '2022-11-02 01:02:36', NULL),
	(3, 1, 'S3', 'Quiz3', 180, 10, 2, 1, 5, 5, 5, '', '0000-00-00', '0000-00-00', '2022-11-02 01:02:37', '2022-11-02 01:02:39', NULL),
	(4, 2, 'S4', 'Quiz4', 180, 10, 2, 1, 8, 6, 6, '', '0000-00-00', '2022-11-02', '2022-11-02 01:02:40', '2022-11-02 01:02:41', NULL),
	(10, 1, '', 'Mathematics Technique', 1, NULL, NULL, NULL, 3, 3, 4, 'yes', '2022-11-04', '0000-00-00', NULL, NULL, NULL),
	(12, 1, '', 'Mathematics Technique 3', 1, NULL, NULL, NULL, 3, 5, 4, 'yes', '2022-11-04', '0000-00-00', NULL, NULL, NULL),
	(15, 1, 'ge2K6F', 'Mathematics s', 1, 0, 2, 1, 3, 2, 2, 'yes', '2022-11-04', '0000-00-00', '2022-11-04 11:12:00', '2022-11-05 11:12:00', NULL),
	(18, 1, 'k4sixF', 'Mathematics', 1, 0, 0, 11, 3, 2, 3, 'yes', '2022-11-06', '0000-00-00', '2022-11-06 17:44:00', '2022-11-06 17:44:00', NULL);
/*!40000 ALTER TABLE `tbl_subject` ENABLE KEYS */;

-- Dumping structure for table quizapp.tbl_teacher
CREATE TABLE IF NOT EXISTS `tbl_teacher` (
  `teacher_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `added_date` date NOT NULL,
  `updated_date` date NOT NULL,
  `image_name` varchar(255) NOT NULL,
  PRIMARY KEY (`teacher_id`) USING BTREE,
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table quizapp.tbl_teacher: ~2 rows (approximately)
/*!40000 ALTER TABLE `tbl_teacher` DISABLE KEYS */;
INSERT INTO `tbl_teacher` (`teacher_id`, `name`, `email`, `username`, `password`, `contact`, `added_date`, `updated_date`, `image_name`) VALUES
	(1, 'Vijay Thapa Online Exam System', 'hi@vijaythapa.com', 'admin', '0192023a7bbd73250516f069df18b500', '9866296009', '2017-04-03', '2020-12-26', ''),
	(2, 'Dudung', 'hi@vijaythapa.com', 'dudung', '0192023a7bbd73250516f069df18b500', '33323', '2022-10-20', '2022-10-20', '');
/*!40000 ALTER TABLE `tbl_teacher` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
