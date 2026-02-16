-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 16 Şub 2026, 01:07:27
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `recipemanagementdatabase`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `home_recipes`
--

CREATE TABLE `home_recipes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `prep_time` int(11) DEFAULT NULL,
  `cook_time` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `home_recipes`
--

INSERT INTO `home_recipes` (`id`, `title`, `category`, `description`, `ingredients`, `instructions`, `image_path`, `prep_time`, `cook_time`, `created_at`) VALUES
(1, 'Turkish Rice Pudding', 'desserts', 'Creamy oven-baked or stovetop Turkish rice pudding.', 'Rice, milk, sugar', 'Simmer rice in milk until thick, add sugar and cook until creamy.', './assets/uploads/homepageRecipePics/category_ricePudding.png', 5, 40, '2026-02-03 14:59:10'),
(2, 'Chicken Meat Stew', 'oven meals', 'Strong coffee', 'Coffee, water, sugar', 'Boil water, add coffee...', './assets/uploads/homepageRecipePics/category_meatS.png', NULL, NULL, '2026-02-03 14:59:10'),
(6, 'Basil Sherbet', 'drinks', 'Refreshing purple basil drink with lemon.', 'Purple basil, sugar, lemon, water', 'Steep basil in hot water, add lemon and sugar, chill before serving.', './assets/uploads/homepageRecipePics/categoryDr_basil.png', 10, 5, '0000-00-00 00:00:00'),
(7, 'Turkish Coffee', 'drinks', 'Traditional strong unfiltered Turkish coffee.', 'Ground Turkish coffee, sugar, water', 'Simmer coffee, sugar and water until frothy and serve hot.', './assets/uploads/homepageRecipePics/categoryDr_coffee.png\r\n', 2, 5, '0000-00-00 00:00:00'),
(8, 'Sour Cherry Compote', 'drinks', 'Light sweet drink made by simmering sour cherries in water.', 'Sour cherries, sugar, water', 'Boil cherries with sugar until softened, cool and serve.', './assets/uploads/homepageRecipePics/categoryDr_compote.png', 5, 15, '0000-00-00 00:00:00'),
(9, 'Semolina Syrup Cookies', 'desserts', 'Classic Turkish syrup-soaked semolina cookies.', 'Flour, semolina, butter, egg, sugar syrup', 'Shape cookies, bake until golden, pour hot syrup over cooled cookies.', './assets/uploads/homepageRecipePics/categoryDe_cookies.png\r\n\r\n', 30, 50, '0000-00-00 00:00:00'),
(10, 'Shredded Pastry Dessert', 'desserts', 'Traditional kadayıf dessert with syrup and nuts.', 'Kadayıf pastry, butter, nuts, syrup', 'Layer kadayıf with butter and nuts, bake, pour syrup on top.', './assets/uploads/homepageRecipePics/categoryDe_dessert.png', 20, 40, '0000-00-00 00:00:00'),
(13, 'Soft Turkish Bagel Rolls', 'pastries', 'Fluffy, soft Turkish-style breakfast rolls.', 'Flour, yeast, milk, sugar, butter', 'Prepare dough, let rise, shape into rings, bake until golden.', './assets/uploads/homepageRecipePics/categoryP_bagel.png', 20, 40, '0000-00-00 00:00:00'),
(14, 'Borek', 'pastries', 'Savory layered pastry filled with cheese, spinach, or meat.', 'Yufka sheets, filling of choice, oil', 'Layer yufka with oil and filling, roll or fold, bake.', './assets/uploads/homepageRecipePics/categoryP_borek.png', 20, 60, '0000-00-00 00:00:00'),
(15, 'Slow-Cooked Casserole', 'meat', 'Clay-pot style slow cooked Turkish casserole.', 'Meat, vegetables, tomato, spices', 'Layer ingredients in pot and slow-cook until tender.', './assets/uploads/homepageRecipePics/categoryMeat_caserole.png\r\n', 15, 120, '0000-00-00 00:00:00'),
(16, 'Meat Vegetable Stew', 'meat', 'Hearty stew with mixed vegetables and meat.', 'Meat, potatoes, eggplant, zucchini, tomatoes, spices', 'Sauté meat, add vegetables, simmer until soft.', './assets/uploads/homepageRecipePics/categoryMeat_stew.png\r\n', 15, 60, '0000-00-00 00:00:00'),
(17, 'Chickpea Stew with Meat', 'meat', 'Classic Turkish chickpea stew cooked with beef or lamb.', 'Chickpeas, meat, tomato paste, spices', 'Cook meat, add chickpeas and tomato paste, simmer until tender.', './assets/uploads/homepageRecipePics/categoryMeat_chickpea.png\r\n', 10, 60, '0000-00-00 00:00:00'),
(18, 'Stuffed Eggplants with Ground Beef', 'oven', 'Traditional Turkish karnıyarık made with fried eggplants.', 'Eggplants, ground beef, onion, tomato, spices', 'Fry eggplants, fill with cooked meat mixture, bake.', './assets/uploads/homepageRecipePics/categoryO_eggplant.png', 20, 40, '0000-00-00 00:00:00'),
(19, 'Baked Pasta', 'oven', 'Oven-baked pasta with béchamel sauce.', 'Pasta, milk, flour, butter, cheese', 'Boil pasta, prepare béchamel, mix and bake.', './assets/uploads/homepageRecipePics/categoryO_pasta.png', 20, 30, '0000-00-00 00:00:00'),
(20, 'Meatballs with Potatoes', 'oven', 'Turkish-style baked meatballs with potatoes.', 'Ground beef, potatoes, onion, spices', 'Shape meatballs, arrange with potatoes, bake with sauce.', './assets/uploads/homepageRecipePics/categoryO_meatball.png', 15, 45, '0000-00-00 00:00:00'),
(21, 'Rice Pilaf', 'rice', 'Classic buttery Turkish-style pilaf.', 'Rice, butter, water or broth, salt', 'Sauté rice in butter, add water, cook until fluffy.', './assets/uploads/homepageRecipePics/categoryRice_rice.png\r\n', 10, 15, '0000-00-00 00:00:00'),
(22, 'Creamy Mushroom Pasta', 'rice', 'Pasta coated in creamy mushroom sauce.', 'Pasta, cream, mushrooms, garlic, salt', 'Sauté mushrooms, add cream, mix with cooked pasta.', './assets/uploads/homepageRecipePics/categoryRice_pasta.png', NULL, NULL, '0000-00-00 00:00:00'),
(23, 'Couscous', 'rice', 'Simple boiled couscous.', 'Couscous, water, salt, butter', 'Boil water, add couscous, cover and let absorb.', './assets/uploads/homepageRecipePics/categoryRice_couscous.png\r\n', NULL, NULL, '0000-00-00 00:00:00'),
(24, 'Yogurt Soup', 'soups', 'Refreshing soup with yogurt, mint, and rice.', 'Yogurt, rice, mint, egg, flour', 'Cook rice, whisk yogurt mixture, combine and simmer gently.', './assets/uploads/homepageRecipePics/categoryS_yogurt.png\r\n', NULL, NULL, '0000-00-00 00:00:00'),
(25, 'Lentil Soup', 'soups', 'Smooth and hearty red lentil soup.', 'Red lentils, onion, carrot, spices', 'Boil lentils with vegetables, blend until smooth.', './assets/uploads/homepageRecipePics/categoryS_lentil.png\r\n', NULL, NULL, '0000-00-00 00:00:00'),
(26, 'Tarhana Soup', 'soups', 'Fermented and dried grain-yogurt soup.', 'Tarhana powder, water, butter, tomato paste', 'Simmer tarhana with water and butter until thick.', './assets/uploads/homepageRecipePics/categoryS_tarhana.png\r\n', 5, 15, '0000-00-00 00:00:00'),
(27, 'Orange Braised Celery Root', 'vegetable', 'Light olive oiled celery root with orange.', 'Celery root, orange juice, carrot, potato', 'Combine vegetables with orange juice and simmer.', './assets/uploads/homepageRecipePics/categoryV_orange.png', 10, 30, '0000-00-00 00:00:00'),
(28, 'Spinach Dish', 'vegetable', 'Turkish-style sautéed spinach with onions.', 'Spinach, onion, tomato paste, spices', 'Sauté onion, add spinach and cook until wilted.', './assets/uploads/homepageRecipePics/categoryV_spinach.png', 10, 20, '0000-00-00 00:00:00'),
(29, 'Cabbage Stew', 'vegetable', 'Traditional hearty cabbage stew.', 'Cabbage, onion, tomato paste, spices', 'Sauté onion, add cabbage and simmer until tender.', './assets/uploads/homepageRecipePics/categoryV_cabbage.png', 10, 40, '0000-00-00 00:00:00'),
(31, 'Lentil Folded Pastry (Golden Dish in this list)', 'pastries', 'Layered dough pastry filled with cooked lentils and poppy paste.', 'Flour, sparkling water, salt, vinegar, cooked lentils, poppy paste, oil', 'Knead dough, roll thin sheets, spread oil and poppy paste between layers, roll again, cut squares, fill with lentils, bake until golden.', './assets/uploads/homepageRecipePics/categoryP_lentilP.png', 40, 50, '0000-00-00 00:00:00');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `home_recipes`
--
ALTER TABLE `home_recipes`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `home_recipes`
--
ALTER TABLE `home_recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
