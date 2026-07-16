<?php
class Team {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT t.*,
                  (SELECT COUNT(*) FROM players WHERE team_id = t.id) as player_count
                  FROM teams t ORDER BY t.created_at DESC";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getById($id) {
        $id = intval($id);
        $query = "SELECT * FROM teams WHERE id = $id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function create($data) {
        $name = mysqli_real_escape_string($this->conn, $data['name']);
        $description = mysqli_real_escape_string($this->conn, $data['description'] ?? '');
        $query = "INSERT INTO teams (name, description) VALUES ('$name', '$description')";
        $result = mysqli_query($this->conn, $query);
        if ($result) return mysqli_insert_id($this->conn);
        return false;
    }

    public function update($id, $data) {
        $id = intval($id);
        $name = mysqli_real_escape_string($this->conn, $data['name']);
        $description = mysqli_real_escape_string($this->conn, $data['description'] ?? '');
        $query = "UPDATE teams SET name = '$name', description = '$description' WHERE id = $id";
        return mysqli_query($this->conn, $query);
    }

    public function delete($id) {
        $id = intval($id);
        $query = "DELETE FROM teams WHERE id = $id";
        return mysqli_query($this->conn, $query);
    }

    public function hasPlayers($id) {
        $id = intval($id);
        $query = "SELECT COUNT(*) as count FROM players WHERE team_id = $id";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['count'] > 0;
    }

    public function getAllForDropdown() {
        $query = "SELECT id, name FROM teams ORDER BY name";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function nameExists($name, $exclude_id = null) {
        $name = mysqli_real_escape_string($this->conn, $name);
        $query = "SELECT id FROM teams WHERE name = '$name'";
        if ($exclude_id) {
            $exclude_id = intval($exclude_id);
            $query .= " AND id != $exclude_id";
        }
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result) > 0;
    }
}
