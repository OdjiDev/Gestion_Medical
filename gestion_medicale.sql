-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 18 juin 2026 à 13:47
-- Version du serveur : 8.0.44
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_medicale`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

CREATE TABLE `achats` (
  `id` bigint UNSIGNED NOT NULL,
  `fournisseur_id` bigint UNSIGNED NOT NULL,
  `total` int NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `achat_items`
--

CREATE TABLE `achat_items` (
  `id` bigint UNSIGNED NOT NULL,
  `achat_id` bigint UNSIGNED NOT NULL,
  `medicament_id` bigint UNSIGNED NOT NULL,
  `quantite` int NOT NULL,
  `prix` int NOT NULL,
  `montant` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

CREATE TABLE `demandes` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `motif` enum('consultation','Vaccination',' consultation',' hospitalisation','autre') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `contenu` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demandes`
--

INSERT INTO `demandes` (`id`, `patient_id`, `motif`, `date`, `service_id`, `contenu`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Vaccination', '2026-06-17', 1, 'ertyuik;lllklk', 'en_attente', '2026-06-17 13:06:56', '2026-06-17 13:06:56'),
(2, 20, 'Vaccination', '2026-06-18', 1, 'qrtiiiiiiiiiyoyiop', 'valide', '2026-06-18 11:38:59', '2026-06-18 11:39:31');

-- --------------------------------------------------------

--
-- Structure de la table `documents_patients`
--

CREATE TABLE `documents_patients` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `demande_id` bigint UNSIGNED DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_envoi` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `examens`
--

CREATE TABLE `examens` (
  `id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `resultat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` bigint UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `medicaments`
--

CREATE TABLE `medicaments` (
  `id` bigint UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int NOT NULL,
  `quantite_alerte` int NOT NULL,
  `prix_vente` int NOT NULL,
  `prix_achat` int NOT NULL,
  `amo` decimal(8,2) NOT NULL,
  `date_expiration` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `medicaments`
--

INSERT INTO `medicaments` (`id`, `nom`, `description`, `quantite`, `quantite_alerte`, `prix_vente`, `prix_achat`, `amo`, `date_expiration`, `created_at`, `updated_at`) VALUES
(1, 'paracetamol', '500 g', 23, 20, 400, 300, 1.00, '2026-06-15', '2026-06-15 16:01:22', '2026-06-17 12:01:54'),
(2, 'novalgène', '500 g', 0, 20, 500, 350, 0.00, '2026-06-15', '2026-06-15 16:02:05', '2026-06-17 12:01:54'),
(3, 'amoxiline', '100g', 0, 20, 200, 100, 0.00, '2026-08-09', '2026-06-16 16:41:43', '2026-06-17 11:18:02');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_28_145830_and_telephone_and_role_to_users_table', 1),
(5, '2026_02_09_102134_create_database_table', 1),
(6, '2026_05_18_115321_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Structure de la table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 11);

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

CREATE TABLE `paiements` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `montant` int NOT NULL,
  `type_paiement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE `parametres` (
  `id` bigint UNSIGNED NOT NULL,
  `amo` decimal(5,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `parametres`
--

INSERT INTO `parametres` (`id`, `amo`, `created_at`, `updated_at`) VALUES
(1, 70.00, '2026-06-15 16:00:32', '2026-06-15 16:00:32');

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
-- Structure de la table `patients`
--

CREATE TABLE `patients` (
  `id` bigint UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n_dossier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`id`, `nom`, `email`, `password`, `sexe`, `adress`, `telephone`, `n_dossier`, `created_at`, `updated_at`) VALUES
(1, 'Petit', 'anastasie.lacroix@example.net', '$2y$12$BDMysAfBwbqmDyChdSaToe9h8Ni9MusMpGiJgZOS9Lx3lF0ojHIYi', 'F', '12, boulevard Thomas Jacques\n25809 Cordier', '+33 (0)1 75 13 31 80', '6249', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(2, 'Dumas', 'stephanie.gallet@example.com', '$2y$12$h7pKSsLzDPVz4irzYv1YIuapPSciDNjbwMxuypBah17eA3RN8kNWu', 'M', '608, chemin de Perrot\n71478 Valentin-la-Forêt', '07 41 29 01 65', '8261', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(3, 'Gilles', 'guillaume.chevalier@example.com', '$2y$12$u6o1xSM7ohARuUwyg6nqZObqGM/mvGn78MM9l.kDs/.XiklV2fkuS', 'M', '88, impasse de Mahe\n23051 MercierBourg', '+33 2 67 97 90 22', '7549', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(4, 'Lucas', 'margaud.loiseau@example.com', '$2y$12$Pa.EDaJk8XbAR8z4kAcsBOQq/rHjlDQsYBkwTfdPemPLpQhZg5ijS', 'M', '87, impasse de Roger\n40628 Josephnec', '01 35 40 22 65', '9822', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(5, 'Potier', 'dmeyer@example.net', '$2y$12$U1lLWnSbDeOW./dWqoVBgeLq4rl7RpFZsUYD5JyW1D.TKJ2z62yPC', 'M', '14, chemin de Lombard\n96370 PerrinBourg', '+33 (0)2 85 96 88 97', '4816', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(6, 'Noel', 'sthomas@example.com', '$2y$12$H3y3SUNPb6YCxlPpDfuN4eEhFIHy6m78DSsklUy49sy.RGwLbo2x2', 'M', '8, boulevard Gabriel Pasquier\n64349 Gautier', '+33 (0)9 45 94 46 73', '5004', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(7, 'Vaillant', 'pichon.clemence@example.org', '$2y$12$D1n7sNuBLxRVosUddNXaiemekhCKzUXoLNgi07jMLIbNiGJC4Z2Eq', 'F', '256, chemin Briand\n11296 Delorme', '0592947882', '8000', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(8, 'Fontaine', 'ejoubert@example.net', '$2y$12$hrtQ/pWvOgdbWlbigygmU.SDl6CnKkwgYM3O2YTS7FB3UCIg078/G', 'F', '79, place de Monnier\n70884 Roche-la-Forêt', '0296019258', '1007', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(9, 'Buisson', 'lefebvre.brigitte@example.net', '$2y$12$/VSZUNFBqvBS7uP1RDjM5exthLdJUZIp3GkaQQVzIe9eNdiLUVAeC', 'F', '58, rue Juliette Costa\n70953 Gerard', '04 11 62 45 60', '5767', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(10, 'Fleury', 'oceane.faivre@example.org', '$2y$12$8pEqUhApKiFDSEQwG31Tg.K32n/8fghv8bgR2wkX1HGab4JHGNA7a', 'M', '556, impasse Marcel Moreno\n79119 Legendre', '01 94 18 97 12', '6656', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(11, 'Roussel', 'berthelot.adrienne@example.net', '$2y$12$JaI1OV86l5F7WIodUcUU0ug06JL0/.Vs.f7gER15MRYL6RkEMwAre', 'M', '17, avenue de Royer\n98270 BuissonVille', '+33 (0)9 65 83 84 31', '4775', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(12, 'Colin', 'jmartins@example.net', '$2y$12$EC0JmzN.QzXBYz16s4cxnu5iOyeEIM7nK/Wd2VZnbhrGdELi.X4zm', 'F', '51, rue de Paul\n68054 Baron-les-Bains', '0314623654', '8730', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(13, 'Devaux', 'techer.gregoire@example.org', '$2y$12$Pe9p/53h8xvurtwsTwQ2dO5/LbqktCqmWZb57VZds.jJOu2B5qM9e', 'M', '67, avenue Alex Da Costa\n42798 Collin', '+33 9 94 72 76 11', '3662', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(14, 'Hoareau', 'jean11@example.net', '$2y$12$WPgW.M1zFmF/6EvZLvoXUu9g0dkWg2tY/9X1Qaff4uhhUin.LL/HS', 'F', '2, place Navarro\n34017 Perretnec', '+33 (0)6 34 35 56 10', '2622', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(15, 'Andre', 'kbarre@example.com', '$2y$12$oV3c7sPfEJeGIT/nzbGcJeAZRqCaf/W4PhXHZp2yNaPL6eC3/in1q', 'M', '52, rue Simone Auger\n90941 Poulain', '+33 2 24 44 86 97', '5494', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(16, 'Didier', 'blanchard.valerie@example.com', '$2y$12$CwoC.M5Oh/.sV//f78tTB.vFytrLaSBO9GH.Bw5i8YHL9F1qYUq7a', 'M', 'boulevard Olivier Gallet\n92875 Da Silva-sur-Vincent', '0116849056', '9712', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(17, 'Hamon', 'efernandes@example.org', '$2y$12$mWxNmr92LfkpoY/g3EQ4nuccoaxIg50jPQp.N77VQNJKF6fyEgH7W', 'M', 'boulevard Bousquet\n80742 Mendes-sur-Marty', '+33 (0)1 47 18 97 43', '9993', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(18, 'De Sousa', 'fmenard@example.com', '$2y$12$MmGCjNG6BB2wRnxO6ENBkuXMdIZ01nZW2tZSAS90GnJSp6DTvQRx2', 'F', '85, chemin Bailly\n56515 Brunnec', '+33 (0)7 87 54 49 68', '7733', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(19, 'Benoit', 'therese37@example.net', '$2y$12$Ye2.X5rctkSno4KRilBuJeNe2L5EZa2OnfkdMHf0h/znC/23t9jf2', 'F', '36, avenue Denis\n64256 Laroche', '08 02 84 84 60', '3675', '2026-06-15 15:57:31', '2026-06-15 15:57:31'),
(20, 'Chauvin', 'zacharie22@example.org', '$2y$12$P8bCI.VKO2VNUOonMZHireBCSRRzIwCGmnhE67SJDHGYw5PnpgCJO', 'M', '62, rue de Rousseau\n37158 Morvan-sur-Mer', '09 88 71 46 23', '9814', '2026-06-15 15:57:31', '2026-06-15 15:57:31');

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `receptions`
--

CREATE TABLE `receptions` (
  `id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amo` tinyint(1) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `tarif` int NOT NULL,
  `montantPayer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montantAmo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `receptions`
--

INSERT INTO `receptions` (`id`, `service_id`, `nom`, `prenom`, `telephone`, `amo`, `status`, `tarif`, `montantPayer`, `montantAmo`, `created_at`, `updated_at`) VALUES
(1, 1, 'patient', 'patient', NULL, 1, 'en_attente', 10000, '3000', '7000', '2026-06-17 12:42:36', '2026-06-17 12:42:36');

-- --------------------------------------------------------

--
-- Structure de la table `rendez_vous`
--

CREATE TABLE `rendez_vous` (
  `id` bigint UNSIGNED NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `objectif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(2, 'user', 'web', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(3, 'pharmacien', 'web', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(4, 'medecin', 'web', '2026-06-15 15:57:26', '2026-06-15 15:57:26');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service_medicales`
--

CREATE TABLE `service_medicales` (
  `id` bigint UNSIGNED NOT NULL,
  `type_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `service_medicales`
--

INSERT INTO `service_medicales` (`id`, `type_service`, `tarif`, `created_at`, `updated_at`) VALUES
(1, 'consutation', 10000, '2026-06-17 12:41:32', '2026-06-17 12:41:32');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8KsISq4tsMX494wFkWrzTrmKeAh8dtFYmZKvv2vC', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiemxPUWxDRkY0Q0pQQjRsdm82SHdKQ3BkdXZtUmY1VHlmZDlObFZiQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYXRpZW50P3BhZ2U9MiI7czo1OiJyb3V0ZSI7czoxMzoicGF0aWVudC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjExO3M6NTQ6ImxvZ2luX3BhdGllbnRfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyMDt9', 1781782893);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public/img/undraw_profile.svg',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `telephone`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'François Auger', 'antoine.torres@example.org', NULL, 'public/img/undraw_profile.svg', '2026-06-15 15:57:26', '$2y$12$gb00d4rXmj0bVmrHg4o2j.r74P.NGSmv80SEkxNJB4B5TpOE8UziW', 'VLni2hYElj', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(2, 'Vincent Delorme', 'lucie32@example.org', NULL, 'public/img/undraw_profile.svg', '2026-06-15 15:57:26', '$2y$12$gb00d4rXmj0bVmrHg4o2j.r74P.NGSmv80SEkxNJB4B5TpOE8UziW', '3gClf7lprw', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(3, 'Émile-Benjamin Fernandes', 'alix.dossantos@example.net', NULL, 'public/img/undraw_profile.svg', '2026-06-15 15:57:26', '$2y$12$gb00d4rXmj0bVmrHg4o2j.r74P.NGSmv80SEkxNJB4B5TpOE8UziW', '2PMwtINo4l', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(4, 'Marc-Patrick Pasquier', 'mendes.jerome@example.com', NULL, 'public/img/undraw_profile.svg', '2026-06-15 15:57:26', '$2y$12$gb00d4rXmj0bVmrHg4o2j.r74P.NGSmv80SEkxNJB4B5TpOE8UziW', 'FxrD0dXmiB', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(5, 'Marie Riviere', 'poirier.alain@example.net', NULL, 'public/img/undraw_profile.svg', '2026-06-15 15:57:26', '$2y$12$gb00d4rXmj0bVmrHg4o2j.r74P.NGSmv80SEkxNJB4B5TpOE8UziW', 'BEfn0rQOD9', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(6, 'Adrien Poirier-Laine', 'clemence10@example.com', NULL, 'public/img/undraw_profile.svg', '2026-06-15 15:57:26', '$2y$12$gb00d4rXmj0bVmrHg4o2j.r74P.NGSmv80SEkxNJB4B5TpOE8UziW', 'krCeMORcay', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(7, 'Madeleine de Marchal', 'nregnier@example.com', NULL, 'public/img/undraw_profile.svg', '2026-06-15 15:57:26', '$2y$12$gb00d4rXmj0bVmrHg4o2j.r74P.NGSmv80SEkxNJB4B5TpOE8UziW', '9LD9xziGBC', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(8, 'Bernadette Rousseau', 'dphilippe@example.com', NULL, 'public/img/undraw_profile.svg', '2026-06-15 15:57:26', '$2y$12$gb00d4rXmj0bVmrHg4o2j.r74P.NGSmv80SEkxNJB4B5TpOE8UziW', 'cckq4h3LGi', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(9, 'Matthieu Renaud', 'simone.martel@example.net', NULL, 'public/img/undraw_profile.svg', '2026-06-15 15:57:26', '$2y$12$gb00d4rXmj0bVmrHg4o2j.r74P.NGSmv80SEkxNJB4B5TpOE8UziW', 'kCpubwrUNa', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(10, 'Gabriel de la Lemaire', 'petit.margaret@example.org', NULL, 'public/img/undraw_profile.svg', '2026-06-15 15:57:26', '$2y$12$gb00d4rXmj0bVmrHg4o2j.r74P.NGSmv80SEkxNJB4B5TpOE8UziW', '1IuBAnLYhU', '2026-06-15 15:57:26', '2026-06-15 15:57:26'),
(11, 'djibril', 'djibidouc17@gmail.com', '61180828', 'public/img/undraw_profile.svg', NULL, '$2y$12$a2S8fh2R5MGIhvvHAeFmRODf1F/Yk1JqxdEvgWx8wWXVpTumSzQ6G', NULL, '2026-06-15 15:57:26', '2026-06-15 15:57:26');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id` bigint UNSIGNED NOT NULL,
  `total` int NOT NULL,
  `montant_payer` int NOT NULL,
  `montant_amo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id`, `total`, `montant_payer`, `montant_amo`, `amo`, `reference`, `date`, `created_at`, `updated_at`) VALUES
(1, 3200, 2360, '840', '1', 'VNT-2026-0001', '2026-06-15', '2026-06-15 16:03:09', '2026-06-15 16:29:45'),
(2, 4500, 3100, '1400', '1', 'VNT-2026-0002', '2026-06-15', '2026-06-15 16:04:11', '2026-06-15 16:29:56'),
(3, 800, 240, '560', '1', 'VNT-2026-0003', '2026-06-15', '2026-06-15 16:17:51', '2026-06-15 16:30:09'),
(4, 800, 240, '560', '1', 'VNT-2026-0004', '2026-06-16', '2026-06-16 22:44:43', '2026-06-16 22:45:02'),
(5, 2200, 1640, '560.00', '0', 'VNT-2026-0005', '2026-06-17', '2026-06-17 11:18:02', '2026-06-17 11:18:02'),
(6, 800, 240, '560', '1', 'VNT-2026-0006', '2026-06-17', '2026-06-17 11:32:55', '2026-06-17 11:35:13'),
(7, 900, 900, '0.00', '0', 'VNT-2026-0007', '2026-06-17', '2026-06-17 12:01:54', '2026-06-17 12:01:54');

-- --------------------------------------------------------

--
-- Structure de la table `vente_items`
--

CREATE TABLE `vente_items` (
  `id` bigint UNSIGNED NOT NULL,
  `vente_id` bigint UNSIGNED NOT NULL,
  `medicament_id` bigint UNSIGNED NOT NULL,
  `quantite` int NOT NULL,
  `prix` int NOT NULL,
  `montant` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vente_items`
--

INSERT INTO `vente_items` (`id`, `vente_id`, `medicament_id`, `quantite`, `prix`, `montant`, `created_at`, `updated_at`) VALUES
(36, 1, 1, 3, 400, 1200, '2026-06-15 16:29:45', '2026-06-15 16:29:45'),
(37, 1, 2, 4, 500, 2000, '2026-06-15 16:29:45', '2026-06-15 16:29:45'),
(38, 2, 1, 5, 400, 2000, '2026-06-15 16:29:56', '2026-06-15 16:29:56'),
(39, 2, 2, 5, 500, 2500, '2026-06-15 16:29:56', '2026-06-15 16:29:56'),
(41, 3, 1, 2, 400, 800, '2026-06-15 16:30:09', '2026-06-15 16:30:09'),
(43, 4, 1, 2, 400, 800, '2026-06-16 22:45:02', '2026-06-16 22:45:02'),
(44, 5, 1, 2, 400, 800, '2026-06-17 11:18:02', '2026-06-17 11:18:02'),
(45, 5, 2, 2, 500, 1000, '2026-06-17 11:18:02', '2026-06-17 11:18:02'),
(46, 5, 3, 2, 200, 400, '2026-06-17 11:18:02', '2026-06-17 11:18:02'),
(48, 6, 1, 2, 400, 800, '2026-06-17 11:35:13', '2026-06-17 11:35:13'),
(49, 7, 1, 1, 400, 400, '2026-06-17 12:01:54', '2026-06-17 12:01:54'),
(50, 7, 2, 1, 500, 500, '2026-06-17 12:01:54', '2026-06-17 12:01:54');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `achats_fournisseur_id_foreign` (`fournisseur_id`);

--
-- Index pour la table `achat_items`
--
ALTER TABLE `achat_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `achat_items_achat_id_foreign` (`achat_id`),
  ADD KEY `achat_items_medicament_id_foreign` (`medicament_id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Index pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `demandes_service_id_foreign` (`service_id`),
  ADD KEY `demandes_patient_id_foreign` (`patient_id`);

--
-- Index pour la table `documents_patients`
--
ALTER TABLE `documents_patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_patients_patient_id_foreign` (`patient_id`),
  ADD KEY `documents_patients_demande_id_foreign` (`demande_id`);

--
-- Index pour la table `examens`
--
ALTER TABLE `examens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examens_service_id_foreign` (`service_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medicaments`
--
ALTER TABLE `medicaments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Index pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paiements_patient_id_foreign` (`patient_id`);

--
-- Index pour la table `parametres`
--
ALTER TABLE `parametres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patients_n_dossier_unique` (`n_dossier`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `receptions`
--
ALTER TABLE `receptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receptions_service_id_foreign` (`service_id`);

--
-- Index pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rendez_vous_patient_id_foreign` (`patient_id`),
  ADD KEY `rendez_vous_user_id_foreign` (`user_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Index pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Index pour la table `service_medicales`
--
ALTER TABLE `service_medicales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vente_items`
--
ALTER TABLE `vente_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vente_items_vente_id_foreign` (`vente_id`),
  ADD KEY `vente_items_medicament_id_foreign` (`medicament_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achats`
--
ALTER TABLE `achats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `achat_items`
--
ALTER TABLE `achat_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `documents_patients`
--
ALTER TABLE `documents_patients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `examens`
--
ALTER TABLE `examens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `medicaments`
--
ALTER TABLE `medicaments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `parametres`
--
ALTER TABLE `parametres`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `receptions`
--
ALTER TABLE `receptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `service_medicales`
--
ALTER TABLE `service_medicales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `vente_items`
--
ALTER TABLE `vente_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achats`
--
ALTER TABLE `achats`
  ADD CONSTRAINT `achats_fournisseur_id_foreign` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `achat_items`
--
ALTER TABLE `achat_items`
  ADD CONSTRAINT `achat_items_achat_id_foreign` FOREIGN KEY (`achat_id`) REFERENCES `achats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `achat_items_medicament_id_foreign` FOREIGN KEY (`medicament_id`) REFERENCES `medicaments` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD CONSTRAINT `demandes_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `demandes_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `service_medicales` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `documents_patients`
--
ALTER TABLE `documents_patients`
  ADD CONSTRAINT `documents_patients_demande_id_foreign` FOREIGN KEY (`demande_id`) REFERENCES `demandes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documents_patients_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `examens`
--
ALTER TABLE `examens`
  ADD CONSTRAINT `examens_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `service_medicales` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paiements`
--
ALTER TABLE `paiements`
  ADD CONSTRAINT `paiements_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `receptions`
--
ALTER TABLE `receptions`
  ADD CONSTRAINT `receptions_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `service_medicales` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rendez_vous`
--
ALTER TABLE `rendez_vous`
  ADD CONSTRAINT `rendez_vous_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rendez_vous_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vente_items`
--
ALTER TABLE `vente_items`
  ADD CONSTRAINT `vente_items_medicament_id_foreign` FOREIGN KEY (`medicament_id`) REFERENCES `medicaments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vente_items_vente_id_foreign` FOREIGN KEY (`vente_id`) REFERENCES `ventes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
