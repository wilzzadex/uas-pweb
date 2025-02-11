/*
 Navicat Premium Data Transfer

 Source Server         : CONTABO - ZADEXNET
 Source Server Type    : MySQL
 Source Server Version : 90100 (9.1.0)
 Source Host           : localhost:3306
 Source Schema         : rasabersama

 Target Server Type    : MySQL
 Target Server Version : 90100 (9.1.0)
 File Encoding         : 65001

 Date: 11/02/2025 18:41:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Sehari Hari', 'sehari-hari');
INSERT INTO `categories` VALUES (2, 'Cepat Saji', 'cepat-saji');
INSERT INTO `categories` VALUES (3, 'Sehat', 'sehat');
INSERT INTO `categories` VALUES (4, 'Tradisional', 'tradisional');
INSERT INTO `categories` VALUES (5, 'Minuman', 'minuman');

-- ----------------------------
-- Table structure for recipe_comment
-- ----------------------------
DROP TABLE IF EXISTS `recipe_comment`;
CREATE TABLE `recipe_comment`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `recipe_id` int NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `rating` int NULL DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC, `recipe_id` ASC, `user_id` ASC) USING BTREE,
  INDEX `recipe_comment_ibfk_1`(`recipe_id` ASC) USING BTREE,
  INDEX `recipe_comment_ibfk_2`(`user_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of recipe_comment
-- ----------------------------
INSERT INTO `recipe_comment` VALUES (17, 12, 3, 2, 'Siip', '2025-02-10 07:48:46', NULL);
INSERT INTO `recipe_comment` VALUES (18, 12, 3, 5, 'mantap sekali inii', '2025-02-10 07:53:29', NULL);
INSERT INTO `recipe_comment` VALUES (19, NULL, NULL, NULL, NULL, '2025-02-10 12:24:55', NULL);
INSERT INTO `recipe_comment` VALUES (20, NULL, NULL, NULL, NULL, '2025-02-10 12:24:59', NULL);
INSERT INTO `recipe_comment` VALUES (21, NULL, NULL, NULL, NULL, '2025-02-10 12:25:09', NULL);
INSERT INTO `recipe_comment` VALUES (22, NULL, NULL, NULL, NULL, '2025-02-10 14:59:45', NULL);
INSERT INTO `recipe_comment` VALUES (23, NULL, NULL, NULL, NULL, '2025-02-11 06:46:58', NULL);
INSERT INTO `recipe_comment` VALUES (24, 11, 3, 5, 'Mantap sedap', '2025-02-11 11:16:53', NULL);
INSERT INTO `recipe_comment` VALUES (25, 14, 3, 4, 'Seger', '2025-02-11 11:17:08', NULL);

-- ----------------------------
-- Table structure for recipe_directions
-- ----------------------------
DROP TABLE IF EXISTS `recipe_directions`;
CREATE TABLE `recipe_directions`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `recipe_id` int NULL DEFAULT NULL,
  `step` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC, `recipe_id` ASC) USING BTREE,
  INDEX `recipe_id`(`recipe_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of recipe_directions
-- ----------------------------
INSERT INTO `recipe_directions` VALUES (12, 11, 'Rebus daging sapi selama 1 jam, masukan bahan\" di atas hingga air menyusut,lalu masak menggunakan minyak dan masak sekitar 10menit');
INSERT INTO `recipe_directions` VALUES (14, 12, 'Bakar ayam yang sudah direbus menggunakan bumbu instan,setelah 15 menit oleskan bumbu basah di atas ayam,lalu bakar sekitar 20menit dan ayam pun siap disajikan');
INSERT INTO `recipe_directions` VALUES (15, 13, 'Rebus santan, gula pasir, garam sampai gula garam larut, lalu dinginkan.');
INSERT INTO `recipe_directions` VALUES (16, 13, 'Campur tepung beras dan tapioka, aduk rata.');
INSERT INTO `recipe_directions` VALUES (17, 13, 'Masukkan santan ke bahan kering dalam 3 tahap, setiap masuk aduk sampai rata dulu, baru masukkan lagi.');
INSERT INTO `recipe_directions` VALUES (18, 13, 'Olesi cetakan kue mangkok dengan minyak tipis-tipis saja.');
INSERT INTO `recipe_directions` VALUES (19, 13, 'Kukus cetakan di dalam kukusan yang sudah dipanaskan sebelumnya dengan api sedang cenderung besar, selama 1 menit saja.');
INSERT INTO `recipe_directions` VALUES (20, 13, 'Tuang adonan ke dalam cetakan tigaperempat bagian, tidak usah full.');
INSERT INTO `recipe_directions` VALUES (21, 13, 'Kukus dengan api sedang cenderung besar selama 15 menit.');
INSERT INTO `recipe_directions` VALUES (22, 13, 'Setelah matang kue didinginkan dulu dan sisihkan.');
INSERT INTO `recipe_directions` VALUES (23, 14, 'Siapkan panci masukkan bubuk agar, gula, dan air 700ml aduk hingga rata lalu nyala kan api aduk hingga mendidih');
INSERT INTO `recipe_directions` VALUES (24, 14, 'Siapkan es batu lalu Setelah agar² matang masukkan es batu ke dalam agar dalam keadaan masih panas, aduk aduk² (saya pakai garpu) aduk hingga agar membentuk lumut');
INSERT INTO `recipe_directions` VALUES (25, 14, 'Masukkan susu uht, skm dan masukkan juga potongan buah mangga. Aduk², es lumut mangga siap di sajikan');
INSERT INTO `recipe_directions` VALUES (26, 15, 'Dalam mangkuk, campur ayam dengan putih telur dan Royco Kaldu Ayam. Aduk hingga rata. Diamkan selama 15 menit.');
INSERT INTO `recipe_directions` VALUES (27, 15, 'Panaskan minyak, goreng ayam hingga matang kecokelatan. Angkat dan tiriskan.');
INSERT INTO `recipe_directions` VALUES (28, 15, 'Panaskan minyak, goreng ayam hingga matang kecokelatan. Angkat dan tiriskan.');
INSERT INTO `recipe_directions` VALUES (31, 16, 'Wedang Jahe Teh: Didihkan air. Masukkan jahe merah, masak di atas api kecil hingga meresap selama sekitar 30 menit. angkat. Celupkan teh SariWangi Teh Asli, diamkan selama 10 menit. Masukkan madu, aduk rata. Saring dan tuang ke gelas saji.');
INSERT INTO `recipe_directions` VALUES (32, 17, 'Cuci ayam fillet menggunakan air bersih dan tap tap pelan dengan tisu');
INSERT INTO `recipe_directions` VALUES (33, 17, 'Bumbui ayam(bolak balik rata) dengan lada,merica,kaldu jamur. atau dapat juga ditambah bumbu paprika');
INSERT INTO `recipe_directions` VALUES (34, 17, 'Tuang 1sdt minyak wijen ke panci dan panaskan. lalu masukkan dada ayam tersebut dan tekan pelan pelan menggunakan spatula sekitar ±5 menit (tolong cek agar tidak gosong karena ini tergantung kompor yang kita pakai:(). kemudian balik dan lakukan hal yang sama. seelah matang sisihkan');
INSERT INTO `recipe_directions` VALUES (35, 17, '(tanpa minyak) masukkan kentang, dan sayuran beku lalu tumis hingga matang. (tomat juga boleh ditumis jika ingin:D)');
INSERT INTO `recipe_directions` VALUES (36, 17, 'Plating dada ayam dan sayuran tadi lalu makanan siap disajikan:3');

-- ----------------------------
-- Table structure for recipe_ingredients
-- ----------------------------
DROP TABLE IF EXISTS `recipe_ingredients`;
CREATE TABLE `recipe_ingredients`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `recipe_id` int NULL DEFAULT NULL,
  `item` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC, `recipe_id` ASC) USING BTREE,
  INDEX `recipe_id`(`recipe_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 58 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of recipe_ingredients
-- ----------------------------
INSERT INTO `recipe_ingredients` VALUES (24, 11, 'Daging sapi,Kemiri,Garam,ketumbar,bawang merah');
INSERT INTO `recipe_ingredients` VALUES (26, 12, 'Ayam 1 potong,Kecap,bawang,saos dan sambal ');
INSERT INTO `recipe_ingredients` VALUES (27, 13, '125 gr gula pasir (manisnya tidak terlalu manis)');
INSERT INTO `recipe_ingredients` VALUES (28, 13, '135 gr tapioka');
INSERT INTO `recipe_ingredients` VALUES (29, 13, '50 gr tepung beras');
INSERT INTO `recipe_ingredients` VALUES (30, 13, '350 ml santan');
INSERT INTO `recipe_ingredients` VALUES (31, 13, '8 lbr daun pandan untuk jus (bisa ganti dengan pasta pandan)');
INSERT INTO `recipe_ingredients` VALUES (32, 13, '1/4 sdt garam');
INSERT INTO `recipe_ingredients` VALUES (33, 14, '1 bks nutrijel Mangga 30gr');
INSERT INTO `recipe_ingredients` VALUES (34, 14, '250 ml susu uht');
INSERT INTO `recipe_ingredients` VALUES (35, 14, '3 sachet kental manis putih');
INSERT INTO `recipe_ingredients` VALUES (36, 14, '100 gr gula pasir/sesuai selera');
INSERT INTO `recipe_ingredients` VALUES (37, 14, '1 plastik es batu');
INSERT INTO `recipe_ingredients` VALUES (38, 14, '700 ml air');
INSERT INTO `recipe_ingredients` VALUES (39, 14, '1 bh mangga (potong potong kecil)');
INSERT INTO `recipe_ingredients` VALUES (40, 15, '8 butir bawang merah, iris tipis');
INSERT INTO `recipe_ingredients` VALUES (41, 15, '2 siung bawang putih, iris tipis');
INSERT INTO `recipe_ingredients` VALUES (42, 15, '5 buah cabai rawit, iris tipis');
INSERT INTO `recipe_ingredients` VALUES (43, 15, '2 siung bawang putih, iris tipis');
INSERT INTO `recipe_ingredients` VALUES (48, 16, '750 ml air');
INSERT INTO `recipe_ingredients` VALUES (49, 16, '150 g jahe merah, cuci bersih, bakar, memarkan');
INSERT INTO `recipe_ingredients` VALUES (50, 16, '1 kantung SariWangi Teh Asli ');
INSERT INTO `recipe_ingredients` VALUES (51, 16, '2 sdm madu');
INSERT INTO `recipe_ingredients` VALUES (52, 16, 'Wedang Jahe Jeruk: Panaskan Buavita Orange dan jahe di atas api kecil hingga meresap ±15-20 menit, angkat. Tuang ke dalam gelas saji, sajikan dengan bunga lawang.');
INSERT INTO `recipe_ingredients` VALUES (53, 17, '1 dada ayam fillet');
INSERT INTO `recipe_ingredients` VALUES (54, 17, '1 handful sayuran beku');
INSERT INTO `recipe_ingredients` VALUES (55, 17, '3 baby potatoes atau tambah sesuai selera');
INSERT INTO `recipe_ingredients` VALUES (56, 17, '1/2 baby tomato atau sesuai selera');
INSERT INTO `recipe_ingredients` VALUES (57, 17, '1 sdt minyak wijen');

-- ----------------------------
-- Table structure for recipe_likes
-- ----------------------------
DROP TABLE IF EXISTS `recipe_likes`;
CREATE TABLE `recipe_likes`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `recipe_id` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC, `user_id` ASC, `recipe_id` ASC) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  INDEX `recipe_id`(`recipe_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of recipe_likes
-- ----------------------------
INSERT INTO `recipe_likes` VALUES (17, 5, 11, NULL);
INSERT INTO `recipe_likes` VALUES (18, 5, 12, NULL);
INSERT INTO `recipe_likes` VALUES (21, 3, 12, NULL);
INSERT INTO `recipe_likes` VALUES (22, 3, 13, NULL);
INSERT INTO `recipe_likes` VALUES (23, 3, 11, NULL);

-- ----------------------------
-- Table structure for recipes
-- ----------------------------
DROP TABLE IF EXISTS `recipes`;
CREATE TABLE `recipes`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `status` enum('publish','draft') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC, `user_id` ASC, `category_id` ASC) USING BTREE,
  INDEX `user_id`(`user_id` ASC) USING BTREE,
  INDEX `category_id`(`category_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of recipes
-- ----------------------------
INSERT INTO `recipes` VALUES (11, 5, 1, 'd738c2612eff1a517684e6c09a1ba84f.jpeg', 'Gepuk Mas Aris', 'Daging sapi yang diolah menjadi gepuk yang sangat empuk,cocok dinikmati dengan teman,keluarga, dan pasangan', 'publish', '2025-02-09 20:11:37', '2025-02-09 20:11:37');
INSERT INTO `recipes` VALUES (12, 5, 1, 'bc979d732683720cc640d01a8b4f4758.jpeg', 'Ayam bakar Kang Iyus', 'Ayam bakar Mas Iyus merupakan ayam bakar khas kota bandung,yang sangat cocok untuk di nikmati dikala lapar mengundang sambil ditemani dengan orang tercinta', 'publish', '2025-02-09 20:18:18', '2025-02-09 20:20:32');
INSERT INTO `recipes` VALUES (13, 7, 4, 'e8f9b46074ef77d09a59cbd8d3e17a74.png', 'Kue Lumpang (Kue Tradisional Asal Palembang)', 'Kue tradisional asal Palembang ini teksturnya kenyal-kenyal dan rasanya enak sekali. Disebut lumpang karena bagian tengahnya ada cekungan seperti lumpang atau lesung yang terbentuk dengan sendirinya saat dikukus. Jadi kalau kue lumpang yang dibuat terbentuk lesung berarti membuatnya sudah benar.', 'publish', '2025-02-11 08:05:16', '2025-02-11 08:05:16');
INSERT INTO `recipes` VALUES (14, 7, 5, 'bbdb0d300d8fe594add3be6dc7a7bc2a.png', 'Es Lumut Mangga', 'Es Lumut Mangga adalah minuman yang sempurna dengan rasa lezat dan menggugah selera untuk meredakan dahaga kita, terutama di hari-hari panas.', 'publish', '2025-02-11 08:53:20', '2025-02-11 08:53:20');
INSERT INTO `recipes` VALUES (15, 3, 1, 'e27295085f47085d9eafd469a6b411f7.jpg', 'Sambal Matah Autentik', 'Ingin bikin ayam sambal matah seenak buatan restoran? Masakan simpel seperti ayam goreng dengan sambal matah ini mudah dibuat dan kamu pun bisa membuatnya persis seperti aslinya.\r\n\r\nCara Membuat Sambal Matah Autentik dari Bali Agar Seenak Buatan Chef\r\nSejatinya sambal matah Bali adalah sambal mentah atau tidak dimasak. Selain dibuat dalam keadaan mentah, ada juga yang memanaskan minyak lebih dulu sebelum dicampur dengan bahan sambal.\r\n\r\nUntuk membuat sambal asal Bali yang enak, ikuti tips di bawah ini, ya!\r\n\r\nGunakan cabai, bawang, dan serai segar untuk cita rasa terbaik. Biasakan untuk memilah bahan sebelum diolah, terutama apabila bahan tersebut akan dikonsumsi mentah.\r\nPilih minyak kelapa yang akan memberi rasa dan aroma khas dari sambal khas Bali ini.\r\nAduk semua bahan dan bumbu sambal matah sambil diremas agar cita rasanya lebih menyatu.\r\nPilih Royco Kaldu Ayam untuk memberi rasa gurih pada sambal matah. Dengan teksturnya yang halus sehingga mudah menyerap pada masakan.\r\nAndalkan sambal mentah ini sebagai menu masakan sehari-hari karena cara membuatnya yang simpel. Kelebihan lainnya adalah bahan-bahan membuatnya sederhana dan hampir selalu tersedia di dapur.', 'publish', '2025-02-11 11:21:32', '2025-02-11 11:21:32');
INSERT INTO `recipes` VALUES (16, 3, 5, '660d61afa65599f46ce305530eb05688.jpg', 'Wedang Jahe', 'Coba resep wedang jahe untuk minuman penghangat badan ini, yuk! Apalagi di tengah banyaknya kegiatan, kamu butuh bangat minuman yang dapat membantu badan lebih bugar.\r\n\r\nUntuk cara membuat wedang jahe rumahan, ada 3 jenis jahe yang bisa digunakan. Yaitu jahe gajah (rimpangnya besar dan gemuk), jahe emprit, dan jahe merah. Pilih jahe merah atau jahe emprit (rimpangnya ramping dan kecil) kalau ingin minuman jamu ini lebih ‘nonjok’.\r\n\r\nBakar jahe sebelum direbus agar rasa aromanya lebih pekat. Kecilkan api saat sudah mendidih dan masak perlahan supaya airnya perlahan menyerap jahe tanpa membuatnya cepat menyusut.\r\n\r\nGunakan slow cooker jika ingin hemat gas sekaligus menghasilkan jamu yang lebih pedas. Memasak pada suhu rendah dalam waktu lama membuat rasanya lebih ‘tebal’. Agar tak berampas, saring wedang sebelum disajikan.', 'publish', '2025-02-11 11:23:15', '2025-02-11 11:23:37');
INSERT INTO `recipes` VALUES (17, 3, 3, 'e15d19310a6812c5435b31b75fe4a672.png', 'Healthy simple chicken steak', 'Healthy simple chicken steak', 'publish', '2025-02-11 11:32:57', '2025-02-11 11:32:57');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (3, 'Ahmad Waliyuddin', 'ahmadwaliyudin2018@gmail.com', '0192023a7bbd73250516f069df18b500', '2025-02-09 22:19:14', '2025-02-09 22:19:14');
INSERT INTO `users` VALUES (4, 'Willy', 'willy@ansita.id', '0192023a7bbd73250516f069df18b500', '2025-02-10 01:34:25', '2025-02-10 01:34:25');
INSERT INTO `users` VALUES (5, 'Haikal Islaminur Muharram', 'haikalislaminurmuharram@gmail.com', '431301000c51954230c969f2e04c3add', '2025-02-09 19:54:36', '2025-02-09 19:54:36');
INSERT INTO `users` VALUES (6, 'Galuh Dwi Candra', 'galuhdwicandra@gmail.com', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '2025-02-10 11:54:12', '2025-02-10 11:54:12');
INSERT INTO `users` VALUES (7, 'Fuji Ahmad', 'onezero0001@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2025-02-11 07:44:46', '2025-02-11 07:44:46');

SET FOREIGN_KEY_CHECKS = 1;
