USE tournament_db;

-- ============================================================
-- CLEAR EXISTING DATA (order respects FK constraints)
-- ============================================================
DELETE FROM matches;
DELETE FROM registrations;
DELETE FROM players;
DELETE FROM teams;
DELETE FROM tournaments;
DELETE FROM users;

-- ============================================================
-- USER
-- ============================================================
INSERT INTO users (id, username, password, created_at) VALUES
(1, 'admin', '$2y$10$22parWhCyf.ZgH0tkJOLSubRzMKhyogE0z41P2U4RiC.vh5VgJcCW', NOW());

-- ============================================================
-- TEAMS (12 tim esports)
-- ============================================================
INSERT INTO teams (id, name, description) VALUES
(1,  'RRQ',        'Rex Regum Qeon — Raja dari segala raja'),
(2,  'EVOS',       'EVOS Esports — Legenda hidup'),
(3,  'ONIC',       'ONIC Esports — Monster kuning'),
(4,  'Alter Ego',  'Alter Ego — Mimpi dan realita'),
(5,  'AURA',       'AURA Esports — Cahaya kemenangan'),
(6,  'BIGETRON',   'Bigetron Era — Dominasi wanita'),
(7,  'Geek Fam',   'Geek Fam — Keluarga digital'),
(8,  'Rebellion',  'Rebellion — Pemberontak sejati'),
(9,  'Genesis',    'Genesis — Awal dari segalanya'),
(10, 'Vortex',     'Vortex — Pusaran kemenangan'),
(11, 'Nova',       'Nova — Bintang baru bersinar'),
(12, 'Titan',      'Titan — Raksasa tak terkalahkan');

-- ============================================================
-- PLAYERS (4-5 pemain per tim = 56 pemain)
-- ============================================================
INSERT INTO players (id, name, nickname, role, team_id) VALUES

-- RRQ (tim 1)
(1,  'Rizky Ardiansyah',  'RizkyR',   'Gold Laner',  1),
(2,  'Alif Firmansyah',   'AlifF',    'Roamer',      1),
(3,  'Bima Sakti',        'BimaS',    'EXP Laner',   1),
(4,  'Cakra Dirgantara',  'CakraD',   'Jungler',     1),
(5,  'Dika Pratama',      'DikaP',    'Mid Laner',   1),

-- EVOS (tim 2)
(6,  'Evan Susanto',      'EvanS',    'Gold Laner',  2),
(7,  'Fikri Hidayat',     'FikriH',   'Jungler',     2),
(8,  'Gilang Permana',    'GilangP',  'EXP Laner',   2),
(9,  'Hendra Lesmana',    'HendraL',  'Roamer',      2),
(10, 'Indra Kusuma',      'IndraK',   'Mid Laner',   2),

-- ONIC (tim 3)
(11, 'Joko Widodo',       'JokoW',    'Jungler',     3),
(12, 'Kevin Sanjaya',     'KevinS',   'Gold Laner',  3),
(13, 'Lutfi Aziz',        'LutfiA',   'Mid Laner',   3),
(14, 'Mega Chandra',      'MegaC',    'EXP Laner',   3),
(15, 'Nanda Pratama',     'NandaP',   'Roamer',      3),

-- Alter Ego (tim 4)
(16, 'Oscar Wirawan',     'OscarW',   'EXP Laner',   4),
(17, 'Putra Mahardika',   'PutraM',   'Jungler',     4),
(18, 'Qori Halimah',      'QoriH',    'Mid Laner',   4),
(19, 'Rama Dwiputra',     'RamaD',    'Gold Laner',  4),
(20, 'Sari Dewi',         'SariD',    'Roamer',      4),

-- AURA (tim 5)
(21, 'Teguh Prasetyo',    'TeguhP',   'Gold Laner',  5),
(22, 'Umar Zaky',         'UmarZ',    'Mid Laner',   5),
(23, 'Vina Anggraini',    'VinaA',    'Roamer',      5),
(24, 'Wahyu Setiawan',    'WahyuS',   'EXP Laner',   5),
(25, 'Xavier Tan',        'XavierT',  'Jungler',     5),

-- BIGETRON (tim 6)
(26, 'Yuni Astuti',       'YuniA',    'Gold Laner',  6),
(27, 'Zainal Abidin',     'ZainalA',  'Mid Laner',   6),
(28, 'Adinda Putri',      'AdindaP',  'Jungler',     6),
(29, 'Bagas Wicaksono',   'BagasW',   'EXP Laner',   6),
(30, 'Cindy Permata',     'CindyP',   'Roamer',      6),

-- Geek Fam (tim 7)
(31, 'Dimas Arya',        'DimasA',   'Jungler',     7),
(32, 'Elsa Fitriana',     'ElsaF',    'Mid Laner',   7),
(33, 'Fahri Ramadhan',    'FahriR',   'Gold Laner',  7),
(34, 'Gita Puspita',      'GitaP',    'Roamer',      7),
(35, 'Hadi Sucipto',      'HadiS',    'EXP Laner',   7),

