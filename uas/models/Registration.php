<?php
class Registration {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getByTournament($tournament_id) {
        $tournament_id = intval($tournament_id);
        $query = "SELECT r.*, t.name as team_name, t.logo as team_logo
                  FROM registrations r 
                  JOIN teams t ON r.team_id = t.id 
                  WHERE r.tournament_id = $tournament_id 
                  ORDER BY t.name";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function create($tournament_id, $team_id) {
        $tournament_id = intval($tournament_id);
        $team_id = intval($team_id);
        $query = "INSERT INTO registrations (tournament_id, team_id) VALUES ($tournament_id, $team_id)";
        return mysqli_query($this->conn, $query);
    }

    public function delete($id) {
        $id = intval($id);
        $query = "DELETE FROM registrations WHERE id = $id";
        return mysqli_query($this->conn, $query);
    }

    public function isRegistered($tournament_id, $team_id) {
        $tournament_id = intval($tournament_id);
        $team_id = intval($team_id);
        $query = "SELECT id FROM registrations WHERE tournament_id = $tournament_id AND team_id = $team_id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result) > 0;
    }
}
