-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 01 déc. 2023 à 08:39
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restoapp`
--
CREATE DATABASE IF NOT EXISTS `restoapp` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `restoapp`;

-- --------------------------------------------------------

--
-- Structure de la table `approvisionnements`
--

CREATE TABLE `approvisionnements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantite` decimal(8,2) NOT NULL,
  `prix` decimal(8,2) NOT NULL,
  `prix_total` decimal(8,2) NOT NULL,
  `boisson_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `approvisionnements`
--

INSERT INTO `approvisionnements` (`id`, `quantite`, `prix`, `prix_total`, `boisson_id`, `created_at`, `updated_at`) VALUES
(1, '120.00', '100.00', '12000.00', 1, '2023-10-12 07:19:11', '2023-10-12 07:19:11'),
(2, '24.00', '10.00', '240.00', 2, '2023-10-12 07:25:09', '2023-10-12 07:47:15'),
(4, '200.00', '0.20', '40.00', 2, '2023-10-15 11:02:49', '2023-10-15 11:02:49'),
(5, '24.00', '10.00', '240.00', 1, '2023-10-15 11:03:41', '2023-10-15 11:03:41');

-- --------------------------------------------------------

--
-- Structure de la table `boissons`
--

CREATE TABLE `boissons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(8,2) NOT NULL,
  `solde` int(11) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `boissons`
--

INSERT INTO `boissons` (`id`, `designation`, `prix`, `solde`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Primus 72cl', '3.00', 136, 1, '2023-10-10 13:43:57', '2023-10-15 11:04:20'),
(2, 'La vie', '0.50', 206, 2, '2023-10-10 13:44:15', '2023-12-01 01:13:26');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Bierre', '2023-10-10 13:42:25', '2023-10-10 13:42:25'),
(2, 'Eau', '2023-10-10 13:42:30', '2023-10-10 13:42:30');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_10_093401_create_tables_table', 1),
(6, '2023_10_10_104254_create_categories_table', 1),
(7, '2023_10_10_111633_create_nourritures_table', 1),
(8, '2023_10_10_114519_create_boissons_table', 1),
(9, '2023_10_11_195048_create_approvisionnements_table', 2),
(10, '2023_10_12_101115_create_ventes_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `nourritures`
--

CREATE TABLE `nourritures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nourritures`
--

INSERT INTO `nourritures` (`id`, `nom`, `prix`, `created_at`, `updated_at`) VALUES
(1, 'Viande Porc', '10.00', '2023-10-10 13:42:48', '2023-10-10 13:42:48'),
(2, 'Poisson', '5.00', '2023-10-10 13:43:00', '2023-10-10 13:43:00');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tables`
--

CREATE TABLE `tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tables`
--

INSERT INTO `tables` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Table 01', '2023-10-10 13:42:12', '2023-10-10 13:42:12'),
(2, 'Table 02', '2023-10-10 13:42:18', '2023-10-10 13:42:18'),
(3, 'Table 03', '2023-10-13 18:00:57', '2023-10-13 18:00:57');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$e/eWdi1HrLatbvWq3xji3.pNxm9Dckfrvgm9V.Cv403IU9g5aTLj.', NULL, '2023-10-10 13:42:01', '2023-10-10 13:42:01');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` decimal(8,2) NOT NULL,
  `prix_vente` decimal(8,2) NOT NULL,
  `prix_tot` decimal(8,2) NOT NULL,
  `type_produit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id`, `libelle`, `quantite`, `prix_vente`, `prix_tot`, `type_produit`, `table_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'La vie', '2.00', '0.50', '1.00', 'boisson', 1, 1, '2023-10-12 10:36:38', '2023-10-15 11:20:20'),
(2, 'Poisson', '2.00', '5.00', '10.00', 'nourriture', 2, 1, '2023-10-12 10:44:30', '2023-10-15 11:18:08'),
(3, 'Viande Porc', '1.00', '10.00', '10.00', 'nourriture', 1, 1, '2023-10-12 11:06:58', '2023-10-15 11:20:20'),
(4, 'La vie', '5.00', '0.50', '2.50', 'boisson', 3, 1, '2023-10-15 11:03:56', '2023-10-15 11:16:37'),
(5, 'Primus 72cl', '6.00', '3.00', '18.00', 'boisson', 3, 1, '2023-10-15 11:04:07', '2023-10-15 11:16:37'),
(6, 'Primus 72cl', '2.00', '3.00', '6.00', 'boisson', 3, 1, '2023-10-15 11:04:20', '2023-10-15 11:16:37'),
(7, 'La vie', '3.00', '0.50', '1.50', 'boisson', 2, 1, '2023-10-15 11:16:20', '2023-10-15 11:18:08'),
(8, 'La vie', '6.00', '0.50', '3.00', 'boisson', 1, 1, '2023-10-15 11:17:36', '2023-10-15 11:20:20'),
(9, 'Poisson', '6.00', '5.00', '30.00', 'nourriture', 1, 1, '2023-10-15 11:17:52', '2023-10-15 11:20:20'),
(10, 'Poisson', '4.00', '5.00', '20.00', 'nourriture', 1, 1, '2023-10-15 11:20:05', '2023-10-15 11:20:20'),
(11, 'La vie', '2.00', '0.50', '1.00', 'boisson', 1, 0, '2023-12-01 01:13:26', '2023-12-01 01:13:26'),
(12, 'Poisson', '2.00', '5.00', '10.00', 'nourriture', 1, 0, '2023-12-01 01:13:33', '2023-12-01 01:13:33');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `approvisionnements`
--
ALTER TABLE `approvisionnements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approvisionnements_boisson_id_foreign` (`boisson_id`);

--
-- Index pour la table `boissons`
--
ALTER TABLE `boissons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `boissons_designation_unique` (`designation`),
  ADD KEY `boissons_category_id_foreign` (`category_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_nom_unique` (`nom`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nourritures`
--
ALTER TABLE `nourritures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nourritures_nom_unique` (`nom`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tables_nom_unique` (`nom`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventes_table_id_foreign` (`table_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `approvisionnements`
--
ALTER TABLE `approvisionnements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `boissons`
--
ALTER TABLE `boissons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `nourritures`
--
ALTER TABLE `nourritures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `approvisionnements`
--
ALTER TABLE `approvisionnements`
  ADD CONSTRAINT `approvisionnements_boisson_id_foreign` FOREIGN KEY (`boisson_id`) REFERENCES `boissons` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `boissons`
--
ALTER TABLE `boissons`
  ADD CONSTRAINT `boissons_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `ventes_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
