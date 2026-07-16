<?php
class DashboardController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function index() {
        $tournament_count = 0;
        $team_count = 0;
        $player_count = 0;
        $match_count = 0;

        $result = mysqli_query($this->conn, "SELECT COUNT(*) as c FROM tournaments");
        if ($result) $tournament_count = mysqli_fetch_assoc($result)['c'];

        $result = mysqli_query($this->conn, "SELECT COUNT(*) as c FROM teams");
        if ($result) $team_count = mysqli_fetch_assoc($result)['c'];

        $result = mysqli_query($this->conn, "SELECT COUNT(*) as c FROM players");
        if ($result) $player_count = mysqli_fetch_assoc($result)['c'];

        $result = mysqli_query($this->conn, "SELECT COUNT(*) as c FROM matches WHERE status = 'completed'");
        if ($result) $match_count = mysqli_fetch_assoc($result)['c'];

        $recent_tournaments = [];
        $result = mysqli_query($this->conn, "SELECT * FROM tournaments ORDER BY created_at DESC LIMIT 5");
        if ($result) $recent_tournaments = mysqli_fetch_all($result, MYSQLI_ASSOC);

        include __DIR__ . '/../views/dashboard/index.php';
    }
}
