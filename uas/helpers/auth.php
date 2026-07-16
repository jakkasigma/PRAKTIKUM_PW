<?php
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header('Location: ?page=login');
        exit;
    }
}

function login($conn, $username, $password) {
    $username = mysqli_real_escape_string($conn, $username);
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 0) {
        return false;
    }

    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    }

    return false;
}

function logout() {
    session_destroy();
    header('Location: ?page=login');
    exit;
}
