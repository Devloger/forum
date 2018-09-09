/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : forum

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-04 17:09:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('47', 'Hatter.', 'Ut ipsam et est.');
INSERT INTO `categories` VALUES ('48', 'Dormouse.', 'Eveniet sit rerum ea necessitatibus odit blanditiis.');
INSERT INTO `categories` VALUES ('49', 'Bill\'s place for a.', 'Culpa et sint molestiae cumque corporis quas rerum.');

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `global` tinyint(1) NOT NULL DEFAULT '0',
  `section` smallint(5) unsigned DEFAULT NULL,
  `style` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `IX_Relationship4` (`section`),
  CONSTRAINT `Relationship4` FOREIGN KEY (`section`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'Users', '0', '0', null, null);
INSERT INTO `groups` VALUES ('2', 'Moderators', '0', '0', null, null);
INSERT INTO `groups` VALUES ('3', 'Admins', '1', '0', null, null);

-- ----------------------------
-- Table structure for `messages`
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(11) unsigned NOT NULL,
  `to` int(11) unsigned NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_polish_ci NOT NULL,
  `date` datetime NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `line` int(10) unsigned NOT NULL,
  `first` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`from`,`to`,`id`),
  UNIQUE KEY `id` (`id`),
  KEY `from` (`from`) USING BTREE,
  KEY `to` (`to`) USING BTREE,
  CONSTRAINT `Relationship5` FOREIGN KEY (`from`) REFERENCES `users` (`id`),
  CONSTRAINT `Relationship7` FOREIGN KEY (`to`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of messages
-- ----------------------------

-- ----------------------------
-- Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` smallint(5) unsigned NOT NULL,
  `name` varchar(190) COLLATE utf8mb4_polish_ci NOT NULL,
  `description` varchar(300) COLLATE utf8mb4_polish_ci NOT NULL,
  `content` text COLLATE utf8mb4_polish_ci NOT NULL,
  `url` varchar(190) COLLATE utf8mb4_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('1', 'Regulamin', 'To jest regulamin', 'REGULAMIN FORUM INTERNETOWEGO „MPCforum.pl”\r\nwersja nr 2.02, obowiązuje od dnia: 24 października 2013 r.\r\n\r\n \r\n\r\n§1 Postanowienia ogólne i definicje\r\n1. Niniejszy Regulamin [Regulamin], określa zasady i warunki korzystania z multitematycznego forum internetowego „MPCforum.pl”, w szczególności prawa i obowiązki Administratora Forum, Moderatorów Forum oraz Użytkowników Forum.\r\n2. Korzystanie z Forum w sposób czynny lub bierny oznacza akceptację Regulaminu\r\n3. Forum przeznaczone jest dla osób, które: ukończyły lat 13 i posiadają pełną zdolność do czynności prawnych lub, w razie potrzeby, wyznaczonego opiekuna prawnego, który wyraził stosowną zgodę.\r\n4. Forum zostało stworzone jako platforma wymiany myśli, opinii, poglądów, informacji\r\ni treści. Zasadą naczelną Forum jest szacunek dla innego Użytkownika i jego światopoglądu.\r\n5. Administrator Forum – podmiot posiadający największe uprawnienia na Forum, odpowiedzialny za zgodne z obowiązującym prawem funkcjonowanie Forum, utrzymywanie systemu informatycznego i Forum w odpowiednim stanie technicznym.\r\n6. Moderator Forum – osoba odpowiedzialna za utrzymanie porządku i ładu na Forum oraz za zgodność treści obecnych na Forum z Regulaminem.\r\n7. Użytkownicy Forum dzielą się na:\r\nUżytkowników biernych, czyli takich, którzy z różnych powodów nie dokonali pełnej rejestracji w systemie Forum, zaakceptowali Regulamin i nabyli prawo do korzystania z niektórych funkcji Forum, w szczególności do przeglądania/czytania wydzielonej przez Administratora treści.\r\nUżytkowników czynnych, czyli takich, którzy dokonali kompletnej rejestracji\r\nw systemie Forum, zaakceptowali Regulamin i nabyli prawo do korzystania ze wszystkich funkcji i działów Forum, w szczególności posiadania i używania Konta Użytkownika.\r\n8. Konto Użytkownika - wydzielona przestrzeń pamięci w systemie informatycznym Forum opisana unikalnymi: loginem i hasłem wraz z przekazanymi podczas rejestracji pozostałymi danymi identyfikacyjnymi. Konto Użytkownika składa się z profilu i wizerunku, np. zawierającego Avatar, Sygnaturę, Rangę oraz inne dane. Na Koncie Użytkownika można dobrowolnie umieścić również inne dane, np. krótki opis dotyczący Użytkownika.\r\n9. Avatar – grafika wyświetlana obok identyfikatora Użytkownika, wprowadzona przez Użytkownika czynnego, o wymiarach i rozmiarze pliku ustalanym przez Administratora Forum.\r\n10. Wpis - jednorazowa wypowiedź odnosząca się do wybranego tematu.\r\n11. Sygnatura – podpis tekstowy wyświetlany pod wpisem.\r\n12. Ranga – wskaźnik ujawniający ilość dokonanych przez Użytkownika czynnego wpisów. Ranga obejmuje:\r\na. Pijawka II 25 wpisów\r\nb. Pijawka III 50 wpisów\r\nc. Debiutant 100 wpisów\r\nd. Debiutant II 150 wpisów\r\ne. Debiutant III 200 wpisów\r\nf. Poczatkujacy 300 wpisów\r\ng. Poczatkujacy II 350 wpisów\r\nh. Poczatkujacy III 400 wpisów\r\ni. Bywalec MPC 500 wpisów\r\nj. Bywalec MPC II 600 wpisów\r\nk. Bywalec MPC III 700 wpisów\r\nl. MPC User 800 wpisów\r\nm. MPC User II 875 wpisów\r\nn. MPC User III 925 wpisów\r\no. MPC Popular User 1000 wpisów\r\np. MPC Popular User II 1500 wpisów\r\nq. MPC Popular User III 2500 wpisów\r\nr. 24h with MPC 3000 wpisów\r\ns. All life with MPC 4000 wpisów\r\nt. MPC Elite Rank I 9000 wpisów\r\nu. MPC Elite Rank II 11000 wpisów\r\nw. MPC Elite Rank III 13000 wpisów\r\ny. Inkwizytor MPC 18000 wpisów\r\nz. Mastah 20000 wpisów\r\n\r\n \r\n\r\n13. Ban – stała lub czasowa blokada dostępu do Forum konkretnego Użytkownika czynnego lub biernego albo adresu IP konkretnego komputera, nakładana przez Administratora Forum lub Moderatora Forum za udowodnione notoryczne naruszanie Regulaminu.\r\n14. Ostrzeżenie – kara umowna za jednorazowe naruszenie Regulaminu nakładana przez Administratora Forum lub Moderatora Forum.\r\n15. Prywatna wiadomość (PW) – każda jednorazowa wiadomość, którą Użytkownik czynny może przesłać innemu Użytkownikowi czynnemu za pośrednictwem Forum, pod warunkiem, że adresat (Użytkownik czynny) nie zastrzegł prywatności swojego adresu\r\ne-mail.\r\n16. Kopiowanie, modyfikowanie, dystrybucja, wyświetlanie publiczne, przedrukowywanie, licencjonowanie, sprzedaż, wymiana, przekazywanie treści i danych Forum lub jego składników bez pisemnej zgody Administratora – jest bezwarunkowo zabronione.\r\n\r\n \r\n\r\n§2 Odpłatność za korzystanie z Forum\r\n1. Korzystanie z Forum jest bezpłatne.\r\n\r\n \r\n\r\n§3 Rejestracja\r\n1. Każdy Użytkownik ma prawo do utworzenia jednego Konta Użytkownika. Każde kolejne konto, z wyłączeniem zasad odwołania od nałożonych kar i banów będzie traktowane jako multikonto i niezwłocznie banowane permanentnie.\r\n2. Użytkownik czynny ma prawo do zgłoszenia żądania usunięcia swojego Konta Użytkownika\r\nw każdym czasie, po otrzymaniu takiego żądania za pośrednictwem poczty elektronicznej, na adres e-mail: kontakt@MPCforum.pl , konto zostanie niezwłocznie przez Administratora Forum usunięte.\r\n3. W procesie rejestracji Użytkownik bierny proszony jest o:\r\na. podanie wybranego Identyfikatora Użytkownika („Nazwa wyświetlana”),\r\nb. podanie adresu e-mail,\r\nc. podanie i potwierdzenie unikalnego hasła,\r\nd. odpowiedź na pytanie rejestracyjne,\r\ne. wprowadzenie unikalnego kodu bezpieczeństwa.\r\nPomyślne zakończenie procesu rejestracji powoduje zmianę statusu Użytkownika na Użytkownika czynnego.\r\n4. Forum umożliwia zmianę hasła przez Użytkownika w każdym czasie po pierwszym udanym logowaniu.\r\n5. Użytkownik podczas rejestracji ma bezwarunkowy obowiązek podania danych kompletnych, zgodnych z prawdą i aktualnych, tj. zgodnych ze stanem faktycznym.\r\n6. Użytkownik dokonując pełnej rejestracji, celem zmiany statusu do Użytkownika czynnego ma możliwość wyrażenia zgody na wykorzystanie przez Administratora w celach marketingowych podanych danych oraz otrzymywanie wiadomości dotyczących funkcjonowania i zmian na Forum, zgodnie z Ustawą z dnia 29 sierpnia 1997 r. o ochronie danych osobowych. (Dz.U.1997, nr 133, poz. 883 z późn. zm.) oraz Ustawą z dnia 18 lipca 2002r. o świadczeniu usług drogą elektroniczną (Dz.U.2002, nr 144, poz. 1204 z późn. zm.). Użytkownikowi przysługują prawa określone w art.32 Ustawy z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (Dz.U.1997, nr 133, poz. 883 z późn. zm.), np. do wniesienia pisemnego sprzeciwu wobec przetwarzania swoich danych osobowych przez Administratora.\r\n\r\n \r\n\r\n§4 Zastrzeżenia\r\n1. Administrator zastrzega sobie prawo do kontaktu z Użytkownikiem czynnym celem weryfikacji podanych danych kontaktowych albo zapytań dotyczących funkcjonowania Forum – w razie uzasadnionej przyczyny.\r\n2. Administrator nie odpowiada za szkody i zakłócenia w działaniu Forum spowodowane przez działanie siły wyższej albo działaniem lub zaniechaniem operatora telekomunikacyjnego.\r\n3. Administrator nie odpowiada za niedostosowanie przez Użytkownika używanego systemu informatycznego lub oprogramowania do wymagań Forum.\r\n4. Administrator nie odpowiada za szkody powstałe w wyniku sprzecznych z obowiązującym prawem polskim działań Użytkowników albo osób trzecich.\r\n5. Administrator nie odpowiada za szkody powstałe w wyniku niezgodnych z Regulaminem działań Użytkowników.\r\n6. Administrator zastrzega sobie prawo do stosowania okresowych przerw w funkcjonowaniu Forum, w szczególności celem konserwacji.\r\n7. Administrator zastrzega sobie prawo do wprowadzenia modyfikacji i ulepszeń\r\nw funkcjonalności i wyglądzie Forum w każdym czasie.\r\n8. Administrator zastrzega sobie prawo do prowadzenia działalności marketingowej na Forum.\r\n9. Administrator zastrzega sobie prawo do zbierania anonimowo i grupowo danych dotyczących funkcjonowania i popularności Forum.\r\n10. Administrator zastrzega sobie prawo do zakończenia funkcjonowania wobec wystąpienia uzasadnionej przyczyny, która uniemożliwi jego działalność - w terminie 30[trzydziestu] dni od jej wystąpienia - przy braku możliwości jej usunięcia. Informacja o zdarzeniu zostanie podana niezwłocznie pod linkiem: www.mpcforum.pl .\r\n\r\n \r\n\r\n§5 Zasady wpisów\r\n1. Administrator przypomina o obowiązku przestrzegania obowiązującego prawa autorskiego.\r\n2. Administrator nakazuje sprawdzenie każdego wysyłanego na Forum pliku wykonalnego internetowym skanerem antywirusowym znajdującym się pod adresem internetowym: http://virustotal.com/\r\n3. Administrator zaleca sprawdzenie, przed założeniem nowego tematu, czy ten sam lub taki sam temat już istnieje. Dublujące się tematy będą usuwane przez Administratora lub Moderatora Forum.\r\n4. Administrator zaleca dostosowanie treści wpisu do istniejących kategorii tematycznych.\r\n5. Administrator zaleca nie umieszczanie (kopiowanie) wpisu umieszczonego na Forum do innych forum lub w wielu kategoriach.\r\n6. Administrator zaleca dokładność i precyzję w sporządzaniu wpisów.\r\n7. Administrator zaleca stosowanie się do zasad ortografii i interpunkcji języka polskiego.\r\n8. Administrator zaleca stosowanie „Netykiety” przy tworzeniu wpisów.\r\n9. Administrator zaleca, w odniesieniu do działów szczegółowych, stosowanie uzupełniające\r\nz Regulaminem, szczegółowych wytycznych tam zamieszczonych – przy czym wytyczne szczegółowe mają moc nadrzędną.\r\n10. Administrator zakazuje handlu pod wszelką postacią na Forum ruchomościami lub przedmiotami wirtualnymi. Za wyjątkiem specjalnie przeznaczonego do tego działu, na specjalnie określonych zasadach i warunkach.\r\n\r\n \r\n\r\n§6 Postanowienia uzupełniające\r\n1. Zabronione bezwarunkowo jest umieszczanie na Forum, na Koncie Użytkownika\r\nlub w wiadomościach kierowanych na Forum albo do Administratora, a także przekazywanie za jego pośrednictwem materiałów i treści sprzecznych z obowiązującym prawem polskim, zasadami współżycia społecznego oraz dobrymi obyczajami i „netykietą”, materiałów i treści: wulgarnych, obscenicznych, uważanych za tabu, powszechnie uznawanych za obraźliwe, naruszających dobra osobiste innych Osób, nakłaniających do popełnienia przestępstwa, propagujących przemoc, rasizm, agresję słowną i nagannych moralnie, a także niedozwolonych przez polskie prawo reklam: hazardu, alkoholu, wyrobów tytoniowych, narkotyków lub zabronionych środków o podobnym działaniu, leków na receptę oraz innych zabronionych prawem polskim lub międzynarodowym. W razie stwierdzenia takiego przypadku Administrator niezwłocznie zawiadomi odpowiednie organy ścigania.\r\n2. Zabronione bezwarunkowo jest umieszczanie na Forum, na Koncie Użytkownika\r\nlub w wiadomościach kierowanych na Forum albo do Administratora ogłoszeń.\r\n3. Zabronione bezwarunkowo jest umieszczanie na Koncie Użytkownika linków do stron zewnętrznych Forum, w szczególności zawierających materiały wymienione w ust 1.\r\n4. Użytkownik czynny ma prawo do umieszczania linków do stron zewnętrznych wobec Forum\r\nw działach i miejscach do tego przeznaczonych.\r\n5. Zabronione bezwarunkowo jest wykorzystywanie materiałów uzyskanych z Forum lub za pośrednictwem Forum - dotyczących Użytkowników w celach komercyjnych,\r\nw szczególności zabronione bezwarunkowo są działania polegające na wysyłaniu niechcianej informacji handlowej.\r\n6. Zabronione bezwarunkowo są wszelkie działania naruszające prywatność Użytkowników.\r\n7. Zabronione bezwarunkowo jest wykorzystywanie luk lub błędów forum. W przypadku znalezienia Użytkownik zobowiązany jest zgłosić Administratorowi zauważoną usterkę. Brak zgłoszenia lub wykorzystywanie luki w wypadku ujawnienia lub uzasadnionego podejrzenia skutkuje blokadą stałą, jako działanie na niekorzyść Forum.\r\n8. Administrator zastrzega sobie bezwarunkowe prawo do zablokowania i/lub usunięcia Konta Użytkownika zawierającego treści sprzeczne z Regulaminem lub obowiązującym\r\nw Polsce prawem. Zablokowana zostanie również następczo komunikacja z Forum za pośrednictwem komputera ze zidentyfikowanym adresem IP.\r\n9. W przypadku zgłoszenia przez Podmiot trzeci roszczeń względem opublikowanych przez Użytkownika danych, Użytkownik, który je opublikował, jest zobowiązany do złożenia\r\nw formie pisemnej oświadczenia w nieprzekraczalnym terminie: 7[siedmiu] dni o: posiadaniu praw autorskich do tych materiałów i potwierdzeniu udzielenia zgody Forum na ich umieszczenie na Forum oraz ich wykorzystanie zgodne z Regulaminem.\r\n10. W przypadku udowodnienia przez Podmiot trzeci roszczeń względem opublikowanych przez Użytkownika danych, materiałów lub linków objętych prawem autorskim, zostaną one niezwłocznie i bezwarunkowo usunięte z Forum, a Administrator załączy adnotację: „Usunięto z uwagi na uzasadnione żądanie Podmiotu trzeciego.”\r\n\r\n \r\n\r\n§7 Postępowanie w sprawie reklamacji\r\n1. Każdemu Użytkownikowi Forum przysługuje prawo do złożenia reklamacji w sprawach związanych z funkcjonowaniem Forum.\r\n2. Reklamacje należy składać drogą elektroniczną na adres e-mail Administratora: kontakt@MPCforum.pl .\r\n3. Administrator rozpatruje reklamację w terminie 14[czternastu] dni roboczych od dnia jej otrzymania.\r\n4. Odpowiedź na reklamację zostanie przesłana do Użytkownika na adres poczty elektronicznej\r\ne-mail podany przez Użytkownika w reklamacji.\r\n5. Administrator zastrzega sobie, że rozpatrzenie reklamacji może wymagać uzyskania od Użytkownika dodatkowych wyjaśnień - czas udzielania wyjaśnień przez Użytkownika każdorazowo przedłuża odpowiednio okres rozpoznania reklamacji.\r\n\r\n \r\n\r\n§8 Taryfikator ostrzeżeń\r\n1. Rejestr nałożonych ostrzeżeń prowadzi Administrator Forum. Użytkownik czynny ma prawo do zapytania w każdym czasie pod adresem e-mail: kontakt@MPCforum.pl o ilość nałożonych mu ostrzeżeń.\r\n2. Administrator Forum ma prawo do nałożenia w indywidualnym i uzasadnionym przypadku Bana czasowego lub bezterminowego, np. za wielokrotne lub poważne naruszenie Forum.\r\n\r\n \r\n\r\n§9 Postanowienia końcowe\r\n1. Forum zapewnia, iż dołoży najwyższej możliwej staranności, aby system Forum działał\r\nw sposób ciągły i bezawaryjnie.\r\n2. Forum zastrzega sobie prawo do zmiany Regulaminu w każdym czasie. Użytkownicy Forum zostaną powiadomieni o zmianie Regulaminu na stronie internetowej Forum albo podczas logowania na Konto Użytkownika i zapewniona im będzie możliwość akceptacji lub odrzucenia nowej treści Regulaminu, co wiąże się z usunięciem istniejącego konta Użytkownika\r\noraz zablokowaniem dostępu do większości treści i funkcji Forum (prócz jego przeglądania)\r\nw przypadku odrzucenia nowego Regulaminu.\r\n3. W sprawach nieuregulowanych Regulaminem mają zastosowanie: Ustawa z dnia 23 kwietnia 1964r. Kodeks cywilny (Dz.U.1964 nr 16 poz.93 z późn.zm.), ustawy szczególne oraz odpowiednie ratyfikowane umowy międzynarodowe.\r\n4. W sprawach uwag, komentarzy i działań dotyczących funkcjonowania Forum prosimy\r\no kontakt pod adresem e-mail: kontakt@MPCforum.pl .\r\n5. Regulamin wchodzi w życie z dniem publikacji na stronie głównej Forum.', 'Regulamin');

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` int(11) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `content` text COLLATE utf8mb4_polish_ci NOT NULL,
  `topic` smallint(5) unsigned NOT NULL,
  `first` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`author`,`id`,`topic`),
  UNIQUE KEY `id` (`id`),
  KEY `Relationship12` (`topic`),
  CONSTRAINT `Relationship11` FOREIGN KEY (`author`) REFERENCES `users` (`id`),
  CONSTRAINT `Relationship12` FOREIGN KEY (`topic`) REFERENCES `topics` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('47', '237', '2017-08-16 11:57:34', 'King. \'When did you manage to do such a curious dream, dear, certainly: but now run in to.', '47', '1');
