USE tournament_db;

INSERT INTO users (username, password) VALUES
('admin', '$2y$10$22parWhCyf.ZgH0tkJOLSubRzMKhyogE0z41P2U4RiC.vh5VgJcCW');

INSERT INTO teams (name, description) VALUES
('Team Alpha', 'Tim kuda hitam turnamen'),
('Team Beta', 'Tim veteran berpengalaman'),
('Team Gamma', 'Tim pendatang baru'),
('Team Delta', 'Tim juara bertahan');

INSERT INTO players (name, nickname, role, team_id) VALUES
('Andi Pratama', 'AndiPro', 'Captain', 1),
('Budi Santoso', 'BudiX', 'Attacker', 1),
('Citra Dewi', 'Citra', 'Support', 1),
('Deni Saputra', 'DeniS', 'Captain', 2),
('Eka Putri', 'EkaP', 'Defender', 2),
('Fajar Nugroho', 'FajarN', 'Attacker', 2),
('Gilang Permana', 'Gilang', 'All Rounder', 3),
('Hesti Wulandari', 'HestiW', 'Support', 3),
('Irfan Hakim', 'IrfanH', 'Captain', 4),
('Joko Susilo', 'JokoS', 'Attacker', 4);

INSERT INTO tournaments (name, description, start_date, end_date, status) VALUES
('Turnamen Game A', 'Turnamen game A antar fakultas', '2026-08-01', '2026-08-10', 'draft'),
('Turnamen Game B', 'Turnamen game B tingkat universitas', '2026-07-15', '2026-07-20', 'ongoing'),
('Turnamen Game C', 'Turnamen game C peringatan HUT', '2026-06-01', '2026-06-05', 'completed');

INSERT INTO registrations (tournament_id, team_id) VALUES
(2, 1), (2, 2), (2, 3), (2, 4),
(3, 1), (3, 2);
