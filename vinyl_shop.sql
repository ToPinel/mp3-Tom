-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 13 avr. 2021 à 15:33
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vinyl_shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(120) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `addr1` varchar(255) NOT NULL,
  `addr2` varchar(255) NOT NULL,
  `cp` int NOT NULL,
  `ville` varchar(255) NOT NULL,
  `tel` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `pwd`, `nom`, `prenom`, `role`, `email`, `addr1`, `addr2`, `cp`, `ville`, `tel`) VALUES
(5, 'admin', '$argon2id$v=19$m=65536,t=4,p=1$b000UkZXQVZTM2ROYmxmQQ$x91SlSoV7Zkkl8pT4CWgtmu3LuG9GejQ1vcC1q2TZKs', 'admin', 'dfgs', 'role_admin', 'admin@admin.fr', 'esqgsdgsdfg', 'sdfgsdg', 12345, 'sdfgsdgsdg', 1234567891),
(4, 'azerty', '$argon2id$v=19$m=65536,t=4,p=1$b000UkZXQVZTM2ROYmxmQQ$x91SlSoV7Zkkl8pT4CWgtmu3LuG9GejQ1vcC1q2TZKs', 'fhyfyhfghfghfgh', 'dfgs', 'role_user', 'azerty@azerty.com', 'esqgsdgsdfg', 'sdfgsdg', 12345, 'sdfgsdgsdg', 1234567891);

-- --------------------------------------------------------

--
-- Structure de la table `vinyles`
--

DROP TABLE IF EXISTS `vinyles`;
CREATE TABLE IF NOT EXISTS `vinyles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mp3` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_img` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `artiste` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vinyles`
--

