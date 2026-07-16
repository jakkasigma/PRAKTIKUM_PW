<?php
class RegistrationController {
    private $conn;
    private $model;

    public function __construct($conn) {
        $this->conn = $conn;
        require_once __DIR__ . '/../models/Registration.php';
        require_once __DIR__ . '/../models/Tournament.php';
        require_once __DIR__ . '/../models/Team.php';
        $this->model = new Registration($this->conn);
    }

    public function create() {
        $tournament_id = $_GET['tournament_id'] ?? null;
        if ($tournament_id) {
            redirect("?page=registrations&action=manage&id=$tournament_id");
        }
        redirect('?page=registrations');
    }

    public function store() {
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=tournament');
        }
        $tournament_id = $_POST['tournament_id'] ?? null;
        $team_id = $_POST['team_id'] ?? null;

        if (!$tournament_id || !$team_id) {
            setFlashMessage('error', 'Data tidak lengkap');
            redirect('?page=tournament');
        }

        if ($this->model->isRegistered($tournament_id, $team_id)) {
            setFlashMessage('error', 'Tim sudah terdaftar di turnamen ini');
            redirect("?page=tournament&action=detail&id=$tournament_id&tab=detail");
        }

        if ($this->model->create($tournament_id, $team_id)) {
            setFlashMessage('success', 'Tim berhasil didaftarkan');
        } else {
            setFlashMessage('error', 'Gagal mendaftarkan tim');
        }
        redirect("?page=tournament&action=detail&id=$tournament_id&tab=detail");
    }

    public function delete($id) {
        if (!verify_csrf_token($_GET['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=tournament');
        }
        $reg = null;
        if ($id) {
            $result = mysqli_query($this->conn, "SELECT tournament_id FROM registrations WHERE id = " . intval($id));
            $reg = mysqli_fetch_assoc($result);
        }

        if ($this->model->delete($id)) {
            setFlashMessage('success', 'Registrasi berhasil dihapus');
        } else {
            setFlashMessage('error', 'Gagal menghapus registrasi');
        }

        $tid = $reg['tournament_id'] ?? 0;
        redirect("?page=tournament&action=detail&id=$tid&tab=detail");
    }

    public function index() {
        require_once __DIR__ . '/../models/Tournament.php';
        $tournamentModel = new Tournament($this->conn);
        $tournaments = $tournamentModel->getAll();

        $data = [];
        foreach ($tournaments as $t) {
            $regs = $this->model->getByTournament($t['id']);
            $data[] = [
                'tournament' => $t,
                'registrations' => $regs,
            ];
        }

        include __DIR__ . '/../views/registration/list.php';
    }

    public function manage($tournament_id) {
        if (!$tournament_id) {
            setFlashMessage('error', 'Tournament tidak ditemukan');
            redirect('?page=registrations');
        }

        require_once __DIR__ . '/../models/Tournament.php';
        $tournamentModel = new Tournament($this->conn);
        $tournament = $tournamentModel->getById($tournament_id);

        if (!$tournament) {
            setFlashMessage('error', 'Tournament tidak ditemukan');
            redirect('?page=registrations');
        }

        $registrations = $this->model->getByTournament($tournament_id);
        $registered_ids = array_column($registrations, 'team_id');
        $slot_available = $tournament['max_teams'] - count($registrations);
        $has_matches = $tournamentModel->hasMatches($tournament_id);

        require_once __DIR__ . '/../models/Team.php';
        $teamModel = new Team($this->conn);
        $all_teams = $teamModel->getAllForDropdown();

        $available_teams = array_filter($all_teams, function($t) use ($registered_ids) {
            return !in_array($t['id'], $registered_ids);
        });

        include __DIR__ . '/../views/registration/manage.php';
    }
}
