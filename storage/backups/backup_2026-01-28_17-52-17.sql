-- Backup Tech Store ⚡
-- Generado: 2026-01-28 17:52:17
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_product_id_foreign` (`product_id`),
  CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `comments` VALUES("1","niceeee","3","4","2026-01-28 17:32:14","2026-01-28 17:32:14");
INSERT INTO `comments` VALUES("2","wowow","3","4","2026-01-28 17:32:39","2026-01-28 17:32:39");


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_order_id_foreign` (`order_id`),
  KEY `items_product_id_foreign` (`product_id`),
  CONSTRAINT `items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `items` VALUES("1","1","4444","1","4","2026-01-26 08:30:51","2026-01-26 08:30:51");
INSERT INTO `items` VALUES("2","2","4444","2","4","2026-01-26 08:38:55","2026-01-26 08:38:55");
INSERT INTO `items` VALUES("3","1","4444","3","4","2026-01-27 21:11:21","2026-01-27 21:11:21");
INSERT INTO `items` VALUES("4","2","500","4","4","2026-01-28 09:10:28","2026-01-28 09:10:28");
INSERT INTO `items` VALUES("5","1","500","6","4","2026-01-28 09:58:18","2026-01-28 09:58:18");
INSERT INTO `items` VALUES("6","1","500","7","4","2026-01-28 10:03:10","2026-01-28 10:03:10");


DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` VALUES("1","0001_01_01_000000_create_users_table","1");
INSERT INTO `migrations` VALUES("2","0001_01_01_000001_create_cache_table","1");
INSERT INTO `migrations` VALUES("3","0001_01_01_000002_create_jobs_table","1");
INSERT INTO `migrations` VALUES("4","2025_12_31_095418_create_products_table","1");
INSERT INTO `migrations` VALUES("5","2026_01_19_220714_alter_users_table","1");
INSERT INTO `migrations` VALUES("6","2026_01_19_222152_alter_users_table","1");
INSERT INTO `migrations` VALUES("7","2026_01_19_222208_alter_users_table","1");
INSERT INTO `migrations` VALUES("8","2026_01_26_073714_create_orders_table","2");
INSERT INTO `migrations` VALUES("9","2026_01_26_074611_create_items_table","2");
INSERT INTO `migrations` VALUES("10","2026_01_28_170617_create_comments_table","3");


DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `total` int(11) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` VALUES("1","4444","2","2026-01-26 08:30:51","2026-01-26 08:30:51");
INSERT INTO `orders` VALUES("2","8888","3","2026-01-26 08:38:55","2026-01-26 08:38:55");
INSERT INTO `orders` VALUES("3","4444","3","2026-01-27 21:11:21","2026-01-27 21:11:21");
INSERT INTO `orders` VALUES("4","1000","2","2026-01-28 09:10:28","2026-01-28 09:10:28");
INSERT INTO `orders` VALUES("5","500","2","2026-01-28 09:52:18","2026-01-28 09:52:18");
INSERT INTO `orders` VALUES("6","500","2","2026-01-28 09:58:16","2026-01-28 09:58:16");
INSERT INTO `orders` VALUES("7","500","2","2026-01-28 10:03:10","2026-01-28 10:03:10");


DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` VALUES("4","2026-01-23 11:52:57","2026-01-27 21:25:03","PS5","Buena consola","500","4.jpg");
INSERT INTO `products` VALUES("5","2026-01-27 21:24:15","2026-01-27 21:24:17","TV","Buena calidad de imagen.","400","5.png");
INSERT INTO `products` VALUES("6","2026-01-27 21:26:25","2026-01-27 21:26:25","Nintendo Switch 2","Buena consola portatil","350","6.png");
INSERT INTO `products` VALUES("7","2026-01-27 21:27:35","2026-01-27 21:27:35","Xbox series X","De lo mejor","500","7.png");
INSERT INTO `products` VALUES("8","2026-01-27 21:29:01","2026-01-27 21:29:01","Apple Macbook Air Apple M4","Rendimiento inigualable en cualquier entorno. Equipado con el Apple M4 de 10 núcleos (4 de rendimiento y 6 de eficiencia) más GPU Apple de 8 núcleos, este ultraportátil ejecuta desde cargas creativas avanzadas hasta multitarea intensiva con una fluidez formidable, ideal para editores de video, desarrolladores o creativos que valoran la eficiencia y silencio absoluto (sin ventiladores).","1000","8.png");
INSERT INTO `products` VALUES("9","2026-01-27 21:30:30","2026-01-27 21:30:30","Procesador AMD Ryzen 7","8 núcleos, 16 hilos\r\nVelocidad de reloj 3.8GHz\r\nTecnología AMD StoreMI\r\nUtilidad AMD Ryzen™ Master\r\nAMD Ryzen™ VR-Ready Premium\r\nMemoria DDR4","194","9.png");
INSERT INTO `products` VALUES("10","2026-01-27 21:31:42","2026-01-27 21:31:42","Monitor AOC C27G4ZXE 27","Pantalla curva de 27 pulgadas FullHD\r\n280 Hz y respuesta 0,3 ms para eSports\r\nPanel Fast VA, alto contraste y colores intensos\r\nHDR10 y Adaptive Sync para juego fluido\r\nSin altavoces integrados, soporte VESA compatible\r\nDiseño sin marco, base optimizada para e","149","10.png");
INSERT INTO `products` VALUES("11","2026-01-27 21:32:32","2026-01-27 21:32:32","Logitech G502 Hero ","El Logitech G502 Hero es uno de los ratones gaming más valorados por su precisión sobresaliente y su gran capacidad de personalización. Los usuarios aprecian su sensor HERO de 25.600 DPI, la ergonomía que permite usarlo cómodamente durante largas sesiones y sus múltiples botones programables adaptables a todo tipo de juegos y tareas. La robustez de construcción y la posibilidad de ajustar el peso también reciben elogios. Algunos consideran que puede resultar algo pesado y notan detalles mejorables en el cable y la disposición de ciertos botones, pero su funcionalidad y fiabilidad lo sitúan entre los favoritos para gamers y profesionales exigentes.","90","11.png");
INSERT INTO `products` VALUES("12","2026-01-27 22:45:51","2026-01-27 22:45:51","Teclado Mecánico RGB Pro","Switches Cherry MX Red y estructura de aluminio.","120","12.png");
INSERT INTO `products` VALUES("13","2026-01-27 22:45:51","2026-01-27 22:45:51","Ratón Óptico Gaming 25K","Sensor de alta precisión y 11 botones programables.","65","13.png");
INSERT INTO `products` VALUES("14","2026-01-27 22:45:51","2026-01-27 22:45:51","Monitor 27\" 144Hz IPS","Resolución QHD con soporte HDR400.","299","14.png");
INSERT INTO `products` VALUES("15","2026-01-27 22:45:51","2026-01-27 22:45:51","Tarjeta Gráfica RTX 4070","12GB GDDR6X para gaming extremo.","650","15.png");
INSERT INTO `products` VALUES("16","2026-01-27 22:45:51","2026-01-27 22:45:51","Memoria RAM 32GB DDR5","Kit 2x16GB a 6000MHz con iluminación RGB.","145","16.png");
INSERT INTO `products` VALUES("17","2026-01-27 22:45:51","2026-01-27 22:45:51","SSD NVMe 2TB Gen4","Velocidad de lectura de hasta 7400 MB/s.","160","17.png");
INSERT INTO `products` VALUES("18","2026-01-27 22:45:51","2026-01-27 22:45:51","Procesador Ryzen 9 7900X","12 núcleos y 24 hilos, arquitectura Zen 4.","450","18.png");
INSERT INTO `products` VALUES("19","2026-01-27 22:45:51","2026-01-27 22:45:51","Placa Base X670E Gaming","Soporte PCIe 5.0 y WiFi 6E integrado.","320","19.png");
INSERT INTO `products` VALUES("20","2026-01-27 22:45:51","2026-01-27 22:45:51","Fuente de Poder 850W Gold","Certificación 80 Plus Gold, modular.","135","20.png");
INSERT INTO `products` VALUES("21","2026-01-27 22:45:51","2026-01-27 22:45:51","Caja PC Meshify Blanca","Panel de cristal templado y gran flujo de aire.","110","21.png");
INSERT INTO `products` VALUES("22","2026-01-27 22:45:51","2026-01-27 22:45:51","Auriculares Wireless 7.1","Batería de 30 horas y sonido envolvente.","180","22.png");
INSERT INTO `products` VALUES("23","2026-01-27 22:45:51","2026-01-27 22:45:51","Webcam 4K Ultra HD","Ideal para streaming con enfoque automático.","95","23.png");
INSERT INTO `products` VALUES("24","2026-01-27 22:45:51","2026-01-27 22:45:51","Altavoces 2.1 Bluetooth","Subwoofer potente para escritorio.","85","24.png");
INSERT INTO `products` VALUES("25","2026-01-27 22:45:51","2026-01-27 22:45:51","Silla Ergonómica Pro","Ajuste lumbar 4D y base de metal.","250","25.png");
INSERT INTO `products` VALUES("26","2026-01-27 22:45:51","2026-01-27 22:45:51","Alfombrilla XXL Control","Superficie de tela de 900x400mm.","30","26.png");
INSERT INTO `products` VALUES("27","2026-01-27 22:45:51","2026-01-27 22:45:51","Disco Duro Externo 4TB","Conexión USB-C de alta velocidad.","115","27.png");
INSERT INTO `products` VALUES("28","2026-01-27 22:45:51","2026-01-27 22:45:51","Router WiFi 6 Pro","Doble banda con tecnología MU-MIMO.","140","28.png");
INSERT INTO `products` VALUES("29","2026-01-27 22:45:51","2026-01-27 22:45:51","Hub USB-C 10 en 1","Salida HDMI 4K, Ethernet y carga PD.","55","29.png");
INSERT INTO `products` VALUES("30","2026-01-27 22:45:51","2026-01-27 22:45:51","Pasta Térmica MX-6","Alta conductividad para CPU y GPU.","15","30.png");
INSERT INTO `products` VALUES("31","2026-01-27 22:45:51","2026-01-27 22:45:51","Capturadora 4K60 S+","Grabación de gameplay sin lag.","190","31.png");
INSERT INTO `products` VALUES("32","2026-01-27 22:45:51","2026-01-28 08:58:26","Ventilador CPU Aire Dual","Doble ventilador de 120mm silencioso.","65","32.png");
INSERT INTO `products` VALUES("33","2026-01-27 22:45:51","2026-01-28 08:59:12","Refrigeración Líquida 360","Radiador triple con ventiladores ARGB.","155","33.png");
INSERT INTO `products` VALUES("34","2026-01-27 22:45:51","2026-01-28 08:59:59","Mando Gaming para PC","Layout estilo Xbox con gatillos hall effect.","55","34.png");
INSERT INTO `products` VALUES("35","2026-01-27 22:45:51","2026-01-28 09:00:28","Brazo Monitor Hidráulico","Soporta monitores de hasta 34 pulgadas.","75","35.png");
INSERT INTO `products` VALUES("36","2026-01-27 22:45:51","2026-01-28 09:00:52","Micrófono de Estudio USB","Brazo incluido y filtro antipop.","125","36.png");
INSERT INTO `products` VALUES("37","2026-01-27 22:45:51","2026-01-28 09:02:04","Laptop Gaming 15.6\"","RTX 4050, i5 13th Gen, 16GB RAM.","899","37.png");
INSERT INTO `products` VALUES("38","2026-01-27 22:45:51","2026-01-28 09:02:33","Tableta Gráfica 13\"","Pantalla laminada y lápiz sin batería.","220","38.png");
INSERT INTO `products` VALUES("39","2026-01-27 22:45:51","2026-01-28 09:02:58","Smartwatch Tech V3","Pantalla AMOLED y sensor de oxígeno.","130","39.png");
INSERT INTO `products` VALUES("40","2026-01-27 22:45:51","2026-01-28 09:03:30","Power Bank 20000mAh","Carga rápida 65W para laptops.","70","40.png");
INSERT INTO `products` VALUES("41","2026-01-27 22:45:51","2026-01-28 09:04:02","Teclado 60% Compacto","Switches ópticos y cable tipo C.","80","41.png");
INSERT INTO `products` VALUES("42","2026-01-27 22:45:51","2026-01-27 22:45:51","Ratón Inalámbrico Ligero","Solo 60 gramos de peso para esports.","110","42.png");
INSERT INTO `products` VALUES("43","2026-01-27 22:45:51","2026-01-27 22:45:51","Gafas VR Standalone","128GB de almacenamiento, sin cables.","450","43.png");
INSERT INTO `products` VALUES("44","2026-01-27 22:45:51","2026-01-27 22:45:51","Impresora 3D Resina","Alta precisión para miniaturas.","280","44.png");
INSERT INTO `products` VALUES("45","2026-01-27 22:45:51","2026-01-27 22:45:51","Kit Herramientas PC","64 puntas para reparación electrónica.","45","45.png");
INSERT INTO `products` VALUES("46","2026-01-27 22:45:51","2026-01-27 22:45:51","Luz LED para Streaming","Panel con temperatura de color ajustable.","90","46.png");
INSERT INTO `products` VALUES("47","2026-01-27 22:45:51","2026-01-27 22:45:51","Soporte Auriculares RGB","Con hub USB integrado.","35","47.png");
INSERT INTO `products` VALUES("48","2026-01-27 22:45:51","2026-01-27 22:45:51","Tarjeta Sonido Externa","DAC de alta fidelidad 24-bit/192kHz.","140","48.png");
INSERT INTO `products` VALUES("49","2026-01-27 22:45:51","2026-01-27 22:45:51","Cable DP 1.4 Trenzado","Soporta 8K y 4K a 144Hz.","20","49.png");
INSERT INTO `products` VALUES("50","2026-01-27 22:45:51","2026-01-27 22:45:51","Limpiador Aire Comprimido","Soplador eléctrico recargable.","50","50.png");
INSERT INTO `products` VALUES("51","2026-01-27 22:45:51","2026-01-27 22:45:51","Adaptador Bluetooth 5.3","Conexión estable para 7 dispositivos.","18","51.png");
INSERT INTO `products` VALUES("52","2026-01-27 22:45:51","2026-01-27 22:45:51","Monitor Portátil 15.6\"","Panel IPS táctil Full HD.","175","52.png");
INSERT INTO `products` VALUES("53","2026-01-27 22:45:51","2026-01-27 22:45:51","Batería UPS 1500VA","Protección contra cortes de energía.","210","53.png");
INSERT INTO `products` VALUES("54","2026-01-27 22:45:51","2026-01-27 22:45:51","Teclado Numérico Wireless","Ideal para laptops sin numpad.","25","54.png");
INSERT INTO `products` VALUES("55","2026-01-27 22:45:51","2026-01-27 22:45:51","Escáner de Documentos Pro","Dúplex automático a color.","320","55.png");
INSERT INTO `products` VALUES("56","2026-01-27 22:45:51","2026-01-27 22:45:51","Módulo WiFi 7 PCIe","Velocidad de hasta 5.8 Gbps.","85","56.png");
INSERT INTO `products` VALUES("57","2026-01-27 22:45:51","2026-01-27 22:45:51","Base Enfriadora Laptop","6 ventiladores y altura ajustable.","40","57.png");
INSERT INTO `products` VALUES("58","2026-01-27 22:45:51","2026-01-27 22:45:51","Protector Sobretensión","10 tomas y puertos USB inteligentes.","45","58.png");
INSERT INTO `products` VALUES("59","2026-01-27 22:45:51","2026-01-27 22:45:51","Mini PC i7 Gen 12","16GB RAM, 512GB SSD, Windows 11.","550","59.png");
INSERT INTO `products` VALUES("60","2026-01-27 22:45:51","2026-01-27 22:45:51","Altavoz Inteligente Tech","Asistente de voz y control hogar.","60","60.png");
INSERT INTO `products` VALUES("61","2026-01-27 22:45:51","2026-01-27 22:45:51","Drone FPV Explorer","Cámara 4K y transmisión 5km.","399","61.png");
INSERT INTO `products` VALUES("62","2026-01-27 22:45:51","2026-01-27 22:45:51","Proyector Laser 4K","3000 lúmenes para cine en casa.","1200","62.png");
INSERT INTO `products` VALUES("63","2026-01-27 22:45:51","2026-01-27 22:45:51","Lector Código de Barras","Inalámbrico 2D para inventarios.","75","63.png");
INSERT INTO `products` VALUES("64","2026-01-27 22:45:51","2026-01-27 22:45:51","Cámara Seguridad WiFi","Visión nocturna y audio bi-direccional.","55","64.png");
INSERT INTO `products` VALUES("65","2026-01-27 22:45:51","2026-01-27 22:45:51","SSD Externo Rugged 1TB","Resistente a golpes y agua.","130","65.png");
INSERT INTO `products` VALUES("66","2026-01-27 22:45:51","2026-01-27 22:45:51","Tarjeta MicroSD 512GB","Clase 10 U3 para video 4K.","65","66.png");
INSERT INTO `products` VALUES("67","2026-01-27 22:45:51","2026-01-27 22:45:51","Gabinete NAS 4 Bahías","Para discos SATA 3.5 y 2.5.","350","67.png");
INSERT INTO `products` VALUES("68","2026-01-27 22:45:51","2026-01-27 22:45:51","Joystick Vuelo Pro","Acelerador separado para simuladores.","180","68.png");
INSERT INTO `products` VALUES("69","2026-01-27 22:45:51","2026-01-27 22:45:51","Volante Racing con Pedales","Force Feedback y acabado en cuero.","299","69.png");
INSERT INTO `products` VALUES("70","2026-01-27 22:45:51","2026-01-27 22:45:51","Convertidor HDMI a VGA","Con salida de audio jack 3.5mm.","12","70.png");
INSERT INTO `products` VALUES("71","2026-01-27 22:45:51","2026-01-27 22:45:51","Regleta Inteligente WiFi","Control individual por aplicación.","35","71.png");
INSERT INTO `products` VALUES("72","2026-01-27 22:45:51","2026-01-27 22:45:51","Sensor de Movimiento Tech","Notificaciones al móvil instantáneas.","25","72.png");
INSERT INTO `products` VALUES("73","2026-01-27 22:45:51","2026-01-27 22:45:51","Termostato Inteligente","Ahorro de energía programable.","150","73.png");
INSERT INTO `products` VALUES("74","2026-01-27 22:45:51","2026-01-27 22:45:51","Cerradura Electrónica BT","Acceso por código o huella.","199","74.png");
INSERT INTO `products` VALUES("75","2026-01-27 22:45:51","2026-01-27 22:45:51","Bombilla LED RGB WiFi","Paquete de 4 unidades.","45","75.png");
INSERT INTO `products` VALUES("76","2026-01-27 22:45:51","2026-01-27 22:45:51","Monitor Ultrawide 34\"","Curvo 1500R para productividad.","450","76.png");
INSERT INTO `products` VALUES("77","2026-01-27 22:45:51","2026-01-27 22:45:51","Estación Carga Inalámbrica","Carga móvil, reloj y audífonos.","50","77.png");
INSERT INTO `products` VALUES("78","2026-01-27 22:45:51","2026-01-27 22:45:51","Kit Raspberry Pi 5","8GB RAM, fuente y caja incluidas.","135","78.png");
INSERT INTO `products` VALUES("79","2026-01-27 22:45:51","2026-01-27 22:45:51","Antena WiFi Largo Alcance","Ganancia de 12dBi para exteriores.","40","79.png");
INSERT INTO `products` VALUES("80","2026-01-27 22:45:51","2026-01-27 22:45:51","Switch Ethernet 16 Puertos","Gigabit para redes empresariales.","90","80.png");
INSERT INTO `products` VALUES("81","2026-01-27 22:45:51","2026-01-27 22:45:51","Repetidor WiFi Extender","Velocidad AC1200 banda dual.","30","81.png");
INSERT INTO `products` VALUES("82","2026-01-27 22:45:51","2026-01-27 22:45:51","Bolso Laptop Antirrobo","Material impermeable y puerto USB.","55","82.png");
INSERT INTO `products` VALUES("83","2026-01-27 22:45:51","2026-01-27 22:45:51","Lápiz Capacitivo Activo","Compatible con iPad y Android.","45","83.png");
INSERT INTO `products` VALUES("84","2026-01-27 22:45:51","2026-01-27 22:45:51","Protector Pantalla Privacidad","Para monitor de 24 pulgadas.","35","84.png");
INSERT INTO `products` VALUES("85","2026-01-27 22:45:51","2026-01-27 22:45:51","Soporte Tablet Escritorio","Brazo flexible de aluminio.","28","85.png");
INSERT INTO `products` VALUES("86","2026-01-27 22:45:51","2026-01-27 22:45:51","Ratón Trackball Ergonómico","Reduce la tensión en la muñeca.","75","86.png");
INSERT INTO `products` VALUES("87","2026-01-27 22:45:51","2026-01-27 22:45:51","Teclado Bluetooth Multi-dispositivo","Cambia entre 3 equipos.","55","87.png");
INSERT INTO `products` VALUES("88","2026-01-27 22:45:51","2026-01-27 22:45:51","Ventilador de Caja 140mm","Paquete de 3 ventiladores silenciosos.","50","88.png");
INSERT INTO `products` VALUES("89","2026-01-27 22:45:51","2026-01-27 22:45:51","Cable USB-C a DP 2M","Conexión directa a monitor.","25","89.png");
INSERT INTO `products` VALUES("90","2026-01-27 22:45:51","2026-01-27 22:45:51","Gorra con Auriculares BT","Ideal para deporte en invierno.","20","90.png");
INSERT INTO `products` VALUES("91","2026-01-27 22:45:51","2026-01-27 22:45:51","Gafas Inteligentes Audio","Lentes polarizados con altavoces.","160","91.png");
INSERT INTO `products` VALUES("92","2026-01-27 22:45:51","2026-01-27 22:45:51","Anillo de Luz 12\"","Trípode y soporte para móvil.","45","92.png");
INSERT INTO `products` VALUES("93","2026-01-27 22:45:51","2026-01-27 22:45:51","Fondo Verde Croma","Retráctil para streamers.","130","93.png");
INSERT INTO `products` VALUES("94","2026-01-27 22:45:51","2026-01-27 22:45:51","Soporte CPU con Ruedas","Ajustable para diferentes torres.","22","94.png");
INSERT INTO `products` VALUES("95","2026-01-27 22:45:51","2026-01-27 22:45:51","Organizador de Cables","Malla flexible de 3 metros.","15","95.png");
INSERT INTO `products` VALUES("96","2026-01-27 22:45:51","2026-01-27 22:45:51","Tarjeta Captura HDMI USB","Plug and play para cámaras DSLR.","45","96.png");
INSERT INTO `products` VALUES("97","2026-01-27 22:45:51","2026-01-27 22:45:51","Luz Monitor ScreenBar","Iluminación asimétrica sin reflejos.","85","97.png");
INSERT INTO `products` VALUES("98","2026-01-27 22:45:51","2026-01-27 22:45:51","Mouse Pad Térmico","Calienta tus manos mientras trabajas.","40","98.png");
INSERT INTO `products` VALUES("99","2026-01-27 22:45:51","2026-01-27 22:45:51","Hub Thunderbolt 4","Transferencia de 40Gbps y carga 90W.","280","99.png");
INSERT INTO `products` VALUES("100","2026-01-27 22:45:51","2026-01-27 22:45:51","Micrófono de Solapa","Inalámbrico para creadores de contenido.","110","100.png");
INSERT INTO `products` VALUES("101","2026-01-27 22:45:51","2026-01-27 22:45:51","Cargador Solar 21W","Plegable con 2 puertos USB.","65","101.png");
INSERT INTO `products` VALUES("102","2026-01-27 22:45:51","2026-01-27 22:45:51","Localizador Tech Tag","Rastreo global de llaves o maletas.","35","102.png");
INSERT INTO `products` VALUES("103","2026-01-27 22:45:51","2026-01-27 22:45:51","Báscula Inteligente WiFi","Mide grasa corporal y músculo.","55","103.png");
INSERT INTO `products` VALUES("104","2026-01-27 22:45:51","2026-01-27 22:45:51","Difusor de Aromas USB","Control por app e iluminación LED.","40","104.png");
INSERT INTO `products` VALUES("105","2026-01-27 22:45:51","2026-01-27 22:45:51","Máquina de Ruido Blanco","Conexión BT y 30 sonidos relajantes.","35","105.png");
INSERT INTO `products` VALUES("106","2026-01-27 22:45:51","2026-01-27 22:45:51","Deshumidificador Pequeño","Para cuarto de servidores pequeño.","95","106.png");
INSERT INTO `products` VALUES("107","2026-01-27 22:45:51","2026-01-27 22:45:51","Monitor de Aire Calidad","Mide CO2 y partículas finas.","85","107.png");
INSERT INTO `products` VALUES("108","2026-01-27 22:45:51","2026-01-27 22:45:51","Termómetro Infrarrojo Digital","Lectura instantánea sin contacto.","30","108.png");
INSERT INTO `products` VALUES("109","2026-01-27 22:45:51","2026-01-27 22:45:51","Candado de Huella USB","Sin llaves, carga de larga duración.","45","109.png");
INSERT INTO `products` VALUES("110","2026-01-27 22:45:51","2026-01-27 22:45:51","Enchufe Inteligente con Medidor","Monitorea el consumo eléctrico.","25","110.png");
INSERT INTO `products` VALUES("111","2026-01-27 22:45:51","2026-01-27 22:45:51","Calculadora Científica Gráfica","Pantalla a color y recargable.","120","111.png");


DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` VALUES("BiZBpe6sOl2IyLFJbYECKme8Aihyrag1eGMD8rD2","3","127.0.0.1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36","YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVUs4QjdvcDY3d052d0JnczZVaHl4RUVLSXVKVzFYWXBEeHhJejZ2cSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy80IjtzOjU6InJvdXRlIjtzOjEyOiJwcm9kdWN0LnNob3ciO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc2OTYyMTQzNDt9fQ==","1769621682");


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'client',
  `balance` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` VALUES("1","Admin","admin@admin.com",NULL,"$2y$12$/QI7mUp7Px7e.OR3trZjJuHbcTFYvpavYgufLUYtrDZ1DbYlVZXki",NULL,"2026-01-19 22:26:23","2026-01-19 22:26:23","admin","5000");
INSERT INTO `users` VALUES("2","javi","galianpinerojavier@gmail.com",NULL,"$2y$12$ixlfbpZY2NsaU5KW0xI57umeT5HfaiT3KiBU1c9VpElYG69CzXFlq","RkFcbYHvWlEWqPB40i3HN99Lp0exhTKbOwEFSzV1M8yAU3Awg8aeYBWfnQ8q","2026-01-23 11:02:57","2026-01-28 10:03:10","admin","9997999");
INSERT INTO `users` VALUES("3","Bárbara","barbarasdeVegaHuidobro@gmail.com",NULL,"$2y$12$26Q6G7qp.S9lMDpzU9yXteI7sPUqzk9yPsvLtziQSUBLW1CziPKdG",NULL,"2026-01-26 08:38:27","2026-01-27 21:11:21","client","556");
INSERT INTO `users` VALUES("4","Adri","adrian@gmail.com",NULL,"$2y$12$iMXFDw.zM55YWDCr6saGeuPkIbrlL14ToOcsPKhnmCkvgX6WjPWkG",NULL,"2026-01-26 09:01:34","2026-01-26 09:01:34","client","5000");


SET FOREIGN_KEY_CHECKS=1;