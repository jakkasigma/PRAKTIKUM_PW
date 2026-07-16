<?php
class TeamController {
    private $conn;
    private $model;

    public function __construct($conn) {
        $this->conn = $conn;
        require_once __DIR__ . '/../models/Team.php';
        $this->model = new Team($this->conn);
    }

    public function index() {
        $teams = $this->model->getAll();
        include __DIR__ . '/../views/team/list.php';
    }

    public function create() {
        include __DIR__ . '/../views/team/form.php';
    }

    public function store() {
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=team');
        }
        $data = $_POST;

        $errors = [];
        if (empty($data['name'])) $errors['name'] = 'Nama tim wajib diisi';

        if (validateUnique($this->conn, 'teams', 'name', $data['name'])) {
            $errors['name'] = 'Nama tim sudah ada';
        }

        if (!empty($errors)) {
            saveOldInput();
            setFlashMessage('errors', $errors);
            setFlashMessage('error', 'Mohon perbaiki data yang salah');
            redirect('?page=team&action=create');
        }

        if ($this->model->create($data)) {
            setFlashMessage('success', 'Tim berhasil ditambahkan');
        } else {
            setFlashMessage('error', 'Gagal menambahkan tim');
        }
        redirect('?page=team');
    }

    public function edit($id) {
        $team = $this->model->getById($id);
        if (!$team) {
            setFlashMessage('error', 'Tim tidak ditemukan');
            redirect('?page=team');
        }
        include __DIR__ . '/../views/team/form.php';
    }

    public function update($id) {
        if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=team');
        }
        $data = $_POST;

        $errors = [];
        if (empty($data['name'])) $errors['name'] = 'Nama tim wajib diisi';

        if (validateUnique($this->conn, 'teams', 'name', $data['name'], $id)) {
            $errors['name'] = 'Nama tim sudah ada';
        }

        if (!empty($errors)) {
            saveOldInput();
            setFlashMessage('errors', $errors);
            setFlashMessage('error', 'Mohon perbaiki data yang salah');
            redirect("?page=team&action=edit&id=$id");
        }

        if ($this->model->update($id, $data)) {
            setFlashMessage('success', 'Tim berhasil diupdate');
        } else {
            setFlashMessage('error', 'Gagal mengupdate tim');
        }
        redirect('?page=team');
    }

    public function delete($id) {
        if (!verify_csrf_token($_GET['csrf_token'] ?? '')) {
            setFlashMessage('error', 'Invalid session token');
            redirect('?page=team');
        }
        if ($this->model->hasPlayers($id)) {
            setFlashMessage('error', 'Tidak bisa hapus: tim masih memiliki pemain');
            redirect('?page=team');
        }

        if ($this->model->delete($id)) {
            setFlashMessage('success', 'Tim berhasil dihapus');
        } else {
            setFlashMessage('error', 'Gagal menghapus tim');
        }
        redirect('?page=team');
    }

    public function detail($id) {
        $team = $this->model->getById($id);
        if (!$team) {
            setFlashMessage('error', 'Tim tidak ditemukan');
            redirect('?page=tournament');
        }

        require_once __DIR__ . '/../models/Player.php';
        $playerModel = new Player($this->conn);
        $players = $playerModel->getByTeam($id);

        include __DIR__ . '/../views/team/detail.php';
    }
}