INSERT INTO `posts` VALUES ('48', '238', '2017-08-16 11:57:35', 'I mentioned before, And have grown most uncommonly fat; Yet you balanced an eel on the whole.', '48', '1');
INSERT INTO `posts` VALUES ('49', '239', '2017-08-16 11:59:32', 'Alas! it was perfectly round, she came upon a time she saw them, they set to partners--\' \'--change lobsters, and retire in same order,\' continued the Pigeon, but in a shrill, loud voice, and see after some executions I have to beat them off, and Alice was too slippery; and when she had found her head struck against the roof of the ground--and I should say what you mean,\' the March Hare..', '49', '1');

-- ----------------------------
-- Table structure for `ranks`
-- ----------------------------
DROP TABLE IF EXISTS `ranks`;
CREATE TABLE `ranks` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `stars` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `style` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `minimum` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of ranks
-- ----------------------------
INSERT INTO `ranks` VALUES ('1', 'User', '1', null, '0');
INSERT INTO `ranks` VALUES ('2', 'Nice User', '2', null, '5');
INSERT INTO `ranks` VALUES ('9', 'Great User', '3', null, '10');

-- ----------------------------
-- Table structure for `reports`
-- ----------------------------
DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(10) unsigned NOT NULL,
  `to` int(10) unsigned NOT NULL,
  `post` int(10) unsigned NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`) USING BTREE,
  KEY `from` (`from`),
  KEY `to` (`to`),
  KEY `post` (`post`),
  CONSTRAINT `from` FOREIGN KEY (`from`) REFERENCES `users` (`id`),
  CONSTRAINT `post` FOREIGN KEY (`post`) REFERENCES `posts` (`id`),
  CONSTRAINT `to` FOREIGN KEY (`to`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of reports
-- ----------------------------

-- ----------------------------
-- Table structure for `reputations`
-- ----------------------------
DROP TABLE IF EXISTS `reputations`;
CREATE TABLE `reputations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `value` tinyint(4) NOT NULL,
  PRIMARY KEY (`post`,`from`,`id`),
  UNIQUE KEY `id` (`id`),
  KEY `Relationship24` (`from`),
  CONSTRAINT `Relationship23` FOREIGN KEY (`post`) REFERENCES `posts` (`id`),
  CONSTRAINT `Relationship24` FOREIGN KEY (`from`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of reputations
-- ----------------------------

-- ----------------------------
-- Table structure for `sections`
-- ----------------------------
DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_polish_ci NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `category` smallint(5) unsigned NOT NULL,
  `parent` smallint(5) unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `url` varchar(150) COLLATE utf8mb4_polish_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`id`,`category`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `url` (`url`),
  KEY `IX_Relationship11` (`parent`),
  KEY `Category` (`category`),
  CONSTRAINT `Category` FOREIGN KEY (`category`) REFERENCES `categories` (`id`),
  CONSTRAINT `sections` FOREIGN KEY (`parent`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of sections
-- ----------------------------
INSERT INTO `sections` VALUES ('47', 'Hatter..', 'Dicta dolores et ea est.', '47', null, '1', '15994332f73510', 'default.jpg');
INSERT INTO `sections` VALUES ('48', 'Alice, who.', 'Rem quasi qui quidem sint.', '47', '47', '1', '15994332ff340e', 'default.jpg');
INSERT INTO `sections` VALUES ('49', 'Soup,\" will you,.', 'Odio doloribus qui ut sequi.', '49', '48', '1', '1599433a572475', 'default.jpg');

-- ----------------------------
-- Table structure for `topics`
-- ----------------------------
DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_polish_ci NOT NULL,
  `section` smallint(5) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `url` varchar(150) COLLATE utf8mb4_polish_ci NOT NULL,
  `pin` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) unsigned NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`,`section`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `Relationship3` (`section`),
  CONSTRAINT `Relationship3` FOREIGN KEY (`section`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of topics
-- ----------------------------
INSERT INTO `topics` VALUES ('47', 'Corrupti expedita aspernatur labore molestiae.', '47', '1', 'voluptas-eum-voluptatem-soluta-numquam-ipsum-totam-est', '0', '284', '2017-08-16 11:57:35');
INSERT INTO `topics` VALUES ('48', 'Sit impedit doloribus accusantium velit consectetur aut.', '48', '1', 'repellendus-officiis-enim-expedita-quae', '0', '3', '2017-08-16 11:57:36');
INSERT INTO `topics` VALUES ('49', 'Repellendus nulla blanditiis odio repellendus sint soluta consectetur.', '49', '1', 'iusto-reprehenderit-minima-magni-ad-repellendus-aperiam-nesciunt', '0', '5', '2017-08-16 11:59:33');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(35) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL DEFAULT '',
  `password` varchar(256) COLLATE utf8mb4_polish_ci NOT NULL,
  `register` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `birth` date NOT NULL,
  `about` varchar(500) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `sex` enum('Kobieta','Mężczyzna') COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `group` smallint(5) unsigned NOT NULL,
  `rank` smallint(5) unsigned NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL DEFAULT 'default.jpg',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`group`,`rank`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `Relationship13` (`group`),
  KEY `Relationship15` (`rank`),
  CONSTRAINT `Relationship13` FOREIGN KEY (`group`) REFERENCES `groups` (`id`),
  CONSTRAINT `Relationship15` FOREIGN KEY (`rank`) REFERENCES `ranks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('4', 'krystian', 'admin@admin', '$2y$10$PHFXmpWAPsUQ4KdUISEXHeckhl1HQnoKFfUdz5G6BqLEFq9AriW7K', '2017-08-24 11:25:54', '0000-00-00 00:00:00', '1995-06-17', 'Jestem adminem!', 'Mężczyzna', '3', '1', '1598320e3908c6.jpg', '1', 'ik8xJpLdbawL0e7ZmNLKmABxhKzoaofdVeU4cIO5ymjPjt2iEZE6qM7KQxT0');
INSERT INTO `users` VALUES ('237', 'marlon.tillman', 'oschuster@yahoo.com', '$2y$10$wT96ADfNW8tammDF5x.qoOyOdc4h7EyHpBGZwPnv48Bm4BSxD9g.m', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', null);
INSERT INTO `users` VALUES ('238', 'shanahan.ervin', 'dicki.destiney@bode.com', '$2y$10$RzWMaDg7A7xxtBES5W28GufE1y7otPvsdNB4W89EFfGSsdgs9Am66', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', null);
INSERT INTO `users` VALUES ('239', 'tzieme', 'mkassulke@heidenreich.org', '$2y$10$p.BkzYHhkxA6ImKJ4VLVNOFyzNi5zRF02efm3/enOgR.KFdp9Onr6', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', null, null, '1', '1', 'default.jpg', '1', null);

-- ----------------------------
-- Table structure for `warns`
-- ----------------------------
DROP TABLE IF EXISTS `warns`;
CREATE TABLE `warns` (
  `id` int(11) unsigned NOT NULL,
  `post` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `value` tinyint(4) NOT NULL,
  PRIMARY KEY (`post`,`from`,`id`),
  UNIQUE KEY `id` (`id`),
  KEY `Relationship27` (`from`),
  CONSTRAINT `Relationship26` FOREIGN KEY (`post`) REFERENCES `posts` (`id`),
  CONSTRAINT `Relationship27` FOREIGN KEY (`from`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- ----------------------------
-- Records of warns
-- ----------------------------
