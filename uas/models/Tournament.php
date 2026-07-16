<?php
class Tournament {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $query = "SELECT t.*, 
                  (SELECT COUNT(*) FROM registrations WHERE tournament_id = t.id) as team_count,
                  (SELECT COUNT(*) FROM matches WHERE tournament_id = t.id) as match_count
                  FROM tournaments t ORDER BY t.created_at DESC";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getById($id) {
        $id = intval($id);
        $query = "SELECT t.*, tm.name as champion_name 
                  FROM tournaments t 
                  LEFT JOIN teams tm ON t.champion_team_id = tm.id 
                  WHERE t.id = $id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function getPublic() {
        $query = "SELECT t.*,
                  (SELECT COUNT(*) FROM registrations WHERE tournament_id = t.id) as team_count
                  FROM tournaments t 
                  WHERE t.status IN ('ongoing', 'completed') 
                  ORDER BY t.created_at DESC";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function create($data) {
        $name = mysqli_real_escape_string($this->conn, $data['name']);
        $description = mysqli_real_escape_string($this->conn, $data['description'] ?? '');
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $max_teams = intval($data['max_teams'] ?? 8);
        $status = $data['status'] ?? 'draft';

        $query = "INSERT INTO tournaments (name, description, start_date, end_date, max_teams, status)
                  VALUES ('$name', '$description', '$start_date', '$end_date', $max_teams, '$status')";
        return mysqli_query($this->conn, $query);
    }

    public function update($id, $data) {
        $id = intval($id);
        $name = mysqli_real_escape_string($this->conn, $data['name']);
        $description = mysqli_real_escape_string($this->conn, $data['description'] ?? '');
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $max_teams = intval($data['max_teams'] ?? 8);
        $status = $data['status'] ?? 'draft';

        $query = "UPDATE tournaments SET 
                  name = '$name', 
                  description = '$description', 
                  start_date = '$start_date', 
                  end_date = '$end_date', 
                  max_teams = $max_teams,
                  status = '$status'
                  WHERE id = $id";
        return mysqli_query($this->conn, $query);
    }

    public function delete($id) {
        $id = intval($id);
        $query = "DELETE FROM tournaments WHERE id = $id";
        return mysqli_query($this->conn, $query);
    }

    public function hasRegistrations($id) {
        $id = intval($id);
        $query = "SELECT COUNT(*) as count FROM registrations WHERE tournament_id = $id";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['count'] > 0;
    }

    public function hasMatches($id) {
        $id = intval($id);
        $query = "SELECT COUNT(*) as count FROM matches WHERE tournament_id = $id";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['count'] > 0;
    }
}