-- Rebellion (tim 8)
(36, 'Irfan Maulana',     'IrfanM',   'EXP Laner',   8),
(37, 'Jessica Angelina',  'JessicaA', 'Roamer',      8),
(38, 'Krisna Wijaya',     'KrisnaW',  'Jungler',     8),
(39, 'Linda Permata',     'LindaP',   'Gold Laner',  8),
(40, 'Miko Ardiansyah',   'MikoA',    'Mid Laner',   8),

-- Genesis (tim 9)
(41, 'Nina Oktaviani',    'NinaO',    'Mid Laner',   9),
(42, 'Omar Hakim',        'OmarH',    'EXP Laner',   9),
(43, 'Pandu Wijaya',      'PanduW',   'Gold Laner',  9),
(44, 'Queen Safira',      'QueenS',   'Roamer',      9),
(45, 'Rudi Hermawan',     'RudiH',    'Jungler',     9),

-- Vortex (tim 10)
(46, 'Sigit Pramono',     'SigitP',   'Jungler',     10),
(47, 'Tina Marlina',      'TinaM',    'Gold Laner',  10),
(48, 'Usman Kurniawan',   'UsmanK',   'EXP Laner',   10),
(49, 'Vera Susanti',      'VeraS',    'Roamer',      10),
(50, 'Winda Febriani',    'WindaF',   'Mid Laner',   10),

-- Nova (tim 11)
(51, 'Agung Prasetya',    'AgungP',   'EXP Laner',   11),
(52, 'Bella Safitri',     'BellaS',   'Roamer',      11),
(53, 'Citra Ayu',         'CitraA',   'Gold Laner',  11),
(54, 'Doni Saputra',      'DoniS',    'Mid Laner',   11),

-- Titan (tim 12)
(55, 'Edo Sanjaya',       'EdoS',     'Jungler',     12),
(56, 'Fitri Handayani',   'FitriH',   'Gold Laner',  12),
(57, 'Guntur Wibowo',     'GunturW',  'EXP Laner',   12),
(58, 'Hana Salsabila',    'HanaS',    'Roamer',      12),
(59, 'Iqbal Maulana',     'IqbalM',   'Mid Laner',   12);

-- ============================================================
-- TOURNAMENTS
-- ============================================================
-- Turnamen 1: MLBB Season 1 — COMPLETED (8 tim, full bracket + champion)
-- Turnamen 2: Valorant Championship — ONGOING (4 tim, bracket sebagian diisi)
-- Turnamen 3: PUBGM Tournament — DRAFT (3 tim, belum bracket)
-- Turnamen 4: FIFA Cup 2026 — ONGOING (8 tim, bracket siap tapi belum ada skor)
-- Turnamen 5: Free Fire Masters — DRAFT (belum ada tim)
INSERT INTO tournaments (id, name, description, start_date, end_date, max_teams, status, champion_team_id) VALUES
(1, 'MLBB Season 1',       'Turnamen Mobile Legends antar fakultas se-Jabodetabek',                                             '2026-05-01', '2026-05-10', 8,  'completed', 1),
(2, 'Valorant Championship','Turnamen Valorant tahunan tingkat universitas',                                                    '2026-06-15', '2026-06-20', 4,  'ongoing',   NULL),
(3, 'PUBGM Tournament',    'Turnamen PUBGM peringatan HUT RI ke-81',                                                           '2026-07-01', '2026-07-05', 8,  'draft',     NULL),
(4, 'FIFA Cup 2026',       'Turnamen FIFA 2026 antar prodi',                                                                   '2026-06-20', '2026-06-28', 8,  'ongoing',   NULL),
(5, 'Free Fire Masters',   'Turnamen Free Fire untuk pemula',                                                                  '2026-08-01', '2026-08-07', 8,  'draft',     NULL);

-- ============================================================
-- REGISTRATIONS
-- ============================================================
-- MLBB Season 1: 8 tim (RRQ, EVOS, ONIC, Alter Ego, AURA, BIGETRON, Geek Fam, Rebellion)
INSERT INTO registrations (id, tournament_id, team_id) VALUES
(1,  1, 1), (2,  1, 2), (3,  1, 3), (4,  1, 4),
(5,  1, 5), (6,  1, 6), (7,  1, 7), (8,  1, 8);

-- Valorant Championship: 4 tim (RRQ, EVOS, ONIC, Alter Ego)
INSERT INTO registrations (id, tournament_id, team_id) VALUES
(9,  2, 1), (10, 2, 2), (11, 2, 3), (12, 2, 4);

-- PUBGM Tournament: 3 tim (AURA, BIGETRON, Genesis) — belum penuh
INSERT INTO registrations (id, tournament_id, team_id) VALUES
(13, 3, 5), (14, 3, 6), (15, 3, 9);

