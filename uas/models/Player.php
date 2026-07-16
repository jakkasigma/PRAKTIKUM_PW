<?php
class Player {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT p.*, t.name as team_name 
                  FROM players p 
                  LEFT JOIN teams t ON p.team_id = t.id 
                  ORDER BY p.created_at DESC";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getById($id) {
        $id = intval($id);
        $query = "SELECT p.*, t.name as team_name 
                  FROM players p 
                  LEFT JOIN teams t ON p.team_id = t.id 
                  WHERE p.id = $id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function getByTeam($team_id) {
        $team_id = intval($team_id);
        $query = "SELECT * FROM players WHERE team_id = $team_id ORDER BY name";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function create($data) {
        $name = mysqli_real_escape_string($this->conn, $data['name']);
        $nickname = mysqli_real_escape_string($this->conn, $data['nickname'] ?? '');
        $role = mysqli_real_escape_string($this->conn, $data['role'] ?? '');
        $team_id = $data['team_id'] ? intval($data['team_id']) : 'NULL';

        $query = "INSERT INTO players (name, nickname, role, team_id) 
                  VALUES ('$name', '$nickname', '$role', $team_id)";
        $result = mysqli_query($this->conn, $query);
        if ($result) return mysqli_insert_id($this->conn);
        return false;
    }

    public function update($id, $data) {
        $id = intval($id);
        $name = mysqli_real_escape_string($this->conn, $data['name']);
        $nickname = mysqli_real_escape_string($this->conn, $data['nickname'] ?? '');
        $role = mysqli_real_escape_string($this->conn, $data['role'] ?? '');
        $team_id = $data['team_id'] ? intval($data['team_id']) : 'NULL';

        $query = "UPDATE players SET 
                  name = '$name', 
                  nickname = '$nickname', 
                  role = '$role', 
                  team_id = $team_id
                  WHERE id = $id";
        return mysqli_query($this->conn, $query);
    }

    public function delete($id) {
        $id = intval($id);
        $query = "DELETE FROM players WHERE id = $id";
        return mysqli_query($this->conn, $query);
    }
}
