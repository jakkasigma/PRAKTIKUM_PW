<?php
class TournamentController {
    private $conn;
    private $model;

    public function __construct($conn) {
        $this->conn = $conn;
        require_once __DIR__ . '/../models/Tournament.php';
        $this->model = new Tournament($this->conn);
    }

    public function index() {
        $tournaments = $this->model->getAll();
        include __DIR__ . '/../views/tournament/list.php';
    }

    public function create() {
        include __DIR__ . '/../views/tournament/form.php';
    }

    public function store() {
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=tournament');
        }
        $data = $_POST;

        $errors = [];
        if (empty($data['name'])) $errors['name'] = 'Nama turnamen wajib diisi';
        if (empty($data['start_date'])) $errors['start_date'] = 'Tanggal mulai wajib diisi';
        if (empty($data['end_date'])) $errors['end_date'] = 'Tanggal selesai wajib diisi';
        if (!empty($data['start_date']) && !empty($data['end_date']) && strtotime($data['start_date']) > strtotime($data['end_date'])) {
            $errors['end_date'] = 'Tanggal selesai harus setelah tanggal mulai';
        }

        if (!empty($errors)) {
            saveOldInput();
            setFlashMessage('errors', $errors);
            setFlashMessage('error', 'Mohon perbaiki data yang salah');
            redirect('?page=tournament&action=create');
        }

