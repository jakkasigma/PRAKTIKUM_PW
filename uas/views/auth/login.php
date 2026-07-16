<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tournament Bracket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-page">
    <div class="login-card-wrap fade-up">
        <div class="login-logo">
            <div class="login-brand-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
            </div>
            <h1>Tournament Bracket</h1>
            <p>Management System</p>
        </div>

        <div class="card card-accent">
            <div class="card-header">
                <div style="display:flex;align-items:center;gap:.75rem;">
                    <span class="header-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </span>
                    <div>
                        <h1 class="card-header-title">Masuk</h1>
                        <p class="card-header-desc">Login ke panel admin</p>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <?php $error = getFlashMessage('error'); ?>
                <?php if ($error): ?>
                    <div class="alert alert-error"><?= e($error) ?></div>
                <?php endif; ?>

                <form method="POST" action="?page=login&action=authenticate" id="login_form">
                    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </span>
                            <input type="text" name="username" class="form-input" placeholder="Masukkan username" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            </span>
                            <input type="password" name="password" id="login_password" class="form-input" placeholder="Masukkan password" required>
                            <button type="button" class="input-toggle-pass" onclick="togglePass()" tabindex="-1" aria-label="Tampilkan password">
                                <svg id="eye_icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg id="eye_off_icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100" id="login_btn">
                        <span class="btn-text">Masuk</span>
                        <span class="btn-spinner" style="display:none;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="spin"><circle cx="12" cy="12" r="10" stroke-dasharray="32" stroke-dashoffset="32"/></svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <div class="login-footer">
            <a href="?page=public" class="login-public-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                Lihat Bracket Publik
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </div>

    <script>
    function togglePass() {
        var p = document.getElementById('login_password');
        var e = document.getElementById('eye_icon');
        var o = document.getElementById('eye_off_icon');
        if (p.type === 'password') {
            p.type = 'text';
            e.style.display = 'none';
            o.style.display = 'inline';
        } else {
            p.type = 'password';
            e.style.display = 'inline';
            o.style.display = 'none';
        }
    }

    document.getElementById('login_form').addEventListener('submit', function() {
        var btn = document.getElementById('login_btn');
        btn.disabled = true;
        btn.classList.add('loading');
        btn.querySelector('.btn-text').textContent = 'Memverifikasi...';
        btn.querySelector('.btn-spinner').style.display = 'inline';
    });
    </script>
</body>
</html>
