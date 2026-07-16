<?php
function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect($url) {
    header("Location: $url");
    exit;
}

function setFlashMessage($key, $message) {
    $_SESSION[$key] = $message;
}

function getFlashMessage($key) {
    if (isset($_SESSION[$key])) {
        $message = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $message;
    }
    return null;
}

function old($key) {
    if (isset($_SESSION['old_input'][$key])) {
        $value = $_SESSION['old_input'][$key];
        unset($_SESSION['old_input'][$key]);
        return $value;
    }
    return '';
}

function saveOldInput() {
    $_SESSION['old_input'] = $_POST;
}

function formatDate($date) {
    if (!$date) return '-';
    return date('d M Y', strtotime($date));
}

function statusBadge($status) {
    $labels = ['draft' => 'Draft', 'ongoing' => 'Berlangsung', 'completed' => 'Selesai'];
    $label = $labels[$status] ?? $status;
    $class = 'badge badge-' . $status;
    return "<span class='$class'>$label</span>";
}

function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function nextPowerOfTwo($n) {
    $power = 1;
    while ($power < $n) {
        $power *= 2;
    }
    return $power;
}

function getRoundLabels($total_rounds) {
    $names = [];
    for ($r = 1; $r <= $total_rounds; $r++) {
        if ($r == $total_rounds) {
            $names[$r] = 'FINAL';
        } elseif ($r == $total_rounds - 1) {
            $names[$r] = 'SEMI FINAL';
        } elseif ($r == $total_rounds - 2) {
            $names[$r] = 'QUARTER FINAL';
        } else {
            $names[$r] = 'ROUND ' . $r;
        }
    }
    return $names;
}

function renderBracketConnectors($slot, $total_rounds) {
    $html = '';
    for ($r = 1; $r < $total_rounds; $r++) {
        $span = pow(2, $r);
        $matches_in_r = $slot / pow(2, $r);
        for ($m = 0; $m < $matches_in_r; $m++) {
            $top = $m * $span + 1;
            $bottom = $top + $span / 2 - 1;
            $mid = ($top + $bottom) / 2;
            $left = $r - 1;
            $html .= "<div style=\"grid-column:{$left};grid-row:{$top}/{$bottom};position:relative;\">
                        <div class=\"connector-v\" style=\"top:50%;bottom:0;right:calc(1rem + 1px);\"></div>
                      </div>";
        }
    }
    return $html;
}