        if ($this->model->create($data)) {
            setFlashMessage('success', 'Tournament berhasil ditambahkan');
        } else {
            setFlashMessage('error', 'Gagal menambahkan tournament');
        }
        redirect('?page=tournament');
    }

    public function edit($id) {
        $tournament = $this->model->getById($id);
        if (!$tournament) {
            setFlashMessage('error', 'Tournament tidak ditemukan');
            redirect('?page=tournament');
        }
        include __DIR__ . '/../views/tournament/form.php';
    }

    public function update($id) {
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=tournament');
        }
        $data = $_POST;

        $errors = [];
        if (empty($data['name'])) $errors['name'] = 'Nama turnamen wajib diisi';
        if (empty($data['start_date'])) $errors['start_date'] = 'Tanggal mulai wajib diisi';
        if (empty($data['end_date'])) $errors['end_date'] = 'Tanggal selesai wajib diisi';
        if (!empty($data['start_date']) && !empty($data['end_date']) && strtotime($data['start_date']) > strtotime($data['end_date'])) {
            $errors['end_date'] = 'Tanggal selesai harus setelah tanggal mulai';
        }

        if (!empty($errors)) {
            saveOldInput();
            setFlashMessage('errors', $errors);
            setFlashMessage('error', 'Mohon perbaiki data yang salah');
            redirect("?page=tournament&action=edit&id=$id");
        }

        $existing = $this->model->getById($id);
        $data['status'] = $data['status'] ?? $existing['status'];

        if ($this->model->update($id, $data)) {
            setFlashMessage('success', 'Tournament berhasil diupdate');
        } else {
            setFlashMessage('error', 'Gagal mengupdate tournament');
        }
        redirect('?page=tournament');
    }

    public function delete($id) {
        if (!verify_csrf_token($_GET['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=tournament');
        }

        $conn = $this->conn;
        mysqli_query($conn, "DELETE FROM matches WHERE tournament_id = " . intval($id));
        mysqli_query($conn, "DELETE FROM registrations WHERE tournament_id = " . intval($id));

        if ($this->model->delete($id)) {
            setFlashMessage('success', 'Tournament berhasil dihapus');
        } else {
            setFlashMessage('error', 'Gagal menghapus tournament');
        }
        redirect('?page=tournament');
    }

    public function detail($id) {
        $tournament = $this->model->getById($id);
        if (!$tournament) {
            setFlashMessage('error', 'Tournament tidak ditemukan');
            redirect('?page=tournament');
        }

        require_once __DIR__ . '/../models/Registration.php';
        $regModel = new Registration($this->conn);
        $registrations = $regModel->getByTournament($id);
        $registered_ids = array_column($registrations, 'team_id');

        $has_matches = $this->model->hasMatches($id);

        require_once __DIR__ . '/../models/Team.php';
        $teamModel = new Team($this->conn);
        $all_teams = $teamModel->getAllForDropdown();
        $available_teams = array_filter($all_teams, function($t) use ($registered_ids) {
            return !in_array($t['id'], $registered_ids);
        });
        $slot_available = $tournament['max_teams'] - count($registrations);

        require_once __DIR__ . '/../models/MatchModel.php';
        $matchModel = new MatchModel($this->conn);
        $matches = $matchModel->getByTournament($id);
        $total_rounds = $matchModel->getTotalRounds($id);

        $tab = $_GET['tab'] ?? 'detail';

        include __DIR__ . '/../views/tournament/detail.php';
    }

    public function pdf($id) {
        require_once __DIR__ . '/../vendor/autoload.php';

        $tournament = $this->model->getById($id);
        if (!$tournament) {
            setFlashMessage('error', 'Tournament tidak ditemukan');
            redirect('?page=tournament');
        }

        require_once __DIR__ . '/../models/Registration.php';
        require_once __DIR__ . '/../models/MatchModel.php';
        $matchModel = new MatchModel($this->conn);
        $matches = $matchModel->getByTournament($id);
        $total_rounds = $matchModel->getTotalRounds($id);

        $matches_by_round = [];
        foreach ($matches as $m) {
            $matches_by_round[$m['round']][] = $m;
        }
        $round_labels = getRoundLabels($total_rounds);

        ob_start();
        include __DIR__ . '/../views/tournament/pdf.php';
        $html = ob_get_clean();

        $options = new \Dompdf\Options();
        $options->setDpi(72);
        $dompdf = new Dompdf\Dompdf($options);
        $slot = (int)$tournament['max_teams'];
        if ($slot <= 8) {
            $dompdf->setPaper('A4', 'landscape');
        } elseif ($slot == 16) {
            $dompdf->setPaper('A3', 'landscape');
        } else {
            $dompdf->setPaper('A2', 'landscape');
        }
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream("bracket-{$tournament['name']}.pdf", ['Attachment' => false]);
        exit;
    }

    public function addTeam($id) {
        $tournament = $this->model->getById($id);
        if (!$tournament) {
            setFlashMessage('error', 'Tournament tidak ditemukan');
            redirect('?page=tournament');
        }

        if ($this->model->hasMatches($id)) {
            setFlashMessage('error', 'Bracket sudah digenerate, tidak bisa menambah tim');
            redirect("?page=tournament&action=detail&id=$id");
        }

        require_once __DIR__ . '/../models/Registration.php';
        $regModel = new Registration($this->conn);
        $registrations = $regModel->getByTournament($id);
        $slot_available = $tournament['max_teams'] - count($registrations);

        if ($slot_available <= 0) {
            setFlashMessage('error', 'Slot turnamen sudah penuh (max ' . $tournament['max_teams'] . ' tim)');
            redirect("?page=tournament&action=detail&id=$id");
        }

        include __DIR__ . '/../views/tournament/add_team.php';
    }

    public function storeTeam($id) {
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect("?page=tournament&action=detail&id=$id");
        }
        $tournament = $this->model->getById($id);
        if (!$tournament) {
            setFlashMessage('error', 'Tournament tidak ditemukan');
            redirect('?page=tournament');
        }

        if ($this->model->hasMatches($id)) {
            setFlashMessage('error', 'Bracket sudah digenerate, tidak bisa menambah tim');
            redirect("?page=tournament&action=detail&id=$id");
        }

        $data = $_POST;

        $errors = [];
        if (empty($data['name'])) $errors['name'] = 'Nama tim wajib diisi';

        require_once __DIR__ . '/../models/Team.php';
        $teamModel = new Team($this->conn);

        if ($teamModel->nameExists($data['name'])) {
            $errors['name'] = 'Nama tim sudah ada';
        }

        if (!empty($errors)) {
            saveOldInput();
            setFlashMessage('errors', $errors);
            setFlashMessage('error', 'Mohon perbaiki data yang salah');
            redirect("?page=tournament&action=addteam&id=$id");
        }

        require_once __DIR__ . '/../models/Registration.php';
        $regModel = new Registration($this->conn);
        $registrations = $regModel->getByTournament($id);
        $slot_available = $tournament['max_teams'] - count($registrations);
        if ($slot_available <= 0) {
            setFlashMessage('error', 'Slot turnamen sudah penuh');
            redirect("?page=tournament&action=detail&id=$id");
        }

        $conn = $this->conn;
        mysqli_begin_transaction($conn);
        try {
            $team_id = $teamModel->create($data);
            if (!$team_id) throw new Exception('Gagal membuat tim');

            $reg_result = $regModel->create($id, $team_id);
            if (!$reg_result) throw new Exception('Gagal registrasi tim');

            $players = $data['players'] ?? [];
            if (!empty($players['nickname'])) {
                require_once __DIR__ . '/../models/Player.php';
                $playerModel = new Player($this->conn);
                foreach ($players['nickname'] as $i => $nickname) {
                    if (empty(trim($nickname))) continue;
                    $player_data = [
                        'name' => $nickname,
                        'nickname' => $nickname,
                        'role' => $players['role'][$i] ?? '',
                        'team_id' => $team_id,
                    ];
                    $p_result = $playerModel->create($player_data);
                    if (!$p_result) throw new Exception('Gagal menambah pemain');
                }
            }

            mysqli_commit($conn);
            setFlashMessage('success', 'Tim ' . $data['name'] . ' beserta anggota berhasil ditambahkan');
        } catch (Exception $e) {
            mysqli_rollback($conn);
            setFlashMessage('error', $e->getMessage());
        }

        redirect("?page=tournament&action=detail&id=$id");
    }
}
