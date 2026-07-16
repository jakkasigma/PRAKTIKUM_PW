<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/auth.php';
require_once __DIR__ . '/../helpers/functions.php';
require_once __DIR__ . '/../helpers/validation.php';
require_once __DIR__ . '/../helpers/bracket.php';

$page = $_GET['page'] ?? 'login';
$action = $_GET['action'] ?? 'index';

$path = explode('/', trim($page, '/'));
if (count($path) > 1) {
    $page = $path[0];
    if (!isset($_GET['action'])) $action = $path[1] ?? 'index';
    if (!isset($_GET['id'])) $_GET['id'] = $path[2] ?? null;
}

if ($page !== 'public' && $page !== 'login') {
    redirectIfNotLoggedIn();
}

switch ($page) {
    case 'login':
        require_once __DIR__ . '/../controllers/AuthController.php';
        $controller = new AuthController($conn);
        if ($action === 'authenticate') {
            $controller->authenticate();
        } else {
            $controller->index();
        }
        break;

    case 'logout':
        logout();
        break;

    case 'dashboard':
        require_once __DIR__ . '/../controllers/DashboardController.php';
        $controller = new DashboardController($conn);
        $controller->index();
        break;

    case 'tournament':
        require_once __DIR__ . '/../controllers/TournamentController.php';
        $controller = new TournamentController($conn);
        $id = $_GET['id'] ?? null;
        switch ($action) {
            case 'create': $controller->create(); break;
            case 'store': $controller->store(); break;
            case 'edit': $controller->edit($id); break;
            case 'update': $controller->update($id); break;
            case 'delete': $controller->delete($id); break;
            case 'detail': $controller->detail($id); break;
            case 'addteam': $controller->addTeam($id); break;
            case 'storeteam': $controller->storeTeam($id); break;
            case 'pdf': $controller->pdf($id); break;
            default: $controller->index(); break;
        }
        break;

    case 'team':
        require_once __DIR__ . '/../controllers/TeamController.php';
        $controller = new TeamController($conn);
        $id = $_GET['id'] ?? null;
        switch ($action) {
            case 'create': $controller->create(); break;
            case 'store': $controller->store(); break;
            case 'edit': $controller->edit($id); break;
            case 'update': $controller->update($id); break;
            case 'delete': $controller->delete($id); break;
            case 'detail': $controller->detail($id); break;
            default: $controller->index(); break;
        }
        break;

    case 'player':
        require_once __DIR__ . '/../controllers/PlayerController.php';
        $controller = new PlayerController($conn);
        $id = $_GET['id'] ?? null;
        switch ($action) {
            case 'create': $controller->create(); break;
            case 'store': $controller->store(); break;
            case 'edit': $controller->edit($id); break;
            case 'update': $controller->update($id); break;
            case 'delete': $controller->delete($id); break;
            default: $controller->index(); break;
        }
        break;

    case 'register':
        require_once __DIR__ . '/../controllers/RegistrationController.php';
        $controller = new RegistrationController($conn);
        $id = $_GET['id'] ?? null;
        switch ($action) {
            case 'store': $controller->store(); break;
            case 'delete': $controller->delete($id); break;
            default: $controller->create(); break;
        }
        break;

    case 'registrations':
        require_once __DIR__ . '/../controllers/RegistrationController.php';
        $controller = new RegistrationController($conn);
        $id = $_GET['id'] ?? null;
        switch ($action) {
            case 'manage': $controller->manage($id); break;
            default: $controller->index(); break;
        }
        break;

    case 'match':
        require_once __DIR__ . '/../controllers/MatchController.php';
        $controller = new MatchController($conn);
        $id = $_GET['id'] ?? null;
        switch ($action) {
            case 'save': $controller->save($id); break;
            case 'generate': $controller->generate($_GET['tournament_id'] ?? null); break;
            case 'reset': $controller->reset($_GET['tournament_id'] ?? null); break;
            default: $controller->input($id); break;
        }
        break;

    case 'public':
        require_once __DIR__ . '/../controllers/PublicController.php';
        $controller = new PublicController($conn);
        $id = $_GET['id'] ?? null;
        switch ($action) {
            case 'bracket': $controller->bracket($id); break;
            case 'detail': $controller->detail($id); break;
            default: $controller->index(); break;
        }
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        echo '<h1 class="text-2xl font-bold text-center mt-20">404 - Halaman Tidak Ditemukan</h1>';
        break;
}
