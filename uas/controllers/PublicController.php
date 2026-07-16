<?php
class PublicController {
    private $conn;
    private $model;

    public function __construct($conn) {
        $this->conn = $conn;
        require_once __DIR__ . '/../models/Tournament.php';
        require_once __DIR__ . '/../models/MatchModel.php';
        require_once __DIR__ . '/../models/Registration.php';
        $this->model = new Tournament($this->conn);
    }

    public function index() {
        $tournaments = $this->model->getPublic();
        include __DIR__ . '/../views/public/tournaments.php';
    }

    public function bracket($id) {
        $tournament = $this->model->getById($id);
        if (!$tournament) {
            echo '<h1 class="text-2xl text-white text-center mt-20">Tournament tidak ditemukan</h1>';
            return;
        }

        require_once __DIR__ . '/../models/MatchModel.php';
        $matchModel = new MatchModel($this->conn);
        $matches = $matchModel->getByTournament($id);
        $total_rounds = $matchModel->getTotalRounds($id);

        include __DIR__ . '/../views/public/bracket.php';
    }

    public function detail($id) {
        $tournament = $this->model->getById($id);
        if (!$tournament) {
            echo '<h1 class="text-2xl text-white text-center mt-20">Tournament tidak ditemukan</h1>';
            return;
        }

        $regModel = new Registration($this->conn);
        $registrations = $regModel->getByTournament($id);

        $matchModel = new MatchModel($this->conn);
        $matches = $matchModel->getByTournament($id);

        include __DIR__ . '/../views/public/bracket.php';
    }
}
