USE tournament_db;

-- ============================================================
-- TAMBAH 15 TIM BARU (ID 18-32)
-- ============================================================
INSERT INTO teams (id, name, description) VALUES
(18, 'Elite 8',      'Tim elite delapan'),
(19, 'Shadow',       'Bayang-bayang kematian'),
(20, 'Phoenix',      'Bangkit dari abu'),
(21, 'Thunder',      'Petir yang menyambar'),
(22, 'Blizzard',     'Badai es yang membekukan'),
(23, 'Fury',         'Amukan yang tak terbendung'),
(24, 'Crimson',      'Merah darah yang haus kemenangan'),
(25, 'Oblivion',     'Penghancur segalanya'),
(26, 'Zenith',       'Puncak tertinggi'),
(27, 'Dragons',      'Naga yang mengamuk'),
(28, 'Warriors',     'Prajurit tangguh'),
(29, 'Eclipse',      'Gerhana kegelapan'),
(30, 'Infinity',     'Tanpa batas'),
(31, 'Velocity',     'Kecepatan cahaya'),
(32, 'Mavericks',    'Pemberontak tanpa aturan');

-- ============================================================
-- TAMBAH 30 PEMAIN BARU (2 per tim)
-- ============================================================
INSERT INTO players (name, nickname, role, team_id) VALUES
('Adi Pratama',     'AdiP',    'Captain', 18),
('Bunga Citra',     'BungaC',  'Attacker', 18),
('Cahyo Saputra',   'CahyoS',  'Captain', 19),
('Dewi Lestari',    'DewiL',   'Support', 19),
('Eko Prasetyo',    'EkoP',    'Captain', 20),
('Fitriani',        'Fitri',   'Attacker', 20),
('Gunawan',         'Gunawan', 'Captain', 21),
('Hilda Ayu',       'HildaA',  'Defender', 21),
('Irwan Saputra',   'IrwanS',  'Captain', 22),
('Jasmine Putri',   'JasmineP','Support', 22),
('Kurniawan',       'Kurnia',  'Captain', 23),
('Larasati',        'Laras',   'Attacker', 23),
('Maulana Malik',   'MaulanaM','Captain', 24),
('Nadya Sari',      'NadyaS',  'Support', 24),
('Oka Wirawan',     'OkaW',    'Captain', 25),
('Putri Ayu',       'PutriA',  'Attacker', 25),
('Qori Aulia',      'QoriA',   'Captain', 26),
('Raka Pratama',    'RakaP',   'Defender', 26),
('Sari Indah',      'SariI',   'Captain', 27),
('Teguh Santoso',   'TeguhS',  'Attacker', 27),
('Ujang Kosasih',   'UjangK',  'Captain', 28),
('Vani Anggraini',  'VaniA',   'Support', 28),
('Wawan Setiawan',  'WawanS',  'Captain', 29),
('Xena Permata',    'XenaP',   'Attacker', 29),
('Yoga Pratama',    'YogaP',   'Captain', 30),
('Zahra Aulia',     'ZahraA',  'Defender', 30),
('Agung Wicaksono', 'AgungW',  'Captain', 31),
('Bella Safira',    'BellaSf', 'Attacker', 31),
('Cipto Wijaya',    'CiptoW',  'Captain', 32),
('Dian Pertiwi',    'DianP',   'Support', 32);

-- ============================================================
-- TURNAMEN 32 TIM
-- ============================================================
INSERT INTO tournaments (id, name, description, start_date, end_date, max_teams, status) VALUES
(6, 'World Championship 2026', 'Turnamen internasional tahunan dengan 32 tim terbaik dari seluruh dunia', '2026-09-01', '2026-09-15', 32, 'draft');

-- ============================================================
-- DAFTARKAN SEMUA 32 TIM
-- ============================================================
INSERT INTO registrations (tournament_id, team_id) VALUES
(6, 1), (6, 2), (6, 3), (6, 4), (6, 5), (6, 6), (6, 7), (6, 8),
(6, 9), (6, 10), (6, 11), (6, 12), (6, 13), (6, 14), (6, 15), (6, 16),
(6, 17), (6, 18), (6, 19), (6, 20), (6, 21), (6, 22), (6, 23), (6, 24),
(6, 25), (6, 26), (6, 27), (6, 28), (6, 29), (6, 30), (6, 31), (6, 32);
