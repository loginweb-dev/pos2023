-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-01-2023 a las 23:37:56
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tpv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `system`
--

CREATE TABLE `system` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `system`
--

INSERT INTO `system` (`id`, `key`, `value`) VALUES
(1, 'db_version', '4.6'),
(2, 'default_business_active_status', '1'),
(4, 'woocommerce_version', '2.7'),
(5, 'superadmin_version', '2.7'),
(6, 'app_currency_id', '78'),
(7, 'invoice_business_name', 'gosystem'),
(8, 'invoice_business_landmark', 'SOLI'),
(9, 'invoice_business_zip', 'Zip'),
(10, 'invoice_business_state', 'BENI'),
(11, 'invoice_business_city', 'TRINIDAD'),
(12, 'invoice_business_country', 'BOLIVIA'),
(13, 'email', 'superadmin@example.com'),
(14, 'package_expiry_alert_days', '5'),
(15, 'enable_business_based_username', '0'),
(17, 'project_version', '1.6'),
(18, 'productcatalogue_version', '0.6'),
(21, 'superadmin_register_tc', NULL),
(22, 'welcome_email_subject', NULL),
(23, 'welcome_email_body', NULL),
(24, 'additional_js', NULL),
(25, 'additional_css', NULL),
(26, 'offline_payment_details', 'DEPOSITO'),
(27, 'superadmin_enable_register_tc', '0'),
(28, 'allow_email_settings_to_businesses', '0'),
(29, 'enable_new_business_registration_notification', '0'),
(30, 'enable_new_subscription_notification', '0'),
(31, 'enable_welcome_email', '0'),
(32, 'enable_offline_payment', '1'),
(34, 'repair_version', '1.1'),
(37, 'essentials_version', '2.5'),
(38, 'manufacturing_version', '2.1'),
(39, 'connector_version', '1.7'),
(40, 'crm_version', '1.4');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `system`
--
ALTER TABLE `system`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
