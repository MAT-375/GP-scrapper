-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2022 at 12:15 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `411_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `googleplay_id`
--

CREATE TABLE `googleplay_id` (
  `id` int(11) NOT NULL,
  `gp_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `googleplay_id`
--

INSERT INTO `googleplay_id` (`id`, `gp_id`, `status`) VALUES
(1, 'com.snapchat.android', 0),
(2, 'com.syntecx.pti', 0),
(3, 'com.whatsapp', 0),
(4, 'com.loan.cash.credit.barwaqt.tez.paisa.jazz.financial.ready.easy', 0),
(5, 'com.whatsapp.w4b', 0),
(6, 'com.zhiliaoapp.musically.go', 0),
(7, 'com.zhiliaoapp.musically', 0),
(8, 'com.picslab.neon.editor', 0),
(9, 'com.lemon.lvoverseas', 0),
(10, 'com.facebook.katana', 0),
(11, 'inc.trilokia.pubgfxtool', 0),
(12, 'com.vesperchip.ffhead', 0),
(13, 'com.aimpool.tech.tool', 0),
(14, 'idm.internet.download.manager.plus', 0),
(15, 'com.g19mobile.gameboosterplus', 0),
(16, 'uk.co.focusmm.DTSCombo', 0),
(17, 'com.mxtech.videoplayer.pro', 0),
(18, 'uk.co.tso.ctt', 0),
(19, 'com.appntox.vpnpro', 0),
(20, 'com.cornerdesk.gfx.lite', 0),
(21, 'com.hkfuliao.chamet', 0),
(22, 'sg.bigo.live', 0),
(23, 'com.google.android.apps.subscriptions.red', 0),
(25, 'com.sgiggle.production', 0),
(26, 'com.scorp.who', 0),
(27, 'com.kwai.bulldog', 0),
(29, 'com.amazon.avod.thirdpartyclient', 0),
(30, 'com.vyke.vtl', 0),
(31, 'com.yalla.yallagames', 0),
(32, 'com.kiloo.subwaysurf', 0),
(33, 'com.superking.ludo.star', 0),
(34, 'com.ludo.king', 0),
(35, 'com.car.parking.master.puzzle.truck.games', 0),
(36, 'com.miniclip.eightballpool', 0),
(37, 'com.playrix.gardenscapes', 0),
(38, 'com.billiards.city.pool.nation.club', 0),
(39, 'com.gameswing.offroad.oiltankertransport.truckdriving.simulator.game', 0),
(40, 'com.fusee.MergeMaster', 0),
(41, 'com.mojang.minecraftpe', 0),
(42, 'com.MOBGames.PoppyMobileChap1', 0),
(43, 'com.rovio.abclassic22', 0),
(44, 'com.robtopx.geometryjump', 0),
(45, 'com.ninjakiwi.bloonstd6', 0),
(46, 'com.rockstargames.gtasa', 0),
(47, 'com.rockstargames.gtavc', 0),
(48, 'com.chucklefish.stardewvalley', 0),
(49, 'com.Zonmob.Stickman.FightingGames.ShadowOfDeath', 0),
(50, 'it.rortos.realflightsimulator', 0),
(51, 'com.tencent.ig', 0),
(52, 'com.dts.freefireth', 0),
(53, 'com.activision.callofduty.shooter', 0),
(55, 'com.tencent.iglite', 0),
(56, 'com.teenpatti.hd.gold', 0),
(57, 'com.dts.freefiremax', 0),
(58, 'com.kabam.marvelbattle', 0),
(59, 'com.bigfishgames.jackpotcityslotsf2pgoogle', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `googleplay_id`
--
ALTER TABLE `googleplay_id`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gp_id` (`gp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `googleplay_id`
--
ALTER TABLE `googleplay_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
