<?php
class MatchModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getByTournament($tournament_id) {
        $tournament_id = intval($tournament_id);
        $query = "SELECT m.*, 
                  t1.name as team1_name, t2.name as team2_name,
                  w.name as winner_name,
                  p.name as mvp_name, p.nickname as mvp_nickname
                  FROM matches m
                  LEFT JOIN teams t1 ON m.team1_id = t1.id
                  LEFT JOIN teams t2 ON m.team2_id = t2.id
                  LEFT JOIN teams w ON m.winner_id = w.id
                  LEFT JOIN players p ON m.mvp_player_id = p.id
                  WHERE m.tournament_id = $tournament_id
                  ORDER BY m.round, m.match_order";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getById($id) {
        $id = intval($id);
        $query = "SELECT m.*,
                  t1.name as team1_name, t2.name as team2_name,
                  w.name as winner_name,
                  p.name as mvp_name
                  FROM matches m
                  LEFT JOIN teams t1 ON m.team1_id = t1.id
                  LEFT JOIN teams t2 ON m.team2_id = t2.id
                  LEFT JOIN teams w ON m.winner_id = w.id
                  LEFT JOIN players p ON m.mvp_player_id = p.id
                  WHERE m.id = $id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function getTotalRounds($tournament_id) {
        $tournament_id = intval($tournament_id);
        $query = "SELECT MAX(round) as total FROM matches WHERE tournament_id = $tournament_id";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['total'] ?? 0;
    }

    public function updateScore($id, $score1, $score2, $winner_id, $mvp_id) {
        $id = intval($id);
        $score1 = intval($score1);
        $score2 = intval($score2);
        $winner_id = intval($winner_id);
        $mvp_id = $mvp_id ? intval($mvp_id) : 'NULL';

        $query = "UPDATE matches SET 
                  score_team1 = $score1, 
                  score_team2 = $score2, 
                  winner_id = $winner_id, 
                  mvp_player_id = $mvp_id,
                  status = 'completed'
                  WHERE id = $id";
        return mysqli_query($this->conn, $query);
    }
}