-- FIFA Cup 2026: 8 tim (RRQ, Genesis, Nova, Titan, EVOS, Vortex, ONIC, AURA)
INSERT INTO registrations (id, tournament_id, team_id) VALUES
(16, 4, 1), (17, 4, 9), (18, 4, 11), (19, 4, 12),
(20, 4, 2), (21, 4, 10), (22, 4, 3), (23, 4, 5);

-- ============================================================
-- MATCHES — MLBB Season 1 (COMPLETED)
-- 8 tim, 3 round, 7 match
-- Round 1: RRQ(1) vs Rebellion(8), EVOS(2) vs Geek Fam(7), ONIC(3) vs Alter Ego(4), AURA(5) vs BIGETRON(6)
-- Round 2: Winner(M1) vs Winner(M2), Winner(M3) vs Winner(M4)
-- Final: Winner(M5) vs Winner(M6)
-- ============================================================
INSERT INTO matches (id, tournament_id, round, match_order, team1_id, team2_id, score_team1, score_team2, winner_id, mvp_player_id, is_bye, status) VALUES

-- ROUND 1 (match_order 1-4)
(1, 1, 1, 1, 1, 8, 3, 0, 1, 1,  0, 'completed'),  -- RRQ 3-0 Rebellion, MVP: Rizky (player 1)
(2, 1, 1, 2, 2, 7, 3, 1, 2, 8,  0, 'completed'),  -- EVOS 3-1 Geek Fam, MVP: GilangP (player 8)
(3, 1, 1, 3, 3, 4, 3, 2, 3, 12, 0, 'completed'),  -- ONIC 3-2 Alter Ego, MVP: KevinS (player 12)
(4, 1, 1, 4, 5, 6, 2, 3, 6, 28, 0, 'completed'),  -- AURA 2-3 BIGETRON, MVP: AdindaP (player 28)

-- ROUND 2 (match_order 5-6)
(5, 1, 2, 5, 1, 2, 3, 2, 1, 4,  0, 'completed'),  -- RRQ 3-2 EVOS, MVP: CakraD (player 4)
(6, 1, 2, 6, 3, 6, 3, 1, 3, 13, 0, 'completed'),  -- ONIC 3-1 BIGETRON, MVP: LutfiA (player 13)

-- FINAL (match_order 7)
(7, 1, 3, 7, 1, 3, 4, 1, 1, 2,  0, 'completed');  -- RRQ 4-1 ONIC, Champion: RRQ, MVP: AlifF (player 2)

-- ============================================================
-- MATCHES — Valorant Championship (ONGOING, 2 match selesai)
-- 4 tim, 2 round
-- Round 1: RRQ(1) vs Alter Ego(4), EVOS(2) vs ONIC(3)
-- Final: Winner(M1) vs Winner(M2) — menunggu
-- ============================================================
INSERT INTO matches (id, tournament_id, round, match_order, team1_id, team2_id, score_team1, score_team2, winner_id, mvp_player_id, is_bye, status) VALUES

-- ROUND 1
(8,  2, 1, 1, 1, 4, 13, 8,  1, 1,  0, 'completed'),  -- RRQ 13-8 Alter Ego, MVP: Rizky (player 1)
(9,  2, 1, 2, 2, 3, 13, 11, 2, 6,  0, 'completed'),  -- EVOS 13-11 ONIC, MVP: EvanS (player 6)

-- FINAL (pending, winner otomatis terisi)
(10, 2, 2, 3, 1, 2, NULL, NULL, NULL, NULL, 0, 'pending');

-- ============================================================
-- MATCHES — FIFA Cup 2026 (ONGOING, bracket siap, belum ada skor)
-- 8 tim, 3 round, 7 match — semua pending
-- Round 1: RRQ(1) vs AURA(5), Genesis(9) vs ONIC(3), Nova(11) vs Vortex(10), Titan(12) vs EVOS(2)
-- ============================================================
INSERT INTO matches (id, tournament_id, round, match_order, team1_id, team2_id, score_team1, score_team2, winner_id, mvp_player_id, is_bye, status) VALUES

-- ROUND 1 (4 match, semua pending)
(11, 4, 1, 1, 1,  5, NULL, NULL, NULL, NULL, 0, 'pending'),
(12, 4, 1, 2, 9,  3, NULL, NULL, NULL, NULL, 0, 'pending'),
(13, 4, 1, 3, 11, 10, NULL, NULL, NULL, NULL, 0, 'pending'),
(14, 4, 1, 4, 12, 2, NULL, NULL, NULL, NULL, 0, 'pending'),

-- ROUND 2 (2 match, pending)
(15, 4, 2, 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'pending'),
(16, 4, 2, 6, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'pending'),

-- FINAL (1 match, pending)
(17, 4, 3, 7, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'pending');

-- ============================================================
-- SELESAI — Data dummy lengkap
-- ============================================================
