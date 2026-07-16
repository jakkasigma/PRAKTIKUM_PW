<?php
class MatchController {
    private $conn;
    private $model;

    public function __construct($conn) {
        $this->conn = $conn;
        require_once __DIR__ . '/../models/MatchModel.php';
        require_once __DIR__ . '/../models/Player.php';
        require_once __DIR__ . '/../models/Registration.php';
        $this->model = new MatchModel($this->conn);
    }

    public function input($id) {
        $match = $this->model->getById($id);
        if (!$match) {
            setFlashMessage('error', 'Match tidak ditemukan');
            redirect('?page=tournament');
        }

        $playerModel = new Player($this->conn);
        $mvp_candidates = [];
        if ($match['team1_id']) {
            $mvp_candidates = array_merge($mvp_candidates, $playerModel->getByTeam($match['team1_id']));
        }
        if ($match['team2_id']) {
            $mvp_candidates = array_merge($mvp_candidates, $playerModel->getByTeam($match['team2_id']));
        }

        include __DIR__ . '/../views/match/form.php';
    }

    public function save($id) {
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=tournament');
        }
        $score1 = $_POST['score_team1'] ?? 0;
        $score2 = $_POST['score_team2'] ?? 0;
        $mvp_id = $_POST['mvp_player_id'] ?? null;

        $match = $this->model->getById($id);
        if (!$match) {
            setFlashMessage('error', 'Match tidak ditemukan');
            redirect('?page=tournament');
        }

        if ($score1 === $score2) {
            saveOldInput();
            setFlashMessage('error', 'Skor tidak boleh seri');
            redirect("?page=match&action=input&id=$id");
        }

        $winner_id = $score1 > $score2 ? $match['team1_id'] : $match['team2_id'];

        if ($mvp_id) {
            $playerModel = new Player($this->conn);
            $mvp = $playerModel->getById($mvp_id);
            if ($mvp && $mvp['team_id'] != $winner_id) {
                $mvp_id = null;
                setFlashMessage('error', 'MVP harus dari tim pemenang');
                saveOldInput();
                redirect("?page=match&action=input&id=$id");
            }
        }

        if ($this->model->updateScore($id, $score1, $score2, $winner_id, $mvp_id)) {
            require_once __DIR__ . '/../helpers/bracket.php';
            autoAdvanceWinner($this->conn, $id);
            setFlashMessage('success', 'Skor berhasil disimpan');
        } else {
            setFlashMessage('error', 'Gagal menyimpan skor');
        }

        redirect("?page=tournament&action=detail&id={$match['tournament_id']}");
    }

    public function generate($tournament_id) {
        if (!verify_csrf_token($_GET['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=tournament');
        }
        if (!$tournament_id) {
            setFlashMessage('error', 'Tournament tidak ditemukan');
            redirect('?page=tournament');
        }

        require_once __DIR__ . '/../models/Tournament.php';
        $tournamentModel = new Tournament($this->conn);
        $tournament = $tournamentModel->getById($tournament_id);

        if (!$tournament) {
            setFlashMessage('error', 'Tournament tidak ditemukan');
            redirect('?page=tournament');
        }

        if ($tournamentModel->hasMatches($tournament_id)) {
            setFlashMessage('error', 'Bracket sudah digenerate. Reset terlebih dahulu jika ingin generate ulang.');
            redirect("?page=tournament&action=detail&id=$tournament_id");
        }

        $regModel = new Registration($this->conn);
        $registrations = $regModel->getByTournament($tournament_id);

        if (count($registrations) < 2) {
            setFlashMessage('error', 'Minimal 2 tim terdaftar untuk generate bracket');
            redirect("?page=tournament&action=detail&id=$tournament_id");
        }

        $team_ids = array_column($registrations, 'team_id');

        require_once __DIR__ . '/../helpers/bracket.php';
        generateBracket($this->conn, $tournament_id, $team_ids, $tournament['max_teams']);

        $query = "UPDATE tournaments SET status = 'ongoing' WHERE id = " . intval($tournament_id);
        mysqli_query($this->conn, $query);

        setFlashMessage('success', 'Bracket berhasil digenerate!');
        redirect("?page=tournament&action=detail&id=$tournament_id");
    }

    public function reset($tournament_id) {
        if (!verify_csrf_token($_GET['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=tournament');
        }
        if (!$tournament_id) {
            setFlashMessage('error', 'Tournament tidak ditemukan');
            redirect('?page=tournament');
        }

        require_once __DIR__ . '/../helpers/bracket.php';
        resetBracket($this->conn, $tournament_id);

        setFlashMessage('success', 'Bracket berhasil direset');
        redirect("?page=tournament&action=detail&id=$tournament_id");
    }
}
