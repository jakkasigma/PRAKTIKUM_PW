<?php
class PlayerController {
    private $conn;
    private $model;

    public function __construct($conn) {
        $this->conn = $conn;
        require_once __DIR__ . '/../models/Player.php';
        require_once __DIR__ . '/../models/Team.php';
        $this->model = new Player($this->conn);
    }

    public function index() {
        $players = $this->model->getAll();
        include __DIR__ . '/../views/player/list.php';
    }

    public function create() {
        $teamModel = new Team($this->conn);
        $teams = $teamModel->getAllForDropdown();
        $selected_team_id = $_GET['team_id'] ?? null;
        include __DIR__ . '/../views/player/form.php';
    }

    public function store() {
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=player');
        }
        $data = $_POST;

        $errors = [];
        if (empty($data['name'])) $errors['name'] = 'Nama pemain wajib diisi';

        if (!empty($errors)) {
            saveOldInput();
            setFlashMessage('errors', $errors);
            setFlashMessage('error', 'Mohon perbaiki data yang salah');
            redirect('?page=player&action=create');
        }

        if ($this->model->create($data)) {
            setFlashMessage('success', 'Pemain berhasil ditambahkan');
        } else {
            setFlashMessage('error', 'Gagal menambahkan pemain');
        }
        redirect('?page=player');
    }

    public function edit($id) {
        $player = $this->model->getById($id);
        if (!$player) {
            setFlashMessage('error', 'Pemain tidak ditemukan');
            redirect('?page=player');
        }
        $teamModel = new Team($this->conn);
        $teams = $teamModel->getAllForDropdown();
        include __DIR__ . '/../views/player/form.php';
    }

    public function update($id) {
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=player');
        }
        $data = $_POST;

        $errors = [];
        if (empty($data['name'])) $errors['name'] = 'Nama pemain wajib diisi';

        if (!empty($errors)) {
            saveOldInput();
            setFlashMessage('errors', $errors);
            setFlashMessage('error', 'Mohon perbaiki data yang salah');
            redirect("?page=player&action=edit&id=$id");
        }

        if ($this->model->update($id, $data)) {
            setFlashMessage('success', 'Pemain berhasil diupdate');
        } else {
            setFlashMessage('error', 'Gagal mengupdate pemain');
        }
        redirect('?page=player');
    }

    public function delete($id) {
        if (!verify_csrf_token($_GET['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=player');
        }
        if ($this->model->delete($id)) {
            setFlashMessage('success', 'Pemain berhasil dihapus');
        } else {
            setFlashMessage('error', 'Gagal menghapus pemain');
        }
        redirect('?page=player');
    }
}