INSERT INTO `vinyles` (`id`, `mp3`, `cover_img`, `title`, `artiste`, `genre`, `annee`, `description`) VALUES
(1, 'its-bigger-than-hip-hop-dead-prez.mp3', 'coverDeadPrez.jpg', 'It\'s bigger than Hip Hop', 'Dead Prez', 'Hip Hop', 1998, 'Dead Prez, stylisé dead prez, est un groupe de hip-hop américain, originaire de Floride. Leur célébrité est due à leur style percutant et à leurs textes engagés. Ces derniers ont pour thème le racisme, la pédagogie critique, l\'activisme contre l\'hypocrisie des différents gouvernements américains, et le contrôle tentaculaire des grandes entreprises sur les médias, en particulier sur les labels de hip-hop. Le nom du groupe fait référence aux « Dead Presidents » (« présidents morts ») qui figurent sur les billets de dollar américains.'),
(2, 'soul-of-mischief-93-til-infinity.mp3', 'coverSoulOf.jpg', '93 til infinity', 'Soul Of Mischief', 'Hip Hop', 1993, 'Souls of Mischief est un groupe de hip-hop américain, originaire d\'Oakland, sur la Côte Ouest des États-Unis. Il se compose des rappeurs A-Plus, Opio, Phesto, et Tajai, qui sont également membres du collectif Hieroglyphics.'),
(3, 'the-pharcyde-passin-me-by.mp3', 'coverPharcyde.jpg', 'Passin me by', 'The Pharcyde', 'Hip Hop', 1993, 'The Pharcyde ([ˈfɑrsaɪd]) est un groupe américain de hip-hop, originaire du quartier de South Central, à Los Angeles, en Californie. Le groupe est initialement formé par Imani (Emandu Wilcox), Slimkid3 (Trevant Hardson), Bootie Brown (Romye Robinson) et Fatlip (Derrick Stewart)1. DJ Mark Luv est le premier disc jockey (DJ), suivi du producteur J-Swift et de J Dilla. Le groupe est surtout connu pour les singles Drop, Passin\' Me By et Runnin\', et pour leur premier album, Bizarre Ride II the Pharcyde (1992). Le groupe continue à organiser des tournées et enregistrer, ensemble et en solo2.'),
(4, 'beastie-boys-funky-boss.mp3', 'thumb_d_gallery_base_89707597.jpg', 'Funky Boss', 'Beastie Boys', 'Hip Hop', 2009, 'Beastie Boys est un groupe de hip-hop américain, originaire des quartiers de Manhattan et de Brooklyn, à New York. Pendant la majeure partie de son existence, le groupe se compose de Michael « Mike D » Diamond, Adam « MCA » Yauch et Adam « Ad-Rock » Horovitz. Plusieurs autres musiciens et disc jockeys, tels que Michael « Mix Master Mike » Schwartz, jouent également au sein du groupe, certains d\'entre eux pendant une durée conséquente, tels DJ Hurricane ou Eric Bobo.'),
(5, 'My Favorite Things.mp3', '81cl+2ZKXsL._SL1500_.jpg', 'My Favorite Things', 'John Coltrane', 'Jazz', 1961, '« C\'est cette My Favorite Things qui est, de tous ceux que nous avons enregistrés, mon morceau préféré. Je ne pense pas que j\'aimerais le refaire d\'une autre façon, alors que tous les autres disques que j\'ai faits auraient pu être améliorés par quelques détails. Cette valse est fantastique : lorsqu\'on la joue lentement, elle a un côté gospel qui n\'est pas du tout déplaisant; lorsqu\'on la joue rapidement, elle possède aussi certaines qualités indéniables. C\'est très intéressant à découvrir, un terrain qui se renouvelle selon l\'impulsion qu\'on lui donne ; c\'est d\'ailleurs la raison pour laquelle nous ne jouons pas cet air toujours sur le même tempo. »\r\n\r\n— John Coltrane, Entretien avec François Postif publié par Jazz Hot en janvier 1962'),
(6, 'ike-tina-turner-game-of-love.mp3', 'Workintogether.jpg', 'Game of Love', 'Ike and Tina Turner', 'Soul', 1970, 'Workin\' Together is a studio album released by R&B duo Ike & Tina Turner on Liberty Records in November 1970.[1] This was their second album with Liberty and their most successful studio album. The album contains their Grammy Award-winning single \"Proud Mary.\"[2]'),
(7, 'stevie-wonder-as-live-in-the-studio-1976.mp3', '71hVRbO+KHL._SX425_.jpg', 'As', 'Stevie Wonder', 'Soul', 1976, 'Songs in the Key of Life est un album de rhythm and blues-Soul de Stevie Wonder, sorti en 1976. Il s\'agit du dernier des cinq albums majeurs qu’il a réalisés au cours des années 1970, considérés comme sa « période classique », les précédents étant Music of My Mind, Talking Book, Innervisions, et Fulfillingness\' First Finale. Cet opus est considéré par les critiques et les fans comme l\'un de ses deux chefs-d\'œuvre avec Innervisions1. Le magazine Rolling Stone a placé l\'album à la 4e place de sa liste des « 500 meilleurs albums de tous les temps » en 20202.\r\n\r\nL’album a été diffusé initialement sous forme d’un double LP complété d’un EP de quatre plages ; la réédition en CD regroupe les titres sur deux disques. Comme son nom l’indique, il traite de nombreux aspects de la vie : amour, relations entre personnes, problèmes sociaux et raciaux (Black Man, Pastime Paradise, Village Ghetto Land) et aspects spirituels (Have a Talk with God).'),
(8, '07-El Machete.mp3', 'download.jpg', 'El Machete', 'Antibalas', 'Afro Beat', 2000, 'Antibalas Afrobeat Orchestra (de l\'espagnol « pare-balle ») est un groupe d\'afrobeat originaire de Brooklyn inspiré par Fela Kuti et le Harlem River Drive Orchestra de Eddie Palmieri.'),
(9, 'People Get Up And Drive Your Funky Soul.mp3', 'cover-James-Brown-Motherlode.jpg', 'People Get Up And Drive Your FunKy Soul', 'James Brown and the JB\'s', 'Soul', 1973, 'Amoureux du Funk, de la Soul et du Godfather James Brown, quelques infos sur ce titre “People get up and drive your funky soul”, écrit par le Tromboniste Fred Wesley, J.B himself & St Clair Pickney, Charles Bobbit, extrait de la B.O du film Slaughter’s Big Rip Off sorti en 1973, disponible également sur la compilation de 1988 Motherlode. Un classique de la Blaxploitation, suite du film Slaughter qui raconte la vengeance dudit Slaughter envers des mafieux qui ont tué ses parents… Une série Z pour nostalgiques, le plus important, en définitive, étant la B.O et ses morceaux percutants à souhait : “Slaughter’s Theme Song”, “Tryin’ to Get Over”, “Transmorgrapfication”, “Happy for the Poor”, “Brother Rapp”, “Big Strong”, “Really, Really, Really”, “Sexy, Sexy, Sexy”, “To My Brother”, “How Long Can I Keep Up”, “People Get Up and Drive Your Funky Soul”, “King Slaughter”, “Straight Ahead”…\r\nVocals — James Brown\r\nAlto saxophone, tenor saxophone — Maceo Parker\r\nBass — Fred Thomas\r\nDrums — John Morgan\r\nGuitar — Jimmy Nolen\r\nPercussion — Johnny Griggs\r\nTenor saxophone, baritone saxophone — St. Clair Pinckney\r\nTrombone — Fred Wesley');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
