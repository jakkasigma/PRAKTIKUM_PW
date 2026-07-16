CREATE DATABASE IF NOT EXISTS tournament_db;
USE tournament_db;

CREATE TABLE users (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE teams (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) UNIQUE NOT NULL,
    logo VARCHAR(255) DEFAULT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tournaments (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    start_date DATE,
    end_date DATE,
    max_teams INT(11) DEFAULT 8,
    status ENUM('draft','ongoing','completed') DEFAULT 'draft',
    champion_team_id INT(11) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (champion_team_id) REFERENCES teams(id) ON DELETE SET NULL
);

CREATE TABLE players (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    nickname VARCHAR(50) DEFAULT NULL,
    role VARCHAR(50) DEFAULT NULL,
    team_id INT(11) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL
);

CREATE TABLE registrations (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    tournament_id INT(11) NOT NULL,
    team_id INT(11) NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_registration (tournament_id, team_id),
    FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON DELETE CASCADE,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE CASCADE
);

CREATE TABLE matches (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    tournament_id INT(11) NOT NULL,
    round INT(11) NOT NULL,
    match_order INT(11) NOT NULL,
    team1_id INT(11) DEFAULT NULL,
    team2_id INT(11) DEFAULT NULL,
    score_team1 INT(11) DEFAULT NULL,
    score_team2 INT(11) DEFAULT NULL,
    winner_id INT(11) DEFAULT NULL,
    mvp_player_id INT(11) DEFAULT NULL,
    is_bye TINYINT(1) DEFAULT 0,
    status ENUM('pending','ongoing','completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON DELETE CASCADE,
    FOREIGN KEY (team1_id) REFERENCES teams(id) ON DELETE SET NULL,
    FOREIGN KEY (team2_id) REFERENCES teams(id) ON DELETE SET NULL,
    FOREIGN KEY (winner_id) REFERENCES teams(id) ON DELETE SET NULL,
    FOREIGN KEY (mvp_player_id) REFERENCES players(id) ON DELETE SET NULL
);
